<?php

class RickClass
{


    function search($searchSpec){
        $INVENNTORY_CLASS = new Inventory();

        if($searchSpec == null){

            return $INVENNTORY_CLASS -> getAll();
        }else{
            return $INVENNTORY_CLASS -> search($searchSpec);
        }
    }

    function deleteGuitar($serialNumber){
        $INVENNTORY_CLASS = new Inventory();

       return $INVENNTORY_CLASS -> deleteGuitar($serialNumber);
    }

    function addGuitar($guitar){
        $INVENNTORY_CLASS = new Inventory();

        $spec = $guitar;
        unset($spec['serialNumber']);
        unset($spec['price']);

        return $INVENNTORY_CLASS -> addGuitar($guitar['serialNumber'], $guitar['price'],$spec );

    }

    function updateGuitar($updatespec, $serialNumber){
        $INVENNTORY_CLASS = new Inventory();
        return $INVENNTORY_CLASS -> updateGuitar($updatespec, $serialNumber);
    }


}
?>