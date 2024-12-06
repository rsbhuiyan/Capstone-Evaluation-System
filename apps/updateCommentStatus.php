<?php
include 'includes/class.autoload.inc.php';
$commentid = $_POST['commentid'];


$commentsContr = new CommentsContr();
$results = $commentsContr->updateCommentStatus($commentid);
if($results != null){
    echo '[{ "commentid": ' .$commentid . '"}]';
}else if ($results == null){
    echo 'error';
}
