<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="skill.css">
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
    <!-- <section class="searchbar">
        <input type="text" placeholder="Search Skills Here..">
        <button type="submit"><i class="fa fa-search"></i></button>
    </section> -->
    <section class="hero">
        <div style="margin-left: 20%;">
            <section class="column-right">
                <div class="skill" style="background-color:#ffffff;">
                    <h2>Skill Set List </h2>
                    <a href="filteredskill.php" class="skills">HANA</a><br>
                    <a href="filteredskill1.php" class="skills">BTP</a><br>
                    <a href="filteredskill2.php" class="skills">ABAP</a><br>
                </div>
            <div class="grid-container">
                <a href="skillprofile.php" class="circle circle1">Jack</a>
                <a href="skillprofile.php" class="circle circle2">Yu Fan</a>
                <a href="skillprofile.php" class="circle circle3">Kate</a>
                <a href="skillprofile.php" class="circle circle4">Andrei</a>
                <a href="skillprofile.php" class="circle circle5">Waseem</a>
                <a href="skillprofile.php" class="circle circle6">Chris</a>
                <a href="skillprofile.php" class="circle circle7">David</a>
                <a href="skillprofile.php" class="circle circle8">Tania</a>
            </div>
        </div>
    </section>
</div>

</body>
</html>