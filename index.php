<?php
/**
 * index.php – Main portfolio page
 * Displays portfolio information and links to mini-apps.
 */

$pageTitle = 'Oleg Kurylo - Developer Portfolio';
$active    = 'home';
$rootDir   = '';

require __DIR__ . '/partials/nav.php';
?>

<section class="hero">
    <h1>Oleg Kurylo - Developer Portfolio</h1>
    <p>🇺🇦 From Ukraine · 🇩🇪 Based in Germany · 💻 C# · Avalonia UI · .NET · React</p>
    <p class="mt-1">
        <a href="https://github.com/Developer3421" target="_blank" rel="noopener" style="color:var(--orange-light)">GitHub</a>
        &nbsp;|&nbsp;
        <span style="color:var(--text-muted)">Microsoft Store</span>
    </p>
</section>

<main>

    <div class="card">
        <h2>🇬🇧 English</h2>
        <h3>About Me</h3>
        <p>I'm Oleg Kurylo, a self-taught C# desktop developer originally from Ukraine, currently living in Germany.</p>
        <p>My journey started in 2021 with small C# WinForms applications. After moving to Germany in 2022, I continued evolving and spent 2023-2024 building more advanced C# WPF applications. In 2025 I migrated everything to the cross-platform Avalonia UI framework, completing and polishing all my desktop apps. In winter 2025 I began publishing my apps to the Microsoft Store.</p>
        <p>Today I have 11 unique desktop applications available on the Microsoft Store, all built around a multi-window philosophy and integrating either external APIs or local AI components. My flagship project is Vetale Browser - a full-featured Avalonia/Chromium browser with an embedded Gemma 3 1B local AI model that runs even on older hardware.</p>
        <p>Most recently I created my first web applications (React + TypeScript) and built a hybrid Avalonia C# + React desktop application.</p>
    </div>

    <div class="card">
        <h2>🛠️ Tech Stack</h2>
        <div class="skills-grid">
            <span class="skill-badge">C#</span>
            <span class="skill-badge">Avalonia UI 11</span>
            <span class="skill-badge">WPF</span>
            <span class="skill-badge">WinForms</span>
            <span class="skill-badge">React 19</span>
            <span class="skill-badge">TypeScript</span>
            <span class="skill-badge">.NET 10 / 9 / 4.8</span>
            <span class="skill-badge">WebViewControl-Avalonia</span>
            <span class="skill-badge">CefSharp</span>
            <span class="skill-badge">WebView2</span>
            <span class="skill-badge">LLamaSharp</span>
            <span class="skill-badge">Whisper.net</span>
            <span class="skill-badge">Playwright</span>
            <span class="skill-badge">LiteDB</span>
            <span class="skill-badge">DPAPI (AES-256)</span>
            <span class="skill-badge">Roslyn</span>
            <span class="skill-badge">MSBuild</span>
            <span class="skill-badge">LibVLCSharp</span>
            <span class="skill-badge">LibreHardwareMonitor</span>
            <span class="skill-badge">WMI</span>
            <span class="skill-badge">LibGit2</span>
            <span class="skill-badge">Octokit</span>
        </div>
    </div>

    <div class="card">
        <h2>📅 Developer Journey</h2>
        <ul>
            <li>2021 - First C# WinForms apps (Ukraine)</li>
            <li>2022 - Moved to Germany, continued C# development</li>
            <li>2023 - Switched to C# WPF, growing app complexity</li>
            <li>2024 - WPF apps refined, Vetale Browser (WPF legacy) released</li>
            <li>2025 - Migrated all projects to Avalonia UI, integrated Gemma 3 1B local AI, published 11 apps to Microsoft Store, and built first React web apps plus a hybrid Avalonia + React app</li>
        </ul>
    </div>

    <div class="card">
        <h2>🖥️ Desktop Applications (Microsoft Store)</h2>

        <h3>📝 Insait Text Editor</h3>
        <p>Intelligent offline-first text editor with local AI assistant. Stack: C#, .NET 10, Avalonia UI, LLamaSharp, LiteDB, SkiaSharp.</p>

        <h3>🛠️ Insait Edit - C# IDE</h3>
        <p>Cross-platform IDE with Roslyn IntelliSense/refactoring, MSBuild integration, terminal emulator, Git/GitHub tools, NuGet/MSIX support, AXAML preview, and multilingual UI.</p>

        <h3>🎬 Insait Video Player</h3>
        <p>Desktop video player with tabs, subtitle/audio controls, and DPAPI-encrypted session storage. Stack includes Avalonia UI, LibVLCSharp, LiteDB.</p>

        <h3>🌍 Insait Translator: German (Hybrid App)</h3>
        <p>Hybrid Avalonia C# + React app with provider fallback translation, local HTTP backend, Piper TTS, and encrypted settings.</p>
    </div>

    <!-- PHP Projects -->
    <div class="card">
        <h2>🐘 PHP Projects</h2>
        <p>Interactive mini-apps built in pure PHP — no frameworks, session-based state, server-side logic.</p>

        <h3>🧮 Insait Calculator</h3>
        <p>Client-side arithmetic calculator with operator precedence, keyboard support, backspace and sign toggle. No eval — uses a safe custom expression parser.</p>
        <p><a href="apps/calculator.php" class="btn btn-primary" style="display:inline-block;margin-top:0.5rem">Open app →</a></p>

        <h3>📋 Insait Tasks</h3>
        <p>Session-based to-do list. Add, complete, delete and clear tasks — data persists across page reloads within the same session.</p>
        <p><a href="apps/todo.php" class="btn btn-primary" style="display:inline-block;margin-top:0.5rem">Open app →</a></p>

        <h3>🎯 Insait Quiz</h3>
        <p>10-question PHP knowledge quiz with progress bar, per-question feedback and a final score screen. Session-tracked state.</p>
        <p><a href="apps/quiz.php" class="btn btn-primary" style="display:inline-block;margin-top:0.5rem">Open app →</a></p>

        <h3>⚖️ Insait BMI</h3>
        <p>Body Mass Index calculator supporting both metric (kg / cm) and imperial (lbs / inches) units, with category classification and a visual BMI scale.</p>
        <p><a href="apps/bmi.php" class="btn btn-primary" style="display:inline-block;margin-top:0.5rem">Open app →</a></p>

        <h3>🔄 Insait Converter</h3>
        <p>Unit converter covering temperature, length, weight and volume with dynamic unit lists and precise conversion logic.</p>
        <p><a href="apps/converter.php" class="btn btn-primary" style="display:inline-block;margin-top:0.5rem">Open app →</a></p>
    </div>

    <div class="card">
        <h2>🏛️ Legacy / Historical Projects</h2>
        <ul>
            <li><strong>Vetale Browser Legacy (WPF, 2024):</strong> First-generation WPF browser using Microsoft WebView2.</li>
            <li><strong>Test (2021):</strong> First repository ever created.</li>
        </ul>
    </div>

    <div class="card">
        <h2>📊 All Repositories</h2>
        <ul>
            <li>Vetale-Browser-Official</li>
            <li>VetaleBrowserCode</li>
            <li>Insait-Text-Editor</li>
            <li>Insait-Edit-C-Sharp</li>
            <li>Insait-Video-Player</li>
            <li>Insait_Translator_German</li>
            <li>german-b1-step-further</li>
            <li>FileManager</li>
            <li>V-Task</li>
            <li>VRelaxTimer</li>
            <li>VCalc</li>
            <li>Vetale-Browser-SuperLite</li>
            <li>Vetale-Browser-Legacy-WPF-2024-</li>
            <li>Web-Projects</li>
            <li>CSharp-Portfolio</li>
        </ul>
    </div>

    <div class="card">
        <h2>📬 Contact</h2>
        <ul>
            <li>GitHub: <a href="https://github.com/Developer3421" target="_blank" rel="noopener" style="color:var(--orange-light)">Developer3421</a></li>
            <li>Microsoft Store: Oleg Kurylo apps</li>
        </ul>
    </div>

    <!-- ===== GERMAN LOCALIZATION ===== -->

    <div class="card">
        <h2>🇩🇪 Deutsch</h2>
        <h3>Über mich</h3>
        <p>Ich bin Oleg Kurylo, ein autodidaktischer C#-Desktop-Entwickler aus der Ukraine, der aktuell in Deutschland lebt.</p>
        <p>Meine Entwicklerreise begann 2021 mit kleinen C#-WinForms-Anwendungen. Nach meiner Übersiedlung nach Deutschland im Jahr 2022 entwickelte ich mich weiter und arbeitete 2023–2024 an fortgeschritteneren C#-WPF-Projekten. Im Jahr 2025 migrierte ich alle Projekte auf das plattformübergreifende Avalonia UI-Framework und schloss alle Desktop-Apps ab. Im Winter 2025 begann ich, meine Apps im Microsoft Store zu veröffentlichen.</p>
        <p>Heute verfüge ich über 11 einzigartige Desktop-Anwendungen im Microsoft Store, die alle auf einer Multi-Window-Philosophie basieren und entweder externe APIs oder lokale KI-Komponenten integrieren. Mein Hauptprojekt ist Vetale Browser — ein vollwertiger Avalonia/Chromium-Browser mit eingebettetem Gemma 3 1B-KI-Modell, das auch auf älterer Hardware offline läuft.</p>
        <p>Kürzlich habe ich meine ersten Web-Anwendungen (React + TypeScript) sowie eine hybride Avalonia C# + React-Desktop-Applikation entwickelt.</p>
    </div>

    <div class="card">
        <h2>🛠️ Technologie-Stack</h2>
        <div class="skills-grid">
            <span class="skill-badge">C#</span>
            <span class="skill-badge">Avalonia UI 11</span>
            <span class="skill-badge">WPF</span>
            <span class="skill-badge">WinForms</span>
            <span class="skill-badge">React 19</span>
            <span class="skill-badge">TypeScript</span>
            <span class="skill-badge">.NET 10 / 9 / 4.8</span>
            <span class="skill-badge">WebViewControl-Avalonia</span>
            <span class="skill-badge">CefSharp</span>
            <span class="skill-badge">WebView2</span>
            <span class="skill-badge">LLamaSharp</span>
            <span class="skill-badge">Whisper.net</span>
            <span class="skill-badge">Playwright</span>
            <span class="skill-badge">LiteDB</span>
            <span class="skill-badge">DPAPI (AES-256)</span>
            <span class="skill-badge">Roslyn</span>
            <span class="skill-badge">MSBuild</span>
            <span class="skill-badge">LibVLCSharp</span>
            <span class="skill-badge">LibreHardwareMonitor</span>
            <span class="skill-badge">WMI</span>
            <span class="skill-badge">LibGit2</span>
            <span class="skill-badge">Octokit</span>
        </div>
    </div>

    <div class="card">
        <h2>📅 Entwickler-Zeitlinie</h2>
        <ul>
            <li>2021 — Erste C# WinForms-Projekte (Ukraine)</li>
            <li>2022 — Umzug nach Deutschland · C#-Entwicklung fortgesetzt</li>
            <li>2023 — Wechsel zu C# WPF · wachsende App-Komplexität</li>
            <li>2024 — WPF-Apps verfeinert · Vetale Browser (WPF Legacy) veröffentlicht</li>
            <li>2025 — Alle Projekte auf Avalonia UI migriert · Gemma 3 1B lokal-KI integriert · 11 Apps im Microsoft Store veröffentlicht · Erste React-Web-Apps &amp; hybride Avalonia + React App</li>
        </ul>
    </div>

    <div class="card">
        <h2>🖥️ Desktop-Anwendungen (Microsoft Store)</h2>

        <h3>📝 Insait Text Editor</h3>
        <p>Intelligenter Texteditor mit offline-fähigem KI-Assistenten (Offline-First). Vollständige MVVM-Architektur mit modularen Services. Lokale KI-Inferenz (LLamaSharp) — keine Cloud-Abhängigkeit. Mehrsprachige Benutzeroberfläche. Stack: C# · .NET 10 · Avalonia UI · LLamaSharp · LiteDB · SkiaSharp.</p>

        <h3>🛠️ Insait Edit — C#-IDE</h3>
        <p>Moderne, plattformübergreifende Entwicklungsumgebung für C# und .NET auf Basis von Avalonia UI und der Roslyn-Compiler-Plattform. Vollständige Roslyn-Integration: IntelliSense, Code-Fixes, Umbenennen. MSBuild-Integration, eingebetteter ConPTY-Terminal, Git- und GitHub-Integration, NuGet-Paketmanager, AXAML-Live-Vorschau, mehrsprachige Oberfläche.</p>

        <h3>🎬 Insait Video Player</h3>
        <p>Funktionsreicher Desktop-Videoplayer mit Sitzungsverwaltung und verschlüsselter Datenspeicherung. Tab-Interface mit Drag-to-Reorder, Untertitelverwaltung und Audiospurauswahl. Stack: C# · .NET 10 · Avalonia UI 11.3 · LibVLCSharp · LiteDB · Windows DPAPI.</p>

        <h3>🌍 Insait Translator: German (Hybrid-App)</h3>
        <p>Hybride Avalonia C# + React App zum Übersetzen beliebiger Sprachen ins Deutsche. Anbieter-Fallback-System (MyMemory → Google Translate → Gemini API), lokaler HTTP-Backend-Server, Deutsch-TTS via Piper, AES-256 + Windows-DPAPI-verschlüsselte Einstellungen.</p>
    </div>

    <div class="card">
        <h2>🐘 PHP-Projekte</h2>
        <p>Interaktive Mini-Apps, entwickelt in reinem PHP — kein Framework, Session-basierter Zustand, serverseitige Logik.</p>

        <h3>🧮 Insait Calculator</h3>
        <p>Arithmetischer Rechner mit Operatorpriorität, Tastaturunterstützung, Rücktaste und Vorzeichenwechsel. Kein eval — sicherer benutzerdefinierter Ausdrucks-Parser.</p>
        <p><a href="apps/calculator.php" class="btn btn-primary" style="display:inline-block;margin-top:0.5rem">App öffnen →</a></p>

        <h3>📋 Insait Tasks</h3>
        <p>Session-basierte Aufgabenliste. Aufgaben hinzufügen, abschließen, löschen und leeren — Daten bleiben innerhalb der Session erhalten.</p>
        <p><a href="apps/todo.php" class="btn btn-primary" style="display:inline-block;margin-top:0.5rem">App öffnen →</a></p>

        <h3>🎯 Insait Quiz</h3>
        <p>10-Fragen-PHP-Wissensquiz mit Fortschrittsanzeige, Frage-Feedback und Ergebnisbildschirm. Session-basierter Zustand.</p>
        <p><a href="apps/quiz.php" class="btn btn-primary" style="display:inline-block;margin-top:0.5rem">App öffnen →</a></p>

        <h3>⚖️ Insait BMI</h3>
        <p>Body-Mass-Index-Rechner mit Unterstützung für metrische (kg / cm) und imperiale (lbs / Zoll) Einheiten, Kategorieklassifizierung und visueller BMI-Skala.</p>
        <p><a href="apps/bmi.php" class="btn btn-primary" style="display:inline-block;margin-top:0.5rem">App öffnen →</a></p>

        <h3>🔄 Insait Converter</h3>
        <p>Einheitenkonverter für Temperatur, Länge, Gewicht und Volumen mit dynamischen Einheitenlisten und präziser Konvertierungslogik.</p>
        <p><a href="apps/converter.php" class="btn btn-primary" style="display:inline-block;margin-top:0.5rem">App öffnen →</a></p>
    </div>

    <div class="card">
        <h2>🏛️ Legacy- / Historische Projekte</h2>
        <ul>
            <li><strong>Vetale Browser Legacy (WPF, 2024):</strong> Erste WPF-Browser-Generation mit Microsoft WebView2 — Grundlage für alle späteren Versionen.</li>
            <li><strong>Test (2021):</strong> Allererste Repository — ein historischer Meilenstein.</li>
        </ul>
    </div>

    <div class="card">
        <h2>📊 Alle Repositories</h2>
        <ul>
            <li>Vetale-Browser-Official</li>
            <li>VetaleBrowserCode</li>
            <li>Insait-Text-Editor</li>
            <li>Insait-Edit-C-Sharp</li>
            <li>Insait-Video-Player</li>
            <li>Insait_Translator_German</li>
            <li>german-b1-step-further</li>
            <li>FileManager</li>
            <li>V-Task</li>
            <li>VRelaxTimer</li>
            <li>VCalc</li>
            <li>Vetale-Browser-SuperLite</li>
            <li>Vetale-Browser-Legacy-WPF-2024-</li>
            <li>Web-Projects</li>
            <li>CSharp-Portfolio</li>
        </ul>
    </div>

    <div class="card">
        <h2>📬 Kontakt</h2>
        <ul>
            <li>GitHub: <a href="https://github.com/Developer3421" target="_blank" rel="noopener" style="color:var(--orange-light)">Developer3421</a></li>
            <li>Microsoft Store: Oleg Kurylo Apps</li>
        </ul>
    </div>

</main>

<?php require __DIR__ . '/partials/footer.php'; ?>
