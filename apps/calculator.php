<?php
/**
 * apps/calculator.php – Interactive calculator mini-app
 */
$pageTitle = 'Insait Calculator | PHP Portfolio';
$active    = 'calculator';
$rootDir   = '../';

require __DIR__ . '/../partials/nav.php';
?>

<section class="hero">
    <h1>🧮 Insait Calculator</h1>
    <p>A simple calculator with basic arithmetic operations</p>
</section>

<main style="max-width:440px">
    <div class="card">
        <div class="calc-display">
            <div class="expr" id="expr">&nbsp;</div>
            <div id="display">0</div>
        </div>
        <div class="calc-grid">
            <button class="calc-btn clr" onclick="calcClear()">C</button>
            <button class="calc-btn clr" onclick="calcBackspace()">⌫</button>
            <button class="calc-btn op"  onclick="calcOp('%')">%</button>
            <button class="calc-btn op"  onclick="calcOp('/')">÷</button>

            <button class="calc-btn" onclick="calcDigit('7')">7</button>
            <button class="calc-btn" onclick="calcDigit('8')">8</button>
            <button class="calc-btn" onclick="calcDigit('9')">9</button>
            <button class="calc-btn op" onclick="calcOp('*')">×</button>

            <button class="calc-btn" onclick="calcDigit('4')">4</button>
            <button class="calc-btn" onclick="calcDigit('5')">5</button>
            <button class="calc-btn" onclick="calcDigit('6')">6</button>
            <button class="calc-btn op" onclick="calcOp('-')">−</button>

            <button class="calc-btn" onclick="calcDigit('1')">1</button>
            <button class="calc-btn" onclick="calcDigit('2')">2</button>
            <button class="calc-btn" onclick="calcDigit('3')">3</button>
            <button class="calc-btn op" onclick="calcOp('+')">+</button>

            <button class="calc-btn" onclick="calcToggleSign()">±</button>
            <button class="calc-btn" onclick="calcDigit('0')">0</button>
            <button class="calc-btn" onclick="calcDot()">.</button>
            <button class="calc-btn eq" onclick="calcEquals()">=</button>
        </div>
    </div>
</main>

<script>
(function () {
    let expr        = '';
    let currentVal  = '0';
    let justEvaled  = false;

    const display = document.getElementById('display');
    const exprEl  = document.getElementById('expr');

    function update() {
        display.textContent = currentVal;
        exprEl.textContent  = expr || '\u00a0';
    }

    window.calcDigit = function (d) {
        if (justEvaled) { currentVal = '0'; expr = ''; justEvaled = false; }
        currentVal = currentVal === '0' ? d : currentVal + d;
        update();
    };

    window.calcDot = function () {
        if (justEvaled) { currentVal = '0'; expr = ''; justEvaled = false; }
        if (!currentVal.includes('.')) currentVal += '.';
        update();
    };

    window.calcOp = function (op) {
        justEvaled = false;
        expr = (expr + ' ' + currentVal + ' ' + op).trim();
        currentVal = '0';
        update();
    };

    window.calcEquals = function () {
        if (!expr) return;
        const fullExpr = expr + ' ' + currentVal;
        try {
            // Safe expression parser — no eval/Function constructor used.
            // Tokenise into numbers and operators, then evaluate respecting
            // operator precedence via two-pass shunting (*, /, % before +, -).
            var result = safeCalc(fullExpr);
            if (result === null || !isFinite(result)) { currentVal = 'Error'; }
            else {
                result = parseFloat(result.toPrecision(12));
                currentVal = String(result);
            }
        } catch (e) {
            currentVal = 'Error';
        }
        exprEl.textContent = fullExpr + ' =';
        display.textContent = currentVal;
        expr = '';
        justEvaled = true;
    };

    window.calcClear = function () {
        expr = ''; currentVal = '0'; justEvaled = false; update();
    };

    window.calcBackspace = function () {
        if (justEvaled) return;
        currentVal = currentVal.length > 1 ? currentVal.slice(0, -1) : '0';
        update();
    };

    window.calcToggleSign = function () {
        currentVal = currentVal.startsWith('-') ? currentVal.slice(1) : '-' + currentVal;
        if (currentVal === '-0') currentVal = '0';
        update();
    };

    // Safe expression evaluator – no eval / Function constructor.
    // Handles: numbers (incl. negatives), +, -, *, /, %
    // Precedence: *, /, % before +, -
    function safeCalc(expr) {
        // Tokenise
        var tokens = [];
        var i = 0;
        var str = expr.replace(/\s+/g, '');
        while (i < str.length) {
            // Unary minus at start or after operator
            if (str[i] === '-' && (i === 0 || '+-*/%'.indexOf(str[i - 1]) !== -1)) {
                var j = i + 1;
                while (j < str.length && (str[j] >= '0' && str[j] <= '9' || str[j] === '.')) j++;
                tokens.push(parseFloat(str.slice(i, j)));
                i = j;
            } else if ((str[i] >= '0' && str[i] <= '9') || str[i] === '.') {
                var j = i;
                while (j < str.length && ((str[j] >= '0' && str[j] <= '9') || str[j] === '.')) j++;
                tokens.push(parseFloat(str.slice(i, j)));
                i = j;
            } else if ('+-*/%'.indexOf(str[i]) !== -1) {
                tokens.push(str[i]);
                i++;
            } else {
                return null; // Unknown character
            }
        }
        // Validate: must be alternating number/operator starting and ending with number
        if (tokens.length === 0) return null;
        for (var k = 0; k < tokens.length; k++) {
            if (k % 2 === 0 && typeof tokens[k] !== 'number') return null;
            if (k % 2 === 1 && typeof tokens[k] !== 'string') return null;
        }
        if (typeof tokens[tokens.length - 1] !== 'number') return null;

        // Pass 1: *, /, %
        var pass1 = [tokens[0]];
        for (var k = 1; k < tokens.length; k += 2) {
            var op = tokens[k], right = tokens[k + 1];
            if (op === '*') pass1[pass1.length - 1] *= right;
            else if (op === '/') pass1[pass1.length - 1] /= right;
            else if (op === '%') pass1[pass1.length - 1] %= right;
            else { pass1.push(op); pass1.push(right); }
        }
        // Pass 2: +, -
        var acc = pass1[0];
        for (var k = 1; k < pass1.length; k += 2) {
            var op = pass1[k], right = pass1[k + 1];
            if (op === '+') acc += right;
            else if (op === '-') acc -= right;
            else return null;
        }
        return acc;
    }

    // Keyboard support
    document.addEventListener('keydown', function (e) {
        if (e.key >= '0' && e.key <= '9') calcDigit(e.key);
        else if (e.key === '.') calcDot();
        else if (e.key === '+') calcOp('+');
        else if (e.key === '-') calcOp('-');
        else if (e.key === '*') calcOp('*');
        else if (e.key === '/') { e.preventDefault(); calcOp('/'); }
        else if (e.key === '%') calcOp('%');
        else if (e.key === 'Enter' || e.key === '=') calcEquals();
        else if (e.key === 'Backspace') calcBackspace();
        else if (e.key === 'Escape') calcClear();
    });
}());
</script>

<?php require __DIR__ . '/../partials/footer.php'; ?>
