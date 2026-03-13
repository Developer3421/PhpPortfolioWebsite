<?php
/**
 * index.php – Main portfolio page
 * Displays portfolio information and links to mini-apps.
 */

$pageTitle = 'PHP Portfolio – Home';
$active    = 'home';
$rootDir   = '';

require __DIR__ . '/partials/nav.php';
?>

<section class="hero">
    <h1>PHP Portfolio</h1>
    <p>Welcome to my PHP portfolio! Here you will find information about me and a set of built-in mini-apps.</p>
</section>

<main>

    <!-- About -->
    <div class="card">
        <h2>👤 About Me</h2>
        <p>
            Hi! I'm <strong>Developer3421</strong> — a developer passionate about building clean, efficient,
            and scalable software across multiple platforms and languages.
            This site is my PHP portfolio and showcases some of my web skills through a set of interactive mini-apps.
        </p>
        <p class="mt-1">
            Beyond web development, I actively maintain the <strong>Insait</strong> suite of desktop tools
            (text editor, video player, translator, drawing app) and the <strong>Vetale Browser</strong> —
            a modern Windows browser with a highly customisable UI and optional local AI features.
            The project is built entirely in plain PHP without external frameworks, with custom CSS in an orange-purple style.
        </p>
    </div>

    <!-- Skills -->
    <div class="card">
        <h2>🛠️ Skills</h2>
        <div class="skills-grid">
            <span class="skill-badge">PHP 8+</span>
            <span class="skill-badge">C# / .NET</span>
            <span class="skill-badge">WPF</span>
            <span class="skill-badge">HTML5</span>
            <span class="skill-badge">CSS3</span>
            <span class="skill-badge">JavaScript</span>
            <span class="skill-badge">Git</span>
            <span class="skill-badge">OOP</span>
            <span class="skill-badge">Playwright</span>
            <span class="skill-badge">MakeCode / micro:bit</span>
            <span class="skill-badge">REST API</span>
            <span class="skill-badge">JSON</span>
        </div>
    </div>

    <!-- Projects -->
    <div class="card">
        <h2>🚀 Projects</h2>

        <h3>🌐 PHP Portfolio Website</h3>
        <p>A full portfolio site built in pure PHP with a set of built-in Insait mini-apps.
           Features: responsive design, session state, form validation, and an orange-purple theme.</p>

        <h3>🖌️ Insait Draw</h3>
        <p>A browser-based drawing application built with JavaScript, allowing freehand sketching directly in the browser.</p>

        <h3>✏️ Insait Text Editor</h3>
        <p>A lightweight text editor built in C# for quickly creating and editing plain-text files on Windows.</p>

        <h3>🎬 Insait Video Player</h3>
        <p>A C# desktop video player with a clean interface for playback of local media files on Windows.</p>

        <h3>🌍 Insait Translator</h3>
        <p>A C# application that assists with German language translation, aimed at learners and everyday use.</p>

        <h3>🌐 Vetale Browser</h3>
        <p>A modern Windows browser with a highly customisable UI, power-user tab workflows, built-in tools,
           and optional local AI. Includes automation (Playwright) and voice input features.
           Available in Official, Legacy WPF, and SuperLite editions.</p>

        <h3>🧮 VCalc</h3>
        <p>A desktop calculator application built in C# for quick everyday calculations.</p>

        <h3>⏱️ VRelaxTimer</h3>
        <p>A relaxation and break timer app built in C# to help maintain healthy work habits.</p>

        <h3>🗂️ File Manager</h3>
        <p>A Windows file manager written in C# offering a clean alternative interface for file system navigation.</p>

        <h3>✅ V-Task</h3>
        <p>A task management application written in C# for organising and tracking personal to-do lists.</p>

        <h3>🤖 micro:bit Projects</h3>
        <p>A collection of embedded projects for the BBC micro:bit built with MakeCode, including a morse chat,
           countdown timer, clap-activated lights, and interactive pet animations.</p>
    </div>

    <!-- Mini-apps shortcuts -->
    <div class="card">
        <h2>🎮 Mini-Apps</h2>
        <p class="mt-1">Try one of the built-in PHP Insait mini-apps:</p>
        <div class="flex-row mt-2">
            <a href="apps/calculator.php" class="btn btn-primary">🧮 Insait Calculator</a>
            <a href="apps/todo.php"       class="btn btn-secondary">📋 Insait Tasks</a>
            <a href="apps/quiz.php"       class="btn btn-primary">🎯 Insait Quiz</a>
            <a href="apps/bmi.php"        class="btn btn-secondary">⚖️ Insait BMI</a>
            <a href="apps/converter.php"  class="btn btn-primary">🔄 Insait Converter</a>
        </div>
    </div>

    <!-- Contact -->
    <div class="card">
        <h2>📬 Contact</h2>
        <ul>
            <li>GitHub: <a href="https://github.com/Developer3421" target="_blank" style="color:var(--orange-light)">Developer3421</a></li>
            <li>Email: developer3421@example.com</li>
        </ul>
    </div>

    <!-- Repo info from README -->
    <div class="card">
        <h2>📄 Repository README</h2>
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
            echo '<p style="color:var(--text-muted)">README.md not found.</p>';
        }
        ?>
    </div>

</main>

<?php require __DIR__ . '/partials/footer.php'; ?>
