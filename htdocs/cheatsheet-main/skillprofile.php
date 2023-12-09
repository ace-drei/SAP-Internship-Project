<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="skillprofile.css">
    <title>Cheat Sheet App </title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@500;900&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/66de160463.js" crossorigin="anonymous"></script>
    <style>
        html, body, body > div, #container, #container-uiarea {
            height: 80%;
        }
    </style>
</head>	
<hr>
<body>
<?php
    require_once 'validation.php'; 
?>
        
        <?php
            if($_SERVER['REQUEST_METHOD'] == 'GET')
            {
                if(!empty($_GET['username']))
                {
                    $cipher = 'AES-128-CBC';
                    $key = 'thebestsecretkey';
                    
                    //retrieve username from URL
                    $username = trim($_GET['username']); 
                    
                    $con = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
                    
                    $sql = "SELECT * FROM profile WHERE username ='$username'";
                    //$sql = "SELECT * FROM profile'";
                    
                    $result = $con -> query($sql); 
                    
                    if($row = $result -> fetch_object())
                    {
                        //iv
                        $iv = hex2bin($row -> iv); 
                        
                        //username
                        $username = $row -> username; 
                         
                        //fullName
                        $fullName_bin = hex2bin($row -> fullName); 
                        $fullName = openssl_decrypt($fullName_bin, $cipher, $key, OPENSSL_RAW_DATA, $iv);
                        //qualifications
                        $qualifications_bin = hex2bin($row -> qualifications); 
                        $qualifications = openssl_decrypt($qualifications_bin, $cipher, $key, OPENSSL_RAW_DATA, $iv);
                        //skillSets
                        $skillSets_bin = hex2bin($row -> skillSets); 
                        $skillSets = openssl_decrypt($skillSets_bin, $cipher, $key, OPENSSL_RAW_DATA, $iv);
                        //email
                        $email_bin = hex2bin($row -> email); 
                        $email = openssl_decrypt($email_bin, $cipher, $key, OPENSSL_RAW_DATA, $iv);
                        //workNumber
                        $workNumber_bin = hex2bin($row -> workNumber); 
                        $workNumber = openssl_decrypt($workNumber_bin, $cipher, $key, OPENSSL_RAW_DATA, $iv);
                        //location
                        $location_bin = hex2bin($row -> location); 
                        $location = openssl_decrypt($location_bin, $cipher, $key, OPENSSL_RAW_DATA, $iv);
                        //company
                        $team_bin = hex2bin($row -> team); 
                        $team = openssl_decrypt($team_bin, $cipher, $key, OPENSSL_RAW_DATA, $iv);
                        //department
                        $department_bin = hex2bin($row -> department); 
                        $department = openssl_decrypt($department_bin, $cipher, $key, OPENSSL_RAW_DATA, $iv);
                        //img 
                        $img_bin = hex2bin($row -> img); 
                        $img = openssl_decrypt($img_bin, $cipher, $key, OPENSSL_RAW_DATA, $iv);
                        
                    }
                     $result -> free();
                     $con -> close();
                }
                else 
                    {
                        $location = "login.php"; 
                        echo "<script type='text/javascript'>alert('Please login to view User Profile');window.location='$location'</script>";
                    }

            }
            
            else
            { 
                $username = trim($_GET['username']); 
                $fullName  = trim($_POST['fullName']);
                $qualifications = trim($_POST['qualifications']);
                $skillSets  = trim($_POST['skillSets']);
                $email  = trim($_POST['email']);
                $workNumber  = trim($_POST['workNumber']);
                $location  = trim($_POST['location']);
                $team = trim($_POST['team']);
                $department = trim($_POST['department']);
                //img 
                $img = file_get_contents($_FILES['img']['tmp_name']);
                
                $error['fullName'] = validateFullName($fullName); 
                $error['username'] = validateUsername($username); 
                $error['password'] = validatePassword($password, $confirmPassword); 
                $error['fullName'] = validateFullName($fullName); 
                $error['qualifications'] = validateQualifications($qualifications); 
                $error['skillSets'] = validateSkillSets($skillSets); 
            
                //$error['email'] = validateEmail($email);
                $error['workNumber'] = validateWorkNumber($workNumber);
                $error['location'] = validateLocation($location);
                $error['team'] = validateTeam($team);
                $error['department'] = validateDepartment($department);
                $error = array_filter($error); 
                
                $cipher = 'AES-128-CBC';
                $key = 'thebestsecretkey';
                
                //iv_hex
                $iv = random_bytes(16);
                $iv_hex = bin2hex($iv); 
                  
                //encryptedFullName
                $encryptedFullName = openssl_encrypt($fullName, $cipher, $key, OPENSSL_RAW_DATA, $iv);
                //encryptedFullName_hex
                $encryptedFullName_hex =  bin2hex($encryptedFullName);
                                
                //encryptedQualifications
                $encryptedQualifications = openssl_encrypt($qualifications, $cipher, $key, OPENSSL_RAW_DATA, $iv);
                //encryptedQualifications_hex
                $encryptedQualifications_hex = bin2hex($encryptedQualifications);
                
                //encryptedSkillSets
                $encryptedSkillSets = openssl_encrypt($skillSets, $cipher, $key, OPENSSL_RAW_DATA, $iv);
                //encryptedSkillSets_hex
                $encryptedSkillSets_hex = bin2hex($encryptedSkillSets);

                //encryptedEmail
                $encryptedEmail = openssl_encrypt($email, $cipher, $key, OPENSSL_RAW_DATA, $iv);
                //encryptedEmail_hex
                $encryptedEmail_hex = bin2hex($encryptedEmail);
                
                //encryptedWorkNumber
                $encryptedWorkNumber = openssl_encrypt($workNumber, $cipher, $key, OPENSSL_RAW_DATA, $iv);
                //encryptedWorkNumber_hex
                $encryptedWorkNumber_hex = bin2hex($encryptedWorkNumber);

                //encryptedLocation
                $encryptedLocation = openssl_encrypt($location, $cipher, $key, OPENSSL_RAW_DATA, $iv);
                //encryptedLocation_hex
                $encryptedLocation_hex = bin2hex($encryptedLocation);

                //encryptedTeam
                $encryptedTeam = openssl_encrypt($team, $cipher, $key, OPENSSL_RAW_DATA, $iv);
                //encryptedCompany_hex
                $encryptedTeam_hex = bin2hex($encryptedTeam);

                //encryptedDepartment
                $encryptedDepartment = openssl_encrypt($department, $cipher, $key, OPENSSL_RAW_DATA, $iv);
                //encryptedDepartment_hex
                $encryptedDepartment_hex = bin2hex($encryptedDepartment);
                
                //encryptedImg
                $encrypted_img = openssl_encrypt($img, $cipher, $key, OPENSSL_RAW_DATA, $iv);
                //encryptedImg_hex
                $encryptedImg_hex = bin2hex($encrypted_img);
                
                if(empty($error))
                {
                    $con = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
                    
                    $sql = "INSERT INTO profile (id, iv, username, password, fullName, qualifications, skillSets, email, workNumber, location, team, department, img) values (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
                    
                    $stmt = $con->prepare($sql); 
                    $id = NULL; 
                    
                    $stmt->bind_param('issssssssssss', $id, $iv_hex, $username, $hashedPassword_hex, $encryptedFullName_hex, $encryptedQualifications_hex, $encryptedSkillSets_hex,$encryptedEmail_hex,$encryptedWorkNumber_hex,$encryptedLocation_hex,$encryptedTeam_hex,$encryptedDepartment_hex, $encryptedImg_hex); 
                    
                    $stmt->execute(); 
                    if($stmt->affected_rows > 0)
                    {
                        printf('<script>alert("Register successfully");</script>');
                    }
                    $stmt->close();
                    $con->close();
                }
                else
                {
                //display error msg 
                echo "<ul class='error'>";
                foreach ($error as $value)
                {
                    echo "<li>$value</li>";
                }
                echo "</ul>";
                }
            }
        ?>
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
    <section class="hero">
		<div class="column-left">
        
     <!-- User Profile  -->
    <section class="User"></section>  
    <div class="grid">
        <div class="user-profile">
            <h5>User Profile</h5> 
            <!-- fullName --> 
            <p><strong>Name :</strong> <?php echo $fullName?></p>
            <!-- qualifications --> 
            <p><strong>Qualifications :</strong> <?php echo $qualifications?></p>
            <!-- skillSets --> 
            <p><strong>Skill Sets :</strong> <?php echo $skillSets?></p>
            <!-- image --> 
            <?php $display_img = '<img src="data:image/jpeg;base64,'.base64_encode( $img ).'" width="80px" height="80px"/>'; ?>
            <label><?php echo $display_img?></label>
    <!-- Contacts details -->
            <h5>Contacts:</h5>
            <!-- email --> 
            <p><strong>Email :</strong> <?php echo $email?></p>
            <!-- workNumber --> 
            <p><strong>Work Number :</strong> <?php echo $workNumber?></p>
             <!-- location --> 
             <p><strong>Location :</strong> <?php echo $location?></p>
            <!-- team --> 
            <p><strong>Team :</strong> <?php echo $team?></p>
            <!-- department --> 
            <p><strong>Department :</strong> <?php echo $department?></p>
     <!-- Rating  -->
     <h5>Rating: </h5>
            <div class="rate-container">
            <div class="rate">
                    <p>Helpfulness:</p>
                    <input type="radio" id="star5" name="rate5" value="5" />
                    <label for="star5" title="text">5 stars</label>
                    <input type="radio" id="star4" name="rate4" value="4" />
                    <label for="star4" title="text">4 stars</label>
                    <input type="radio" id="star3" name="rate3" value="3" />
                    <label for="star3" title="text">3 stars</label>
                    <input type="radio" id="star2" name="rate2" value="2" />
                    <label for="star2" title="text">2 stars</label>
                    <input type="radio" id="star1" name="rate1" value="1" />
                    <label for="star1" title="text">1 star</label>
                </div>
                <div class="responsiveness">
                    <p>Responsiveness:</p>
                    <input type="radio" id="star6" name="responsiveness5" value="5" />
                    <label for="star6" title="text">5 stars</label>
                    <input type="radio" id="star7" name="responsiveness4" value="4" />
                    <label for="star7" title="text">4 stars</label>
                    <input type="radio" id="star8" name="responsiveness3" value="3" />
                    <label for="star8" title="text">3 stars</label>
                    <input type="radio" id="star9" name="responsiveness2" value="2" />
                    <label for="star9" title="text">2 stars</label>
                    <input type="radio" id="star10" name="responsiveness1" value="1" />
                    <label for="star10" title="text">1 star</label>
                </div>
                <div class="knowledge">
                    <p>Knowledge:</p>
                    <input type="radio" id="star11" name="knowledge1" value="5" />
                    <label for="star11" title="text">5 stars</label>
                    <input type="radio" id="star12" name="knowledge2" value="4" />
                    <label for="star12" title="text">4 stars</label>
                    <input type="radio" id="star13" name="knowledge3" value="3" />
                    <label for="star13" title="text">3 stars</label>
                    <input type="radio" id="star14" name="knowledge4" value="2" />
                    <label for="star14" title="text">2 stars</label>
                    <input type="radio" id="star15" name="knowledge5" value="1" />
                    <label for="star15" title="text">1 star</label>
                </div>
                
            </div>
        </div>
       
    </div>
    
    </section>
    <section class="column-right">
        <div> 
    <button onclick="Done()">Click to Return</button>
            <script>
                        function Done() 
                        {
                        window.location.href = "filteredskill1.php?username=";
                        }
            </script>


    </div>
    </section>
    
    </div>


</body>
</html>