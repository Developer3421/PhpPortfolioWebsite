# PHP Portfolio Website

A personal portfolio website built with pure PHP, showcasing developer information and five interactive mini-applications. No external frameworks or dependencies — just PHP 8.0+, HTML5, CSS3, and vanilla JavaScript.

## Live Features

- **Bilingual interface** — switch between English and German at any time (session-based)
- **Dark theme** — purple/orange colour scheme with CSS custom properties
- **Responsive layout** — fluid grids and `clamp()` typography work on any screen size
- **Five interactive apps** accessible from the navigation bar

## Project Structure

```
PhpPortfolioWebsite/
├── index.php           # Main portfolio / landing page
├── assets/
│   └── style.css       # Global styles (CSS variables, dark theme)
├── apps/
│   ├── calculator.php  # Arithmetic calculator
│   ├── todo.php        # To-do list
│   ├── quiz.php        # PHP knowledge quiz
│   ├── bmi.php         # BMI calculator
│   └── converter.php   # Unit converter
└── partials/
    ├── nav.php         # Shared navigation header
    └── footer.php      # Shared footer
```

## Mini-Applications

### Calculator (`apps/calculator.php`)
Standard arithmetic calculator with a **custom expression parser** — no `eval()` is used. Supports operator precedence (`*`, `/`, `%` before `+`, `-`), sign toggle (±), and full keyboard input (digits, operators, Enter, Backspace, Escape).

### To-Do List (`apps/todo.php`)
Task manager that stores items in **browser localStorage** so data survives page reloads. Features include timestamps, completion toggling, a progress counter, and a "Clear All" action. Inputs are HTML-escaped to prevent XSS.

### PHP Quiz (`apps/quiz.php`)
Ten multiple-choice questions about PHP fundamentals, managed with **server-side sessions**. Tracks progress with a progress bar, shows per-question feedback, and displays a scored summary at the end with an option to retry.

### BMI Calculator (`apps/bmi.php`)
Calculates Body Mass Index with **metric** (kg/cm) and **imperial** (lbs/in) unit modes. Results are colour-coded by category (Underweight, Normal, Overweight, Obese) and include health tips. Validates realistic value ranges before calculation.

### Unit Converter (`apps/converter.php`)
Converts values across four categories using PHP 8 `match` expressions:

| Category    | Units available |
|-------------|-----------------|
| Temperature | Celsius, Fahrenheit, Kelvin |
| Length      | Metres, Kilometres, Miles, Feet, Inches, Centimetres |
| Weight      | Kilograms, Grams, Pounds, Ounces, Tonnes |
| Volume      | Litres, Millilitres, US Gallons, US Fluid Ounces, Cubic Metres |

## Technology Stack

| Layer      | Technology |
|------------|------------|
| Backend    | PHP 8.0+ (sessions, match expressions) |
| Frontend   | HTML5, CSS3, vanilla JavaScript |
| Styling    | CSS custom properties, Flexbox, Grid, `clamp()` |
| Persistence | PHP sessions (quiz & language) · browser localStorage (to-dos) |
| Database   | None — no external storage required |

## Requirements

- **PHP 8.0** or newer (uses `match` expressions)
- A web server with PHP support (Apache, Nginx, or PHP's built-in server)

## Quick Start

```bash
# Clone the repository
git clone https://github.com/Developer3421/PhpPortfolioWebsite.git
cd PhpPortfolioWebsite

# Start PHP's built-in development server
php -S localhost:8000

# Open in browser
# http://localhost:8000
```

## Security Notes

- **No `eval()`** — the calculator uses a custom tokeniser and two-pass evaluator for safe expression parsing.
- **HTML escaping** — all user input rendered to the page is passed through `htmlspecialchars()` to prevent XSS.
- **Session-based state** — quiz progress and language preference are stored server-side, not in hidden form fields.

## Author

**Oleg Kurylo** — [GitHub](https://github.com/Developer3421)

---

*Made with ❤️ in PHP*
