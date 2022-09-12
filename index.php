<!-- Index page. Here will be displayed all posts from db. --> 

<?php
require_once dirname(__FILE__) . DIRECTORY_SEPARATOR . "config.php";
require_once CLASS_PATH . DIRECTORY_SEPARATOR . "User.php";
require_once CLASS_PATH . DIRECTORY_SEPARATOR . "Comment.php";

$uid = json_decode(json_encode(unserialize($_SESSION['user'])), true);

$coment = new Comment();
$comments = $coment->allPosts($dbConn);

require_once ROOT_PATH . DIRECTORY_SEPARATOR . "templates" . DIRECTORY_SEPARATOR . "index.php";