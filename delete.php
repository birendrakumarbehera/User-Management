<?php
include "./includes/db.php";

$email = $_GET['email'];
$query = "DELETE FROM `user` WHERE email = '$email'";
$data = mysqli_query($conn,$query);
if($data){
    echo "<script>
    alert('Data is Successfully deleted');
    window.location.href='./dashboard.php';
    </script>";
}
else{
    echo"<script>alert('Something error occurs');";
}








?>