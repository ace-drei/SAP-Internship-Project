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
    $question = $_POST["question"];
    $answers = explode("\n", $_POST["answers"]); // Split answers by newline

    // Insert the question into the faq table
    $sql = "INSERT INTO faq (question) VALUES (?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $question);
    $stmt->execute();
    $stmt->close();

    // Get the ID of the inserted question
    $questionId = $conn->insert_id;

    // Insert answers into the faq_answers table
    foreach ($answers as $answer) {
        $answer = trim($answer); // Remove leading/trailing whitespace
        if (!empty($answer)) {   // Skip empty lines
            $sql = "INSERT INTO faq_answers (faq_id, answer) VALUES (?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("is", $questionId, $answer);
            $stmt->execute();
            $stmt->close();
        }
    }
}

$conn->close();

// Redirect back to the display page
header("Location: faq.php");
exit();
?>
