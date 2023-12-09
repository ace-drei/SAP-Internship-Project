<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="skill.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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
    .user-profile-row {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        align-items: center;
    }

    .user-profile {
        display: inline-block;
        text-align: center;
        margin: 10px;
    }
    .round-image {
    border-radius: 50%;
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
		<div class="user-profile-row">                    
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
                                
                                
                                if ($result->num_rows > 0) {
                                    $profileCount = 0; // Initialize the profile count
                        
                                    while ($row = $result->fetch_object()) {
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
                                        // Other decrypted data as needed
                                        // ...

                                        
                                        // Decrypt image
                                        $iv = hex2bin($row->iv);
                                        $username = $row->username;
                                        $img_bin = hex2bin($row->img);
                                        $img = openssl_decrypt($img_bin, $cipher, $key, OPENSSL_RAW_DATA, $iv);
                                                                
                                        // Display user profile data
                                        echo '<div class="user-profile">';
                                        echo '<img src="data:image/jpeg;base64,' . base64_encode($img) . '" class="round-image" width="170px" height="170px"/>';
                                        echo '<p><strong>Name :</strong> ' . $fullName . '</p>';
                                        echo '<p><strong>Skill Sets :</strong> ' . $skillSets . '</p>';
                                        echo '<p><strong>Connect with me :</strong> <a href="skillprofile.php?username=' . urlencode($row->username) .'">Click here</a>';
                                        echo "<br>";
                                        echo "<br>";
                                        echo '</div>';
                        
                                        // Start a new row after every 5 profiles
                                        if ($profileCount % 5 == 4) { // Note: It's 4 because we start counting from 0
                                            echo '</div><div class="user-profile-row">';
                                        }
                        
                                        $profileCount++;
                                    }
                                } else {
                                    echo "No users found.";
                                }
                        
                                $result->free();
                                $con->close();
                                ?>
                    </div>
    </div>
    </section>
    <section class="column-right">
        <div> 
        <button onclick="Logout()">Logout</button>
            <script>
                        function Logout() 
                        {
                            window.location.href = "skillhome.php";
                        }
            </script>


    </div>
    </section>

</div>

</body>
</html>