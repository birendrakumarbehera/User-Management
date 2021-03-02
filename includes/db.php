<?php
$conn = mysqli_connect('localhost','techamru_oye','X.6UpS64p-','techamru_ecom');

  // server should keep session data for AT LEAST 1 hour
  ini_set('session.gc_maxlifetime', 5000000);

  // each client should remember their session id for EXACTLY 1 hour
  session_set_cookie_params(5000000);
session_start();
error_reporting(0);


?>