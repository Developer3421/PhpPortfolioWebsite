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
    <title><?= htmlspecialchars($pageTitle ?? 'InsaitApps') ?></title>
    <link rel="icon" href="<?= $rootDir ?>assets/InsaitLogo.png" type="image/png">
    <link rel="stylesheet" href="<?= $rootDir ?>assets/style.css">
</head>
<body>
<nav>
    <a href="<?= $rootDir ?>index.php" class="brand">Insait<span>Apps</span></a>
    <span class="brand-author">by Oleg Kurylo</span>
    <ul class="nav-links">
        <li><a href="<?= $rootDir ?>index.php"           <?= $active === 'home'       ? 'class="active"' : '' ?>>
            <svg class="nav-icon" viewBox="0 0 20 20"><path d="M10 2L2 9h2v9h5v-5h2v5h5V9h2L10 2z"/></svg> Home</a></li>
        <li><a href="<?= $rootDir ?>apps/calculator.php" <?= $active === 'calculator' ? 'class="active"' : '' ?>>
            <svg class="nav-icon" viewBox="0 0 20 20"><rect x="3" y="2" width="14" height="16" rx="2" fill="none" stroke="currentColor" stroke-width="1.5"/><rect x="6" y="5" width="8" height="2.5" rx="1"/><circle cx="6.5" cy="11" r="1"/><circle cx="10" cy="11" r="1"/><circle cx="13.5" cy="11" r="1"/><circle cx="6.5" cy="14.5" r="1"/><circle cx="10" cy="14.5" r="1"/><circle cx="13.5" cy="14.5" r="1"/></svg> Insait Calculator</a></li>
        <li><a href="<?= $rootDir ?>apps/todo.php"       <?= $active === 'todo'       ? 'class="active"' : '' ?>>
            <svg class="nav-icon" viewBox="0 0 20 20"><rect x="3" y="3" width="14" height="14" rx="2" fill="none" stroke="currentColor" stroke-width="1.5"/><path d="M7 7h6M7 10h6M7 13h4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/></svg> Insait Tasks</a></li>
        <li><a href="<?= $rootDir ?>apps/quiz.php"       <?= $active === 'quiz'       ? 'class="active"' : '' ?>>
            <svg class="nav-icon" viewBox="0 0 20 20"><circle cx="10" cy="10" r="8" fill="none" stroke="currentColor" stroke-width="1.5"/><path d="M8 8c0-1.1.9-2 2-2s2 .9 2 2c0 1-1 1.5-2 2v1" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/><circle cx="10" cy="14.5" r="0.75" fill="currentColor"/></svg> Insait Quiz</a></li>
        <li><a href="<?= $rootDir ?>apps/bmi.php"        <?= $active === 'bmi'        ? 'class="active"' : '' ?>>
            <svg class="nav-icon" viewBox="0 0 20 20"><path d="M10 3v14M4 10h12" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/><circle cx="4" cy="10" r="2" fill="none" stroke="currentColor" stroke-width="1.2"/><circle cx="16" cy="10" r="2" fill="none" stroke="currentColor" stroke-width="1.2"/></svg> Insait BMI</a></li>
        <li><a href="<?= $rootDir ?>apps/converter.php"  <?= $active === 'converter'  ? 'class="active"' : '' ?>>
            <svg class="nav-icon" viewBox="0 0 20 20"><path d="M4 6h9l-3-3m0 6l3-3M16 14H7l3 3m0-6l-3 3" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg> Insait Converter</a></li>
    </ul>
    <div class="lang-switcher">
        <a href="?lang=en" class="lang-btn <?= $lang === 'en' ? 'lang-active' : '' ?>">🇬🇧 EN</a>
        <a href="?lang=de" class="lang-btn <?= $lang === 'de' ? 'lang-active' : '' ?>">🇩🇪 DE</a>
    </div>
</nav>
