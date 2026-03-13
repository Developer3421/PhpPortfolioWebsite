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
        $error = 'Please enter numeric values.';
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
            $error = 'Values must be greater than zero.';
        } elseif ($w > 600 || $h > 3) {
            $error = 'Please enter realistic values.';
        } else {
            $bmi = $w / ($h * $h);
            if ($bmi < 18.5) {
                $cat   = 'Underweight';
                $color = '#5bceff';
                $tip   = 'Consider a balanced diet to gain weight.';
                $emoji = '🔵';
            } elseif ($bmi < 25) {
                $cat   = 'Normal weight';
                $color = '#00c864';
                $tip   = 'Great! Keep up the healthy lifestyle.';
                $emoji = '🟢';
            } elseif ($bmi < 30) {
                $cat   = 'Overweight';
                $color = '#ffb300';
                $tip   = 'Regular exercise and a balanced diet are recommended.';
                $emoji = '🟡';
            } else {
                $cat   = 'Obese';
                $color = '#ff4040';
                $tip   = 'Please consult a doctor for personalised advice.';
                $emoji = '🔴';
            }
            $result = compact('bmi', 'cat', 'color', 'tip', 'emoji');
        }
    }
}

$pageTitle = 'Insait BMI | PHP Portfolio';
$active    = 'bmi';
$rootDir   = '../';

require __DIR__ . '/../partials/nav.php';
?>

<section class="hero">
    <h1>⚖️ Insait BMI</h1>
    <p>Calculate your Body Mass Index (BMI)</p>
</section>

<main style="max-width:560px">
    <div class="card">
        <h2>Enter your details</h2>

        <?php if ($error): ?>
            <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>

        <form method="POST">
            <div class="form-group">
                <label for="unit">Measurement system</label>
                <select id="unit" name="unit" onchange="updateLabels()">
                    <option value="metric"   <?= $unit === 'metric'   ? 'selected' : '' ?>>Metric (kg / cm)</option>
                    <option value="imperial" <?= $unit === 'imperial' ? 'selected' : '' ?>>Imperial (lbs / inches)</option>
                </select>
            </div>

            <div class="form-group">
                <label for="weight" id="weightLabel">
                    Weight (kg)
                </label>
                <input type="number" id="weight" name="weight"
                       step="0.1" min="1" max="999"
                       placeholder="e.g. 70"
                       value="<?= htmlspecialchars($weight) ?>"
                       required>
            </div>

            <div class="form-group">
                <label for="height" id="heightLabel">
                    Height (cm)
                </label>
                <input type="number" id="height" name="height"
                       step="0.1" min="1" max="999"
                       placeholder="e.g. 175"
                       value="<?= htmlspecialchars($height) ?>"
                       required>
            </div>

            <button type="submit" class="btn btn-primary">Calculate BMI</button>
        </form>
    </div>

    <?php if ($result): ?>
        <div class="card text-center">
            <h2>Result</h2>
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
                <p style="color:var(--text-muted);margin-bottom:0.5rem;font-size:0.88rem">BMI Scale:</p>
                <div style="display:grid;grid-template-columns:repeat(4,1fr);gap:0.4rem;font-size:0.82rem;text-align:center">
                    <div style="background:rgba(91,206,255,0.2);border-radius:6px;padding:0.4rem">
                        <div style="color:#5bceff;font-weight:700">&lt; 18.5</div>
                        <div style="color:var(--text-muted)">Underweight</div>
                    </div>
                    <div style="background:rgba(0,200,100,0.2);border-radius:6px;padding:0.4rem">
                        <div style="color:#00c864;font-weight:700">18.5–24.9</div>
                        <div style="color:var(--text-muted)">Normal</div>
                    </div>
                    <div style="background:rgba(255,179,0,0.2);border-radius:6px;padding:0.4rem">
                        <div style="color:#ffb300;font-weight:700">25–29.9</div>
                        <div style="color:var(--text-muted)">Overweight</div>
                    </div>
                    <div style="background:rgba(255,64,64,0.2);border-radius:6px;padding:0.4rem">
                        <div style="color:#ff4040;font-weight:700">≥ 30</div>
                        <div style="color:var(--text-muted)">Obese</div>
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
        unit === 'imperial' ? 'Weight (lbs)' : 'Weight (kg)';
    document.getElementById('heightLabel').textContent =
        unit === 'imperial' ? 'Height (inches)' : 'Height (cm)';
}
// Set correct labels on page load
updateLabels();
</script>

<?php require __DIR__ . '/../partials/footer.php'; ?>
