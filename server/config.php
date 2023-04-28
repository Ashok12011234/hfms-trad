<?php
include('classes/sysLvlCls/connection.php');

// Create database
$conn = new mysqli(Database::getInstance()->HOST, Database::getInstance()->USERNAME, Database::getInstance()->PASSWORD);
$createDB = "CREATE DATABASE IF NOT EXISTS `".Database::getInstance()->NAME."`";
$conn->query($createDB);
$conn->close();

