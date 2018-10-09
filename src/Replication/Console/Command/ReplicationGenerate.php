<?php

namespace Ls\Replication\Console\Command;


use Composer\Autoload\ClassLoader;
use Ls\Omni\Console\Command as OmniCommand;
use Ls\Omni\Service\Metadata as ServiceMetadata;
use Ls\Omni\Service\Service;
use Ls\Omni\Service\ServiceType;
use Ls\Omni\Service\Soap\Client;
use Ls\Omni\Service\Soap\Operation;
use Ls\Replication\Code\CronJobConfigGenerator;
use Ls\Replication\Code\CronJobGenerator;
use Ls\Replication\Code\CronTabGenerator;
use Ls\Replication\Code\ModelGenerator;
use Ls\Replication\Code\ModelInterfaceGenerator;
use Ls\Replication\Code\RepositoryGenerator;
use Ls\Replication\Code\RepositoryInterfaceGenerator;
use Ls\Replication\Code\ResourceCollectionGenerator;
use Ls\Replication\Code\ResourceModelGenerator;
use Ls\Replication\Code\SchemaUpdateGenerator;
use Ls\Replication\Code\SearchGenerator;
use Ls\Replication\Code\SearchInterfaceGenerator;
use Ls\Replication\Code\SystemConfigGenerator;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class ReplicationGenerate extends OmniCommand
{
    const COMMAND_NAME = 'replication:generate';
    const SYSTEM = 'system';
    const CRON = 'config';

    /** @var array  */
    private static $known_result_properties = ['LastKey', 'MaxKey', 'RecordsRemaining'];

    /** @var boolean */
    protected $system = FALSE;

    /** @var boolean */
    protected $cron = FALSE;

    /** @var ServiceMetadata */
    private $metadata;

    /** @var  ClassLoader */
    private $loader;

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @throws \Ls\Omni\Exception\InvalidServiceTypeException
     */
    protected function initialize(InputInterface $input, OutputInterface $output)
    {
        $this->type = ServiceType::ECOMMERCE();
        parent::initialize($input, $output);

        $client = new Client(Service::getUrl($this->type, $this->base_url), $this->type);
        $this->metadata = $client->getMetadata(TRUE);
        $this->system = !!$this->input->getOption(self::SYSTEM);
        $this->cron = !!$this->input->getOption(self::CRON);
        $this->loader = new \Composer\Autoload\ClassLoader; //new \Composer\Autoload\ClassLoader; //$GLOBALS[ 'loader' ];];
    }



    protected function configure()
    {
        $this->setName(self::COMMAND_NAME)
            ->setDescription('Generate replication related after running omni:client:generate')
            ->addOption(self::BASE_URL, 'b', InputOption::VALUE_OPTIONAL, 'omni service base url')
            ->addOption(self::CRON, 'c', InputOption::VALUE_OPTIONAL, 'display XML crontab configurations', FALSE)
            ->addOption(self::SYSTEM, 's', InputOption::VALUE_OPTIONAL, 'display XML system configurations', FALSE);
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        
        /** @var Operation $operation */
        foreach ($this->metadata->getOperations() as $operation_name => $operation) {
            if (strpos($operation_name, 'ReplEcomm') !== FALSE) {
                $this->processOperation($operation);
            }
        }

        CronTabGenerator::Generate($this->metadata);
        $this->output->writeln('- - - - - -');
    }

    /**
     * @param Operation $operation
     */
    private function processOperation(Operation $operation)
    {

        $replication_operation = $this->metadata->getReplicationOperationByName($operation->getName());

        try {
            if ($this->system) {
                $system_config_generator = new SystemConfigGenerator($replication_operation);
                //file_put_contents( $system_config_generator->getPath(), $system_config_generator->generate() );

                $this->output->writeln($system_config_generator->generate());
            } elseif ($this->cron) {
                $cron_job_config_generator = new CronJobConfigGenerator($replication_operation);
                $this->output->writeln($cron_job_config_generator->generate());
            } else {

                // SCHEMA UPDATE Ls/Replication/Setup/UpgradeSchema/$classname.php

                $schema_update_generator = new SchemaUpdateGenerator($replication_operation);
                file_put_contents($schema_update_generator->getPath(), $schema_update_generator->generate());


                // MODEL INTERFACE \\Ls\\Replication\\Api\\Data\$classname." ".Interface.php but not the search part
                $model_interface_generator = new ModelInterfaceGenerator($replication_operation);
                file_put_contents($replication_operation->getInterfacePath(TRUE),
                    $model_interface_generator->generate());


                // MODEL Pure Model classes Ls\Replication\Model\@classname.php
                $model_generator = new ModelGenerator($replication_operation);
                file_put_contents($replication_operation->getMainEntityPath(TRUE), $model_generator->generate());


                // REPOSITORY INTERFACE  /Ls/Replication/API/$classname.RepositoryInterface.php
                $repository_interface_generator = new RepositoryInterfaceGenerator($replication_operation);
                file_put_contents($replication_operation->getRepositoryInterfacePath(TRUE),
                    $repository_interface_generator->generate());

                // REPOSITORY Ls\Replication\Model\$classname.Repository.php
                $repository_generator = new RepositoryGenerator($replication_operation);
                file_put_contents($replication_operation->getRepositoryPath(TRUE),
                    $repository_generator->generate());


                // RESOURCE MODEL \\Ls\Replication\Model\ResourceModel\$classname.php

                $resource_model_generator = new ResourceModelGenerator($replication_operation);
                file_put_contents($replication_operation->getResourceModelPath(TRUE),
                    $resource_model_generator->generate());


                // RESOURCE COLLECTION \\Ls\Replication\Model\ResourceModel\$classname\Collection.php
                $resource_collection_generator = new ResourceCollectionGenerator($replication_operation);
                $resource_collection_generator->createPath();
                file_put_contents($replication_operation->getResourceCollectionPath(TRUE),
                    $resource_collection_generator->generate());


                // CRON JOB  \LS\Replication\Cron\$classname.php
                $cron_job_generator = new CronJobGenerator($replication_operation);
                file_put_contents($replication_operation->getJobPath(TRUE),
                    $cron_job_generator->generate());


                // SEARCH INTERFACE \Ls\Replication\API\Data\$classname.SearchResultInterface.php
                $search_interface_generator = new SearchInterfaceGenerator($replication_operation);
                file_put_contents($replication_operation->getSearchInterfacePath(TRUE),
                    $search_interface_generator->generate());
                // SEARCH MODEL
                $search_generator = new SearchGenerator($replication_operation);
                file_put_contents($replication_operation->getSearchPath(TRUE),
                    $search_generator->generate());
                $this->output->writeln('- - - -');
            }

        } catch (\Exception $e) {
            $this->output->writeln("\tSomething went wrong, please check log directory");
            $this->output->writeln($e->getMessage());
            $this->output->writeln('- - - -');
        }
    }
}