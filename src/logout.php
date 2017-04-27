<?php
/* WARNING: This code is vulnerable. */
setcookie("username", "", time() - 3600);
header('Location: index.php');
