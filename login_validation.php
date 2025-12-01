<?php

session_start();
$username=$_POST['username'];
$password=$_POST['password'];
$link=mysqli_connect('localhost','root','','community_connect');
$q="select * from users where username='$username' and password='$password'";
$result=mysqli_query($link,$q);
if(mysqli_num_rows($result)>=1)
{
    $data=mysqli_fetch_array($result);
    $_SESSION['login_user']=$data;
    header("location:index.php");

}
else
{
    
    header("location:login.php?error=username/password is wrong. please try again.");
    
}
?>

