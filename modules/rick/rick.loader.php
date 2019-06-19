<?php
/**
 *
 * User: JHRunning
 * Date: 2/10/15
 * Time: 2:32 PM
 */


//load model
require_once 'modules/rick/model/builder.model.enum.php';
require_once 'modules/rick/model/guitar.model.class.php';
require_once 'modules/rick/model/guitarspec.model.class.php';
require_once 'modules/rick/model/inventory.model.class.php';
require_once 'modules/rick/model/type.model.enum.php';
require_once 'modules/rick/model/wood.model.enum.php';

//load class
require_once 'modules/rick/controller/rick.class.php';

//load api class
require_once 'modules/rick/api/rick.api.class.php';


//load apis
$RickAPI = new RickApiClass();