<?php

 $conn=mysqli_connect("localhost","root","","community_connect");

    $full_name=$_POST['full_name'];
    $username=$_POST['username'];
    $email=$_POST['email'];
    $password=$_POST['password'];
    $confirm_password=$_POST['confirm_password'];
    $role=$_POST['role'];
    $district=$_POST['district'];
   


    $q="insert into customer_login(id,full_name,username,email,password,confirm_password,role,district) values ('NULL','$full_name','$username','$email','$password','$confirm_password','$role','$district')";


    $result=mysqli_query($conn,$q);

    if($result)
    {
        echo "<script>alert('Account Created Succesfully');window.location='index.php';</script>";
        
    }
    else{
        echo "<script>alert('Something went wrong');window.location='sign_up.php';</script>";
    }


?>