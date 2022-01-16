<?php
session_start();
session_destroy();
header('location:http://localhost/geeky/iSchool/index.php');
?>