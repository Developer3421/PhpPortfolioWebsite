<?php
/**
 * apps/todo.php – To-do list mini-app (session-based)
 */
session_start();

if (!isset($_SESSION['todos'])) {
    $_SESSION['todos'] = [];
}

$message = '';
$msgType = '';

// Handle POST actions
if (($_SERVER['REQUEST_METHOD'] ?? '') === 'POST') {
    $action = $_POST['action'] ?? '';

    if ($action === 'add') {
        $text = trim($_POST['task'] ?? '');
        if ($text === '') {
            $message = 'Please enter task text.';
            $msgType = 'danger';
        } elseif (mb_strlen($text) > 200) {
            $message = 'Task is too long (maximum 200 characters).';
            $msgType = 'danger';
        } else {
            $_SESSION['todos'][] = ['text' => $text, 'done' => false, 'created' => date('d.m.Y H:i')];
            $message = 'Task added!';
            $msgType = 'success';
        }
    } elseif ($action === 'toggle') {
        $idx = (int)($_POST['idx'] ?? -1);
        if (isset($_SESSION['todos'][$idx])) {
            $_SESSION['todos'][$idx]['done'] = !$_SESSION['todos'][$idx]['done'];
        }
    } elseif ($action === 'delete') {
        $idx = (int)($_POST['idx'] ?? -1);
        if (isset($_SESSION['todos'][$idx])) {
            array_splice($_SESSION['todos'], $idx, 1);
            $message = 'Task deleted.';
            $msgType = 'info';
        }
    } elseif ($action === 'clear') {
        $_SESSION['todos'] = [];
        $message = 'All tasks cleared.';
        $msgType = 'info';
    }
}

$todos = $_SESSION['todos'];
$total = count($todos);
$done  = count(array_filter($todos, fn($t) => $t['done']));

$pageTitle = 'Insait Tasks | PHP Portfolio';
$active    = 'todo';
$rootDir   = '../';

require __DIR__ . '/../partials/nav.php';
?>

<section class="hero">
    <h1>📋 Insait Tasks</h1>
    <p>Manage your tasks — data is stored in the session</p>
</section>

<main>
    <div class="card">
        <h2>➕ New Task</h2>

        <?php if ($message): ?>
            <div class="alert alert-<?= htmlspecialchars($msgType) ?>">
                <?= htmlspecialchars($message) ?>
            </div>
        <?php endif; ?>

        <form method="POST">
            <input type="hidden" name="action" value="add">
            <div class="form-group">
                <label for="task">Task text</label>
                <input type="text" id="task" name="task"
                       placeholder="Enter your task here…"
                       maxlength="200" required
                       autocomplete="off">
            </div>
            <button type="submit" class="btn btn-primary">Add Task</button>
        </form>
    </div>

    <div class="card">
        <h2>📝 My Tasks
            <span style="font-size:0.85rem;color:var(--text-muted);font-weight:400">
                (<?= $done ?>/<?= $total ?> completed)
            </span>
        </h2>

        <?php if ($total === 0): ?>
            <p style="color:var(--text-muted);text-align:center;padding:2rem 0">
                📭 Task list is empty. Add your first task above!
            </p>
        <?php else: ?>
            <?php foreach ($todos as $idx => $todo): ?>
                <div class="todo-item <?= $todo['done'] ? 'done' : '' ?>">
                    <form method="POST" style="display:inline">
                        <input type="hidden" name="action" value="toggle">
                        <input type="hidden" name="idx"    value="<?= $idx ?>">
                        <button type="submit" class="btn btn-sm <?= $todo['done'] ? 'btn-secondary' : 'btn-primary' ?>"
                                title="<?= $todo['done'] ? 'Mark as incomplete' : 'Mark as complete' ?>">
                            <?= $todo['done'] ? '↩' : '✓' ?>
                        </button>
                    </form>
                    <span class="todo-text"><?= htmlspecialchars($todo['text']) ?></span>
                    <small style="color:var(--text-muted);white-space:nowrap"><?= $todo['created'] ?></small>
                    <form method="POST" style="display:inline">
                        <input type="hidden" name="action" value="delete">
                        <input type="hidden" name="idx"    value="<?= $idx ?>">
                        <button type="submit" class="btn btn-sm"
                                style="background:rgba(220,50,50,0.3);color:#ff7070"
                                onclick="return confirm('Delete this task?')">✕</button>
                    </form>
                </div>
            <?php endforeach; ?>

            <?php if ($total > 0): ?>
                <div class="mt-2">
                    <form method="POST" style="display:inline">
                        <input type="hidden" name="action" value="clear">
                        <button type="submit" class="btn btn-sm"
                                style="background:rgba(220,50,50,0.2);color:#ff7070"
                                onclick="return confirm('Delete all tasks?')">
                            🗑 Clear All
                        </button>
                    </form>
                </div>
            <?php endif; ?>
        <?php endif; ?>
    </div>
</main>

<?php require __DIR__ . '/../partials/footer.php'; ?>
