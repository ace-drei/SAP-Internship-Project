<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="howto.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@500;900&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/66de160463.js" crossorigin="anonymous"></script>
    <title>Register Page</title>
    <style>
        html, body, body > div, #container, #container-uiarea
        {
            height: 90%;
        }
    </style>
    <script>
        function displayErrorAlert(errors) {
            var errorMessage = "Please fix the following errors:\n";
            for (var key in errors) {
                errorMessage += "- " + errors[key] + "\n";
            }
            alert(errorMessage);
        }
    </script>
</head>
<body class="scrollable">
    <nav id="topnav">
        <!-- <img src="cheatsheet.bmp" width="200" height="200" alt="CheatSheet Logo"/> -->
        <div class="logo"><span class="cheat-sheet">CheatSheet</span> by <span class="span">SAP</span></div>
    </nav>
    <?php
        require_once 'validation.php';
    ?>
    <?php
     $error = array();
        if(isset($_POST['register']))
        {
            $username = trim($_POST['username']);
            $password = trim($_POST['password']);
            $confirmPassword = trim($_POST['confirmPassword']);
            $fullName  = trim($_POST['fullName']);
            $qualifications = trim($_POST['qualifications']);
            $skillSets  = $_POST['skillSets'];
            $email  = trim($_POST['email']);
            $workNumber  = trim($_POST['workNumber']);
            $location  = trim($_POST['location']);
            $team = trim($_POST['team']);
            $department = trim($_POST['department']);
            //img
            $img = file_get_contents($_FILES['img']['tmp_name']);  
            $error['username'] = validateUsername($username);
            $error['password'] = validatePassword($password, $confirmPassword);
            $error['fullName'] = validateFullName($fullName);
            $error['qualifications'] = validateQualifications($qualifications);
            $error['skillSets'] = validateSkillSets($skillSets);       
            $error['email'] = validateEmail($email);
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
            //hashedPassword
            $hashedPassword = hash('sha3-256', $password, true);
            //hashedPassword_hex
            $hashedPassword_hex = bin2hex($hashedPassword);
            //encryptedFullName
            $encryptedFullName = openssl_encrypt($fullName, $cipher, $key, OPENSSL_RAW_DATA, $iv);
            //encryptedFullName_hex
            $encryptedFullName_hex = bin2hex($encryptedFullName);
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
            //encryptedteam
            $encryptedTeam = openssl_encrypt($team, $cipher, $key, OPENSSL_RAW_DATA, $iv);
            //encryptedteam_hex
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
                    printf('<script>alert("Register successfully"); location.href = "./skillhome.php"</script>');
                }
                $stmt->close();
                $con->close();
            }
            else {
                $errorMessages = array();
                foreach ($error as $value) {
                    $errorMessages[] = $value;
                }
                echo '<script>displayErrorAlert('.json_encode($errorMessages).');</script>';
            }            
        }
    ?>    
     <!-- Top navigation -->
    <nav id="sidenav">
        <div class="sidenav-items">
            <nav id="sidenav">
                <div class="sidenav-items">
                <a href="home.php"><span class="icon" data-tooltip="Home"><img src="home.png" alt="Home Icon"></span></a>
                    <a href="faq.php"><span class="icon" data-tooltip="FAQ"><img src="faq.png" alt="FAQ"></span></a>
                    <a href="howtobookdesk.php"><span class="icon" data-tooltip="Desk"><img src="desk1.png" alt="Desk Icon"></span></a>
                    <a href="calendar.php"><span class="icon" data-tooltip="Personal Calendar"><img src="calendar.png" alt="Calendar"></span></a>
                    <a href="lunch.php"><span class="icon" data-tooltip="Book Your Lunch"><img src="lunch.png" alt="Lunch"></span></a>
                    <a href="skillhome.php"><span class="icon" data-tooltip="Skill Role Play"><img src="role.png" alt="Role Play Icon"></span></a>
                    <a href="login.php"><span class="icon" data-tooltip="Login"><img src="login.png" alt="login icon"></span></a>
                    <a href="register.php"><span class="icon" data-tooltip="Register"><img src="register.png" alt="Register"></span></a>                 
                </div>
            </nav>
        </div>
    </nav>
    <!--End of Nav bar-->
    <br>
    <br>
    <br>
    <div class="hero">
    <div style="margin-left: 0%;">
                <section class="column-right">
        <form class="user" action="" method="post" enctype="multipart/form-data">
            <div class="bigTextDiv">
                <h1 class="bigText">Cheet Sheet App | Register</h1>
            </div>
            </div>
            <br>
            <!-- username -->
            <input type="text" class="txtBox" id="username" name="username" placeholder="Enter Username" autofocus="autofocus" required="required"/>
            <!-- password -->
            <input type="password" class="txtBox" id="password" name="password" placeholder="Enter Password" required="required"/>
            <!-- confirmPassword -->
            <input type="password" class="txtBox" id="confirmPassword" name="confirmPassword" placeholder="Confirm Password" required="required"/>
            <!-- fullName -->
            <input type="text" class="txtBox" id="fullName" name="fullName" placeholder="Enter Full Name" required="required"/>
            <!-- qualifications -->
            <label for="qualifications">Select Qualifications:</label>
            <select id="qualifications" name="qualifications" required><option value="Diploma">Diploma</option><option value="Graduate">Graduate</option><option value="Masters">Masters</option><option value="PHD">PHD</option></select>
            <!-- skillSets -->
            <input type="text" class="txtBox" id="skillSets" name="skillSets" placeholder="Enter SkillSets HANA,BTP,ABAP" required="required"/>
           <!-- email -->
           <input type="text" class="txtBox<?php echo isset($errors['email']) ? 'error' : ''; ?>" id="email" name="email" placeholder="Enter full.name@sap.com" required="required"/>
            <?php if (isset($errors['email'])) : ?>
            <div class="error-msg"><?php echo $errors['email']; ?></div>
            <?php endif; ?>
            <!-- workNumber -->
            <input type="text" class="txtBox" id="workNumber" name="workNumber" placeholder="Enter work Number" required="required" maxlength="10"/>
            <!-- location -->
            <label for="location">Select location:</label>
            <select id="location" name="location" required><option value="Dublin">Dublin</option><option value="Galway">Galway</option></select>
            <!-- team -->
            <input type="text" class="txtBox" id="team" name="team" placeholder="Enter Team" required="required"/>
            <!-- department -->
            <input type="text" class="txtBox" id="department" name="department" placeholder="Enter Department" required="required"/>
            <!-- img -->
            <label class="txtBox">Upload Image :</label>
            <input type="file" class="txtBox" id="img" name="img" accept="image/*" required="required"/>
            <input type="submit" class="btn2" id="register" value="Register" name="register"/>
        </form>
        <br>
    </div>
</body>
</html>