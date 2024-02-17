<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Tax Calculator</title>
</head>

<body>
    <h1>TAXXY: Tax Calculator</h1>
    <form method="post">
        <label for="salary">Enter Salary (PHP):</label>
        <input type="number" id="salary" name="salary" required>
        <br>
        <input type="radio" id="monthly" name="salary_type" value="monthly" checked>
        <label for="monthly">Monthly</label>
        <input type="radio" id="bi-monthly" name="salary_type" value="bi-monthly">
        <label for="bi-monthly">Bi-Monthly</label>
        <br>
        <button type="submit">Calculate</button>
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $salary = floatval($_POST["salary"]);
        $salaryType = $_POST["salary_type"]; // "monthly" or "bi-monthly"

        // Check if salary is not negative
        if ($salary < 0) {
            echo "<p style='color: red;'>Please enter a valid number.</p>";
        } else {
            // Calculate estimated annual salary
            $annualSalary = ($salaryType === "monthly") ? $salary * 12 : $salary * 24;

            // Determine tax range and compute taxes
            if ($annualSalary <= 250000) {
                $annualTax = 0;
            } elseif ($annualSalary <= 400000) {
                $annualTax = ($annualSalary - 250000) * 0.20;
            } elseif ($annualSalary <= 800000) {
                $annualTax = 22500 + ($annualSalary - 400000) * 0.25;
            } elseif ($annualSalary <= 2000000) {
                $annualTax = 102500 + ($annualSalary - 800000) * 0.30;
            } elseif ($annualSalary <= 8000000) {
                $annualTax = 402500 + ($annualSalary - 2000000) * 0.32;
            } else {
                $annualTax = 2202500 + ($annualSalary - 8000000) * 0.35;
            }

            // Calculate monthly tax
            $monthlyTax = $annualTax / 12;

            echo "<h2>Results:</h2>";
            echo "<p>Estimated Annual Salary: " . number_format($annualSalary, 2) . "</p>";
            echo "<p>Annual Tax: " . number_format($annualTax, 2) . "</p>"; // New line for annual tax
            echo "<p>Monthly Tax: " . number_format($monthlyTax, 2) . "</p>";
        }
    }
    ?>