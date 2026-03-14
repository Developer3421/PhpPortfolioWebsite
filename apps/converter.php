<?php
/**
 * apps/converter.php – Unit converter mini-app (temperature, length, weight, volume)
 */
session_start();

// ── Language ────────────────────────────────────────────────
if (isset($_GET['lang']) && in_array($_GET['lang'], ['en', 'de'], true)) {
    $_SESSION['lang'] = $_GET['lang'];
}
$lang = $_SESSION['lang'] ?? 'en';

$t = [
    'en' => [
        'hero_sub'    => 'Convert temperature, length, weight and volume',
        'card_title'  => 'Conversion settings',
        'err_cat'     => 'Unknown category.',
        'err_numeric' => 'Please enter a numeric value.',
        'err_units'   => 'Please select valid units.',
        'lbl_cat'     => 'Category',
        'lbl_value'   => 'Value',
        'ph_value'    => 'Enter value…',
        'lbl_from'    => 'From',
        'lbl_to'      => 'To',
        'btn_convert' => 'Convert',
        'result'      => 'Result',
    ],
    'de' => [
        'hero_sub'    => 'Temperatur, Länge, Gewicht und Volumen umrechnen',
        'card_title'  => 'Konvertierungseinstellungen',
        'err_cat'     => 'Unbekannte Kategorie.',
        'err_numeric' => 'Bitte einen numerischen Wert eingeben.',
        'err_units'   => 'Bitte gültige Einheiten auswählen.',
        'lbl_cat'     => 'Kategorie',
        'lbl_value'   => 'Wert',
        'ph_value'    => 'Wert eingeben…',
        'lbl_from'    => 'Von',
        'lbl_to'      => 'Nach',
        'btn_convert' => 'Umrechnen',
        'result'      => 'Ergebnis',
    ],
][$lang];

$categoryLabels = [
    'en' => [
        'temperature' => '🌡️ Temperature',
        'length'      => '📏 Length',
        'weight'      => '⚖️ Weight',
        'volume'      => '🧴 Volume',
    ],
    'de' => [
        'temperature' => '🌡️ Temperatur',
        'length'      => '📏 Länge',
        'weight'      => '⚖️ Gewicht',
        'volume'      => '🧴 Volumen',
    ],
];

$categories = [
    'temperature' => [
        'label' => $categoryLabels[$lang]['temperature'],
        'units' => ['Celsius', 'Fahrenheit', 'Kelvin'],
    ],
    'length' => [
        'label' => $categoryLabels[$lang]['length'],
        'units' => ['Metres', 'Kilometres', 'Miles', 'Feet', 'Inches', 'Centimetres'],
    ],
    'weight' => [
        'label' => $categoryLabels[$lang]['weight'],
        'units' => ['Kilograms', 'Grams', 'Pounds', 'Ounces', 'Tonnes'],
    ],
    'volume' => [
        'label' => $categoryLabels[$lang]['volume'],
        'units' => ['Litres', 'Millilitres', 'Gallons (US)', 'Fluid Ounces (US)', 'Cubic Metres'],
    ],
];

// Conversion to/from base unit
function toBase(float $v, string $unit, string $cat): float
{
    return match ($cat) {
        'temperature' => match ($unit) {
            'Celsius'    => $v,
            'Fahrenheit' => ($v - 32) * 5 / 9,
            'Kelvin'     => $v - 273.15,
            default      => $v,
        },
        'length' => match ($unit) {   // base: metres
            'Metres'      => $v,
            'Kilometres'  => $v * 1000,
            'Miles'       => $v * 1609.344,
            'Feet'        => $v * 0.3048,
            'Inches'      => $v * 0.0254,
            'Centimetres' => $v * 0.01,
            default       => $v,
        },
        'weight' => match ($unit) {   // base: kilograms
            'Kilograms' => $v,
            'Grams'     => $v * 0.001,
            'Pounds'    => $v * 0.45359237,
            'Ounces'    => $v * 0.028349523,
            'Tonnes'    => $v * 1000,
            default     => $v,
        },
        'volume' => match ($unit) {   // base: litres
            'Litres'              => $v,
            'Millilitres'         => $v * 0.001,
            'Gallons (US)'        => $v * 3.785411784,
            'Fluid Ounces (US)'   => $v * 0.02957352956,
            'Cubic Metres'        => $v * 1000,
            default               => $v,
        },
        default => $v,
    };
}

function fromBase(float $base, string $unit, string $cat): float
{
    return match ($cat) {
        'temperature' => match ($unit) {
            'Celsius'    => $base,
            'Fahrenheit' => $base * 9 / 5 + 32,
            'Kelvin'     => $base + 273.15,
            default      => $base,
        },
        'length' => match ($unit) {
            'Metres'      => $base,
            'Kilometres'  => $base / 1000,
            'Miles'       => $base / 1609.344,
            'Feet'        => $base / 0.3048,
            'Inches'      => $base / 0.0254,
            'Centimetres' => $base / 0.01,
            default       => $base,
        },
        'weight' => match ($unit) {
            'Kilograms' => $base,
            'Grams'     => $base / 0.001,
            'Pounds'    => $base / 0.45359237,
            'Ounces'    => $base / 0.028349523,
            'Tonnes'    => $base / 1000,
            default     => $base,
        },
        'volume' => match ($unit) {
            'Litres'            => $base,
            'Millilitres'       => $base / 0.001,
            'Gallons (US)'      => $base / 3.785411784,
            'Fluid Ounces (US)' => $base / 0.02957352956,
            'Cubic Metres'      => $base / 1000,
            default             => $base,
        },
        default => $base,
    };
}

$result     = null;
$error      = '';
$selCat     = $_POST['category'] ?? 'length';
$selFrom    = $_POST['from_unit'] ?? '';
$selTo      = $_POST['to_unit']   ?? '';
$inputVal   = $_POST['value']     ?? '';

if (($_SERVER['REQUEST_METHOD'] ?? '') === 'POST') {
    if (!array_key_exists($selCat, $categories)) {
        $error = $t['err_cat'];
    } elseif (!is_numeric($inputVal)) {
        $error = $t['err_numeric'];
    } else {
        $units = $categories[$selCat]['units'];
        if (!in_array($selFrom, $units, true) || !in_array($selTo, $units, true)) {
            $error = $t['err_units'];
        } else {
            $base   = toBase((float)$inputVal, $selFrom, $selCat);
            $output = fromBase($base, $selTo, $selCat);
            $result = [
                'input'  => (float)$inputVal,
                'output' => $output,
                'from'   => $selFrom,
                'to'     => $selTo,
            ];
        }
    }
}

// Default unit selects
if (!$selFrom && isset($categories[$selCat])) {
    $selFrom = $categories[$selCat]['units'][0];
    $selTo   = $categories[$selCat]['units'][1];
}

$pageTitle = 'Insait Converter | PHP Portfolio';
$active    = 'converter';
$rootDir   = '../';

require __DIR__ . '/../partials/nav.php';
?>

<section class="hero">
    <h1>🔄 Insait Converter</h1>
    <p><?= $t['hero_sub'] ?></p>
</section>

<main style="max-width:580px">
    <div class="card">
        <h2><?= $t['card_title'] ?></h2>

        <?php if ($error): ?>
            <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>

        <form method="POST" id="convForm">
            <div class="form-group">
                <label for="category"><?= $t['lbl_cat'] ?></label>
                <select id="category" name="category" onchange="updateUnits()">
                    <?php foreach ($categories as $key => $cat): ?>
                        <option value="<?= $key ?>" <?= $selCat === $key ? 'selected' : '' ?>>
                            <?= htmlspecialchars($cat['label']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group">
                <label for="value"><?= $t['lbl_value'] ?></label>
                <input type="number" id="value" name="value"
                       step="any"
                       placeholder="<?= htmlspecialchars($t['ph_value']) ?>"
                       value="<?= htmlspecialchars($inputVal) ?>"
                       required>
            </div>

            <div style="display:grid;grid-template-columns:1fr 1fr;gap:1rem">
                <div class="form-group">
                    <label for="from_unit"><?= $t['lbl_from'] ?></label>
                    <select id="from_unit" name="from_unit">
                        <?php foreach ($categories[$selCat]['units'] as $u): ?>
                            <option value="<?= htmlspecialchars($u) ?>" <?= ($u === $selFrom) ? 'selected' : '' ?>>
                                <?= htmlspecialchars($u) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="to_unit"><?= $t['lbl_to'] ?></label>
                    <select id="to_unit" name="to_unit">
                        <?php foreach ($categories[$selCat]['units'] as $u): ?>
                            <option value="<?= htmlspecialchars($u) ?>" <?= ($u === $selTo) ? 'selected' : '' ?>>
                                <?= htmlspecialchars($u) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>

            <button type="submit" class="btn btn-primary"><?= $t['btn_convert'] ?></button>
        </form>
    </div>

    <?php if ($result): ?>
        <div class="card text-center">
            <h2><?= $t['result'] ?></h2>
            <div class="result-box">
                <?= rtrim(rtrim(number_format($result['input'], 6, '.', ''), '0'), '.') ?>
                <?= htmlspecialchars($result['from']) ?> =
            </div>
            <div class="converter-result">
                <?= rtrim(rtrim(number_format($result['output'], 8, '.', ''), '0'), '.') ?>
                <?= htmlspecialchars($result['to']) ?>
            </div>
        </div>
    <?php endif; ?>
</main>

<script>
var categoriesData = <?= json_encode(array_map(fn($c) => $c['units'], $categories)) ?>;

function updateUnits() {
    var cat   = document.getElementById('category').value;
    var units = categoriesData[cat] || [];
    var from  = document.getElementById('from_unit');
    var to    = document.getElementById('to_unit');

    [from, to].forEach(function(sel, i) {
        sel.innerHTML = '';
        units.forEach(function(u) {
            var opt = document.createElement('option');
            opt.value = u; opt.textContent = u;
            sel.appendChild(opt);
        });
        if (units[i]) sel.value = units[i];
    });
}
</script>

<?php require __DIR__ . '/../partials/footer.php'; ?>
