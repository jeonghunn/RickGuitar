<?php
/**
 *
 * User: JHRunning
 * Date: 2/10/15
 * Time: 2:32 PM
 */


if ($ACTION == "square_main") $SquareAPI->API_getMain($user_srl);
if ($ACTION == "square_collection") $SquareAPI->API_getCollection($user_srl);
if($ACTION == "square_write") $SquareAPI -> API_Write($user_srl);
if($ACTION == "square_read") $SquareAPI -> API_Read($user_srl);
if($ACTION == "square_status_update") $SquareAPI -> API_DocStatusUpdate($user_srl);
if($ACTION == "square_list_bysquare") $SquareAPI -> API_getCommentList($user_srl);
