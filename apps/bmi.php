<?php
/**
 * apps/bmi.php – BMI (Body Mass Index) calculator mini-app
 */

$result  = null;
$error   = '';
$weight  = '';
$height  = '';
$unit    = 'metric';

if (($_SERVER['REQUEST_METHOD'] ?? '') === 'POST') {
    $unit   = $_POST['unit']   ?? 'metric';
    $weight = trim($_POST['weight'] ?? '');
    $height = trim($_POST['height'] ?? '');

    if (!is_numeric($weight) || !is_numeric($height)) {
        $error = 'Будь ласка, введіть числові значення.';
    } else {
        $w = (float)$weight;
        $h = (float)$height;

        if ($unit === 'imperial') {
            // lbs → kg, inches → m
            $w = $w * 0.453592;
            $h = $h * 0.0254;
        } else {
            $h = $h / 100; // cm → m
        }

        if ($w <= 0 || $h <= 0) {
            $error = 'Значення мають бути більше нуля.';
        } elseif ($w > 600 || $h > 3) {
            $error = 'Введіть реалістичні значення.';
        } else {
            $bmi = $w / ($h * $h);
            if ($bmi < 18.5) {
                $cat   = 'Недостатня вага';
                $color = '#5bceff';
                $tip   = 'Розгляньте збалансоване харчування для набору ваги.';
                $emoji = '🔵';
            } elseif ($bmi < 25) {
                $cat   = 'Нормальна вага';
                $color = '#00c864';
                $tip   = 'Чудово! Підтримуйте здоровий спосіб життя.';
                $emoji = '🟢';
            } elseif ($bmi < 30) {
                $cat   = 'Надмірна вага';
                $color = '#ffb300';
                $tip   = 'Рекомендуються регулярні фізичні вправи та дієта.';
                $emoji = '🟡';
            } else {
                $cat   = 'Ожиріння';
                $color = '#ff4040';
                $tip   = 'Зверніться до лікаря для отримання рекомендацій.';
                $emoji = '🔴';
            }
            $result = compact('bmi', 'cat', 'color', 'tip', 'emoji');
        }
    }
}

$pageTitle = 'ІМТ | PHP Portfolio';
$active    = 'bmi';
$rootDir   = '../';

require __DIR__ . '/../partials/nav.php';
?>

<section class="hero">
    <h1>⚖️ Калькулятор ІМТ</h1>
    <p>Розрахуйте свій Індекс Маси Тіла (ІМТ / BMI)</p>
</section>

<main style="max-width:560px">
    <div class="card">
        <h2>Введіть дані</h2>

        <?php if ($error): ?>
            <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>

        <form method="POST">
            <div class="form-group">
                <label for="unit">Система вимірювань</label>
                <select id="unit" name="unit" onchange="updateLabels()">
                    <option value="metric"   <?= $unit === 'metric'   ? 'selected' : '' ?>>Метрична (кг / см)</option>
                    <option value="imperial" <?= $unit === 'imperial' ? 'selected' : '' ?>>Імперська (lbs / inch)</option>
                </select>
            </div>

            <div class="form-group">
                <label for="weight" id="weightLabel">
                    Вага (кг)
                </label>
                <input type="number" id="weight" name="weight"
                       step="0.1" min="1" max="999"
                       placeholder="напр. 70"
                       value="<?= htmlspecialchars($weight) ?>"
                       required>
            </div>

            <div class="form-group">
                <label for="height" id="heightLabel">
                    Зріст (см)
                </label>
                <input type="number" id="height" name="height"
                       step="0.1" min="1" max="999"
                       placeholder="напр. 175"
                       value="<?= htmlspecialchars($height) ?>"
                       required>
            </div>

            <button type="submit" class="btn btn-primary">Розрахувати ІМТ</button>
        </form>
    </div>

    <?php if ($result): ?>
        <div class="card text-center">
            <h2>Результат</h2>
            <div class="result-box" style="font-size:3rem;color:<?= $result['color'] ?>">
                <?= number_format($result['bmi'], 1) ?>
            </div>
            <p style="font-size:1.3rem;margin:0.75rem 0">
                <?= $result['emoji'] ?>
                <strong style="color:<?= $result['color'] ?>"><?= htmlspecialchars($result['cat']) ?></strong>
            </p>
            <p style="color:var(--text-muted)"><?= htmlspecialchars($result['tip']) ?></p>

            <!-- BMI scale -->
            <div style="margin-top:1.5rem;text-align:left">
                <p style="color:var(--text-muted);margin-bottom:0.5rem;font-size:0.88rem">Шкала ІМТ:</p>
                <div style="display:grid;grid-template-columns:repeat(4,1fr);gap:0.4rem;font-size:0.82rem;text-align:center">
                    <div style="background:rgba(91,206,255,0.2);border-radius:6px;padding:0.4rem">
                        <div style="color:#5bceff;font-weight:700">&lt; 18.5</div>
                        <div style="color:var(--text-muted)">Недостатня</div>
                    </div>
                    <div style="background:rgba(0,200,100,0.2);border-radius:6px;padding:0.4rem">
                        <div style="color:#00c864;font-weight:700">18.5–24.9</div>
                        <div style="color:var(--text-muted)">Норма</div>
                    </div>
                    <div style="background:rgba(255,179,0,0.2);border-radius:6px;padding:0.4rem">
                        <div style="color:#ffb300;font-weight:700">25–29.9</div>
                        <div style="color:var(--text-muted)">Надлишок</div>
                    </div>
                    <div style="background:rgba(255,64,64,0.2);border-radius:6px;padding:0.4rem">
                        <div style="color:#ff4040;font-weight:700">≥ 30</div>
                        <div style="color:var(--text-muted)">Ожиріння</div>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
</main>

<script>
function updateLabels() {
    var unit = document.getElementById('unit').value;
    document.getElementById('weightLabel').textContent =
        unit === 'imperial' ? 'Вага (фунти / lbs)' : 'Вага (кг)';
    document.getElementById('heightLabel').textContent =
        unit === 'imperial' ? 'Зріст (дюйми / inches)' : 'Зріст (см)';
}
// Set correct labels on page load
updateLabels();
</script>

<?php require __DIR__ . '/../partials/footer.php'; ?>
