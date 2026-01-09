<?php

function usercast($userid){
  file_get_contents("/?user=$userid");
}

function broadcastMessage($message,$mode){
  //here
}

function broadcastPhoto($photoURL,$message,$mode){
  //here
}

function broadcastVideo($videoURL,$message,$mode){
  //here
}

function broadcastDocs($docsURL,$message,$mode){
  //here
}

function loader($userid){
  //here
}
?>
