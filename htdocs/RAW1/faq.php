<!DOCTYPE html>
<html>
<head>
    <!-- Add your meta tags, stylesheets, and other head content here -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        function rateAnswer(faqId, isCorrect) {
            $.post('rate_answer.php', { id: faqId, correct: isCorrect }, function (data) {
                // Update the FAQ list or provide feedback to the user
            });
        }
    </script>
</head>
<body>

    <!-- Navigation and Header -->
    <!-- ... -->

    <!-- FAQ Section -->
    <section class="faq-section">
        <h2>CheatSheet App</h2>
        <ul class="faq-list">
           
            <?php
            define('DB_HOST', 'localhost'); 
            define('DB_USER', 'root');
            define('DB_PASS', '');
            define('DB_NAME', 'cheatsheetapp');
            
            // Establish database connection
            $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $question = $_POST["question"];
                $answers = explode("\n", $_POST["answers"]); // Split answers by new line
            
                // Insert the question into the faq table
                $sql = "INSERT INTO faq (question) VALUES (?)";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("s", $question);
                $stmt->execute();
                $stmt->close();
            
                // Get the ID of the newly inserted question
                $faqId = $conn->insert_id;
            
                // Insert answers into the faq_answers table
                $sql = "INSERT INTO faq_answers (faq_id, answer) VALUES (?, ?)";
                $stmt = $conn->prepare($sql);
                foreach ($answers as $answer) {
                    $stmt->bind_param("is", $faqId, trim($answer));
                    $stmt->execute();
                }
                $stmt->close();
            }
            
            $conn->close();
            
            // Redirect back to the Question and Answer Entry page
            header("Location: index.html");
            exit();
            ?>
        </ul>
    </section>

    <!-- Ask a Question Section -->
    <section class="ask-question-section">
        <h2>Ask a Question</h2>
        <form action="insert_question.php" method="post">
            <label for="question">Question:</label>
            <input type="text" id="question" name="question" required><br><br>
            
            <label for="answers">Answers (separated by commas):</label>
            <input type="text" id="answers" name="answers" required><br><br>
            
            <button type="submit">Submit Question</button>
        </form>
    </section>

    <!-- Add your footer content here -->

</body>
</html>
