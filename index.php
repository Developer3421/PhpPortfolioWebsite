<?php
/**
 * index.php – Main portfolio page
 * Displays portfolio information and links to mini-apps.
 */

$pageTitle = 'PHP Portfolio – Головна';
$active    = 'home';
$rootDir   = '';

require __DIR__ . '/partials/nav.php';
?>

<section class="hero">
    <h1>PHP Portfolio</h1>
    <p>Ласкаво просимо до мого PHP-портфоліо! Тут ви знайдете інформацію про мене та набір міні-додатків.</p>
</section>

<main>

    <!-- About -->
    <div class="card">
        <h2>👤 Про мене</h2>
        <p>
            Привіт! Я PHP-розробник, що захоплюється створенням чистого, ефективного та масштабованого коду.
            Цей сайт є моїм портфоліо та демонструє деякі з моїх навичок через набір міні-додатків.
        </p>
        <p class="mt-1">
            Проєкт побудований повністю на чистому PHP без зовнішніх фреймворків,
            із власним CSS у помаранчево-фіолетовому стилі.
        </p>
    </div>

    <!-- Skills -->
    <div class="card">
        <h2>🛠️ Навички</h2>
        <div class="skills-grid">
            <span class="skill-badge">PHP 8+</span>
            <span class="skill-badge">HTML5</span>
            <span class="skill-badge">CSS3</span>
            <span class="skill-badge">JavaScript</span>
            <span class="skill-badge">MySQL</span>
            <span class="skill-badge">Git</span>
            <span class="skill-badge">REST API</span>
            <span class="skill-badge">OOP</span>
            <span class="skill-badge">MVC</span>
            <span class="skill-badge">Linux</span>
            <span class="skill-badge">Composer</span>
            <span class="skill-badge">JSON</span>
        </div>
    </div>

    <!-- Projects -->
    <div class="card">
        <h2>🚀 Проєкти</h2>

        <h3>📂 PHP Portfolio Website</h3>
        <p>Повноцінний портфоліо-сайт на чистому PHP з набором вбудованих міні-додатків.
           Особливості: адаптивний дизайн, сесійний стан, валідація форм, помаранчево-фіолетова тема.</p>

        <h3>🧮 Веб-калькулятор</h3>
        <p>Інтерактивний калькулятор із підтримкою базових арифметичних операцій, реалізований на PHP та JavaScript.</p>

        <h3>📋 Менеджер завдань</h3>
        <p>Простий To-Do додаток із сесійним збереженням даних, можливістю додавати, відмічати та видаляти завдання.</p>

        <h3>🎯 PHP-вікторина</h3>
        <p>Інтерактивна вікторина з PHP-питаннями, підрахунком балів та відзначенням правильних/неправильних відповідей.</p>

        <h3>⚖️ Калькулятор ІМТ</h3>
        <p>Обчислення Індексу Маси Тіла з категоризацією та рекомендаціями щодо здоров'я.</p>

        <h3>🔄 Конвертер одиниць</h3>
        <p>Конвертер для температури, довжини, ваги та об'єму між різними системами вимірювань.</p>
    </div>

    <!-- Mini-apps shortcuts -->
    <div class="card">
        <h2>🎮 Міні-додатки</h2>
        <p class="mt-1">Перейдіть до одного з вбудованих PHP міні-додатків:</p>
        <div class="flex-row mt-2">
            <a href="apps/calculator.php" class="btn btn-primary">🧮 Калькулятор</a>
            <a href="apps/todo.php"       class="btn btn-secondary">📋 Завдання</a>
            <a href="apps/quiz.php"       class="btn btn-primary">🎯 Вікторина</a>
            <a href="apps/bmi.php"        class="btn btn-secondary">⚖️ ІМТ</a>
            <a href="apps/converter.php"  class="btn btn-primary">🔄 Конвертер</a>
        </div>
    </div>

    <!-- Contact -->
    <div class="card">
        <h2>📬 Контакти</h2>
        <ul>
            <li>GitHub: <a href="https://github.com/Developer3421" target="_blank" style="color:var(--orange-light)">Developer3421</a></li>
            <li>Email: developer3421@example.com</li>
        </ul>
    </div>

    <!-- Repo info from README -->
    <div class="card">
        <h2>📄 README репозиторію</h2>
        <?php
        $readmePath = __DIR__ . '/README.md';
        if (file_exists($readmePath)) {
            $content = file_get_contents($readmePath);
            // Minimal Markdown → HTML conversion
            $content = htmlspecialchars($content, ENT_QUOTES, 'UTF-8');
            $content = preg_replace('/^### (.+)$/m', '<h3>$1</h3>', $content);
            $content = preg_replace('/^## (.+)$/m',  '<h2 style="color:var(--purple-light);margin:1rem 0 0.5rem">$1</h2>', $content);
            $content = preg_replace('/^# (.+)$/m',   '<h1 style="color:var(--orange-light);font-size:1.6rem;margin:0.5rem 0">$1</h1>', $content);
            $content = preg_replace('/\*\*(.+?)\*\*/s', '<strong>$1</strong>', $content);
            $content = preg_replace('/\*(.+?)\*/s', '<em>$1</em>', $content);
            $content = preg_replace('/`(.+?)`/', '<code style="background:rgba(255,255,255,0.1);padding:0.1em 0.4em;border-radius:4px;font-family:monospace">$1</code>', $content);
            $content = nl2br($content);
            echo '<div style="color:var(--text-muted)">' . $content . '</div>';
        } else {
            echo '<p style="color:var(--text-muted)">README.md не знайдено.</p>';
        }
        ?>
    </div>

</main>

<?php require __DIR__ . '/partials/footer.php'; ?>
