
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
           
            <div class="mu-gallery-body">
            <form action="slider.php" method="POST" enctype="multipart/form-data">
              <h1>上傳照片</h1>
              <input type="file" name="file[]" id="file" multiple>
              <input type="submit" name="submit_upload" value="確認" >
              <?php
              if(isset($_POST['submit_upload']))
              {
                      $fileCount = count($_FILES['file']['name']);
                      $uploadDirectory = "upload/slider/";  
                      //echo $fileCount; 
          
                  for ($i = 0; $i < $fileCount; $i++) {
          
                  if ($_FILES["file"]["error"][$i] > 0){
                  echo "Error: " . $_FILES["file"]["error"];
                  }
                  else{
                  
                  if (file_exists("upload/slider/". $_FILES["file"]["name"][$i])){
                  echo "檔案已經存在，請勿重覆上傳相同檔案";
                  }
                  else{
                  move_uploaded_file($_FILES["file"]["tmp_name"][$i],"upload/slider/".$_FILES["file"]["name"][$i]);
                  $name=$_FILES["file"]["name"][$i];
                  $tmp=$_FILES["file"]["tmp_name"][$i];
          
                  $connection->insert('slider','(name,status) VALUES(:name,:status)',array('name'=>$name,'status'=>'0'));
                  //echo $folder_id;
                  //echo "成功新增<br/>";
                      }
                  }
                  }
          }

          if(isset($_GET['del_photo'])){
            $photonm=$_GET['del_photo'];
            $connection->delete('slider','name = :name',array('name'=>$photonm));
            unlink("upload/slider/".$photonm);
        }

        if(isset($_GET['hide_photo'])){
            $photonm=$_GET['hide_photo'];
            $connection->update('slider','status = :status','name=:name',array('status'=>'1','name'=>$photonm));//1是隱藏照片
        }

        if(isset($_GET['display_photo'])){
            $photonm=$_GET['display_photo'];
            $connection->update('slider','status = :status','name=:name',array('status'=>'0','name'=>$photonm));//0是顯示照片
        }
              ?>
                </form>
            <table>
                <thead> 
                    所有照片</br>  
                </thead>
                <tbody>
                    <?php  
                    $photonum=0;
                    $photo=array();                   
                    $rows=$connection->fetOne('slider','*','status=:status',array('status'=>'0'));
                    foreach($rows as $data) {
                        $photo[$photonum]=$data['name'];
                        $photonum++;
                    }
                    $i=0; while ($i<$photonum){ ?>
                    <tr>
                   
                        <td>
                        <img src="<?php echo "upload/slider/".$photo[$i]; ?>" height="180" width="200" style="display:block; margin:auto;"></img>
                        <?php echo $photo[$i];?></a>
                        </td>
                       <td> 
                            <a href="slider.php?hide_photo=<?php echo $photo[$i];?>">隱藏 </a>
                        </td>
                        <td class="delete">
                            <a href="slider.php?del_photo=<?php echo $photo[$i];?>">刪除</a>
                        </td>
                        
                    </tr>
                    <?php $i++;  } ?> 
                </tbody>
            </table>

            <table>
                <thead> 
                    隱藏照片</br>  
                </thead>
                <tbody>
                    <?php  
                    $photonum=0;
                    $photo=array();                   
                    $rows=$connection->fetOne('slider','*','status=:status',array('status'=>'1'));
                    foreach($rows as $data) {
                        $photo[$photonum]=$data['name'];
                        $photonum++;
                    }
                    $i=0; while ($i<$photonum){ ?>
                    <tr>
                   
                        <td>
                        <img src="<?php echo "upload/slider/".$photo[$i]; ?>" height="180" width="200" style="display:block; margin:auto;"></img>
                        <?php echo $photo[$i];?></a>
                        </td>
                       <td> 
                            <a href="slider.php?display_photo=<?php echo $photo[$i];?>">顯示 </a>
                        </td>
                        
                    </tr>
                    <?php $i++;  } ?> 
                </tbody>
            </table>
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
