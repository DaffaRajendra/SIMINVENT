<?php
require_once __DIR__ . '/helpers.php';

if (!isset($_SESSION['user_id'])) {
    setFlash('error', 'Silakan login terlebih dahulu.');
    redirect('../auth/login.php');
}