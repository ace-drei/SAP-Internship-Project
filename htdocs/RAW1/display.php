<!DOCTYPE html>
<html>
<head>
    <!-- Add your meta tags, stylesheets, and other head content here -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
    function toggleAnswers(questionId) {
        const answersList = document.querySelector(`#answers-list-${questionId}`);
        const expandButton = document.querySelector(`#expand-button-${questionId}`);
        
        if (answersList.style.display === 'none') {
            answersList.style.display = 'block';
            expandButton.textContent = '-';
        } else {
            answersList.style.display = 'none';
            expandButton.textContent = '+';
        }
    }
</script>
    <script>
        function rateAnswer(answerId, isCorrect) {
            $.post('rate_answer.php', { id: answerId, correct: isCorrect }, function (data) {
                // Update the FAQ list or provide feedback to the user
            });
        }

        function submitNewAnswer(questionId) {
            const newAnswer = prompt("Enter a new answer:");
            if (newAnswer) {
                $.post('submit_new_answer.php', { question_id: questionId, new_answer: newAnswer }, function (data) {
                    // Update the FAQ list or provide feedback to the user
                });
            }
        }
    </script>
    <style>
        /* Add this CSS to your existing styles */

.faq-list {
    list-style: none;
    padding: 0;
}

.question {
    border: 1px solid #ccc;
    margin: 10px 0;
    padding: 10px;
}

.question-title {
    margin: 0;
    padding: 5px;
    background-color: #f0f0f0;
    cursor: pointer;
}

.expand-button {
    margin-right: 5px;
}

.answers-list {
    list-style: none;
    margin: 0;
    padding: 0;
    display: none;
}

.answer {
    margin: 10px 0;
    padding: 10px;
    border: 1px solid #ddd;
    background-color: #f9f9f9;
}

.rating-buttons button {
    margin-right: 10px;
}

    </style>
</head>
<body>

    <!-- Navigation and Header -->
    <!-- ... -->

    <!-- FAQ Section -->
    <section class="faq-section">
        <h2>FAQ</h2>
        <ul class="faq-list">
            <?php
            define('DB_HOST', 'localhost'); 
            define('DB_USER', 'root');
            define('DB_PASS', '');
            define('DB_NAME', 'cheatsheetapp');

            $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            $sql = "SELECT q.id AS question_id, q.question, a.id AS answer_id, a.answer, a.yes_count, a.no_count
                    FROM faq q
                    LEFT JOIN faq_answers a ON q.id = a.faq_id
                    ORDER BY q.id, a.yes_count DESC";

            $result = $conn->query($sql);
            
            $currentQuestionId = null;

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    if ($row['question_id'] !== $currentQuestionId) {
                        if ($currentQuestionId !== null) {
                            echo '</ul>';
                            echo '<button onclick="submitNewAnswer(' . $currentQuestionId . ')">Add New Answer</button>';
                            echo '</li>'; // Moved the closing li tag here
                        }
                        $currentQuestionId = $row['question_id'];
                        echo '<li class="question">';
                        echo '<h3 class="question-title">';
                        echo '<button id="expand-button-' . $currentQuestionId . '" class="expand-button" onclick="toggleAnswers(' . $currentQuestionId . ')">+</button>';
                        echo $row['question'];
                        echo '</h3>';
                        echo '<ul class="answers-list" id="answers-list-' . $currentQuestionId . '">';
                    }
            
                    echo '<li class="answer">';
                    echo '<div class="answer-text">' . $row['answer'] . '</div>';
                    echo '<div class="rating-buttons">';
                    echo '<button onclick="rateAnswer(' . $row['answer_id'] . ', true)">Yes (' . $row['yes_count'] . ')</button>';
                    //echo '<button onclick="rateAnswer(' . $row['answer_id'] . ', false)">No (' . $row['no_count'] . ')</button>';
                    echo '</div>';
                    echo '</li>';
                }
            
                if ($currentQuestionId !== null) {
                    echo '</ul>';
                    echo '<button onclick="submitNewAnswer(' . $currentQuestionId . ')">Add New Answer</button>';
                    echo '</li>';
                }
            } else {
                echo '<li>No FAQs available.</li>';
            }

            $conn->close();
            ?>
        </ul>
    </section>

    <!-- Add your footer content here -->

</body>
</html>
