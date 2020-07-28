
<?php 
require './htmltemp/head.php'; 
require 'dbfunction.php';
$connection=new dbfunction();
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
           <?php
           if(!isset($_POST['submit_upload'])){
           ?>
            <div class="mu-gallery-body">
            <form action="upload_file.php" method="POST" enctype="multipart/form-data">
            <input type="file" name="file"  multiple>
            <input type="submit" name="submit_upload" value="確認">
            </form>
            </div>
            <?php 
            }
            if(isset($_POST['submit_upload']))
            {
              $extension=pathinfo($_FILES['file']['name'],PATHINFO_EXTENSION);
                if ($_FILES["file"]["error"] > 0){
                    echo "Error: " . $_FILES["file"]["error"];
                    }
                  else{
                    if (file_exists("upload/file/".$_FILES["file"]["name"])){
                        echo "檔案已經存在，請勿重覆上傳相同檔案";
                        }
                        else if(in_array($extension,array('pdf','docx','odt','rar','zip','7z'))){
                            move_uploaded_file($_FILES['file']['tmp_name'],"upload/file/".$_FILES['file']['name']);
                            $fileArr=array();
                            $fileArr2=array();  
                            $fileCount=0;
                            $rows=$connection->fetOne('file','*',null,null);
                            $connection->insert('file','(filename,type) VALUES(:name,:type)',array('name'=>(basename($_FILES['file']['name'],".".$extension)),'type'=>$extension));
                            //$fileid=$connection->getOne("file","file_id","file_id");
                            //$connection->insert('file_type','(file_id,type) VALUES(:id,:type)',array('id'=>$fileid[0],'type'=>$extension)); 

                            foreach($rows as $data) 
                            {
                                $fileArr[$fileCount]=$data['filename'];
                                $fileArr2[$fileCount]=$data['type'];
                                ?>
                                <a href="upload/file/<?php echo $fileArr[$fileCount].".".$fileArr2[$fileCount]?>"><?php echo $fileArr[$fileCount].".".$fileArr2[$fileCount]?></a>
                                <?php
                                $fileCount++;
                            } ?>
                            <a href="upload/file/<?php echo $_FILES['file']['name']?>"><?php echo $_FILES['file']['name']?></a>  
                      <?php }
                      else
                      {
                        echo '不允許該檔案格式';
                      }
                      }
            }
            ?>
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
        <form name="form" method="post" action="make_background.php">
              <button type="submit" name="submit" >登出</button>
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
