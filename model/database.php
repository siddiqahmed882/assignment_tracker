<?php
  $dsn = "mysql:host=localhost;dbname=assignment_tracker";
  $username = "siddiq";
  $password = "test1234";

  try{
    $db = new PDO($dsn, $username, $password);
  } catch(PDOException $e) {
    $error = "Database Error: " . $e->getMessage();
    include('view/error.php');
    exit;
  }