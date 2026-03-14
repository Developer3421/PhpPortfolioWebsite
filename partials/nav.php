<?php
/**
 * Shared navigation component.
 * Include at the top of every page.
 *
 * Usage:  $active = 'home'; // or 'calculator', 'todo', 'quiz', 'bmi', 'converter'
 *         require __DIR__ . '/partials/nav.php';
 */
if (session_status() === PHP_SESSION_NONE) session_start();

// Language switch via GET param
if (isset($_GET['lang']) && in_array($_GET['lang'], ['en', 'de'], true)) {
    $_SESSION['lang'] = $_GET['lang'];
}
$lang    = $_SESSION['lang'] ?? 'en';
$active  = $active  ?? 'home';
$rootDir = $rootDir ?? '';   // '' for root pages, '../' for apps/
?>
<!DOCTYPE html>
<html lang="<?= $lang ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($pageTitle ?? 'PHP Portfolio') ?></title>
    <link rel="stylesheet" href="<?= $rootDir ?>assets/style.css">
</head>
<body>
<nav>
    <a href="<?= $rootDir ?>index.php" class="brand">Insait<span>Apps</span></a>
    <span class="brand-author">by Oleg Kurylo</span>
    <ul class="nav-links">
        <li><a href="<?= $rootDir ?>index.php"              <?= $active === 'home'       ? 'class="active"' : '' ?>>🏠 Home</a></li>
        <li><a href="<?= $rootDir ?>apps/calculator.php"    <?= $active === 'calculator' ? 'class="active"' : '' ?>>🧮 Insait Calculator</a></li>
        <li><a href="<?= $rootDir ?>apps/todo.php"          <?= $active === 'todo'       ? 'class="active"' : '' ?>>📋 Insait Tasks</a></li>
        <li><a href="<?= $rootDir ?>apps/quiz.php"          <?= $active === 'quiz'       ? 'class="active"' : '' ?>>🎯 Insait Quiz</a></li>
        <li><a href="<?= $rootDir ?>apps/bmi.php"           <?= $active === 'bmi'        ? 'class="active"' : '' ?>>⚖️ Insait BMI</a></li>
        <li><a href="<?= $rootDir ?>apps/converter.php"     <?= $active === 'converter'  ? 'class="active"' : '' ?>>🔄 Insait Converter</a></li>
    </ul>
    <div class="lang-switcher">
        <a href="?lang=en" class="lang-btn <?= $lang === 'en' ? 'lang-active' : '' ?>">🇬🇧 EN</a>
        <a href="?lang=de" class="lang-btn <?= $lang === 'de' ? 'lang-active' : '' ?>">🇩🇪 DE</a>
    </div>
</nav>
