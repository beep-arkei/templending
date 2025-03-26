<?php
// Connect to SQLite database
$pdo = new PDO('sqlite:beppu_lending.db');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Check if form is submitted via POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        $stmt = $pdo->prepare("INSERT INTO loan_applications 
            (name, address, mobile, messenger, comaker, monthly_income, income_source, specified_income, loan_amount, payment_plan) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

        $stmt->execute([
            $_POST['name'],
            $_POST['address'],
            $_POST['mobile'],
            $_POST['messenger'],
            $_POST['comaker'],
            $_POST['monthlyIncome'],
            $_POST['incomeSource'],
            $_POST['incomeSpecify'] ?? null,
            $_POST['loanAmount'],
            $_POST['paymentPlan']
        ]);

        echo json_encode(["success" => true, "message" => "Application submitted successfully!"]);
    } catch (PDOException $e) {
        echo json_encode(["success" => false, "message" => "Database error: " . $e->getMessage()]);
    }
} else {
    echo json_encode(["success" => false, "message" => "Invalid request."]);
}
?>