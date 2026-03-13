<?php
/**
 * apps/quiz.php – PHP knowledge quiz mini-app (session-based)
 */
session_start();

// Question bank
$questions = [
    ['q' => 'What is the file extension for PHP files?',
     'a' => ['.php', '.html', '.py', '.js'], 'correct' => 0],
    ['q' => 'Which character starts variables in PHP?',
     'a' => ['#', '@', '$', '&'], 'correct' => 2],
    ['q' => 'Which function outputs text in PHP?',
     'a' => ['print_text()', 'echo', 'console.log()', 'printf_out()'], 'correct' => 1],
    ['q' => 'Which superglobal contains POST data?',
     'a' => ['$_GET', '$_POST', '$_REQUEST', '$_DATA'], 'correct' => 1],
    ['q' => 'How do you start a PHP block?',
     'a' => ['<php>', '<?php', '<%', '<script php>'], 'correct' => 1],
    ['q' => 'Which function counts array elements?',
     'a' => ['size()', 'length()', 'count()', 'sizeof()'], 'correct' => 2],
    ['q' => 'Which operator concatenates strings in PHP?',
     'a' => ['+', '.', '&', '||'], 'correct' => 1],
    ['q' => 'Which function starts a session?',
     'a' => ['start_session()', 'session_begin()', 'session_start()', 'init_session()'], 'correct' => 2],
    ['q' => 'What does PHP output: echo 5 + "3 apples"?',
     'a' => ['Error', '8', '53', '5'], 'correct' => 1],
    ['q' => 'Which keyword declares a function in PHP?',
     'a' => ['def', 'fun', 'function', 'func'], 'correct' => 2],
];

// Session quiz state
if (!isset($_SESSION['quiz'])) {
    $_SESSION['quiz'] = ['current' => 0, 'score' => 0, 'answers' => [], 'finished' => false];
}
$quiz = &$_SESSION['quiz'];

$totalQ    = count($questions);
$message   = '';
$msgType   = '';
$showResult = null;

if (($_SERVER['REQUEST_METHOD'] ?? '') === 'POST') {
    $action = $_POST['action'] ?? '';

    if ($action === 'answer' && !$quiz['finished']) {
        $chosen = isset($_POST['answer']) ? (int)$_POST['answer'] : -1;
        $qIdx   = $quiz['current'];

        if ($chosen < 0 || $chosen >= count($questions[$qIdx]['a'])) {
            $message = 'Please select an answer!';
            $msgType = 'danger';
        } else {
            $correct = $questions[$qIdx]['correct'];
            $isRight = ($chosen === $correct);
            $quiz['answers'][$qIdx] = ['chosen' => $chosen, 'correct' => $correct, 'right' => $isRight];
            if ($isRight) $quiz['score']++;

            $quiz['current']++;
            if ($quiz['current'] >= $totalQ) {
                $quiz['finished'] = true;
            }
        }
    } elseif ($action === 'restart') {
        $_SESSION['quiz'] = ['current' => 0, 'score' => 0, 'answers' => [], 'finished' => false];
        $quiz = &$_SESSION['quiz'];
    }
}

$pageTitle = 'Insait Quiz | PHP Portfolio';
$active    = 'quiz';
$rootDir   = '../';

require __DIR__ . '/../partials/nav.php';
?>

<section class="hero">
    <h1>🎯 Insait Quiz</h1>
    <p>Test your PHP knowledge — <?= $totalQ ?> questions</p>
</section>

<main style="max-width:680px">

    <?php if ($message): ?>
        <div class="alert alert-<?= htmlspecialchars($msgType) ?>"><?= htmlspecialchars($message) ?></div>
    <?php endif; ?>

    <!-- Progress bar -->
    <?php $pct = round(($quiz['current'] / $totalQ) * 100); ?>
    <div style="background:rgba(255,255,255,0.1);border-radius:99px;height:8px;margin-bottom:1.5rem;overflow:hidden">
        <div style="height:100%;width:<?= $pct ?>%;background:linear-gradient(90deg,var(--orange),var(--purple-light));border-radius:99px;transition:width 0.4s"></div>
    </div>
    <p style="text-align:center;color:var(--text-muted);margin-bottom:1.5rem">
        Question <?= min($quiz['current'] + 1, $totalQ) ?> of <?= $totalQ ?> &nbsp;·&nbsp; Score: <?= $quiz['score'] ?>
    </p>

    <?php if ($quiz['finished']): ?>
        <!-- Results screen -->
        <div class="card text-center">
            <h2>🏆 Results</h2>
            <div class="result-box" style="font-size:2.5rem;margin:1.5rem 0">
                <?= $quiz['score'] ?> / <?= $totalQ ?>
            </div>
            <?php $pctScore = round(($quiz['score'] / $totalQ) * 100); ?>
            <?php if ($pctScore >= 80): ?>
                <p>🌟 Excellent! You're a PHP guru!</p>
            <?php elseif ($pctScore >= 50): ?>
                <p>👍 Not bad! Keep practising.</p>
            <?php else: ?>
                <p>📚 Time to brush up on PHP!</p>
            <?php endif; ?>

            <div class="mt-3" style="text-align:left">
                <?php foreach ($questions as $i => $q): ?>
                    <?php $ans = $quiz['answers'][$i] ?? null; ?>
                    <div style="margin-bottom:0.75rem">
                        <strong style="color:var(--orange-light)"><?= $i+1 ?>. <?= htmlspecialchars($q['q']) ?></strong><br>
                        <?php if ($ans): ?>
                            <?php if ($ans['right']): ?>
                                <span style="color:#00c864">✓ <?= htmlspecialchars($q['a'][$ans['correct']]) ?></span>
                            <?php else: ?>
                                <span style="color:#ff6060">✗ Your answer: <?= htmlspecialchars($q['a'][$ans['chosen']]) ?></span><br>
                                <span style="color:#00c864">✓ Correct: <?= htmlspecialchars($q['a'][$ans['correct']]) ?></span>
                            <?php endif; ?>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            </div>

            <form method="POST" class="mt-3">
                <input type="hidden" name="action" value="restart">
                <button type="submit" class="btn btn-primary">🔄 Try Again</button>
            </form>
        </div>

    <?php else: ?>
        <!-- Question screen -->
        <?php $qIdx = $quiz['current']; $q = $questions[$qIdx]; ?>
        <div class="card">
            <h2>Question <?= $qIdx + 1 ?></h2>
            <p style="font-size:1.15rem;margin-bottom:1.5rem;color:var(--text-light)">
                <?= htmlspecialchars($q['q']) ?>
            </p>
            <form method="POST">
                <input type="hidden" name="action" value="answer">
                <?php foreach ($q['a'] as $aIdx => $aText): ?>
                    <label class="quiz-option">
                        <input type="radio" name="answer" value="<?= $aIdx ?>"
                               style="accent-color:var(--orange-light)">
                        &nbsp;<?= htmlspecialchars($aText) ?>
                    </label>
                <?php endforeach; ?>
                <div class="mt-2">
                    <button type="submit" class="btn btn-primary">Answer →</button>
                </div>
            </form>
        </div>
    <?php endif; ?>

</main>

<?php require __DIR__ . '/../partials/footer.php'; ?>
