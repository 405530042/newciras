
<?php 
require './htmltemp/head.php'; //for html star tag and <head></head>
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
              新版網頁製作中!
              <form name="form" method="post" action="make_background.php">
              <button type="submit" name="submit_logout" >登出</button>
              </form>
              <form name="form" method="post" action="create_album.php">
              <button type="submit" name="submit_album" >新增相簿</button>
              </form>
              <form name="form" method="post" action="upload_file.php">
              <button type="submit" name="submit_file" >上傳檔案</button>
              </form>
              <form name="form" method="post" action="slider.php">
              <button type="submit" name="submit_slider" >幻燈片</button>
              </form>
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
