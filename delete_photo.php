<?php

require 'dbfunction.php';
$connection=new dbfunction();

$folderid=$_GET['album_id'];
$name=$_GET['photo_name'];
$connection->delete('test2','folder_id = :folder_id AND name = :name',array('folder_id'=>$folderid,'name'=>$name));

?>