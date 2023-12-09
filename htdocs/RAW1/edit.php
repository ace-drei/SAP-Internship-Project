<?php
require_once 'update_ratings.php';

$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["id"])) {
        $faqId = $_POST["id"];

        // Update the like count in the database
        $sql = "UPDATE faq SET likes = likes + 1 WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $faqId);
        $stmt->execute();

        $conn->close();
    }
}
?>
