<?php
/**
 * apps/bmi.php – BMI (Body Mass Index) calculator mini-app
 */
session_start();

// ── Language ────────────────────────────────────────────────
if (isset($_GET['lang']) && in_array($_GET['lang'], ['en', 'de'], true)) {
    $_SESSION['lang'] = $_GET['lang'];
}
$lang = $_SESSION['lang'] ?? 'en';

$t = [
    'en' => [
        'hero_sub'        => 'Calculate your Body Mass Index (BMI)',
        'err_numeric'     => 'Please enter numeric values.',
        'err_zero'        => 'Values must be greater than zero.',
        'err_realistic'   => 'Please enter realistic values.',
        'card_title'      => 'Enter your details',
        'lbl_unit'        => 'Measurement system',
        'opt_metric'      => 'Metric (kg / cm)',
        'opt_imperial'    => 'Imperial (lbs / inches)',
        'lbl_weight'      => 'Weight',
        'lbl_weight_kg'   => 'Weight (kg)',
        'lbl_weight_lbs'  => 'Weight (lbs)',
        'lbl_height'      => 'Height',
        'lbl_height_cm'   => 'Height (cm)',
        'lbl_height_in'   => 'Height (inches)',
        'ph_weight'       => 'e.g. 70',
        'ph_height'       => 'e.g. 175',
        'btn_calc'        => 'Calculate BMI',
        'result'          => 'Result',
        'bmi_scale'       => 'BMI Scale:',
        'cat_under'       => 'Underweight',
        'cat_normal'      => 'Normal weight',
        'cat_over'        => 'Overweight',
        'cat_obese'       => 'Obese',
        'tip_under'       => 'Consider a balanced diet to gain weight.',
        'tip_normal'      => 'Great! Keep up the healthy lifestyle.',
        'tip_over'        => 'Regular exercise and a balanced diet are recommended.',
        'tip_obese'       => 'Please consult a doctor for personalised advice.',
        'scale_normal'    => 'Normal',
    ],
    'de' => [
        'hero_sub'        => 'Berechne deinen Body-Mass-Index (BMI)',
        'err_numeric'     => 'Bitte numerische Werte eingeben.',
        'err_zero'        => 'Werte müssen größer als null sein.',
        'err_realistic'   => 'Bitte realistische Werte eingeben.',
        'card_title'      => 'Gib deine Daten ein',
        'lbl_unit'        => 'Maßsystem',
        'opt_metric'      => 'Metrisch (kg / cm)',
        'opt_imperial'    => 'Imperial (lbs / Zoll)',
        'lbl_weight'      => 'Gewicht',
        'lbl_weight_kg'   => 'Gewicht (kg)',
        'lbl_weight_lbs'  => 'Gewicht (lbs)',
        'lbl_height'      => 'Größe',
        'lbl_height_cm'   => 'Größe (cm)',
        'lbl_height_in'   => 'Größe (Zoll)',
        'ph_weight'       => 'z. B. 70',
        'ph_height'       => 'z. B. 175',
        'btn_calc'        => 'BMI berechnen',
        'result'          => 'Ergebnis',
        'bmi_scale'       => 'BMI-Skala:',
        'cat_under'       => 'Untergewicht',
        'cat_normal'      => 'Normalgewicht',
        'cat_over'        => 'Übergewicht',
        'cat_obese'       => 'Adipositas',
        'tip_under'       => 'Achte auf eine ausgewogene Ernährung, um Gewicht zuzunehmen.',
        'tip_normal'      => 'Super! Mach weiter so mit dem gesunden Lebensstil.',
        'tip_over'        => 'Regelmäßige Bewegung und eine ausgewogene Ernährung werden empfohlen.',
        'tip_obese'       => 'Bitte wende dich an einen Arzt für persönliche Beratung.',
        'scale_normal'    => 'Normal',
    ],
][$lang];

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
        $error = $t['err_numeric'];
    } else {
        $w = (float)$weight;
        $h = (float)$height;

        if ($unit === 'imperial') {
            $w = $w * 0.453592;
            $h = $h * 0.0254;
        } else {
            $h = $h / 100;
        }

        if ($w <= 0 || $h <= 0) {
            $error = $t['err_zero'];
        } elseif ($w > 600 || $h > 3) {
            $error = $t['err_realistic'];
        } else {
            $bmi = $w / ($h * $h);
            if ($bmi < 18.5) {
                $cat   = $t['cat_under'];
                $color = '#5bceff';
                $tip   = $t['tip_under'];
                $emoji = '🔵';
            } elseif ($bmi < 25) {
                $cat   = $t['cat_normal'];
                $color = '#00c864';
                $tip   = $t['tip_normal'];
                $emoji = '🟢';
            } elseif ($bmi < 30) {
                $cat   = $t['cat_over'];
                $color = '#ffb300';
                $tip   = $t['tip_over'];
                $emoji = '🟡';
            } else {
                $cat   = $t['cat_obese'];
                $color = '#ff4040';
                $tip   = $t['tip_obese'];
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
    <h1><span class="hero-icon">⚖️</span> Insait BMI</h1>
    <p><?= $t['hero_sub'] ?></p>
</section>

<main style="max-width:560px">
    <div class="card">
        <h2><?= $t['card_title'] ?></h2>

        <?php if ($error): ?>
            <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>

        <form method="POST">
            <div class="form-group">
                <label for="unit"><?= $t['lbl_unit'] ?></label>
                <select id="unit" name="unit" onchange="updateLabels()">
                    <option value="metric"   <?= $unit === 'metric'   ? 'selected' : '' ?>><?= $t['opt_metric'] ?></option>
                    <option value="imperial" <?= $unit === 'imperial' ? 'selected' : '' ?>><?= $t['opt_imperial'] ?></option>
                </select>
            </div>

            <div class="form-group">
                <label for="weight" id="weightLabel"><?= $t['lbl_weight_kg'] ?></label>
                <input type="number" id="weight" name="weight"
                       step="0.1" min="1" max="999"
                       placeholder="<?= $t['ph_weight'] ?>"
                       value="<?= htmlspecialchars($weight) ?>"
                       required>
            </div>

            <div class="form-group">
                <label for="height" id="heightLabel"><?= $t['lbl_height_cm'] ?></label>
                <input type="number" id="height" name="height"
                       step="0.1" min="1" max="999"
                       placeholder="<?= $t['ph_height'] ?>"
                       value="<?= htmlspecialchars($height) ?>"
                       required>
            </div>

            <button type="submit" class="btn btn-primary"><?= $t['btn_calc'] ?></button>
        </form>
    </div>

    <?php if ($result): ?>
        <div class="card text-center">
            <h2><?= $t['result'] ?></h2>
            <div class="result-box" style="font-size:3rem;color:<?= $result['color'] ?>">
                <?= number_format($result['bmi'], 1) ?>
            </div>
            <p style="font-size:1.3rem;margin:0.75rem 0">
                <?= $result['emoji'] ?>
                <strong style="color:<?= $result['color'] ?>"><?= htmlspecialchars($result['cat']) ?></strong>
            </p>
            <p style="color:var(--text-muted)"><?= htmlspecialchars($result['tip']) ?></p>

            <div style="margin-top:1.5rem;text-align:left">
                <p style="color:var(--text-muted);margin-bottom:0.5rem;font-size:0.88rem"><?= $t['bmi_scale'] ?></p>
                <div style="display:grid;grid-template-columns:repeat(4,1fr);gap:0.4rem;font-size:0.82rem;text-align:center">
                    <div style="background:rgba(91,206,255,0.2);border-radius:6px;padding:0.4rem">
                        <div style="color:#5bceff;font-weight:700">&lt; 18.5</div>
                        <div style="color:var(--text-muted)"><?= $t['cat_under'] ?></div>
                    </div>
                    <div style="background:rgba(0,200,100,0.2);border-radius:6px;padding:0.4rem">
                        <div style="color:#00c864;font-weight:700">18.5–24.9</div>
                        <div style="color:var(--text-muted)"><?= $t['scale_normal'] ?></div>
                    </div>
                    <div style="background:rgba(255,179,0,0.2);border-radius:6px;padding:0.4rem">
                        <div style="color:#ffb300;font-weight:700">25–29.9</div>
                        <div style="color:var(--text-muted)"><?= $t['cat_over'] ?></div>
                    </div>
                    <div style="background:rgba(255,64,64,0.2);border-radius:6px;padding:0.4rem">
                        <div style="color:#ff4040;font-weight:700">≥ 30</div>
                        <div style="color:var(--text-muted)"><?= $t['cat_obese'] ?></div>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
</main>

<script>
var labelWeightKg  = <?= json_encode($t['lbl_weight_kg'])  ?>;
var labelWeightLbs = <?= json_encode($t['lbl_weight_lbs']) ?>;
var labelHeightCm  = <?= json_encode($t['lbl_height_cm'])  ?>;
var labelHeightIn  = <?= json_encode($t['lbl_height_in'])  ?>;

function updateLabels() {
    var unit = document.getElementById('unit').value;
    document.getElementById('weightLabel').textContent = unit === 'imperial' ? labelWeightLbs : labelWeightKg;
    document.getElementById('heightLabel').textContent = unit === 'imperial' ? labelHeightIn  : labelHeightCm;
}
updateLabels();
</script>

<?php require __DIR__ . '/../partials/footer.php'; ?>
