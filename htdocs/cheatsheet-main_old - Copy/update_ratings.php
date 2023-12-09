<?php
// database connection...
define('DB_HOST', 'localhost'); 
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'cheatsheetapp');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["id"]) && isset($_POST["action"])) {
        $faqId = $_POST["id"];
        $action = $_POST["action"];

        $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

        // Update the likes or dislikes count in the database
        if ($action === "like") {
            $sql = "UPDATE faq SET likes = likes + 1 WHERE id = ?";
        } elseif ($action === "dislike") {
            $sql = "UPDATE faq SET dislikes = dislikes + 1 WHERE id = ?";
        }

        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $faqId); 
        $stmt->execute();

        $conn->close();
    }
}
?>
