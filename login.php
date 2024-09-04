<?php include ('includes/header.php');?>


<form method="post" action="login.php">
  <label for="username">Användarnamn:</label>
  <input type="text" id="username" name="username">
  <br>
  <label for="password">Lösenord:</label>
  <input type="password" id="password" name="password">
  <br>
  <input type="submit" value="Login">
</form>

<?php 
$_SESSION['user'] = 'myusername';
$_SESSION['password'] = 'mypassword';

if ($_POST['username'] == $_SESSION['user'] && $_POST['password'] == $_SESSION['password']) {
    $_SESSION['logged_in'] = true;
    header('Location: admin.php' );
    exit;
} else {
  echo 'Fel lösenord eller användarnamn';
}
