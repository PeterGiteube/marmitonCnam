<?php

class Unit {
    private $idUnit;
    private $label;

    /**
     * @return mixed
     */
    public function getIdUnit()
    {
        return $this->idUnit;
    }

    /**
     * @param mixed $idUnit
     */
    public function setIdUnit($idUnit)
    {
        $this->idUnit = $idUnit;
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