<?php
include('classes/sysLvlCls/connection.php');

// Create database
$conn = new mysqli(Database::HOST,Database::USERNAME,Database::PASSWORD);
$createDB = "CREATE DATABASE IF NOT EXISTS `".Database::NAME."`";
$conn->query($createDB);
$conn->close();

