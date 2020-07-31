<?php
require 'dbfunction.php';
$connection=new dbfunction();
if(isset($_POST['submit']))
{
    $attribute=$_POST['attribute'];
    $category=$_POST['category'];
    $title=$_POST['title'];
    $date=$_POST['date'];
    $content=$_POST['textfield'];
    $connection->insert('artical','(attribute,title,category,date,content) VALUES(:attribute,:title,:category,:date,:content)',array('attribute'=>$attribute,'title'=>$title,'category'=>$category,'date'=>$date,'content'=>$content));
    echo "<script> alert('成功');parent.location.href='make_background.php'; </script>";
}
?>

<html>
<head>
<script type="text/javascript" src="ckeditor/ckeditor.js"></script>
</head>
<body>
    <form name="form" method="POST" action="artical_edit.php">
        <p>屬性<select name="attribute">
        <option value="活動公告">活動公告</option>
　      <option value="時事蒐集">時事蒐集</option>
        <option value="新聞快訊">新聞快訊</option>
        </select>
        <p>標題<input type="text" name="title">
        <p>分類<select name="category">
        <option value="活動">活動</option>
        </select>
        <p>日期<input type="date" name="date">
        <p>內容
        <textarea name="textfield" class="ckeditor" id="textfield"></textarea>
        <input type="submit" name="submit" value="送出">  
    </form>
</body>
</html>
