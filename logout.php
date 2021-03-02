<?php
include './includes/db.php';
//$email = $_GET['email'];

session_destroy();
echo "<script>
alert('Logout Success');
window.location.href='./index.php';
</script>";



?>