<?php
$db_file = "lending_db.sqlite";

try {
    $conn = new PDO("sqlite:" . $db_file);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "CREATE TABLE IF NOT EXISTS loan_applications (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        name TEXT NOT NULL,
        address TEXT NOT NULL,
        mobile TEXT NOT NULL,
        messenger TEXT NOT NULL,
        co_maker TEXT,
        monthly_income REAL NOT NULL,
        income_source TEXT NOT NULL,
        income_specify TEXT,
        loan_amount REAL NOT NULL,
        payment_plan INTEGER NOT NULL,
        payment_per_month REAL NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )";

    $conn->exec($sql);
    echo "Database initialized successfully!";
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>