<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo htmlspecialchars($pageTitle); ?></title>
    <meta name="description" content="<?php echo htmlspecialchars($pageDescription); ?>">
    <meta name="robots" content="noindex,nofollow">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&icon_names=shaved_ice" />
</head>
<body>
<header class="site-header">
    <div class="header-top">
        <a class="logo" href="index.php">
            <span class="material-symbols-outlined">shaved_ice</span>
            <h1>SugarRush</h1>
        </a>
    </div>

    <nav class="site-nav">
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="products.php">All Products</a></li>
            <li><a href="register.php">Register</a></li>
            <li><a href="register.php?manage=1">Edit User Info</a></li>
            <li><a href="register.php?delete=1">Delete User</a></li>
        </ul>
    </nav>
</header>
<main>