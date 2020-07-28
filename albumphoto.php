<?php
require 'dbfunction.php';
$connection=new dbfunction();
$foldernm = $_GET["album_name"];
$folderid = $_GET["album_id"];

$fileNum=0;
$photo=array(); 
$row=$connection->fetOne('test2','name','folder_id=:folder_id',array('folder_id'=>$folderid));

if(isset($_GET['delete_photo']))
{
    $name=$_GET['delete_photo'];
    $folderid=$_GET['album_id'];
    $foldernm=$_GET['album_name'];
    $connection->delete('test2','folder_id = :folder_id AND name = :name',array('folder_id'=>$folderid,'name'=>$name));
    //unlink("upload/album/".$foldernm."/".$name);
}

foreach($row as $data)
{
    $photo[$fileNum]=$data['name'];
    ?>
<img src="<?php echo "upload/album/".$foldernm."/".$photo[$fileNum]; ?>" height="300" width="400" style="display:block; margin:auto;"></img>
<?php
echo "<br/>";?>
<div style='text-align:center'>
<?php echo $photo[$fileNum]."<br/><br/>"; ?>
 <a href="albumphoto.php?delete_photo=<?php echo $photo[$fileNum]?>&album_id=<?php echo $folderid?>&album_name=<?php echo $foldernm?>">刪除</a>      
</div>
<?php
    $fileNum++;
}



?>


