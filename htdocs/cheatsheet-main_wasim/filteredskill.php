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
        html, body, body > div, #container, #container-uiarea 
        {
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
    <!-- <section class="searchbar">
        <input type="text" placeholder="Search Skills Here..">
        <button type="submit"><i class="fa fa-search"></i></button>
    </section> -->
    <section class="hero">
        <div style="margin-left: 20%;">
            <section class="column-right">
                        
                <div class="grid-container">
                    
                    <?php
                    
                                require_once 'validation.php';
                                $cipher = 'AES-128-CBC';
                                $key = 'thebestsecretkey';
                                
                                $con = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
                                if ($con->connect_error) 
                                {
                                    die("Connection failed: " . $con->connect_error);
                                }
                                
                                
                                  $sql = "SELECT * FROM profile";
                                //$sql = "SELECT * FROM profile WHERE skillSets = 'HANA'";
                                  //$sql = "SELECT fullName, img FROM profile WHERE skillSets = 'HANA'";

                                $result = $con->query($sql);
                                
                                if ($result->num_rows > 0) 
                                {
                                    while ($row = $result->fetch_object()) 
                                    {                                                                                
                                        // Decrypt user data
                                        $iv = hex2bin($row->iv);
                                        $username = $row->username;
                                        $skillSets_bin = hex2bin($row->skillSets);
                                        $skillSets = openssl_decrypt($skillSets_bin, $cipher, $key, OPENSSL_RAW_DATA, $iv);

                                        // Decrypt user data
                                        $iv = hex2bin($row->iv);
                                        $username = $row->username;
                                        $fullName_bin = hex2bin($row->fullName);
                                        $fullName = openssl_decrypt($fullName_bin, $cipher, $key, OPENSSL_RAW_DATA, $iv);
                                        
                                        // Display user profile data
                                        echo '<div class="user-profile">';
                                        echo '<a href="skillprofile.php?username=' .'">View Skill Profile</a>';
                                        echo '<p><strong>Name :</strong> ' . $fullName . '</p>';
                                        echo '<p><strong>Skill Sets :</strong> ' . $skillSets . '</p>';
                                                                                                                 
                                        // Decrypt image
                                        $iv = hex2bin($row->iv);
                                        $username = $row->username;
                                        $img_bin = hex2bin($row->img);
                                        $img = openssl_decrypt($img_bin, $cipher, $key, OPENSSL_RAW_DATA, $iv);
                                        echo '<img src="data:image/jpeg;base64,'.base64_encode( $img ).'" width="80px" height="80px"/>';
                                        
                                        
                                                                               
                                        echo '</div>';
                                        
                                        
                                    }
                                } 
                                else 
                                    {
                                        echo "No users found.";
                                    }

                                $result->free();
                                $con->close();
                    ?> 
                    </div>
                         <br>
                </div>
    </section>
</div>

</body>
</html>