<?php
session_start();
session_destroy();
header("Location: /pengajian/login.php");
?>