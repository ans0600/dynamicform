<?php
/**
 * Created by PhpStorm.
 * User: frank
 * Date: 19/10/14
 * Time: 4:20 PM
 */

namespace Acme\DynamicFormBundle\Entity;


use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Entity
 * @ORM\Table(name="field")
 */

class Field {


    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    protected $fieldName;

    /**
     * @ORM\Column(type="string", length=255)
     */
    protected $fieldLabel;

    /**
     * @ORM\Column(type="string", length=255)
     */
    protected $fieldType;

    /**
     * @ORM\Column(type="text")
     */
    protected $fieldInitialData;


    /**
     * @ORM\ManyToOne(targetEntity="Form", inversedBy="fields")
     * @ORM\JoinColumn(name="form_id", referencedColumnName="id")
     */
    protected $form;


    /**
     * @ORM\ManyToMany(targetEntity="FieldConstraint", inversedBy="$constraints")
     * @ORM\JoinTable(name="field_constraint_mapping")
     */
    protected $constraints;

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
     * Set fieldName
     *
     * @param string $fieldName
     * @return Field
     */
    public function setFieldName($fieldName)
    {
        $this->fieldName = $fieldName;

        return $this;
    }

    /**
     * Get fieldName
     *
     * @return string 
     */
    public function getFieldName()
    {
        return $this->fieldName;
    }

    /**
     * Set fieldLabel
     *
     * @param string $fieldLabel
     * @return Field
     */
    public function setFieldLabel($fieldLabel)
    {
        $this->fieldLabel = $fieldLabel;

        return $this;
    }

    /**
     * Get fieldLabel
     *
     * @return string 
     */
    public function getFieldLabel()
    {
        return $this->fieldLabel;
    }

    /**
     * Set fieldType
     *
     * @param string $fieldType
     * @return Field
     */
    public function setFieldType($fieldType)
    {
        $this->fieldType = $fieldType;

        return $this;
    }

    /**
     * Get fieldType
     *
     * @return string 
     */
    public function getFieldType()
    {
        return $this->fieldType;
    }

    /**
     * Set form
     *
     * @param \Acme\DynamicFormBundle\Entity\Form $form
     * @return Field
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
     * Constructor
     */
    public function __construct()
    {
        $this->constraints = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add constraints
     *
     * @param \Acme\DynamicFormBundle\Entity\FieldConstraint $constraints
     * @return Field
     */
    public function addConstraint(\Acme\DynamicFormBundle\Entity\FieldConstraint $constraints)
    {
        $this->constraints[] = $constraints;

        return $this;
    }

    /**
     * Remove constraints
     *
     * @param \Acme\DynamicFormBundle\Entity\FieldConstraint $constraints
     */
    public function removeConstraint(\Acme\DynamicFormBundle\Entity\FieldConstraint $constraints)
    {
        $this->constraints->removeElement($constraints);
    }

    /**
     * Get constraints
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getConstraints()
    {
        return $this->constraints;
    }

    /**
     * Set fieldInitialData
     *
     * @param string $fieldInitialData
     * @return Field
     */
    public function setFieldInitialData($fieldInitialData)
    {
        $this->fieldInitialData = $fieldInitialData;

        return $this;
    }

    /**
     * Get fieldInitialData
     *
     * @return string 
     */
    public function getFieldInitialData()
    {
        return $this->fieldInitialData;
    }
}
