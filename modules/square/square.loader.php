<?php
/**
 *
 * User: JHRunning
 * Date: 2/10/15
 * Time: 2:32 PM
 */


//load model
require_once 'modules/square/model/square.model.php';

//load class
require_once 'modules/square/controller/square.class.php';
require_once 'modules/square/controller/square_card.class.php';
//require_once 'modules/board/controller/attach.class.php';

//load api class
require_once 'modules/square/api/square.api.class.php';


//load apis
$SquareAPI = new SquareApiClass();