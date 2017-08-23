<?php

session_start();
unset($SESSION['user']);
session_destroy();
header ('location: index.php')

?>
