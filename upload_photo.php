
<?php 
require './htmltemp/head.php'; //for html star tag and <head></head>
require 'dbfunction.php';

$connection=new dbfunction();
//$connection->connect();
if(isset($_POST['submit_logout']))
{
  unset($_SESSION['auth']);
  session_destroy();
}
if(!empty($_SESSION['auth'])) 
    { 
        if($_SESSION['auth']=='1')
        {
?>
  <body>
  <?php 
 require './htmltemp/_header.php'; //for <header>教職員工....</header>
 ?>
 <!-- Start menu -->

       <?php
require './htmltemp/_navbar.php' //for navigation bar 最新消息....

?>
  <!-- End menu -->
  <!-- Start search box -->
 <?php
 require './htmltemp/_search.php';?>
          <!-- End search box -->
  <section id="mu-page-breadcrumb">
   <div class="container">
     <div class="row">
       <div class="col-md-12">
         <div class="mu-page-breadcrumb-area">
           <h2>CIRAS</h2>
           <ol class="breadcrumb">
            <li><a href="#">Home</a></li>            
            <li class="active">CIRAS</li>
          </ol>
         </div>
       </div>
     </div>
   </div>
 </section>
 <!-- End breadcrumb -->
  <!-- Start service  -->

  <section id="mu-gallery">
   <div class="container">
     <div class="row">
       <div class="col-md-12">
         <div class="mu-gallery-area">
          <!-- start title -->
          <div class="mu-title">
  <H2>CIRAS</H2>
          </div>
          <!-- end title -->
          <!-- start gallery content -->
          <div class="mu-gallery-content">
           
            <div class="mu-gallery-body">
                <?php if(!isset($_POST['submit_upload'])){
                    $foldernm=$_GET['album_name'];
                    $folderid=$_GET['add_album_id'];
                    //echo $folderid;
                    //echo $foldernm;?>
              <form name="form" method="post" action="upload_photo.php">
              <button type="submit" name="submit_logout" >登出</button>
              </form> 
              
              <form action="upload_photo.php" method="POST" enctype="multipart/form-data">
              <h1>上傳照片</h1>
              <input type="file" name="file[]" id="file" multiple>
              <input type="hidden" name="folderid" value="<?php  echo $folderid?>">
              <input type="hidden" name="foldernm" value="<?php echo $foldernm?>">
              <input type="submit" name="submit_upload" value="確認" >
                </form>

                <?php }
      
        

        if(isset($_POST['submit_upload']))
        {
            $foldernm=$_POST['foldernm'];
            $folderid=$_POST['folderid']; 
            //echo $foldernm;
            //echo $folderid;  
            $fileCount = count($_FILES['file']['name']);
            $uploadDirectory = "upload/album/".$foldernm."/";  
            //echo $fileCount; 

        for ($i = 0; $i < $fileCount; $i++) {

        if ($_FILES["file"]["error"][$i] > 0){
        echo "Error: " . $_FILES["file"]["error"];
        }
        else{
        
        if (file_exists("upload/album/".$foldernm."/" . $_FILES["file"]["name"][$i])){
        echo "檔案已經存在，請勿重覆上傳相同檔案";
        }
        else{
        move_uploaded_file($_FILES["file"]["tmp_name"][$i],"upload/album/".$foldernm."/".$_FILES["file"]["name"][$i]);
        $name=$_FILES["file"]["name"][$i];
        $tmp=$_FILES["file"]["tmp_name"][$i];

        $connection->insert('test2','(name,path,folder_id) VALUES(:name,:path,:folder_id)',array('name'=>$name,'path'=>$tmp,'folder_id'=>$folderid));
        //echo $folder_id;
        //echo "成功新增<br/>";
            }
        }
        }

    //$foldernm2 = $_POST['foldernm2'];
    $FileDir="upload/album/".$foldernm."/";
    $FileNum=count(glob("$FileDir/*.*"));
    $result = glob($FileDir."*");
//echo $FileNum;

for ($i = 0; $i < $FileNum; $i++) {

echo "<br/>";?>
<img src="<?php echo $result[$i]; ?>" height="300" width="400" style="display:block; margin:auto;"></img>
<?php
echo "<br/>";

   
}

        
    }

?>
              
            </div>   
          </div>
          <!-- end gallery content -->
         </div>
       </div>
     </div>
   </div>
 </section>
 
  <!-- Start footer -->
  <footer id="mu-footer">
    <!-- start footer top -->
  <?php 
require './htmltemp/_footer.php'; //for footer (information 、友站連結....)
  ?>
    <!-- end footer top -->
  </footer>
  <!-- End footer -->
 <?php 
require './htmltemp/footer.php';
 ?>
       <?php }
       else
       {
        echo "此帳號無權限";?>
        <form name="form" method="post" action="upload_photo.php">
              <button type="submit" name="submit_logout" >登出</button>
              </form>

       <?php
       
      }
    } 
    else
    {?>
      <h1>請登入<h1>
      <?php echo "<script> alert('請登入');parent.location.href='login.php'; </script>";
    } 
    ?>

        
