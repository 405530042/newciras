
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
              <form name="form" method="post" action="create_album.php">
              <button type="submit" name="submit_logout" >登出</button>
              </form> 
              
              <form  method="POST" action="create_album.php">
              <h1>建立相簿</h1>
                相簿名稱<input  name="foldernm"  placeholder="enter album name">
                活動日期<input type="date" name="folderdate" >
                <input type="submit" name="submit_create" value="新增" >
              </form>
              <?php
               if(isset($_POST['submit_create']))
               {
                   $folder=$_POST['foldernm'];
                   $date=$_POST['folderdate'];
       
                   //echo $folder;
       
                   mkdir("upload/album/".$folder);
       
                   $connection->insert('folder','(name,event_date) VALUES(:name,:event_date)',array('name'=>$folder,'event_date'=>$date));
               }
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

              if(isset($_GET['delete_id'])){
                $id=$_GET['delete_id'];
                $name=$_GET['delete_name'];
                $connection->delete('folder','folder_id = :folder_id',array('folder_id'=>$id));
                //rmdir("upload/".$name);
                $FileDir="upload/album/".$name."/";
                //header('Location:create_album.php');
            }

              ?>
              <table>
                <thead>   
                </thead>
                <tbody>
                    <?php  $i=0; while ($i<$folderCount){ ?>
                    <tr>
                        <td class="task"><a href="albumphoto.php?album_name=<?php echo $folderCodeArr[$i];?>&album_id=<?php echo $folderCodeArr2[$i];?>"><?php echo $folderCodeArr[$i];?></a></td>
                       <td> 
                            <a href="upload_photo.php?add_album_id=<?php echo $folderCodeArr2[$i];?>&album_name=<?php echo $folderCodeArr[$i]?>">新增 </a>
                        </td>
                        <td class="delete">
                            <a href="create_album.php?delete_id=<?php echo $folderCodeArr2[$i];?>&delete_name=<?php echo $folderCodeArr[$i]?>">刪除</a>
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
    
