<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: /pengajian/login.php");
    exit;
}
?>