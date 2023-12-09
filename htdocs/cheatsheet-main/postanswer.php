<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="postanswer.css">
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
    </div>
</nav>
    <!--Page Content-->
<div>
    <section class="hero">
        <div style="margin-bottom: 20%;">
            <section class="column-right">
                <div>
                    <h3>How to Book A Desk</h3>
                    <form action="/action_page.html">
                        <label for="faqanswers">Answer</label>
                        <br>
                        <textarea id="faqanswer" rows="2" cols="70">Post your answer here...</textarea>
                        <input type="submit">
                    </form>
                <button onclick="Done()">Submit Answer</button>
            </div>
            </section>>
        </div>
    </section>
    <script>
        function Done() {
            window.location.href = "faq.php";
        }
    </script>
</div>

</body>
</html>