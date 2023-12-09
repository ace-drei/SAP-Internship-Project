<?php
// Include your database connection code here
define('DB_HOST', 'localhost'); 
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'cheatsheetapp');

$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["faqanswer"])) {
        $answer = $_POST["faqanswer"];

        // Insert the answer into the database
        $sql = "INSERT INTO faq (answer) VALUES (?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $answer);
        
        if ($stmt->execute()) {
            echo "Answer inserted successfully!";
        } else {
            echo "Error inserting answer: " . $stmt->error;
        }

        $stmt->close();
    }
}

$conn->close();
?>
