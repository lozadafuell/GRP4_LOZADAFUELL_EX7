<?php
session_start(); // Start session once, here

$page = $_GET['page'] ?? 'home';
$pageTitle = ucfirst($page);
$currentPage = $page;

$allowedPages = ['home', 'about', 'contact', 'login'];

include 'includes/header.php';

if (in_array($page, $allowedPages)) {
    include "pages/{$page}.php";
} else {
    echo "<h2>404 - Page Not Found</h2><p>The page you requested does not exist.</p>";
}

include 'includes/footer.php';
?>
