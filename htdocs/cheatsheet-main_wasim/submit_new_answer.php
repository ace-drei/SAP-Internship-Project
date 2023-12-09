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
    $questionId = $_POST["question_id"];
    $newAnswer = $_POST["new_answer"];

    // Insert the new answer into the faq_answers table
    $sql = "INSERT INTO faq_answers (faq_id, answer) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("is", $questionId, $newAnswer);
    $stmt->execute();
    $stmt->close();
}

$conn->close();
?>
