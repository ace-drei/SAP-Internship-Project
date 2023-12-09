<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="faq.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Cheat Sheet App </title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
    /* ... Your existing styles ... */
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
        margin: 20px auto;
        max-width: 600px;
        padding: 20px;
        border: 1px solid #ccc;
        background-color: #f9f9f9;
    }
    .rating-box {
    display: flex;
    align-items: center;
    gap: 10px; /* Adjust the spacing between thumbs up and thumbs down */
    margin-top: 10px; /* Add margin between the rating boxes */
    border: 1px solid #ccc;
    padding: 5px;
    background-color: #f9f9f9;
    }
    .faq-content {
    word-wrap: break-word; /* Wrap long words to fit within the box */
    max-width: 100%; /* Ensure the content doesn't overflow */
    }
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
<script>
    // Function to handle the like button click
function likeAnswer(faqId, countId) {
    const likeCountElement = document.getElementById(countId);
    let likeCount = parseInt(likeCountElement.textContent);

    // Check if the count is less than 5 before incrementing
    if (likeCount < 5) {
        likeCount++;
        likeCountElement.textContent = likeCount;

        // Send data to PHP script using AJAX
        updateRating(faqId, 'like');
    }
}

   // Function to handle the dislike button click
   function dislikeAnswer(faqId, countId) {
        console.log('Dislike button clicked for FAQ ID:', faqId);
        const dislikeCountElement = document.getElementById(countId);
        let dislikeCount = parseInt(dislikeCountElement.textContent);

        // Check if the count is less than 5 before incrementing
        if (dislikeCount < 5) {
            dislikeCount++;
            dislikeCountElement.textContent = dislikeCount;

            // Send data to PHP script using AJAX
            updateRating(faqId, 'dislikes');
        }
    }

    // Function to send data to PHP script using AJAX
    function updateRating(faqId, action) {
        $.ajax({
            type: "POST",
            url: "update_ratings.php", // This file to handle the update
            data: { id: faqId, action: action },
            success: function(response) 
            {
                
            }
        });
    }
</script>
<?php
    require_once 'update_ratings.php';
    require_once 'add.php';

    $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

    // Fetch all FAQs from the database
    $sql = "SELECT f.id, f.question, f.answer, COALESCE(SUM(ld.action = 'like'), 0) AS likes, COALESCE(SUM(ld.action = 'dislike'), 0) AS dislikes
            FROM faq f
            LEFT JOIN Likes_Dislikes ld ON f.id = ld.faqId
            GROUP BY f.id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $faqId = $row["id"];
            $question = $row["question"];
            $answer = $row["answer"];
            $likes = $row["likes"];
            $dislikes = $row["dislikes"];

            echo '<section class="hero">';
            echo '<div class="faq-entry">';
            echo '<h2>FAQ</h2>';
            echo '<div class="faq-content">';
            echo '<p><strong>Question:</strong> ' . $question . '</p>';
            echo '<p><strong>Answer:</strong> ' . $answer . '</p>';
            echo '<div class="rating-box">';
            echo '<i onclick="likeAnswer(' . $faqId . ', \'likeCount' . $faqId . '\')" class="fa fa-thumbs-up"></i>';
            echo '<span id="likeCount' . $faqId . '">' . $likes . '</span>';
            echo '</div>';
            echo '<div class="rating-box">';
            echo '<i onclick="dislikeAnswer(' . $faqId . ', \'dislikeCount' . $faqId . '\')" class="fa fa-thumbs-down"></i>';
            echo '<span id="dislikeCount' . $faqId . '">' . $dislikes . '</span>';
            echo '</div>';
            echo '</div>';
            echo '</section>';
        }
    } else {
        echo "No FAQs found.";
    }

    $conn->close();
    ?>
    <!-- layout for form to add FAQ -->
    <div class="add-faq-form">
        <h1 class="text-center">Add FAQ</h1>
        <form method="POST" action="QA.php">
            <!-- question -->
            <div class="form-group">
                <label>Enter Question</label>
                <input type="text" name="question" class="form-control" required />
            </div>
            <!-- answer -->
            <div class="form-group">
                <label>Enter Answer</label>
                <textarea name="answer" id="answer" class="form-control" required></textarea>
            </div>
            <!-- submit button -->
            <input type="submit" name="submit" class="btn btn-info" value="Add FAQ" />
        </form>
    </div>
    </div>
</div>
           

</body>
</html>