<?php
session_start();
session_unset();   // limpia variables
session_destroy(); // destruye sesión

header("Location: /publieventos/app/auth/login.php");
exit();