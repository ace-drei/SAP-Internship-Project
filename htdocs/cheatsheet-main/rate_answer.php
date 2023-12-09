<?php
define('DB_HOST', 'localhost'); 
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'cheatsheetapp');

$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $answerId = $_POST["id"];
    $isCorrect = $_POST["correct"];

    // Update the Yes/No counts for the answer
    if ($isCorrect) {
        $sql = "UPDATE faq_answers SET yes_count = LEAST(yes_count + 1, 5) WHERE id = ?";
    } else {
        $sql = "UPDATE faq_answers SET no_count = LEAST(no_count + 1, 5) WHERE id = ?";
    }

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $answerId);
    $stmt->execute();
    $stmt->close();
}

$conn->close();
?>
