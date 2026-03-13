<?php
/**
 * index.php – Main portfolio page
 * Displays Oleg Kurylo's developer portfolio with bilingual (EN/DE) support.
 */

$pageTitle = 'Oleg Kurylo — Developer Portfolio';
$active    = 'home';
$rootDir   = '';

$lang = 'en';
if (isset($_GET['lang']) && $_GET['lang'] === 'de') {
    $lang = 'de';
}

require __DIR__ . '/partials/nav.php';
?>

<style>
.lang-toggle { text-align: right; margin-bottom: 1rem; }
.lang-toggle a {
    display: inline-block;
    padding: 0.3rem 0.8rem;
    border-radius: 4px;
    text-decoration: none;
    font-weight: 600;
    color: var(--text-muted);
    border: 1px solid var(--text-muted);
    margin-left: 0.4rem;
    transition: background 0.2s, color 0.2s;
}
.lang-toggle a.active-lang {
    background: var(--orange);
    color: #fff;
    border-color: var(--orange);
}
.portfolio-table { width: 100%; border-collapse: collapse; margin-top: 0.75rem; }
.portfolio-table th, .portfolio-table td {
    padding: 0.45rem 0.7rem;
    border: 1px solid rgba(255,255,255,0.12);
    text-align: left;
    vertical-align: top;
}
.portfolio-table th { background: rgba(255,255,255,0.07); color: var(--orange-light); }
.portfolio-table td { color: var(--text-muted); }
.journey-line { font-family: monospace; color: var(--text-muted); line-height: 1.9; white-space: pre-wrap; }
.app-links a { color: var(--orange-light); margin-right: 0.8rem; text-decoration: none; }
.app-links a:hover { text-decoration: underline; }
.stack-note { font-size: 0.85rem; color: var(--text-muted); margin-top: 0.3rem; }
</style>

<section class="hero">
    <h1>Oleg Kurylo — Developer Portfolio</h1>
    <p>🇺🇦 From Ukraine &nbsp;·&nbsp; 🇩🇪 Based in Germany &nbsp;·&nbsp; 💻 C# · Avalonia UI · .NET · React</p>
    <div style="margin-top:0.75rem">
        <a href="https://github.com/Developer3421" target="_blank" class="btn btn-primary" style="margin-right:0.5rem">GitHub</a>
        <a href="https://apps.microsoft.com/search?query=Oleg+Kurylo" target="_blank" class="btn btn-secondary">Microsoft Store</a>
    </div>
</section>

<main>

<div class="lang-toggle">
    <a href="?lang=en" <?= $lang === 'en' ? 'class="active-lang"' : '' ?>>🇬🇧 English</a>
    <a href="?lang=de" <?= $lang === 'de' ? 'class="active-lang"' : '' ?>>🇩🇪 Deutsch</a>
</div>

<?php if ($lang === 'en'): ?>

    <!-- About Me – English -->
    <div class="card">
        <h2>👤 About Me</h2>
        <p>
            I'm <strong>Oleg Kurylo</strong>, a self-taught C# desktop developer originally from Ukraine,
            currently living in Germany.
        </p>
        <p class="mt-1">
            My journey started in 2021 with small C# WinForms applications. After moving to Germany in 2022,
            I continued evolving and spent 2023–2024 building more advanced C# WPF applications.
            In 2025 I migrated everything to the cross-platform <strong>Avalonia UI</strong> framework,
            completing and polishing all my desktop apps. In winter 2025 I began publishing my apps to
            the <strong>Microsoft Store</strong>.
        </p>
        <p class="mt-1">
            Today I have <strong>11 unique desktop applications</strong> available on the Microsoft Store,
            all built around a multi-window philosophy and integrating either external APIs or local AI components.
            My flagship project is <strong>Vetale Browser</strong> — a full-featured Avalonia/Chromium browser
            with an embedded Gemma 3 1B local AI model that runs even on older hardware.
        </p>
        <p class="mt-1">
            Most recently I created my first web applications (React + TypeScript) and built a hybrid
            Avalonia C# + React desktop application.
        </p>
    </div>

    <!-- Tech Stack – English -->
    <div class="card">
        <h2>🛠️ Tech Stack</h2>
        <table class="portfolio-table">
            <thead><tr><th>Area</th><th>Technologies</th></tr></thead>
            <tbody>
                <tr><td>Primary language</td><td>C#</td></tr>
                <tr><td>Desktop UI</td><td>Avalonia UI 11, WPF, WinForms</td></tr>
                <tr><td>Web / Hybrid</td><td>React 19, TypeScript, Vite, Tailwind CSS</td></tr>
                <tr><td>Runtime</td><td>.NET 10, .NET 9, .NET Framework 4.8</td></tr>
                <tr><td>Web rendering</td><td>WebViewControl-Avalonia (Chromium), CefSharp, Microsoft WebView2</td></tr>
                <tr><td>Local AI</td><td>LLamaSharp, Gemma 3 1B, Whisper.net</td></tr>
                <tr><td>Automation</td><td>Microsoft Playwright</td></tr>
                <tr><td>Database</td><td>LiteDB, Windows DPAPI (AES-256)</td></tr>
                <tr><td>Compiler tools</td><td>Microsoft Roslyn, MSBuild</td></tr>
                <tr><td>Media</td><td>LibVLCSharp</td></tr>
                <tr><td>Hardware monitoring</td><td>LibreHardwareMonitor, WMI</td></tr>
                <tr><td>Source control</td><td>LibGit2, Octokit</td></tr>
            </tbody>
        </table>
    </div>

    <!-- Developer Journey – English -->
    <div class="card">
        <h2>📅 Developer Journey</h2>
        <div class="journey-line">2021  ──▶  First C# WinForms apps (Ukraine)
2022  ──▶  Moved to Germany · continued C# development
2023  ──▶  Switched to C# WPF · growing app complexity
2024  ──▶  WPF apps refined · Vetale Browser (WPF legacy) released
2025  ──▶  Migrated all projects to Avalonia UI
            Gemma 3 1B local AI integrated
            11 apps published to Microsoft Store (winter 2025)
            First React web apps &amp; hybrid Avalonia + React app</div>
    </div>

    <!-- Desktop Applications – English -->
    <div class="card">
        <h2>🖥️ Desktop Applications (Microsoft Store)</h2>

        <h3>🌐 Vetale Browser <em style="font-weight:400;font-size:0.9rem">(Flagship)</em></h3>
        <p>A modern Windows browser with local AI, a highly customizable UI, and built-in tools for power users.</p>
        <ul>
            <li>Avalonia UI + WebViewControl-Avalonia (Chromium-based rendering)</li>
            <li>Embedded Gemma 3 1B local AI — runs offline, even on older hardware</li>
            <li>Voice input via Whisper.net pipeline</li>
            <li>Multi-window tab workflow with drag &amp; drop</li>
            <li>Built-in DevTools / automation via Microsoft Playwright</li>
            <li>GDPR-style user agreement &amp; local-only data storage</li>
            <li>Target: .NET 10 · win-x64, win-x86, win-arm64</li>
        </ul>
        <p class="stack-note">Stack: C# · Avalonia UI · WebViewControl-Avalonia · LLamaSharp · Whisper.net · Playwright</p>
        <div class="app-links">
            <a href="https://apps.microsoft.com/search?query=Vetale+Browser" target="_blank">Microsoft Store</a>
            <a href="https://github.com/Developer3421/VetaleBrowserCode" target="_blank">GitHub Source Code</a>
        </div>

        <hr style="border-color:rgba(255,255,255,0.08);margin:1.2rem 0">

        <h3>📝 Insait Text Editor</h3>
        <p>Intelligent text editor with an offline-first local AI assistant.</p>
        <ul>
            <li>Full MVVM architecture with modular services</li>
            <li>Local AI inference (LLamaSharp) — no cloud dependency</li>
            <li>Multilingual UI</li>
        </ul>
        <p class="stack-note">Stack: C# · .NET 10 · Avalonia UI · LLamaSharp · LiteDB · SkiaSharp</p>
        <div class="app-links">
            <a href="https://apps.microsoft.com/search?query=Insait+Text+Editor" target="_blank">Microsoft Store</a>
            <a href="https://github.com/Developer3421/Insait-Text-Editor" target="_blank">GitHub</a>
        </div>

        <hr style="border-color:rgba(255,255,255,0.08);margin:1.2rem 0">

        <h3>🛠️ Insait Edit — C# IDE</h3>
        <p>A modern, cross-platform IDE for C# and .NET development built on Avalonia UI and the Roslyn compiler platform.</p>
        <ul>
            <li>Full Roslyn integration: IntelliSense, code fixes, rename refactoring</li>
            <li>MSBuild integration: build, run, and publish .NET projects</li>
            <li>Embedded ConPTY terminal emulator with ANSI rendering</li>
            <li>Git &amp; GitHub integration (commit, push, pull, diff, clone)</li>
            <li>NuGet package manager &amp; MSIX manager built in</li>
            <li>ESP32 / nanoFramework support with visual LED panel designer</li>
            <li>AXAML live preview for Avalonia UI files</li>
            <li>Multilingual UI (English, Ukrainian, German, Russian, Turkish)</li>
            <li>Gemini AI assistant for code help and translation</li>
        </ul>
        <p class="stack-note">Stack: C# · .NET 10 · Avalonia UI 11.3 · Roslyn 5.0 · MSBuild · LibGit2 · NuGet.Protocol · Octokit · LiteDB · nanoFramework</p>
        <div class="app-links">
            <a href="https://github.com/Developer3421/Insait-Edit-C-Sharp" target="_blank">GitHub</a>
        </div>

        <hr style="border-color:rgba(255,255,255,0.08);margin:1.2rem 0">

        <h3>🎬 Insait Video Player</h3>
        <p>Feature-rich desktop video player with session management and encrypted data storage.</p>
        <ul>
            <li>Tab interface with drag-to-reorder and overflow menu</li>
            <li>Session management with Windows DPAPI-encrypted storage</li>
            <li>Subtitle management and audio track selection</li>
        </ul>
        <p class="stack-note">Stack: C# · .NET 10 · Avalonia UI 11.3 · LibVLCSharp · LiteDB · Windows DPAPI</p>
        <div class="app-links">
            <a href="https://apps.microsoft.com/search?query=Insait+Video+Player" target="_blank">Microsoft Store</a>
            <a href="https://github.com/Developer3421/Insait-Video-Player" target="_blank">GitHub</a>
        </div>

        <hr style="border-color:rgba(255,255,255,0.08);margin:1.2rem 0">

        <h3>🌍 Insait Translator: German <em style="font-weight:400;font-size:0.9rem">(Hybrid App)</em></h3>
        <p>Hybrid Avalonia C# + React app that translates any language into German with optional Text-to-Speech.</p>
        <ul>
            <li>Hybrid architecture: Avalonia desktop shell with embedded React web UI</li>
            <li>Multi-provider fallback system (MyMemory → Google Translate → Gemini API)</li>
            <li>Local HTTP backend server for the React UI — no Node.js runtime required</li>
            <li>German TTS via Piper — playback and MP3 export</li>
            <li>AES-256 + Windows DPAPI encrypted settings</li>
        </ul>
        <p class="stack-note">Stack: C# · .NET 10 · Avalonia UI 11 · ReactiveUI · React/Vite · LiteDB · Piper TTS · NAudio · AES-256</p>
        <div class="app-links">
            <a href="https://apps.microsoft.com/search?query=Insait+Translator" target="_blank">Microsoft Store</a>
            <a href="https://github.com/Developer3421/Insait_Translator_German" target="_blank">GitHub</a>
        </div>

        <hr style="border-color:rgba(255,255,255,0.08);margin:1.2rem 0">

        <h3>📅 German B1 – Step Further</h3>
        <p>Structured German-language learning app (B1 level) with integrated AI assistant.</p>
        <ul>
            <li>4 sections × 18 topics: vocabulary, conversation, grammar, exercises</li>
            <li>Session management with bookmark functionality</li>
            <li>Gemma-3-270m local AI for personalized learning support</li>
        </ul>
        <p class="stack-note">Stack: C# · .NET 10 · Avalonia UI · LiteDB · LLamaSharp</p>
        <div class="app-links">
            <a href="https://apps.microsoft.com/search?query=German+B1+Step+Further" target="_blank">Microsoft Store</a>
            <a href="https://github.com/Developer3421/german-b1-step-further" target="_blank">GitHub</a>
        </div>

        <hr style="border-color:rgba(255,255,255,0.08);margin:1.2rem 0">

        <h3>📁 FileManager</h3>
        <p>Modern, lightweight file manager with multi-tab navigation.</p>
        <ul>
            <li>Multi-tab navigation with persistent tab restore on startup</li>
            <li>Native Windows Shell context menus</li>
            <li>Built-in image viewer · Drive usage display</li>
            <li>Multilingual (English, Ukrainian, German)</li>
        </ul>
        <p class="stack-note">Stack: C# · .NET · Avalonia UI</p>
        <div class="app-links">
            <a href="https://apps.microsoft.com/search?query=Insait+FileManager" target="_blank">Microsoft Store</a>
            <a href="https://github.com/Developer3421/FileManager" target="_blank">GitHub</a>
        </div>

        <hr style="border-color:rgba(255,255,255,0.08);margin:1.2rem 0">

        <h3>📊 V-Task — System Resource Monitor</h3>
        <p>Slim, modern real-time system monitor for CPU, RAM, GPU, disk, and network.</p>
        <ul>
            <li>Configurable refresh rate · 5 languages</li>
            <li>No telemetry, no network access — all data stays local</li>
        </ul>
        <p class="stack-note">Stack: C# · .NET 10 · Avalonia UI 11.3 · LibreHardwareMonitor · LiteDB · WMI</p>
        <div class="app-links">
            <a href="https://apps.microsoft.com/search?query=V-Task" target="_blank">Microsoft Store</a>
            <a href="https://github.com/Developer3421/V-Task" target="_blank">GitHub</a>
        </div>

        <hr style="border-color:rgba(255,255,255,0.08);margin:1.2rem 0">

        <h3>⏱️ VRelaxTimer</h3>
        <p>Lightweight focus and relaxation timer with a local AI text assistant.</p>
        <ul>
            <li>Minimalist UX · Single-file deployment · Fully offline</li>
        </ul>
        <p class="stack-note">Stack: C# · .NET 9 · WPF · LLamaSharp</p>
        <div class="app-links">
            <a href="https://apps.microsoft.com/search?query=VRelaxTimer" target="_blank">Microsoft Store</a>
            <a href="https://github.com/Developer3421/VRelaxTimer" target="_blank">GitHub</a>
        </div>

        <hr style="border-color:rgba(255,255,255,0.08);margin:1.2rem 0">

        <h3>🧮 VCalc — Scientific Calculator</h3>
        <p>Elegant scientific calculator with full keyboard support and multi-window mode.</p>
        <ul>
            <li>sin, cos, tan, log, ln, power, π, e · Numpad support</li>
            <li>Multiple windows open simultaneously</li>
            <li>No network access, no telemetry</li>
        </ul>
        <p class="stack-note">Stack: C# · .NET 10 · WPF</p>
        <div class="app-links">
            <a href="https://apps.microsoft.com/search?query=VCalc" target="_blank">Microsoft Store</a>
            <a href="https://github.com/Developer3421/VCalc" target="_blank">GitHub</a>
        </div>

        <hr style="border-color:rgba(255,255,255,0.08);margin:1.2rem 0">

        <h3>🌐 Vetale Browser Super Lite</h3>
        <p>Minimalist Chromium-based desktop browser focused on stability and low resource usage.</p>
        <ul>
            <li>Built on CefSharp (embedded Chromium)</li>
        </ul>
        <p class="stack-note">Stack: C# · WPF · .NET Framework 4.8 · CefSharp</p>
        <div class="app-links">
            <a href="https://apps.microsoft.com/search?query=Vetale+Browser+Super+Lite" target="_blank">Microsoft Store</a>
            <a href="https://github.com/Developer3421/Vetale-Browser-SuperLite" target="_blank">GitHub</a>
        </div>
    </div>

    <!-- Web Applications – English -->
    <div class="card">
        <h2>🌍 Web Applications</h2>

        <h3>📝 WebInsait Text Editor</h3>
        <p>Rich-text editor in the browser — the web counterpart of the desktop Insait Text Editor.</p>
        <p class="stack-note">React 19 · TypeScript · Vite · Tailwind CSS · shadcn/ui</p>
        <div class="app-links">
            <a href="https://webinsaittexteditor--Developer3421.github.app" target="_blank">🔗 webinsaittexteditor--Developer3421.github.app</a>
        </div>

        <hr style="border-color:rgba(255,255,255,0.08);margin:1.2rem 0">

        <h3>♟️ Chess &amp; Translate</h3>
        <p>Chess game with integrated real-time multilingual translation — powered by an LLM.</p>
        <p class="stack-note">React 19 · TypeScript · Spark Runtime SDK (LLM + KV Storage)</p>
        <div class="app-links">
            <a href="https://chess-translator-app--Developer3421.github.app" target="_blank">🔗 chess-translator-app--Developer3421.github.app</a>
        </div>

        <hr style="border-color:rgba(255,255,255,0.08);margin:1.2rem 0">

        <h3>🔑 Password Generator</h3>
        <p>Secure, client-side password generator — no data leaves the browser.</p>
        <p class="stack-note">React 19 · TypeScript · Vite · Tailwind CSS</p>
        <div class="app-links">
            <a href="https://password-generator--Developer3421.github.app" target="_blank">🔗 password-generator--Developer3421.github.app</a>
        </div>
    </div>

    <!-- Legacy Projects – English -->
    <div class="card">
        <h2>🏛️ Legacy / Historical Projects</h2>
        <table class="portfolio-table">
            <thead><tr><th>Project</th><th>Year</th><th>Description</th></tr></thead>
            <tbody>
                <tr>
                    <td>Vetale Browser Legacy (WPF, 2024)</td>
                    <td>2024</td>
                    <td>First-generation WPF browser using Microsoft WebView2 — foundation for all later versions</td>
                </tr>
                <tr>
                    <td>Test</td>
                    <td>2021</td>
                    <td>First repository ever created — a historic milestone</td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- All Repositories – English -->
    <div class="card">
        <h2>📊 All Repositories</h2>
        <table class="portfolio-table">
            <thead><tr><th>Repository</th><th>Language</th><th>Description</th></tr></thead>
            <tbody>
                <tr><td><a href="https://github.com/Developer3421/Vetale-Browser-Official" target="_blank" style="color:var(--orange-light)">Vetale-Browser-Official</a></td><td>—</td><td>Flagship browser (docs &amp; distribution)</td></tr>
                <tr><td><a href="https://github.com/Developer3421/VetaleBrowserCode" target="_blank" style="color:var(--orange-light)">VetaleBrowserCode</a></td><td>C#</td><td>Vetale Browser source code</td></tr>
                <tr><td><a href="https://github.com/Developer3421/Insait-Text-Editor" target="_blank" style="color:var(--orange-light)">Insait-Text-Editor</a></td><td>C#</td><td>AI-powered text editor</td></tr>
                <tr><td><a href="https://github.com/Developer3421/Insait-Edit-C-Sharp" target="_blank" style="color:var(--orange-light)">Insait-Edit-C-Sharp</a></td><td>C#</td><td>Full-featured C# IDE</td></tr>
                <tr><td><a href="https://github.com/Developer3421/Insait-Video-Player" target="_blank" style="color:var(--orange-light)">Insait-Video-Player</a></td><td>C#</td><td>Desktop video player</td></tr>
                <tr><td><a href="https://github.com/Developer3421/Insait_Translator_German" target="_blank" style="color:var(--orange-light)">Insait_Translator_German</a></td><td>C#</td><td>Hybrid translator (Avalonia + React)</td></tr>
                <tr><td><a href="https://github.com/Developer3421/german-b1-step-further" target="_blank" style="color:var(--orange-light)">german-b1-step-further</a></td><td>C#</td><td>German B1 learning app</td></tr>
                <tr><td><a href="https://github.com/Developer3421/FileManager" target="_blank" style="color:var(--orange-light)">FileManager</a></td><td>C#</td><td>Multi-tab file manager</td></tr>
                <tr><td><a href="https://github.com/Developer3421/V-Task" target="_blank" style="color:var(--orange-light)">V-Task</a></td><td>C#</td><td>System resource monitor</td></tr>
                <tr><td><a href="https://github.com/Developer3421/VRelaxTimer" target="_blank" style="color:var(--orange-light)">VRelaxTimer</a></td><td>C#</td><td>Relaxation timer with AI</td></tr>
                <tr><td><a href="https://github.com/Developer3421/VCalc" target="_blank" style="color:var(--orange-light)">VCalc</a></td><td>C#</td><td>Scientific calculator</td></tr>
                <tr><td><a href="https://github.com/Developer3421/Vetale-Browser-SuperLite" target="_blank" style="color:var(--orange-light)">Vetale-Browser-SuperLite</a></td><td>C#</td><td>Minimal Chromium browser</td></tr>
                <tr><td><a href="https://github.com/Developer3421/Vetale-Browser-Legacy-WPF-2024-" target="_blank" style="color:var(--orange-light)">Vetale-Browser-Legacy-WPF-2024-</a></td><td>—</td><td>Historical WPF browser</td></tr>
                <tr><td><a href="https://github.com/Developer3421/Web-Projects" target="_blank" style="color:var(--orange-light)">Web-Projects</a></td><td>—</td><td>React web apps collection</td></tr>
                <tr><td><a href="https://github.com/Developer3421/CSharp-Portfolio" target="_blank" style="color:var(--orange-light)">CSharp-Portfolio</a></td><td>—</td><td>HR portfolio with Store statistics</td></tr>
            </tbody>
        </table>
    </div>

<?php else: ?>

    <!-- About Me – German -->
    <div class="card">
        <h2>👤 Über mich</h2>
        <p>
            Ich bin <strong>Oleg Kurylo</strong>, ein autodidaktischer C#-Desktop-Entwickler aus der Ukraine,
            der aktuell in Deutschland lebt.
        </p>
        <p class="mt-1">
            Meine Entwicklerreise begann 2021 mit kleinen C#-WinForms-Anwendungen. Nach meiner Übersiedlung
            nach Deutschland im Jahr 2022 entwickelte ich mich weiter und arbeitete 2023–2024 an
            fortgeschritteneren C#-WPF-Projekten. Im Jahr 2025 migrierte ich alle Projekte auf das
            plattformübergreifende <strong>Avalonia UI</strong>-Framework und schloss alle Desktop-Apps ab.
            Im Winter 2025 begann ich, meine Apps im <strong>Microsoft Store</strong> zu veröffentlichen.
        </p>
        <p class="mt-1">
            Heute verfüge ich über <strong>11 einzigartige Desktop-Anwendungen</strong> im Microsoft Store,
            die alle auf einer Multi-Window-Philosophie basieren und entweder externe APIs oder lokale
            KI-Komponenten integrieren. Mein Hauptprojekt ist <strong>Vetale Browser</strong> — ein
            vollwertiger Avalonia/Chromium-Browser mit eingebettetem Gemma 3 1B-KI-Modell, das auch auf
            älterer Hardware offline läuft.
        </p>
        <p class="mt-1">
            Kürzlich habe ich meine ersten Web-Anwendungen (React + TypeScript) sowie eine hybride
            Avalonia C# + React-Desktop-Applikation entwickelt.
        </p>
    </div>

    <!-- Tech Stack – German -->
    <div class="card">
        <h2>🛠️ Technologie-Stack</h2>
        <table class="portfolio-table">
            <thead><tr><th>Bereich</th><th>Technologien</th></tr></thead>
            <tbody>
                <tr><td>Hauptsprache</td><td>C#</td></tr>
                <tr><td>Desktop-UI</td><td>Avalonia UI 11, WPF, WinForms</td></tr>
                <tr><td>Web / Hybrid</td><td>React 19, TypeScript, Vite, Tailwind CSS</td></tr>
                <tr><td>Laufzeit</td><td>.NET 10, .NET 9, .NET Framework 4.8</td></tr>
                <tr><td>Web-Rendering</td><td>WebViewControl-Avalonia (Chromium), CefSharp, Microsoft WebView2</td></tr>
                <tr><td>Lokale KI</td><td>LLamaSharp, Gemma 3 1B, Whisper.net</td></tr>
                <tr><td>Automatisierung</td><td>Microsoft Playwright</td></tr>
                <tr><td>Datenbank</td><td>LiteDB, Windows DPAPI (AES-256)</td></tr>
                <tr><td>Compiler-Tools</td><td>Microsoft Roslyn, MSBuild</td></tr>
                <tr><td>Medien</td><td>LibVLCSharp</td></tr>
                <tr><td>Hardware-Monitoring</td><td>LibreHardwareMonitor, WMI</td></tr>
                <tr><td>Versionskontrolle</td><td>LibGit2, Octokit</td></tr>
            </tbody>
        </table>
    </div>

    <!-- Developer Journey – German -->
    <div class="card">
        <h2>📅 Entwickler-Zeitlinie</h2>
        <div class="journey-line">2021  ──▶  Erste C# WinForms-Projekte (Ukraine)
2022  ──▶  Umzug nach Deutschland · C#-Entwicklung fortgesetzt
2023  ──▶  Wechsel zu C# WPF · wachsende App-Komplexität
2024  ──▶  WPF-Apps verfeinert · Vetale Browser (WPF Legacy) veröffentlicht
2025  ──▶  Alle Projekte auf Avalonia UI migriert
            Gemma 3 1B lokal-KI integriert
            11 Apps im Microsoft Store veröffentlicht (Winter 2025)
            Erste React-Web-Apps &amp; hybride Avalonia + React App</div>
    </div>

    <!-- Desktop Applications – German -->
    <div class="card">
        <h2>🖥️ Desktop-Anwendungen (Microsoft Store)</h2>

        <h3>🌐 Vetale Browser <em style="font-weight:400;font-size:0.9rem">(Flagship)</em></h3>
        <p>Moderner Windows-Browser mit lokaler KI, hochgradig anpassbarer Benutzeroberfläche und integrierten Tools für Power-User.</p>
        <ul>
            <li>Avalonia UI + WebViewControl-Avalonia (Chromium-basiertes Rendering)</li>
            <li>Eingebettetes Gemma 3 1B lokal-KI-Modell — offline, auch auf älterer Hardware</li>
            <li>Spracheingabe via Whisper.net-Pipeline</li>
            <li>Multi-Window-Tab-Workflow mit Drag &amp; Drop</li>
            <li>Integrierte DevTools / Automatisierung via Microsoft Playwright</li>
            <li>DSGVO-konformes Benutzerabkommen &amp; lokale Datenspeicherung</li>
            <li>Ziel: .NET 10 · win-x64, win-x86, win-arm64</li>
        </ul>
        <p class="stack-note">Stack: C# · Avalonia UI · WebViewControl-Avalonia · LLamaSharp · Whisper.net · Playwright</p>
        <div class="app-links">
            <a href="https://apps.microsoft.com/search?query=Vetale+Browser" target="_blank">Microsoft Store</a>
            <a href="https://github.com/Developer3421/VetaleBrowserCode" target="_blank">GitHub Quellcode</a>
        </div>

        <hr style="border-color:rgba(255,255,255,0.08);margin:1.2rem 0">

        <h3>📝 Insait Text Editor</h3>
        <p>Intelligenter Texteditor mit offline-fähigem KI-Assistenten (Offline-First).</p>
        <ul>
            <li>Vollständige MVVM-Architektur mit modularen Services</li>
            <li>Lokale KI-Inferenz (LLamaSharp) — keine Cloud-Abhängigkeit</li>
            <li>Mehrsprachige Benutzeroberfläche</li>
        </ul>
        <p class="stack-note">Stack: C# · .NET 10 · Avalonia UI · LLamaSharp · LiteDB · SkiaSharp</p>
        <div class="app-links">
            <a href="https://apps.microsoft.com/search?query=Insait+Text+Editor" target="_blank">Microsoft Store</a>
            <a href="https://github.com/Developer3421/Insait-Text-Editor" target="_blank">GitHub</a>
        </div>

        <hr style="border-color:rgba(255,255,255,0.08);margin:1.2rem 0">

        <h3>🛠️ Insait Edit — C#-IDE</h3>
        <p>Moderne, plattformübergreifende Entwicklungsumgebung für C# und .NET auf Basis von Avalonia UI und der Roslyn-Compiler-Plattform.</p>
        <ul>
            <li>Vollständige Roslyn-Integration: IntelliSense, Code-Fixes, symbolweites Umbenennen</li>
            <li>MSBuild-Integration zum Erstellen, Ausführen und Veröffentlichen von .NET-Projekten</li>
            <li>Eingebetteter ConPTY-Terminal-Emulator mit ANSI-Rendering</li>
            <li>Git- und GitHub-Integration (Commit, Push, Pull, Diff, Klonen)</li>
            <li>NuGet-Paketverwaltung und MSIX-Manager direkt in der IDE</li>
            <li>ESP32-/nanoFramework-Unterstützung mit visuellem LED-Panel-Designer</li>
            <li>AXAML-Live-Vorschau für Avalonia-UI-Dateien</li>
            <li>Mehrsprachige Oberfläche (Englisch, Ukrainisch, Deutsch, Russisch, Türkisch)</li>
            <li>Gemini-KI-Assistent für Code-Unterstützung</li>
        </ul>
        <p class="stack-note">Stack: C# · .NET 10 · Avalonia UI 11.3 · Roslyn 5.0 · MSBuild · LibGit2 · NuGet.Protocol · Octokit · LiteDB · nanoFramework</p>
        <div class="app-links">
            <a href="https://github.com/Developer3421/Insait-Edit-C-Sharp" target="_blank">GitHub</a>
        </div>

        <hr style="border-color:rgba(255,255,255,0.08);margin:1.2rem 0">

        <h3>🎬 Insait Video Player</h3>
        <p>Funktionsreicher Desktop-Videoplayer mit Sitzungsverwaltung und verschlüsselter Datenspeicherung.</p>
        <ul>
            <li>Tab-Interface mit Drag-to-Reorder und Überlaufmenü</li>
            <li>Sitzungsverwaltung mit Windows-DPAPI-verschlüsselter Speicherung</li>
            <li>Untertitelverwaltung und Audiospurauswahl</li>
        </ul>
        <p class="stack-note">Stack: C# · .NET 10 · Avalonia UI 11.3 · LibVLCSharp · LiteDB · Windows DPAPI</p>
        <div class="app-links">
            <a href="https://apps.microsoft.com/search?query=Insait+Video+Player" target="_blank">Microsoft Store</a>
            <a href="https://github.com/Developer3421/Insait-Video-Player" target="_blank">GitHub</a>
        </div>

        <hr style="border-color:rgba(255,255,255,0.08);margin:1.2rem 0">

        <h3>🌍 Insait Translator: German <em style="font-weight:400;font-size:0.9rem">(Hybrid-App)</em></h3>
        <p>Hybride Avalonia C# + React App zum Übersetzen beliebiger Sprachen ins Deutsche mit optionaler Text-to-Speech-Funktion.</p>
        <ul>
            <li>Hybride Architektur: Avalonia-Desktop-Shell mit eingebettetem React-Web-UI</li>
            <li>Anbieter-Fallback-System (MyMemory → Google Translate → Gemini API)</li>
            <li>Lokaler HTTP-Backend-Server für die React-UI — kein Node.js zur Laufzeit erforderlich</li>
            <li>Deutsch-TTS via Piper — Wiedergabe und MP3-Export</li>
            <li>AES-256 + Windows-DPAPI-verschlüsselte Einstellungen</li>
        </ul>
        <p class="stack-note">Stack: C# · .NET 10 · Avalonia UI 11 · ReactiveUI · React/Vite · LiteDB · Piper TTS · NAudio · AES-256</p>
        <div class="app-links">
            <a href="https://apps.microsoft.com/search?query=Insait+Translator" target="_blank">Microsoft Store</a>
            <a href="https://github.com/Developer3421/Insait_Translator_German" target="_blank">GitHub</a>
        </div>

        <hr style="border-color:rgba(255,255,255,0.08);margin:1.2rem 0">

        <h3>📅 German B1 – Ein Schritt weiter</h3>
        <p>Strukturierte Deutschlern-App (B1-Niveau) mit integriertem KI-Assistenten.</p>
        <ul>
            <li>4 Abschnitte × 18 Themen: Wortschatz, Konversation, Grammatik, Übungen</li>
            <li>Sitzungsverwaltung mit Lesezeichenfunktion</li>
            <li>Gemma-3-270m lokale KI für personalisierte Lernunterstützung</li>
        </ul>
        <p class="stack-note">Stack: C# · .NET 10 · Avalonia UI · LiteDB · LLamaSharp</p>
        <div class="app-links">
            <a href="https://apps.microsoft.com/search?query=German+B1+Step+Further" target="_blank">Microsoft Store</a>
            <a href="https://github.com/Developer3421/german-b1-step-further" target="_blank">GitHub</a>
        </div>

        <hr style="border-color:rgba(255,255,255,0.08);margin:1.2rem 0">

        <h3>📁 FileManager</h3>
        <p>Moderner, leichtgewichtiger Dateimanager mit Multi-Tab-Navigation.</p>
        <ul>
            <li>Multi-Tab-Navigation mit persistenter Tab-Wiederherstellung beim Start</li>
            <li>Native Windows-Shell-Kontextmenüs</li>
            <li>Eingebetteter Bildbetrachter · Laufwerksanzeige mit Nutzungsinformationen</li>
            <li>Mehrsprachig (Englisch, Ukrainisch, Deutsch)</li>
        </ul>
        <p class="stack-note">Stack: C# · .NET · Avalonia UI</p>
        <div class="app-links">
            <a href="https://apps.microsoft.com/search?query=Insait+FileManager" target="_blank">Microsoft Store</a>
            <a href="https://github.com/Developer3421/FileManager" target="_blank">GitHub</a>
        </div>

        <hr style="border-color:rgba(255,255,255,0.08);margin:1.2rem 0">

        <h3>📊 V-Task — Systemressourcen-Monitor</h3>
        <p>Schlanker, moderner Echtzeit-Systemmonitor für CPU, RAM, GPU, Festplatte und Netzwerk.</p>
        <ul>
            <li>Konfigurierbare Aktualisierungsrate · 5 Sprachen</li>
            <li>Keine Telemetrie, kein Netzwerkzugriff — alle Daten verbleiben lokal</li>
        </ul>
        <p class="stack-note">Stack: C# · .NET 10 · Avalonia UI 11.3 · LibreHardwareMonitor · LiteDB · WMI</p>
        <div class="app-links">
            <a href="https://apps.microsoft.com/search?query=V-Task" target="_blank">Microsoft Store</a>
            <a href="https://github.com/Developer3421/V-Task" target="_blank">GitHub</a>
        </div>

        <hr style="border-color:rgba(255,255,255,0.08);margin:1.2rem 0">

        <h3>⏱️ VRelaxTimer</h3>
        <p>Leichtgewichtige Desktop-Anwendung für Fokus und Entspannung mit lokalem KI-Textassistenten.</p>
        <ul>
            <li>Minimalistisches UX · Single-File-Deployment · Vollständig offline</li>
        </ul>
        <p class="stack-note">Stack: C# · .NET 9 · WPF · LLamaSharp</p>
        <div class="app-links">
            <a href="https://apps.microsoft.com/search?query=VRelaxTimer" target="_blank">Microsoft Store</a>
            <a href="https://github.com/Developer3421/VRelaxTimer" target="_blank">GitHub</a>
        </div>

        <hr style="border-color:rgba(255,255,255,0.08);margin:1.2rem 0">

        <h3>🧮 VCalc — Wissenschaftlicher Taschenrechner</h3>
        <p>Eleganter wissenschaftlicher Taschenrechner mit vollständiger Tastaturunterstützung und Multi-Window-Modus.</p>
        <ul>
            <li>sin, cos, tan, log, ln, Potenz, π, e · Nummernblock-Unterstützung</li>
            <li>Mehrere Fenster gleichzeitig geöffnet</li>
            <li>Kein Netzwerkzugriff, keine Telemetrie</li>
        </ul>
        <p class="stack-note">Stack: C# · .NET 10 · WPF</p>
        <div class="app-links">
            <a href="https://apps.microsoft.com/search?query=VCalc" target="_blank">Microsoft Store</a>
            <a href="https://github.com/Developer3421/VCalc" target="_blank">GitHub</a>
        </div>

        <hr style="border-color:rgba(255,255,255,0.08);margin:1.2rem 0">

        <h3>🌐 Vetale Browser Super Lite</h3>
        <p>Minimalistischer Chromium-basierter Desktop-Browser mit Fokus auf Stabilität und geringer Ressourcennutzung.</p>
        <ul>
            <li>Basiert auf CefSharp (eingebettetes Chromium)</li>
        </ul>
        <p class="stack-note">Stack: C# · WPF · .NET Framework 4.8 · CefSharp</p>
        <div class="app-links">
            <a href="https://apps.microsoft.com/search?query=Vetale+Browser+Super+Lite" target="_blank">Microsoft Store</a>
            <a href="https://github.com/Developer3421/Vetale-Browser-SuperLite" target="_blank">GitHub</a>
        </div>
    </div>

    <!-- Web Applications – German -->
    <div class="card">
        <h2>🌍 Web-Anwendungen</h2>

        <h3>📝 WebInsait Text Editor</h3>
        <p>Rich-Text-Editor im Browser — die Web-Version des Desktop Insait Text Editors.</p>
        <p class="stack-note">React 19 · TypeScript · Vite · Tailwind CSS · shadcn/ui</p>
        <div class="app-links">
            <a href="https://webinsaittexteditor--Developer3421.github.app" target="_blank">🔗 webinsaittexteditor--Developer3421.github.app</a>
        </div>

        <hr style="border-color:rgba(255,255,255,0.08);margin:1.2rem 0">

        <h3>♟️ Chess &amp; Translate</h3>
        <p>Schachspiel mit integrierter Echtzeit-Mehrsprachen-Übersetzung — KI-gestützt.</p>
        <p class="stack-note">React 19 · TypeScript · Spark Runtime SDK (LLM + KV Storage)</p>
        <div class="app-links">
            <a href="https://chess-translator-app--Developer3421.github.app" target="_blank">🔗 chess-translator-app--Developer3421.github.app</a>
        </div>

        <hr style="border-color:rgba(255,255,255,0.08);margin:1.2rem 0">

        <h3>🔑 Password Generator</h3>
        <p>Sicherer, clientseitiger Passwort-Generator — keine Daten verlassen den Browser.</p>
        <p class="stack-note">React 19 · TypeScript · Vite · Tailwind CSS</p>
        <div class="app-links">
            <a href="https://password-generator--Developer3421.github.app" target="_blank">🔗 password-generator--Developer3421.github.app</a>
        </div>
    </div>

    <!-- Legacy Projects – German -->
    <div class="card">
        <h2>🏛️ Legacy- / Historische Projekte</h2>
        <table class="portfolio-table">
            <thead><tr><th>Projekt</th><th>Jahr</th><th>Beschreibung</th></tr></thead>
            <tbody>
                <tr>
                    <td>Vetale Browser Legacy (WPF, 2024)</td>
                    <td>2024</td>
                    <td>Erste WPF-Browser-Generation mit Microsoft WebView2 — Grundlage für alle späteren Versionen</td>
                </tr>
                <tr>
                    <td>Test</td>
                    <td>2021</td>
                    <td>Allererste Repository — ein historischer Meilenstein</td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- All Repositories – German -->
    <div class="card">
        <h2>📊 Alle Repositories</h2>
        <table class="portfolio-table">
            <thead><tr><th>Repository</th><th>Sprache</th><th>Beschreibung</th></tr></thead>
            <tbody>
                <tr><td><a href="https://github.com/Developer3421/Vetale-Browser-Official" target="_blank" style="color:var(--orange-light)">Vetale-Browser-Official</a></td><td>—</td><td>Flagship-Browser (Docs &amp; Distribution)</td></tr>
                <tr><td><a href="https://github.com/Developer3421/VetaleBrowserCode" target="_blank" style="color:var(--orange-light)">VetaleBrowserCode</a></td><td>C#</td><td>Vetale Browser Quellcode</td></tr>
                <tr><td><a href="https://github.com/Developer3421/Insait-Text-Editor" target="_blank" style="color:var(--orange-light)">Insait-Text-Editor</a></td><td>C#</td><td>KI-gestützter Texteditor</td></tr>
                <tr><td><a href="https://github.com/Developer3421/Insait-Edit-C-Sharp" target="_blank" style="color:var(--orange-light)">Insait-Edit-C-Sharp</a></td><td>C#</td><td>Vollständige C#-IDE</td></tr>
                <tr><td><a href="https://github.com/Developer3421/Insait-Video-Player" target="_blank" style="color:var(--orange-light)">Insait-Video-Player</a></td><td>C#</td><td>Desktop-Videoplayer</td></tr>
                <tr><td><a href="https://github.com/Developer3421/Insait_Translator_German" target="_blank" style="color:var(--orange-light)">Insait_Translator_German</a></td><td>C#</td><td>Hybrid-Übersetzer (Avalonia + React)</td></tr>
                <tr><td><a href="https://github.com/Developer3421/german-b1-step-further" target="_blank" style="color:var(--orange-light)">german-b1-step-further</a></td><td>C#</td><td>Deutschlern-App B1</td></tr>
                <tr><td><a href="https://github.com/Developer3421/FileManager" target="_blank" style="color:var(--orange-light)">FileManager</a></td><td>C#</td><td>Multi-Tab-Dateimanager</td></tr>
                <tr><td><a href="https://github.com/Developer3421/V-Task" target="_blank" style="color:var(--orange-light)">V-Task</a></td><td>C#</td><td>Systemressourcen-Monitor</td></tr>
                <tr><td><a href="https://github.com/Developer3421/VRelaxTimer" target="_blank" style="color:var(--orange-light)">VRelaxTimer</a></td><td>C#</td><td>Entspannungstimer mit KI</td></tr>
                <tr><td><a href="https://github.com/Developer3421/VCalc" target="_blank" style="color:var(--orange-light)">VCalc</a></td><td>C#</td><td>Wissenschaftlicher Taschenrechner</td></tr>
                <tr><td><a href="https://github.com/Developer3421/Vetale-Browser-SuperLite" target="_blank" style="color:var(--orange-light)">Vetale-Browser-SuperLite</a></td><td>C#</td><td>Minimaler Chromium-Browser</td></tr>
                <tr><td><a href="https://github.com/Developer3421/Vetale-Browser-Legacy-WPF-2024-" target="_blank" style="color:var(--orange-light)">Vetale-Browser-Legacy-WPF-2024-</a></td><td>—</td><td>Historischer WPF-Browser</td></tr>
                <tr><td><a href="https://github.com/Developer3421/Web-Projects" target="_blank" style="color:var(--orange-light)">Web-Projects</a></td><td>—</td><td>React-Web-App-Sammlung</td></tr>
                <tr><td><a href="https://github.com/Developer3421/CSharp-Portfolio" target="_blank" style="color:var(--orange-light)">CSharp-Portfolio</a></td><td>—</td><td>HR-Portfolio mit Store-Statistiken</td></tr>
            </tbody>
        </table>
    </div>

<?php endif; ?>

    <!-- Mini-apps shortcuts -->
    <div class="card">
        <h2>🎮 Mini-Apps</h2>
        <p class="mt-1"><?= $lang === 'de' ? 'Teste eine der integrierten PHP Insait Mini-Apps:' : 'Try one of the built-in PHP Insait mini-apps:' ?></p>
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
        <h2>📬 <?= $lang === 'de' ? 'Kontakt' : 'Contact' ?></h2>
        <ul>
            <li>GitHub: <a href="https://github.com/Developer3421" target="_blank" style="color:var(--orange-light)">Developer3421</a></li>
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
