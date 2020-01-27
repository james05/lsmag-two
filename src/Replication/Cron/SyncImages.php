<?php

namespace Ls\Replication\Cron;

use Exception;
use \Ls\Core\Model\LSR;
use \Ls\Replication\Model\ReplImageLink;
use \Ls\Replication\Model\ReplImageLinkSearchResults;
use Magento\Catalog\Api\Data\ProductInterface;
use Magento\Framework\Exception\InputException;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Exception\StateException;

/**
 * Class SyncInventory
 * @package Ls\Replication\Cron
 */
class SyncImages extends ProductCreateTask
{
    /** @var bool */
    public $cronStatus = false;

    /** @var int */
    public $remainingRecords;

    /**
     * @throws InputException
     */
    public function execute()
    {
        if ($this->lsr->isLSR()) {
            $this->replicationHelper->updateConfigValue(
                $this->replicationHelper->getDateTime(),
                LSR::SC_ITEM_IMAGES_CONFIG_PATH_LAST_EXECUTE
            );
            $this->replicationHelper->setEnvVariables();
            $this->logger->debug('Running SyncImages Task');

            $this->syncItemImages();

            $this->replicationHelper->updateCronStatus($this->cronStatus, LSR::SC_SUCCESS_CRON_ITEM_IMAGES);
            $this->logger->debug('End SyncImages Task');
        }
    }

    /**
     * @return array
     * @throws InputException
     */
    public function executeManually()
    {
        $this->execute();
        $remainingRecords = (int)$this->getRemainingRecords();
        return [$remainingRecords];
    }

    /**
     * @throws InputException
     */
    public function syncItemImages()
    {
        $batchSize = $this->replicationHelper->getProductImagesBatchSize();
        $sortOrder = $this->replicationHelper->getSortOrderObject();
        /** Get Images for only those items which are already processed */
        $filters  = [
            ['field' => 'main_table.TableName', 'value' => 'Item%', 'condition_type' => 'like'],
            ['field' => 'main_table.TableName', 'value' => 'Item Category', 'condition_type' => 'neq'],
            ['field' => 'second.processed', 'value' => 1, 'condition_type' => 'eq']
        ];
        $criteria = $this->replicationHelper->buildCriteriaForArrayWithAlias(
            $filters,
            $batchSize,
            false
        );

        /** @var  $collection */
        $collection = $this->replImageLinkCollectionFactory->create();

        /** we only need unique product Id's which has any images to modify */
        $this->replicationHelper->setCollectionPropertiesPlusJoin(
            $collection,
            $criteria,
            'KeyValue',
            'ls_replication_repl_item',
            'nav_id',
            true,
            true
        );
        $collection->getSelect()->order('main_table.processed ASC');
        if ($collection->getSize() > 0) {
            // right now the only thing we have to do is flush all the images and do it again.
            /** @var ReplImageLink $itemImage */
            foreach ($collection->getItems() as $itemImage) {
                $productImages = [];
                try {
                    $itemSku = $itemImage->getKeyValue();
                    $itemSku = str_replace(',', '-', $itemSku);
                    /* @var ProductInterface $productData */
                    $productData = $this->productRepository->get($itemSku, true, null, true);
                    // check for new images.
                    $filtersForAllImages  = [
                        ['field' => 'KeyValue', 'value' => $itemImage->getKeyValue(), 'condition_type' => 'eq'],
                        ['field' => 'TableName', 'value' => $itemImage->getTableName(), 'condition_type' => 'eq']
                    ];
                    $criteriaForAllImages = $this->replicationHelper->buildCriteriaForDirect(
                        $filtersForAllImages,
                        -1,
                        false
                    )->setSortOrders([$sortOrder]);
                    /** @var ReplImageLinkSearchResults $newImagestoProcess */
                    $newImagesToProcess = $this->replImageLinkRepositoryInterface->getList($criteriaForAllImages);
                    if ($newImagesToProcess->getTotalCount() > 0) {
                        $this->processMediaGalleryImages($newImagesToProcess, $productData);
                    }

                } catch (Exception $e) {
                    $this->logger->debug(
                        'Problem with Image Synchronization : ' . $itemImage->getKeyValue() . ' in ' . __METHOD__
                    );
                    $this->logger->debug($e->getMessage());
                    $itemImage->setData('processed_at', $this->replicationHelper->getDateTime());
                    $itemImage->setData('is_failed', 1);
                    $itemImage->setData('processed', 1);
                    $itemImage->setData('is_updated', 0);
                    // @codingStandardsIgnoreLine
                    $this->replImageLinkRepositoryInterface->save($itemImage);
                }
            }
            $remainingItems = (int)$this->getRemainingRecords();
            if ($remainingItems == 0) {
                $this->cronStatus = true;
            }
        } else {
            $this->cronStatus = true;
        }
    }

    /**
     * @return int
     */
    public function getRemainingRecords()
    {
        if (!$this->remainingRecords) {
            $filters  = [
                ['field' => 'main_table.TableName', 'value' => 'Item%', 'condition_type' => 'like'],
                ['field' => 'main_table.TableName', 'value' => 'Item Category', 'condition_type' => 'neq'],
                ['field' => 'second.processed', 'value' => 1, 'condition_type' => 'eq']
            ];
            $criteria = $this->replicationHelper->buildCriteriaForArrayWithAlias(
                $filters,
                -1,
                false
            );

            /** @var  $collection */
            $collection = $this->replImageLinkCollectionFactory->create();

            /** we only need unique product Id's which has any images to modify */
            $this->replicationHelper->setCollectionPropertiesPlusJoin(
                $collection,
                $criteria,
                'KeyValue',
                'ls_replication_repl_item',
                'nav_id',
                true,
                true
            );
            $this->remainingRecords = $collection->getSize();
        }
        return $this->remainingRecords;
    }

    /**
     * @param ReplImageLinkSearchResults $imagesToUpdate
     * @param ProductInterface $productData
     * @throws InputException
     * @throws LocalizedException
     * @throws StateException
     */
    public function processMediaGalleryImages($imagesToUpdate, $productData)
    {
        $encodedImages = [];
        try {
            $encodedImages = $this->getMediaGalleryEntries(
                $imagesToUpdate->getItems()
            );
        } catch (Exception $e) {
            $this->logger->debug(
                'Problem getting encoded Images in : ' . __METHOD__
            );
            $this->logger->debug($e->getMessage());
        }

        if (!empty($encodedImages)) {
            $encodedImages = $this->convertToRequiredFormat($encodedImages);
            $this->mediaGalleryProcessor->processMediaGallery(
                $productData,
                $encodedImages
            );
            $this->updateHandler->execute($productData);
        }
    }

    /**
     * @param array $mediaGalleryEntries
     * @return array
     * @throws LocalizedException
     */
    public function convertToRequiredFormat(array $mediaGalleryEntries)
    {
        $images = [];
        foreach ($mediaGalleryEntries as $entry) {
            $images[] = $this->entryConverterPool
                ->getConverterByMediaType($entry->getMediaType())
                ->convertFrom($entry);
        }
        return $images;
    }

    /** TODO reuse the logic and optimize the solution
     * DO NOT REMOVE THIS CODE
     */
    private function syncItemImagesOld()
    {
        $batchSize = $this->replicationHelper->getProductImagesBatchSize();
        /** Get Images for only those items which are already processed */
        $sortOrder = $this->replicationHelper->getSortOrderObject();
        $filters   = [
            ['field' => 'main_table.TableName', 'value' => 'Item', 'condition_type' => 'eq'],
            ['field' => 'second.processed', 'value' => 1, 'condition_type' => 'eq']
        ];
        $criteria  = $this->replicationHelper->buildCriteriaForArrayWithAlias(
            $filters,
            $batchSize,
            false
        );

        /** @var  $collection */
        $collection = $this->replImageLinkCollectionFactory->create();

        /** we only need unique product Id's which has any images to modify */
        $this->replicationHelper->setCollectionPropertiesPlusJoin(
            $collection,
            $criteria,
            'KeyValue',
            'ls_replication_repl_item',
            'nav_id',
            true
        );
        if ($collection->getSize() > 0) {
            /** @var ReplImageLink $itemImage */
            foreach ($collection->getItems() as $itemImage) {
                $productImages = [];
                $deletedImages = [];
                $newImages     = [];
                try {
                    $productData = $this->productRepository->get($itemImage->getKeyValue());
                    // get existing product images.
                    $productImages = $productData->getMediaGalleryEntries();
                    // check for deleted images.
                    $filtersforDeleted  = [
                        ['field' => 'KeyValue', 'value' => $itemImage->getKeyValue(), 'condition_type' => 'eq'],
                        ['field' => 'TableName', 'value' => $itemImage->getTableName(), 'condition_type' => 'eq'],
                        ['field' => 'IsDeleted', 'value' => 1, 'condition_type' => 'eq']

                    ];
                    $criteriaforDeleted = $this->replicationHelper->buildCriteriaForArray($filtersforDeleted, -1, false);
                    /** @var ReplImageLinkSearchResults $deletedImages */
                    $deletedImages = $this->replImageLinkRepositoryInterface->getList($criteriaforDeleted);
                    if ($deletedImages->getTotalCount() > 0) {
                        /** @var ReplImageLink $image */
                        foreach ($deletedImages->getItems() as $image) {
                            // check if deleted image is already in the loaded media galleries
                            if (!empty($productImages)) {
                                foreach ($productImages as $key => $existingImage) {
                                    /** here we can integrate all the  business logic to identify unique image,
                                     * right now we are doing it based on the image name
                                     **/
                                    $imagename = $this->replicationHelper->parseImageIdfromFile($existingImage->getFile());
                                    if ($imagename == $image->getImageId()) {
                                        $this->imageProcessor->removeImage($productData, $existingImage->getFile());
                                        unset($productImages[$key]);
                                    }
                                }
                            }
                            $image->setData('processed_at', $this->replicationHelper->getDateTime());
                            $image->setData('processed', 1);
                            $image->setData('is_updated', 0);
                            // @codingStandardsIgnoreLine
                            $this->replImageLinkRepositoryInterface->save($image);
                        }
                    }
                    // check for new images.
                    $filtersforNewOrUpdatedImages  = [
                        ['field' => 'KeyValue', 'value' => $itemImage->getKeyValue(), 'condition_type' => 'eq'],
                        ['field' => 'TableName', 'value' => $itemImage->getTableName(), 'condition_type' => 'eq']
                    ];
                    $criteriaforNewOrUpdatedImages = $this->replicationHelper->buildCriteriaForArray($filtersforNewOrUpdatedImages,
                        -1)
                        ->setSortOrders([$sortOrder]);

                    /** @var ReplImageLinkSearchResults $newImagestoProcess */
                    $newImagestoProcess = $this->replImageLinkRepositoryInterface->getList($criteriaforNewOrUpdatedImages);
                    if ($newImagestoProcess->getTotalCount() > 0) {
                        /** @var ReplImageLink $image */
                        $newImages = $this->getMediaGalleryEntries($newImagestoProcess->getItems(), $productImages);
                    }
                    // merge array of new Images into existing product images but
                    //TODO do not pass those new images which already exist in the product Images.
                    $productImages = array_merge($productImages, $newImages);
                    $productData->setMediaGalleryEntries($productImages);
                    $this->productRepository->save($productData);
                } catch (Exception $e) {
                    $this->logger->debug('Problem with Image Synchronization : ' . $itemImage->getKeyValue() . ' in ' . __METHOD__);
                    $this->logger->debug($e->getMessage());
                }
            }
        }
    }
}
