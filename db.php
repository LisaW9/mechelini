<?php

header("Access-Control-Allow-Origin: *");
$con = mysqli_connect("www.lisawouters.be","lisawo1q","L1saW0ut3rs1109","mechelini") or die ("could not connect database");

if(isset($_POST['insert']))
{
    $abbo_id=$_POST['abbo_id'];
    $email=$_POST['email'];
    $password=$_POST['password'];
    $q=mysqli_query($con,"INSERT INTO `users` (`abbo_id`,`email`,`password`) VALUES ('$abbo_id','$email','$password')");
    if($q)
        echo "success";
    else
        echo "error";
}

if(isset($_POST['update']))
{
    $abbo_id=$_POST['abbo_id'];
    $email=$_POST['email'];
    $password=$_POST['password'];
    $q=mysqli_query($con,"UPDATE `users` SET `abbo_id`='$abbo_id',`email`='$email',`password`='$password' where `id`='$id'");
    if($q)
        echo "success";
    else
        echo "error";
}