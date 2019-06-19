<?php


class Inventory
{

    function addGuitar($serialNumber, $price, $spec){
        $Guitar = new Guitar($serialNumber, $price , $spec);

        return DBQuery(getSqlInsertQuery('rick',  $Guitar -> getGuitar()));
    }

    function getGuitar($serialNumber){
return DBQuery(getSqlSelectQuery('rick', array('serialNumber' => $serialNumber), null, "DESC", false));
    }



    function search($searchSpec){

        unset($searchSpec['serialNumber']);
        unset($searchSpec['price']);
return DBQuery(getSqlSelectQuery('rick', $searchSpec, null, "DESC", false));
    }

    function getAll(){

       // echo getSqlSelectQuery('rick', array(), null, "DESC", false);
        return DBQuery(getSqlSelectQuery('rick', array(), null, "DESC", false));
    }

    function updateGuitar($updateSpec ,$serialNumber){
       echo getSqlUpdateQuery('rick', $updateSpec ,array('serialNumber' => $serialNumber), false);
return DBQuery(getSqlUpdateQuery('rick', $updateSpec ,array('serialNumber' => $serialNumber), false));
    }

    function deleteGuitar($serialNumber){
return DBQuery(getSqlDeleteQuery('rick', array('serialNumber' => $serialNumber), false));
    }

}