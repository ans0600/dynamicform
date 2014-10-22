<?php

namespace Acme\DynamicFormBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Config\Definition\Exception\Exception;


/**
 * @ORM\Entity
 * @ORM\Table(name="form_data")
 */

class FormData {

    const GENERATE_STRATEGY = 'IDENTITY';

    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\OneToOne(targetEntity="Form", inversedBy="formData")
     * @ORM\JoinColumn(name="form_id", referencedColumnName="id")
     **/
    protected $form;


    /**
     * Field schematic - JSON encoded
     *
     * @ORM\Column(type="text")
     */
    protected $schematic;

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set schematic
     *
     * @param string $schematic
     * @return FormData
     */
    public function setSchematic($schematic)
    {
        $this->schematic = $schematic;

        return $this;
    }

    /**
     * Get schematic
     *
     * @return string 
     */
    public function getSchematic()
    {
        return $this->schematic;
    }

    /**
     * Set form
     *
     * @param \Acme\DynamicFormBundle\Entity\Form $form
     * @return FormData
     */
    public function setForm(\Acme\DynamicFormBundle\Entity\Form $form = null)
    {
        $this->form = $form;

        return $this;
    }

    /**
     * Get form
     *
     * @return \Acme\DynamicFormBundle\Entity\Form 
     */
    public function getForm()
    {
        return $this->form;
    }

    /**
     *  Get
     */
    public function getFields()
    {
        try{
            $schematicObj=json_decode($this->getSchematic());
            return (array)$schematicObj;

        }catch (\Exception $e)
        {

        }
        return array();

    }

    /**
     * Get the dynamically generated entity class name for this metric
     *
     * @return string
     */
    public function getEntityClassName()
    {
        return '\\Acme\\DynamicFormBundle\\DynamicEntity\\form_'.$this->getForm()->getId();
    }

    /**
     * Build the ORM metadata for this object
     * @param null $metadata
     * @return ORM\ClassMetadata
     */
    public function buildItemClassMetadata($metadata = null)
    {
        $name="form_".$this->getForm()->getId();

        if (!$metadata) $metadata = new \Doctrine\ORM\Mapping\ClassMetadata($name);

        $builder = new ORM\Builder\ClassMetadataBuilder($metadata);
        $builder->setTable($name);
        $builder->createField('id', 'bigint')->isPrimaryKey()->generatedValue(static::GENERATE_STRATEGY)->build();

        $fields=$this->getFields();

        foreach($fields as $f)
        {
            $fieldType=property_exists($f,'type')?$f->type:null;
            $fieldName=property_exists($f,'name')?$f->name:null;

            if($fieldType&&$fieldName)
            {
                //TODO git rid of switch
                switch ($fieldType)
                {
                    case 'integer':
                        $builder->createField($fieldName, $fieldType)->nullable()->build();
                        break;
                    case 'string':
                        //TODO hard code length for now
                        $builder->createField($fieldName, $fieldType)->nullable()->length(255)->build();
                        break;

                }

            }

        }

        $builder->addField('ctime', 'datetime');
        return $builder->getClassMetadata();
    }
}
