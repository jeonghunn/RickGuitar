<?php
/**
 *
 * User: JHRunning
 * Date: 2/10/15
 * Time: 2:32 PM
 */


//load class
require_once 'modules/board/documents.class.php';
require_once 'modules/board/comment.class.php';
require_once 'modules/board/attach.class.php';

//load api class
require_once 'modules/board/board.api.class.php';


//load apis
$BoardAPI = new BoardAPIClass();
if($ACTION == "doc_list") $BoardAPI -> API_getDocList($user_srl);
if($ACTION == "doc_write") $BoardAPI -> API_DocWrite($user_srl);
if($ACTION == "doc_read") $BoardAPI -> API_DocRead($user_srl);
if($ACTION == "doc_status_update") $BoardAPI -> API_DocStatusUpdate($user_srl);
if($ACTION == "comment_list") $BoardAPI -> API_getCommentList($user_srl);
if($ACTION == "comment_write") $BoardAPI -> API_CommentWrite($user_srl);
if($ACTION == "comment_status_update") $BoardAPI -> API_CommentStatusUpdate($user_srl);
if($ACTION == "download") $BoardAPI -> API_AttachDownload();
