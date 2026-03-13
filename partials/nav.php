<?php
/**
 * Shared navigation component.
 * Include at the top of every page.
 *
 * Usage:  $active = 'home'; // or 'calculator', 'todo', 'quiz', 'bmi', 'converter'
 *         require __DIR__ . '/partials/nav.php';
 */
$active  = $active  ?? 'home';
$rootDir = $rootDir ?? '';   // '' for root pages, '../' for apps/
?>
<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($pageTitle ?? 'PHP Portfolio') ?></title>
    <link rel="stylesheet" href="<?= $rootDir ?>assets/style.css">
</head>
<body>
<nav>
    <a href="<?= $rootDir ?>index.php" class="brand">PHP<span>Portfolio</span></a>
    <ul class="nav-links">
        <li><a href="<?= $rootDir ?>index.php"              <?= $active === 'home'       ? 'class="active"' : '' ?>>🏠 Головна</a></li>
        <li><a href="<?= $rootDir ?>apps/calculator.php"    <?= $active === 'calculator' ? 'class="active"' : '' ?>>🧮 Калькулятор</a></li>
        <li><a href="<?= $rootDir ?>apps/todo.php"          <?= $active === 'todo'       ? 'class="active"' : '' ?>>📋 Завдання</a></li>
        <li><a href="<?= $rootDir ?>apps/quiz.php"          <?= $active === 'quiz'       ? 'class="active"' : '' ?>>🎯 Вікторина</a></li>
        <li><a href="<?= $rootDir ?>apps/bmi.php"           <?= $active === 'bmi'        ? 'class="active"' : '' ?>>⚖️ ІМТ</a></li>
        <li><a href="<?= $rootDir ?>apps/converter.php"     <?= $active === 'converter'  ? 'class="active"' : '' ?>>🔄 Конвертер</a></li>
    </ul>
</nav>
