<?php
/**
 * Created by PhpStorm.
 * User: frank
 * Date: 19/10/14
 * Time: 12:33 PM
 */

namespace Acme\DynamicFormBundle\Entity;

use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Entity
 * @ORM\Table(name="field_constraint")
 */
class FieldConstraint {

    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    protected $constraintClass;

    /**
     * @ORM\Column(type="text")
     */
    protected $constraintParams;


    
    /**
     * @ORM\ManyToMany(targetEntity="Field", mappedBy="constraints")
     */
    protected $fields;


    public function getConstraintObject()
    {
        $className=$this->getConstraintClass();
        if($this->getConstraintParams())
        {
            $params=json_decode($this->getConstraintParams());
            return new $className((array)$params);
        }
        else{
            return new $className();
        }

    }

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
     * Set constraintClass
     *
     * @param string $constraintClass
     * @return FieldConstraint
     */
    public function setConstraintClass($constraintClass)
    {
        $this->constraintClass = $constraintClass;

        return $this;
    }

    /**
     * Get constraintClass
     *
     * @return string 
     */
    public function getConstraintClass()
    {
        return $this->constraintClass;
    }

    /**
     * Set constraintParams
     *
     * @param string $constraintParams
     * @return FieldConstraint
     */
    public function setConstraintParams($constraintParams)
    {
        $this->constraintParams = $constraintParams;

        return $this;
    }

    /**
     * Get constraintParams
     *
     * @return string 
     */
    public function getConstraintParams()
    {
        return $this->constraintParams;
    }

    /**
     * Set field
     *
     * @param \Acme\DynamicFormBundle\Entity\Field $field
     * @return FieldConstraint
     */
    public function setField(\Acme\DynamicFormBundle\Entity\Field $field = null)
    {
        $this->field = $field;

        return $this;
    }

    /**
     * Get field
     *
     * @return \Acme\DynamicFormBundle\Entity\Field 
     */
    public function getField()
    {
        return $this->field;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->fields = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add fields
     *
     * @param \Acme\DynamicFormBundle\Entity\Field $fields
     * @return FieldConstraint
     */
    public function addField(\Acme\DynamicFormBundle\Entity\Field $fields)
    {
        $this->fields[] = $fields;

        return $this;
    }

    /**
     * Remove fields
     *
     * @param \Acme\DynamicFormBundle\Entity\Field $fields
     */
    public function removeField(\Acme\DynamicFormBundle\Entity\Field $fields)
    {
        $this->fields->removeElement($fields);
    }

    /**
     * Get fields
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getFields()
    {
        return $this->fields;
    }
}
