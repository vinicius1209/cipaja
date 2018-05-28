<?php

class NegocioEntity implements JsonSerializable
{
    private $area;
    private $id;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     * @return NegocioEntity
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getArea()
    {
        return $this->area;
    }

    /**
     * @param mixed $area
     * @return NegocioEntity
     */
    public function setArea($area)
    {
        $this->area = $area;
        return $this;
    }

    public function jsonSerialize()
    {
        return [
            "area" => $this->area
        ];
    }

}