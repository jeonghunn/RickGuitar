<?php
/**
 *
 * User: JHRunning
 * Date: 2/10/15
 * Time: 2:32 PM
 */


if ($ACTION == "guitar_add") $RickAPI->API_Add($user_srl);
if ($ACTION == "guitar_search") $RickAPI->API_Search($user_srl);
if ($ACTION == "guitar_update") $RickAPI->API_Update($user_srl);
if ($ACTION == "guitar_delete") $RickAPI->API_delete($user_srl);


