<?php


class GuitarSpec
{
public $builder, $model, $type, $numStrings, $backWood, $topWood;



function __construct($builder, $model, $type, $numStrings, $backWood, $topWood)
{
    $this->builder = $builder;
    $this->model = $model;
    $this->type = $type;
    $this->numStrings = $numStrings;
    $this->backWood = $backWood;
    $this->topWood = $topWood;
}


    /**
     * @return mixed
     */
    public function getBuilder()
    {
        return $this->builder;
    }

    /**
     * @return mixed
     */
    public function getModel()
    {
        return $this->model;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @return mixed
     */
    public function getNumStrings()
    {
        return $this->numStrings;
    }

    /**
     * @return mixed
     */
    public function getBackWood()
    {
        return $this->backWood;
    }

    /**
     * @return mixed
     */
    public function getTopWood()
    {
        return $this->topWood;
    }


    function matches($otherSpec){

    }



    function getGuitarSpec()
    {
      return array('builder'=> $this->getBuilder(),
            'model' => $this->getModel(),
            'type'=> $this->getType(),
            'numStrings' => $this->getNumStrings(),
            'backWood' => $this->getBackWood(),
            'topWood' => $this->getTopWood());



    }

}