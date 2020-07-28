<?php
//require 'connect.php';
require 'dbfunction.php';

$connection = new dbfunction();
$connection->connect();

                                              
$account = (isset($_POST['account']))?$_POST['account']:"";
$password = (isset($_POST['password']))?$_POST['password']:"";


/*$sth=$connection->db() -> prepare("SELECT * FROM user where account LIKE :account AND password LIKE :password");

//$sth = $pdo->prepare($sql);

$sth -> execute(array(':account' => $account,':password' => $password));
$result = $sth -> fetch(PDO::FETCH_ASSOC) ;*/

$result=$connection->fetOne('user','*','account = :account AND password = :password',array('account'=>$account,'password'=>$password));

//echo $result['account'];

foreach($result as $data) {
        $acc = (isset($data['account']))?$data['account']:"";
        $pass = (isset($data['password']))?$data['password']:"";
        $nm=$data['name'];
        $au=$data['auth'];
    }
//var_dump($result);
if (isset($acc)&&isset($pass)) {
        session_start();
        $_SESSION['name']=$nm;
        $_SESSION['auth']=$au;
        header('Location:make_background.php');
   }
   else echo "登入失敗";
   
   

/*if($sth->execute(array(":account" => $account, ":password" => $password)))
{
        if ($account!=null && $password=!null && ":account"==$account && ":password"==$password )
        header('Location:todolist.php');

        else 

        echo '登入失敗';
       
        //echo "succ";
        //$result = $sth->fetch();
        //printf($result['account']);
}
else
{
        echo $sth->error;
}*/

?>
