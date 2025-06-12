<?php
session_start();
if (!isset($_SESSION['ID'])) {
    header('Location: Index.php');
    exit;
}

?>