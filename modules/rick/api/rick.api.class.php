<?php
/**
 * Created by Tarks.
 * User: JHRunning
 */


class RickApiClass
{


    function API_Search($user_srl)
    {

        $RICK_CLASS = new RickClass();

        $guitarspec = new GuitarSpec(0,0,0,0,0,0);
        $guitar = new Guitar(0,0, $guitarspec);

        $requestArray = makeModelFromRequest($guitar->getGuitar(),null, null);
if($requestArray['model'] == null){
    $requestArray = null;
} else{
    unset($requestArray['serialNumber']);
    unset($requestArray['price']);
}

        $List = $RICK_CLASS->search($requestArray);
        $guitarspec = new GuitarSpec(0,0,0,0,0,0);
        $guitar = new Guitar(0,0, $guitarspec);

        SqlPrintList($List, arrayKeyToInfoArray($guitar->getGuitar()));


    }

    function API_Add($user_srl)
    {


        $RICK_CLASS = new RickClass();


        $guitarspec = new GuitarSpec(0,0,0,0,0,0);
        $guitar = new Guitar(0,0, $guitarspec);

        $requestArray = makeModelFromRequest($guitar->getGuitar(),null, null);




        $result = $RICK_CLASS ->addGuitar($requestArray);

        if($result){
            SuccessMessage('guitar_add_success');
        }else{
            ErrorMessage('guitar_add_error');
        }


    }


    function API_delete(){


        $RICK_CLASS = new RickClass();

        $serialNumber = REQUEST('serialNumber');

        $result = $RICK_CLASS->deleteGuitar($serialNumber);

        if($result){
            SuccessMessage('guitar_delete_success');
        }else{
            ErrorMessage('guitar_delete_error');
        }
    }

    function API_Update(){


        $RICK_CLASS = new RickClass();

        $guitarspec = new GuitarSpec();
        $guitar = new Guitar(0,0, $guitarspec);

        $requestArray = makeModelFromRequest($guitar->getGuitar(),null, null);

        $result = $RICK_CLASS->updateGuitar($requestArray, $requestArray['serialNumber']);

        if($result){
            SuccessMessage('guitar_update_success');
        }else{
            ErrorMessage('guitar_update_error');
        }

    }
}

