<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="lunch.css">
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
    <section class="hero">
		<div class="column-left"> 	
        </div> 
    <section class="column-right">
        <div>
            <p></p>
            <h3>How to Book Your Lunch</h3>
            <p>1.Download the WorkxGo app from your AppStore</p>
            <img id="topleft" src="lunch1.png"/>
            <p>2.Choose your office location</p>
            <h5>Unlock with PIN SAP DUBLIN: 1401532, SAP GALWAY: 1401533</h5>
            <img id="topright" src="lunch2.png" width="420" height="700"/>
            <p>3.Select Restaurant Check-in</p>
            <img id="bottomleft" src="lunch3.png" width="420" height="700"/>
            <p>4.Choose a date that you will be going into office and book it!</p>
            <img id="bottomright" src="lunch4.png" width="420" height="700"/>

            <button onclick="Done()">Done</button>

            <script>
            function Done() {
              window.location.href = "home.php";
            }
            </script>
		</div>
</body>
</html>