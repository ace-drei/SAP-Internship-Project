<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="faq1.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Cheat Sheet App </title>
    <style>
        html, body, body > div, #container, #container-uiarea {
            height: 100%;
        }
    </style>
</head>	
<hr>
<body>

    <nav id="topnav">
        <img src="cheatsheet.bmp" width="200" height="200" alt="CheatSheet Logo"/>
        <div class="logo"><span class="cheat-sheet">CheatSheet</span> by <span class="span">SAP</span></div>
    </nav>  
            <?php
            // database connection...
                define('DB_HOST', 'localhost'); 
                define('DB_USER', 'root');
                define('DB_PASS', '');
                define('DB_NAME', 'cheatsheetapp');
                $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

                $id = 1;
               
                    // Fetch the answer from the database for the specified FAQ ID
                    $sql = "SELECT question, answer, likes, dislikes FROM faq WHERE id = ?";
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param("i", $id);
                    $stmt->execute();
                    $result = $stmt->get_result();

                    if ($result->num_rows > 0) 
                        {
                            $row = $result->fetch_assoc();
                            $question = $row["question"];
                            $answer = $row["answer"];
                            $likes = $row["likes"];
                            $dislikes = $row["dislikes"];
                        } 
                    else 
                        {
                            $question = "Qusetion not found for the specified FAQ ID.";
                            $answer = "Answer not found for the specified FAQ ID.";
                            $likes = 0;
                            $dislikes = 0;
                        }

                    $stmt->close();
                    
                ?>
    
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
<!--Page Content-->
<div>
    <section class="hero">
            <section class="column-right">
                <div>
                    <h3><?php echo $question; ?></h3>
                    <div class="container">
                    <div class="answer"><?php echo $answer; ?>
                            <br>
                            <div class="rating">
                            <i onclick="likeAnswer(<?php echo $id; ?>, 'likeCount1')" class="fa fa-thumbs-up"></i>
                            <span id="likeCount1"><?php echo $likes; ?></span>
                            <i onclick="dislikeAnswer(<?php echo $id; ?>, 'dislikeCount1')" class="fa fa-thumbs-down"></i>
                            <span id="dislikeCount1"><?php echo $dislikes; ?></span>
                        </div>
                    </div>
                </div>
                <button onclick="Done()">Post new answer here</button>
            </div>
        </div>
    </section>
    
    <script>
    // Function to handle the like button click
    function likeAnswer(faqId, countId) {
        const likeCountElement = document.getElementById(countId);
        let likeCount = parseInt(likeCountElement.textContent);
        likeCount++;
        likeCountElement.textContent = likeCount;

    }

    // Function to handle the dislike button click
    function dislikeAnswer(faqId, countId) {
        const dislikeCountElement = document.getElementById(countId);
        let dislikeCount = parseInt(dislikeCountElement.textContent);
        dislikeCount++;
        dislikeCountElement.textContent = dislikeCount;
    }
</script>

    
    <script>
        function Done() {
            window.location.href = "postanswer.php";
        }
    </script>
</div>
</body>
</html>