<?php
require 'dbfunction.php';
$connection=new dbfunction();
$FileDir="upload/album/";

$folderCodeArr=array(); 
$folderCodeArr2=array(); 
$folderCount=0;
$rows=$connection->fetOne('folder','*',null,null);
foreach($rows as $data) {
    //echo $data['name'];
    $folderCodeArr[$folderCount]=$data['name'];
    $folderCodeArr2[$folderCount]=$data['folder_id'];
    $folderCount++;
}

for ($i = 0; $i<$folderCount; $i++) {
    /*$FileDir2="upload/album/".$folderCodeArr[$i];
    $result = glob("$FileDir2/*");*/
    //echo$result[0];
    $row=$connection->fetOne('test2','name','folder_id=:folder_id',array('folder_id'=>$folderCodeArr2[$i]));
    ?>
    <img src="<?php echo "upload/album/".$folderCodeArr[$i]."/".$row[0][0]; ?>" height="300" width="400" style="display:block; margin:auto;"></img>
    <div style='text-align:center'>
    <a href="photo.php?album_id=<?php echo $folderCodeArr2[$i];?>&album_name=<?php echo $folderCodeArr[$i];?>"><?php echo $folderCodeArr[$i]."<br/><br/>";?></a>
    </div>                      
<?php
}


/*$FileNum=count(glob("$FileDir/*"));
$result = glob($FileDir."*");

//echo $FileNum;

for ($i = 0; $i<$FileNum; $i++) {
    $j=$i+1;
    //echo $result[$i];
    $FileDir2=$result[$i]."/";
    $FileNum2=count(glob("$FileDir2/*.*"));
    $result2 = glob($FileDir2."*");?>


<img src="<?php echo $result2[0]; ?>" height="300" width="400" style="display:block; margin:auto;"></img>
<?php

echo "<br/>";?>
 <div style='text-align:center'>
 <a href="photo.php?album_name=<?=$result[$i]?>"><?php echo $result[$i]."<br/><br/>";?></a>
 
 </div>  


<?php }
//dirname($path)*/
?>