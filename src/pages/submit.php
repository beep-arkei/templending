<?php
header("Content-Type: application/json"); // Ensure JSON output

file_put_contents("debug.log", print_r($_POST, true));

// Connect to SQLite database
$pdo = new PDO('sqlite:beppu_lending.db');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        // Debugging: Log incoming data
        file_put_contents("debug.log", print_r($_POST, true));

        // Prepare SQL statement
        $stmt = $pdo->prepare("INSERT INTO loan_applications 
            (name, address, mobile, messenger, comaker, monthly_income, income_source, specified_income, loan_amount, payment_plan) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

        // Execute with safe null defaults
        $stmt->execute([
            $_POST['name'] ?? null,
            $_POST['address'] ?? null,
            $_POST['mobile'] ?? null,
            $_POST['messenger'] ?? null,
            $_POST['comaker'] ?? null,
            $_POST['monthlyIncome'] ?? null,
            $_POST['incomeSource'] ?? null,
            $_POST['incomeSpecify'] ?? null,
            $_POST['loanAmount'] ?? null,
            $_POST['paymentPlan'] ?? null
        ]);

        echo json_encode(["success" => true, "message" => "Application submitted successfully!"]);
    } catch (PDOException $e) {
        echo json_encode(["success" => false, "message" => "Database error: " . $e->getMessage()]);
    }
} else {
    echo json_encode(["success" => false, "message" => "Invalid request."]);
}
?>

