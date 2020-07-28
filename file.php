
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
           $filenum=0;
           $file=array();
           $repeat=0;
           $rows=$connection->fetOne('file','*',null,null); 
           foreach($rows as $data)
           {
             $repeat=0;
             for($i=0;$i<$filenum;$i++)
             {
               if(isset($file[$i]))
               {
                if($file[$i]==$data['filename'])
                {
                  $repeat=1;
                }
               }
                
             }
             if($repeat==0)
             {
              $file[$filenum]=$data['filename'];
              $filenum++;
             }
           }
           ?>

          <table>
                <thead>   
                </thead>
                <tbody>
                    <?php  $i=0; while ($i<$filenum){ ?>
                    <tr>
                        <td><?php echo $file[$i];?></td>
                        <?php
                        $row=$connection->fetOne('file','*','filename=:filename',array('filename'=>$file[$i])); 
                        $pdf=0;$docx=0;$odt=0;$rar=0;$zip=0;$z=0;
                        foreach($row as $data)
                        {
                          if($data['type']=='pdf')
                          {$pdf=1;}
                          if($data['type']=='docx')
                          {$docx=1;}
                          if($data['type']=='odt')
                          {$odt=1;}
                          if($data['type']=='rar')
                          {$rar=1;}
                          if($data['type']=='zip')
                          {$zip=1;}
                          if($data['type']=='7z')
                          {$z=1;}
                        }
                        
                        if($pdf==1)
                        {?>
                          <td><a href="upload/file/<?php echo $file[$i].".pdf"?>"><img src="assets/img/file/pdf.png" height="40" width="30"></a></td><?php
                        }
                        if($docx==1)
                        {?>
                        <td><a href="upload/file/<?php echo $file[$i].".docx"?>"><img src="assets/img/file/docx.png" height="40" width="30"></a></td><?php
                        }
                        if($odt==1)
                        {?>
                        <td><a href="upload/file/<?php echo $file[$i].".odt"?>"><img src="assets/img/file/odt.jpg" height="40" width="30"></a></td><?php
                        }
                        if($rar==1)
                        {?>
                        <td><a href="upload/file/<?php echo $file[$i].".rar"?>"><img src="assets/img/file/rar.jpg" height="40" width="30"></a></td><?php
                        }
                        if($zip==1)
                        {?>
                        <td><a href="upload/file/<?php echo $file[$i].".zip"?>"><img src="assets/img/file/rar.jpg" height="40" width="30"></a></td><?php
                        }
                        if($z==1)
                        {?>
                        <td><a href="upload/file/<?php echo $file[$i].".7z"?>"><img src="assets/img/file/rar.jpg" height="40" width="30"></a></td><?php
                        }?>
                        
                    </tr>
                    <?php $i++;  } ?> 
                </tbody>
            </table>
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
