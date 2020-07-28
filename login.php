<?php 
/*if(!isset($_SESSION)) 
{ 
  session_start(); 
} */

if(!empty($_SESSION['auth']))
{
  header('Location:make_background.php');
  //echo "登入過了";
}
?>
<?php
require './htmltemp/head.php';
?>
<body>
<form class="form-signin" name="form1" method="post" action="login_var.php">
  <img class="mb-4" src="./assets/img/ciras.PNG" alt="" width="72" height="72">
  <h1 class="h3 mb-3 font-weight-normal">Please sign in</h1>
  <label for="inputEmail" class="sr-only">Email address</label>
  <input type="email" id="inputEmail" class="form-control" placeholder="Email address" required="" autofocus="" name="account">
  <label for="inputPassword" class="sr-only">Password</label>
  <input type="password" id="inputPassword" class="form-control" placeholder="Password" required="" name="password">
  <div class="checkbox mb-3">
    <label>
      <input type="checkbox" value="remember-me"> Remember me
    </label>
  </div>
  <button class="btn btn-lg btn-primary btn-block" type="submit" name="submit">Sign in</button>
  <p class="mt-5 mb-3 text-muted">© 2017-2019</p>
</form>
<button class="btn btn-lg btn-primary btn-block" type="submit">Sign up</button>
<?php
require './htmltemp/footer.php';
?>