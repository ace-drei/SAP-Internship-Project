<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="howto.css">
    <title>Login Page</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@500;900&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/66de160463.js" crossorigin="anonymous"></script>
    <style>
        html, body, body > div, #container, #container-uiarea {
            height: 81%;
        }
    </style>
</head>	
<body class="scrollable">
    <nav id="topnav">
        <img src="cheatsheet.bmp" width="200" height="200" alt="CheatSheet Logo"/>
        <div class="logo"><span class="cheat-sheet">CheatSheet</span> by <span class="span">SAP</span></div>
    </nav>

    <?php
    require_once 'validation.php'; 
?>
<?php 
    if(isset($_POST['login']))
    {
        $username = trim($_POST['username']);
        $password = trim($_POST['password']); 
        //hashedPassword 
        $hashedPassword = hash('sha3-256', $password, true);
        //hashedPassword_hex 
        $hashedPassword_hex = bin2hex($hashedPassword);
        
        $exist = 0; 
        $con = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME); 
        $sql = "SELECT * FROM profile"; 
        $result = $con -> query($sql); 
        while($row = $result -> fetch_object())
        {
            $compareUsername = $row -> username;  
            $comparePassword = $row -> password;   

            if(strcmp($compareUsername, $username)==0 && strcmp($comparePassword, $hashedPassword_hex)==0)
            {
                $exist = 1;   
                $location = "filteredskill1.php?username=".$username; 
                echo "<script type='text/javascript'>alert('Login successfully');window.location='$location'</script>";
            } 
            else 
            {
                $exist = 0;
            }
        }
        if($exist === 0)
        {
            echo "<script type='text/javascript'>alert('Username and password do not match');</script>";
        }
    }
?> 
    <nav id="sidenav">
        <div class="sidenav-items">
        <a href="home.php">
                        <span class="icon" data-tooltip="Home"><img src="home.png" alt="Home Icon"></span>
                    </a>
                    <a href="faq.php">
                        <span class="icon" data-tooltip="FAQ"><img src="faq.png" alt="FAQ"></span>
                    </a>
                    <a href="howtobookdesk.php">
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
    <div>
        <section class="hero">
            <div style="margin-left: 0%;">
                <section class="column-right">
                <div class="container">
            <form id="loginForm" method="post" action="">
            <div class="bigTextDiv">
                <h1 class="bigText">Cheet Sheet App | Login</h1>
            </div>
            <!-- username --> 
            <input type="text" class="txtBox" id="username" 
            name="username" placeholder="Username" 
            autofocus="autofocus" required="required"/>
            <br>
            <br>
            <!-- password --> 
            <input type="password" class="txtBox" id="password" 
            name="password" placeholder="Password" required="required"/>
            <br>
            <br>
            <input type="submit" class="btn2" id="login" value="Login" name="login" />
            <br> 
            <br>
            </form>
        </div>
                </section>
            </div>
        </section>
    </div>
</body>
</html>