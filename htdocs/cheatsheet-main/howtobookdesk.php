<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="howto.css">
    <title>Cheat Sheet App </title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@500;900&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/66de160463.js" crossorigin="anonymous"></script>
    <style>
        html, body, body > div, #container, #container-uiarea {
            height: 100%;
        }
    </style>
</head>	
<hr>
<body class="scrollable">
    
	<!-- Top navigation -->
    <nav id="topnav">
        <img src="cheatsheet.bmp" width="200" height="200" alt="CheatSheet Logo"/>
        <div class="logo"><span class="cheat-sheet">CheatSheet</span> by <span class="span">SAP</span></div>
    </nav>

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

    <!--Page Content-->
    <div>
    <section class="hero">
    <section class="column-right">
        <div>
            <h2>How to Book A Desk</h2>
            <p class="p2"> Click this <a href="https://apps.powerapps.com/play/e/default-42f7676c-f455-423c-82f6-dc2d99791af7/a/cd610825-ff1d-4f3e-a84b-d6a3befb1d47?tenantId=42f7676c-f455-423c-82f6-dc2d99791af7"> link </a> to book your desk!</p>
            <div class="video-container">
                <video class="vid" width="800px" height="600px" controls>
                  <source src="Jack Demo 2.mp4" type="video/mp4" />
                </video>
        
            <button onclick="Done()">Done</button>
            <script>
                        function Done() 
                        {
                        window.location.href = "home.php";
                        }
            </script>		
            </div>
    </div>
</body>
</html>