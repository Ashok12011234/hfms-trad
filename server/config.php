<?php
include('classes/sysLvlCls/connection.php');

// Create database
$conn = new mysqli("db","user","pass");
$createDB = "CREATE DATABASE IF NOT EXISTS `".Database::NAME."`";
$conn->query($createDB);
$conn->close();

