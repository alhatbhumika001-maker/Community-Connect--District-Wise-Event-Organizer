<?php

session_start();
$email=$_POST['email'];
$password=$_POST['password'];
$link=mysqli_connect('localhost','root','','community_connect');
$q="select * from users where email='$email' and password='$password'";
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

