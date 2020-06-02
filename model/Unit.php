<?php

class Unit {
    private $id;
    private $label;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->idUnit;
    }

    /**
     * @param mixed $idUnit
     */
    public function setId($id)
    {
        $this->idUnit = $id;
    }

    /**
     * @return mixed
     */
    public function getLabel()
    {
        return $this->label;
    }

    /**
     * @param mixed $label
     */
    public function setLabel($label)
    {
        $this->label = $label;
    }
}