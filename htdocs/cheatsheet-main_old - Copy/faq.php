<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="faq.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <title>Cheat Sheet App </title>
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
        .column1 {
    float: center;
    width: 70%;
    padding: 40px;
    height: 900px;
    position: fixed;
    top: 15%;
    left: 18%;
    border-radius: 60px;
  }
        html, body, body > div, #container, #container-uiarea {
            height: 100%;
        }
    .faq-entry {
    border: 1px solid #ccc;
    padding: 10px;
    margin: 10px 0;
    background-color: #f9f9f9;
    }
    .hero{
        margin: 5px 0;
        white-space: normal; /* Reset white-space property */
        word-wrap: break-word; /* Wrap long words to fit within the box */
    }
    .faq-entry h2 {
        margin: 0;
        font-size: 18px;
    }
    .faq-entry p {
        margin: 5px 0;
        white-space: normal; /* Reset white-space property */
        word-wrap: break-word; /* Wrap long words to fit within the box */
    }
    .faq-entry i {
        cursor: pointer;
        margin-right: 5px;
    }
    .add-faq-form {
        margin: 250px auto;
        max-width: 600px;
        padding: 20px;
        border: 1px solid #ccc;
        background-color: #f9f9f9;
    }
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
.question-number {
    font-weight: bold;
    margin-right: 5px;
}
</style>
    </style>
</head>	
<hr>
<body>
    <nav id="topnav">
        <img src="cheatsheet.bmp" width="200" height="200" alt="CheatSheet Logo"/>
        <div class="logo"><span class="cheat-sheet">CheatSheet</span> by <span class="span">SAP</span></div>
    </nav>
	<!-- Top navigation -->
    <nav id="sidenav">
        <div class="sidenav-items">
            <nav id="sidenav">
                <div class="sidenav-items">
                <a href="home.php">
                        <span class="icon" data-tooltip="Home"><img src="home.png" alt="Home Icon"></span>
                    </a>
                    <a href="faq.php">
                        <span class="icon" data-tooltip="FAQ"><img src="faq.png" alt="FAQ"></span>
                    </a>
                    <a href="index.php">
                        <span class="icon" data-tooltip="Desk"><img src="desk1.png" alt="Desk Icon"></span>
                    </a>
                    <a href="calendar.php">
                        <span class="icon" data-tooltip="Personal Calendar"><img src="calendar.png" alt="Calendar"></span>
                    </a>
                    <a href="lunch.php">
                        <span class="icon" data-tooltip="Book Your Lunch"><img src="lunch.png" alt="Lunch"></span>
                    </a>
                    <a href="skillhome.php">
                        <span class="icon" data-tooltip="Skill Role Play"><img src="role.png" alt="Role Play Icon"></span>
                    </a>
                    <a href="login.php">
                        <span class="icon" data-tooltip="Login"><img src="login.png" alt="login icon"></span>
                    </a>
                    <a href="register.php">
                    <span class="icon" data-tooltip="Register"><img src="register.png" alt="Register"></span>
                    </a>
                    
                </div>
            </nav>
        </div>
    </nav>

    <div class="hero">
    <div class="column1" style="background-color:#becfe7;">
        <h2>Most Common Asked Questions</h2>
        <br>
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
                $questionNumber = 1; // Initialize the question number
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
                        $questionNumber++; // Increment the question number
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
            

            <!-- Ask a Question Section -->
    <section class="ask-question-section">
        <h2>Ask a Question</h2>
        <form action="insert_question.php" method="post">
            <label for="question">Question:</label>
            <input type="text" id="question" name="question" required><br><br>
<!--             
            <label for="answers">Answers (one per line):</label>
            <textarea id="answers" name="answers" rows="4" required></textarea><br><br> -->
            
            <button type="submit">Submit Question</button>
        </form>
    </section>
        </div>
    </div>
</body>
</html>