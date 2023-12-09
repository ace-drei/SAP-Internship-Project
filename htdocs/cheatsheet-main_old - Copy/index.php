<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="howto.css">
    <title>Cheat Sheet App </title>
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

    <!--Page Content-->
    <div>
    <section class="hero">
    <section class="column-right">
        <div>
            <h2>How to Book A Desk</h2>
            <p class="p2"> Click this <a href="https://fiorilaunchpad.sap.com/sites#resourceplanning-Display"> link </a> to book your desk!</p>
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