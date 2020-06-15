<?php
session_start();

$_SESSION = [];

session_destroy();

header('location:signinform.php');
exit;