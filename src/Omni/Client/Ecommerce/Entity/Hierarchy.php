<?php
/**
 * THIS IS AN AUTOGENERATED FILE
 * DO NOT MODIFY
 * @codingStandardsIgnoreFile
 */


namespace Ls\Omni\Client\Ecommerce\Entity;

use Ls\Omni\Client\Ecommerce\Entity\Enum\HierarchyType;
use Ls\Omni\Exception\InvalidEnumException;

class Hierarchy extends Entity
{

    /**
     * @property ArrayOfHierarchyAttribute $Attributes
     */
    protected $Attributes = null;

    /**
     * @property ArrayOfHierarchyNode $Nodes
     */
    protected $Nodes = null;

    /**
     * @property string $Description
     */
    protected $Description = null;

    /**
     * @property HierarchyType $Type
     */
    protected $Type = null;

    /**
     * @param ArrayOfHierarchyAttribute $Attributes
     * @return $this
     */
    public function setAttributes($Attributes)
    {
        $this->Attributes = $Attributes;
        return $this;
    }

    /**
     * @return ArrayOfHierarchyAttribute
     */
    public function getAttributes()
    {
        return $this->Attributes;
    }

    /**
     * @param ArrayOfHierarchyNode $Nodes
     * @return $this
     */
    public function setNodes($Nodes)
    {
        $this->Nodes = $Nodes;
        return $this;
    }

    /**
     * @return ArrayOfHierarchyNode
     */
    public function getNodes()
    {
        return $this->Nodes;
    }

    /**
     * @param string $Description
     * @return $this
     */
    public function setDescription($Description)
    {
        $this->Description = $Description;
        return $this;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->Description;
    }

    /**
     * @param HierarchyType|string $Type
     * @return $this
     * @throws InvalidEnumException
     */
    public function setType($Type)
    {
        if ( ! $Type instanceof HierarchyType ) {
            if ( HierarchyType::isValid( $Type ) ) 
                $Type = new HierarchyType( $Type );
            elseif ( HierarchyType::isValidKey( $Type ) ) 
                $Type = new HierarchyType( constant( "HierarchyType::$Type" ) );
            elseif ( ! $Type instanceof HierarchyType )
                throw new InvalidEnumException();
        }
        $this->Type = $Type->getValue();

        return $this;
    }

    /**
     * @return HierarchyType
     */
    public function getType()
    {
        return $this->Type;
    }


}
