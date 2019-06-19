<?php


class Guitar
{
public $serialNumber, $price, $spec;

    function __construct($serialNumber, $price, $spec) {
$this -> serialNumber = $serialNumber;
$this -> price = $price;
$this -> spec = $spec;

    }
    /**
     * @return mixed
     */
    public function getSerialNumber()
    {
        return $this->serialNumber;
    }

    /**
     * @return mixed
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param mixed $price
     */
    public function setPrice($price)
    {
        $this->price = $price;
    }

    /**
     * @return mixed
     */
    public function getSpec()
    {
        return $this->spec;
    }

    function getGuitar()
    {
        $array =  array('serialNumber'=> $this->getSerialNumber(),
            'price' => $this->getPrice());

        if(is_array($this->getSpec())) {
            $array = array_merge($array ,$this->getSpec());

        }
        else if($this->getSpec() != null) $array = array_merge($array ,$this->getSpec()->getGuitarSpec());

        return $array;
    }

}