<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="faq.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Cheat Sheet App </title>
    <style>
        .column1 {
    float: center;
    width: 70%;
    padding: 40px;
    height: 700px;
    position: fixed;
    top: 15%;
    left: 18%;
    border-radius: 60px;
  }
        html, body, body > div, #container, #container-uiarea {
            height: 100%;
        }
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
        margin: 250px auto;
        max-width: 600px;
        padding: 20px;
        border: 1px solid #ccc;
        background-color: #f9f9f9;
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

    <div class="post-new-question">
    <div class="column1" style="background-color:#e4e8e9;">
        <h2>Most Common Asked Questions</h2>
        <br>
        <?php
            define('DB_HOST', 'localhost'); 
            define('DB_USER', 'root');
            define('DB_PASS', '');
            define('DB_NAME', 'cheatsheetapp');
            
            // Establish database connection
            $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            $sql = "SELECT id, question FROM faq";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo '<p><a href="faq1.php?questionId=' . $row['id'] . '" class="/">' . $row['question'] . '</a></p>';
                }
            } else {
                echo "No questions found.";
            }

            // Handle form submission
            if (isset($_POST['submit'])) {
                $newQuestion = $_POST['question'];
                $insertSql = "INSERT INTO faq (question) VALUES ('$newQuestion')";
                if ($conn->query($insertSql) === TRUE) {
                    echo '<p class="faq-entry">' . $newQuestion . '</p>';
                } else {
                    echo "Error: " . $insertSql . "<br>" . $conn->error;
                }
            }

            $conn->close();
            ?>

            <!-- Layout for form to add FAQ -->
            <div class="add-faq-form">
                <form method="POST" action="faq.php">
                    <div class="form-group">
                        <label>Enter Question</label>
                        <input type="text" name="question" class="form-control" required />
                    </div>
                    <input type="submit" name="submit" class="btn btn-info" value="Submit Question" />
                </form>
            </div>
        </div>
    </div>
</body>
</html>