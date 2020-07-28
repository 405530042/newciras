<?php
require 'dbfunction.php';
$connection=new dbfunction();
$folderid = $_GET["album_id"];
$foldernm = $_GET["album_name"];
/*$FileDir="upload/album/".$foldernm."/";
$FileNum=count(glob("$FileDir/*.*"));
$result = glob($FileDir."*");*/
// echo $FileNum;
$fileNum=0;
$photo=array(); 
$row=$connection->fetOne('test2','name','folder_id=:folder_id',array('folder_id'=>$folderid));
foreach($row as $data)
{
    $photo[$fileNum]=$data['name'];
    ?>
<img src="<?php echo "upload/album/".$foldernm."/".$photo[$fileNum]; ?>" height="300" width="400" style="display:block; margin:auto;"></img>
<?php
echo "<br/>";?>
<div style='text-align:center'>
<?php echo $photo[$fileNum]."<br/><br/>"; ?>
</div>
<?php
    $fileNum++;
}

?>