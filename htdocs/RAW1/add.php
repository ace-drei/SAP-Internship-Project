
<?php
// Establish database connection
$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

// Check for connection error
if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}
// Handle form submission to add new FAQ
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["question"]) && isset($_POST["answer"])) {
        $question = $_POST["question"];
        $answer = $_POST["answer"];

        // Prepare and execute the SQL INSERT query
        $sql = "INSERT INTO faq (question, answer) VALUES (?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $question, $answer);
        if ($stmt->execute()) {
            echo "New FAQ added successfully.";
        } else {
            echo "Error adding FAQ: " . $conn->error;
        }
    }
}

$conn->close();
?>