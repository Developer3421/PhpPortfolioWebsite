<?php
/**
 * apps/todo.php – To-do list mini-app (localStorage-based)
 */
session_start();

// ── Language ────────────────────────────────────────────────
if (isset($_GET['lang']) && in_array($_GET['lang'], ['en', 'de'], true)) {
    $_SESSION['lang'] = $_GET['lang'];
}
$lang = $_SESSION['lang'] ?? 'en';

$t = [
    'en' => [
        'hero_sub'        => 'Manage your tasks — data is saved in your browser',
        'new_task'        => '➕ New Task',
        'task_label'      => 'Task text',
        'task_placeholder'=> 'Enter your task here…',
        'btn_add'         => 'Add Task',
        'msg_empty'       => 'Please enter task text.',
        'msg_too_long'    => 'Task is too long (maximum 200 characters).',
        'my_tasks'        => '📝 My Tasks',
        'completed'       => 'completed',
        'empty_list'      => '📭 Task list is empty. Add your first task above!',
        'mark_incomplete' => 'Mark as incomplete',
        'mark_complete'   => 'Mark as complete',
        'confirm_delete'  => 'Delete this task?',
        'confirm_clear'   => 'Delete all tasks?',
        'clear_all'       => '🗑 Clear All',
    ],
    'de' => [
        'hero_sub'        => 'Verwalte deine Aufgaben — Daten werden im Browser gespeichert',
        'new_task'        => '➕ Neue Aufgabe',
        'task_label'      => 'Aufgabentext',
        'task_placeholder'=> 'Aufgabe hier eingeben…',
        'btn_add'         => 'Aufgabe hinzufügen',
        'msg_empty'       => 'Bitte Aufgabentext eingeben.',
        'msg_too_long'    => 'Aufgabe ist zu lang (maximal 200 Zeichen).',
        'my_tasks'        => '📝 Meine Aufgaben',
        'completed'       => 'abgeschlossen',
        'empty_list'      => '📭 Aufgabenliste ist leer. Füge oben deine erste Aufgabe hinzu!',
        'mark_incomplete' => 'Als unerledigt markieren',
        'mark_complete'   => 'Als erledigt markieren',
        'confirm_delete'  => 'Diese Aufgabe löschen?',
        'confirm_clear'   => 'Alle Aufgaben löschen?',
        'clear_all'       => '🗑 Alle löschen',
    ],
][$lang];

$pageTitle = 'Insait Tasks | InsaitApps';
$active    = 'todo';
$rootDir   = '../';

require __DIR__ . '/../partials/nav.php';
?>

<section class="hero">
    <h1>📋 Insait Tasks</h1>
    <p><?= $t['hero_sub'] ?></p>
</section>

<main>
    <!-- Add task -->
    <div class="card">
        <h2><?= $t['new_task'] ?></h2>
        <div id="msg-box" class="alert" style="display:none"></div>
        <div class="form-group">
            <label for="task-input"><?= $t['task_label'] ?></label>
            <input type="text" id="task-input"
                   placeholder="<?= htmlspecialchars($t['task_placeholder']) ?>"
                   maxlength="200" autocomplete="off"
                   onkeydown="if(event.key==='Enter')addTask()">
        </div>
        <button class="btn btn-primary" onclick="addTask()"><?= $t['btn_add'] ?></button>
    </div>

    <!-- Task list -->
    <div class="card">
        <h2 id="tasks-heading"><?= $t['my_tasks'] ?></h2>
        <div id="todo-list"></div>
        <div class="mt-2" id="clear-wrap" style="display:none">
            <button class="btn btn-sm"
                    style="background:rgba(220,50,50,0.2);color:#ff7070"
                    onclick="clearAll()">
                <?= $t['clear_all'] ?>
            </button>
        </div>
    </div>
</main>

<script>
(function () {
    var STORAGE_KEY = 'insait_todos';
    var T = <?= json_encode($t, JSON_UNESCAPED_UNICODE) ?>;

    // ── Helpers ──────────────────────────────────────────────
    function load() {
        try { return JSON.parse(localStorage.getItem(STORAGE_KEY)) || []; }
        catch(e) { return []; }
    }

    function save(todos) {
        localStorage.setItem(STORAGE_KEY, JSON.stringify(todos));
    }

    function pad(n) { return n < 10 ? '0' + n : n; }

    function now() {
        var d = new Date();
        return pad(d.getDate()) + '.' + pad(d.getMonth()+1) + '.' + d.getFullYear()
             + ' ' + pad(d.getHours()) + ':' + pad(d.getMinutes());
    }

    // ── Render ───────────────────────────────────────────────
    function render() {
        var todos   = load();
        var total   = todos.length;
        var doneCount = todos.filter(function(t){ return t.done; }).length;
        var list    = document.getElementById('todo-list');
        var heading = document.getElementById('tasks-heading');
        var clearWrap = document.getElementById('clear-wrap');

        heading.innerHTML = T.my_tasks +
            ' <span style="font-size:0.85rem;color:var(--text-muted);font-weight:400">(' +
            doneCount + '/' + total + ' ' + T.completed + ')</span>';

        clearWrap.style.display = total > 0 ? '' : 'none';

        if (total === 0) {
            list.innerHTML = '<p style="color:var(--text-muted);text-align:center;padding:2rem 0">' +
                             escHtml(T.empty_list) + '</p>';
            return;
        }

        list.innerHTML = todos.map(function(todo, idx) {
            var doneClass  = todo.done ? ' done' : '';
            var btnClass   = todo.done ? 'btn-secondary' : 'btn-primary';
            var btnIcon    = todo.done ? '↩' : '✓';
            var btnTitle   = todo.done ? escHtml(T.mark_incomplete) : escHtml(T.mark_complete);
            return '<div class="todo-item' + doneClass + '">' +
                '<button class="btn btn-sm ' + btnClass + '" title="' + btnTitle + '" ' +
                    'onclick="toggleTask(' + idx + ')">' + btnIcon + '</button>' +
                '<span class="todo-text">' + escHtml(todo.text) + '</span>' +
                '<small style="color:var(--text-muted);white-space:nowrap">' + escHtml(todo.created) + '</small>' +
                '<button class="btn btn-sm" style="background:rgba(220,50,50,0.3);color:#ff7070" ' +
                    'onclick="deleteTask(' + idx + ')">✕</button>' +
            '</div>';
        }).join('');
    }

    function escHtml(s) {
        return String(s)
            .replace(/&/g,'&amp;').replace(/</g,'&lt;')
            .replace(/>/g,'&gt;').replace(/"/g,'&quot;');
    }

    // ── Show message ─────────────────────────────────────────
    function showMsg(text, type) {
        var box = document.getElementById('msg-box');
        box.className = 'alert alert-' + type;
        box.textContent = text;
        box.style.display = '';
        clearTimeout(box._timer);
        box._timer = setTimeout(function(){ box.style.display = 'none'; }, 3000);
    }

    // ── Public actions ───────────────────────────────────────
    window.addTask = function () {
        var input = document.getElementById('task-input');
        var text  = input.value.trim();
        if (text === '') { showMsg(T.msg_empty, 'danger'); return; }
        if (text.length > 200) { showMsg(T.msg_too_long, 'danger'); return; }

        var todos = load();
        todos.push({ text: text, done: false, created: now() });
        save(todos);
        input.value = '';
        render();
    };

    window.toggleTask = function (idx) {
        var todos = load();
        if (todos[idx]) { todos[idx].done = !todos[idx].done; save(todos); render(); }
    };

    window.deleteTask = function (idx) {
        if (!confirm(T.confirm_delete)) return;
        var todos = load();
        todos.splice(idx, 1);
        save(todos);
        render();
    };

    window.clearAll = function () {
        if (!confirm(T.confirm_clear)) return;
        save([]);
        render();
    };

    // ── Init ─────────────────────────────────────────────────
    render();
}());
</script>

<?php require __DIR__ . '/../partials/footer.php'; ?>
