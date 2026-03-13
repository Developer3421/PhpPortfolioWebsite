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
            $message = 'Будь ласка, введіть текст завдання.';
            $msgType = 'danger';
        } elseif (mb_strlen($text) > 200) {
            $message = 'Завдання надто довге (максимум 200 символів).';
            $msgType = 'danger';
        } else {
            $_SESSION['todos'][] = ['text' => $text, 'done' => false, 'created' => date('d.m.Y H:i')];
            $message = 'Завдання додано!';
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
            $message = 'Завдання видалено.';
            $msgType = 'info';
        }
    } elseif ($action === 'clear') {
        $_SESSION['todos'] = [];
        $message = 'Усі завдання очищено.';
        $msgType = 'info';
    }
}

$todos = $_SESSION['todos'];
$total = count($todos);
$done  = count(array_filter($todos, fn($t) => $t['done']));

$pageTitle = 'Завдання | PHP Portfolio';
$active    = 'todo';
$rootDir   = '../';

require __DIR__ . '/../partials/nav.php';
?>

<section class="hero">
    <h1>📋 Список завдань</h1>
    <p>Управляйте своїми завданнями — дані зберігаються в сесії</p>
</section>

<main>
    <div class="card">
        <h2>➕ Нове завдання</h2>

        <?php if ($message): ?>
            <div class="alert alert-<?= htmlspecialchars($msgType) ?>">
                <?= htmlspecialchars($message) ?>
            </div>
        <?php endif; ?>

        <form method="POST">
            <input type="hidden" name="action" value="add">
            <div class="form-group">
                <label for="task">Текст завдання</label>
                <input type="text" id="task" name="task"
                       placeholder="Введіть завдання тут…"
                       maxlength="200" required
                       autocomplete="off">
            </div>
            <button type="submit" class="btn btn-primary">Додати завдання</button>
        </form>
    </div>

    <div class="card">
        <h2>📝 Мої завдання
            <span style="font-size:0.85rem;color:var(--text-muted);font-weight:400">
                (<?= $done ?>/<?= $total ?> виконано)
            </span>
        </h2>

        <?php if ($total === 0): ?>
            <p style="color:var(--text-muted);text-align:center;padding:2rem 0">
                📭 Список завдань порожній. Додайте перше завдання вище!
            </p>
        <?php else: ?>
            <?php foreach ($todos as $idx => $todo): ?>
                <div class="todo-item <?= $todo['done'] ? 'done' : '' ?>">
                    <form method="POST" style="display:inline">
                        <input type="hidden" name="action" value="toggle">
                        <input type="hidden" name="idx"    value="<?= $idx ?>">
                        <button type="submit" class="btn btn-sm <?= $todo['done'] ? 'btn-secondary' : 'btn-primary' ?>"
                                title="<?= $todo['done'] ? 'Позначити як невиконане' : 'Позначити як виконане' ?>">
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
                                onclick="return confirm('Видалити це завдання?')">✕</button>
                    </form>
                </div>
            <?php endforeach; ?>

            <?php if ($total > 0): ?>
                <div class="mt-2">
                    <form method="POST" style="display:inline">
                        <input type="hidden" name="action" value="clear">
                        <button type="submit" class="btn btn-sm"
                                style="background:rgba(220,50,50,0.2);color:#ff7070"
                                onclick="return confirm('Видалити всі завдання?')">
                            🗑 Очистити все
                        </button>
                    </form>
                </div>
            <?php endif; ?>
        <?php endif; ?>
    </div>
</main>

<?php require __DIR__ . '/../partials/footer.php'; ?>
