<html>
<head>
    <?php include("header.php") ?>
</head>
<body>
<?php
include("navbar.php");
session_start();
if ($_SESSION["loggedin"] == "true") {
    header("Location: home.php");
}
?>

<html>
	<head>
		<!--  I USE BOOTSTRAP BECAUSE IT MAKES FORMATTING/LIFE EASIER -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css"><!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css"><!-- Optional theme -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script><!-- Latest compiled and minified JavaScript -->
	</head>
	<body>
        
        
        
		<div class="container">
            
			<div class="row">
				<div class="col-md-4 col-sm-4 col-xs-3"></div>
				<div class="col-md-4 col-sm-4 col-xs-6">                  
                    
                <h3 class="row form-group" >User Registration</h3>     
                    
				<form action="<?=$_SERVER['PHP_SELF']?>" method="POST">                 

  				 <div class="row form-group">
                    <div class="ui input">
                        <input type="text" name="firstname" required="required" placeholder="First Name"/>
                    </div>
                </div>
				 <div class="row form-group">
                    <div class="ui input">
                        <input type="text" name="lastname" required="required" placeholder="Last Name"/>
                    </div>
                </div>

                <div class="row form-group">
                    <div class="ui input">
                        <input type="email" name="email" required="required" placeholder="Email"/>
                    </div>
                </div>
   
						<div class="row form-group">
								<input class='form-control' type="text" name="username" required="required" placeholder="username">
						</div>
						<div class="row form-group">
								<input class='form-control' type="password" name="password" required="required" placeholder="password">
						</div>
						<div class="row form-group">
								<input class=" btn btn-default" type="submit" name="submit"  required="required" value="Register"/>
						</div>

					</form>
				</div>
			</div>
			<?php
				if(isset($_POST['submit'])) { // Was the form submitted?
        
                    /*
                    CREATE TABLE linkbook.users
                    (
                    uIDnum INT,
                    fName VARCHAR(30),
                    lName VARCHAR(30),
                    email VARCHAR(20),
                    username VARCHAR(50),
                    salt CHAR(40) NOT NULL,
                    hashed_pass CHAR(40) NOT NULL,
                    orginization VARCHAR(30),
                    bio TEXT,
                    profile_picture VARCHAR(50),
                    coding_languages VARCHAR(60),
                    PRIMARY KEY (uIDnum)
                    );
					*/
                    
                    include("../secure/secure.php");

                    $link = mysqli_connect($site, $user, $pass, $db) or die("Connect Error " . mysqli_error($link));
        
                    $sql = "INSERT INTO users(uIDnum, fName, lName, email, username, salt, hashed_pass, organization, bio, profile_picture, coding_languages) VALUES(?,?,?,?,?,?,?,?,?,?,?)"; 
        
					//$sql = "INSERT INTO user(username, salt, hashed_password) VALUES(?,?,?)";
        
                if ($stmt = mysqli_prepare($link, $sql)) {


                    $uIDnum = mt_rand();

                    $fName = $_POST['firstname'];
                    $lName = $_POST['lastname'];
                    $email = $_POST['email'];

                    $user = $_POST['username'];
                    $salt = mt_rand();
                    $hpass = password_hash($salt . $_POST['password'], PASSWORD_BCRYPT) or die("bind param");

                    $orgo = "empty";
                    $bio = "empty";
                    $pic = "empty";
                    $lang = "empty";

                    mysqli_stmt_bind_param($stmt, "issssssssss", $uIDnum, $fName, $lName, $email, $user, $salt, $hpass, $orgo, $bio, $pic, $lang) or die("bind param");

                    //mysqli_stmt_bind_param($stmt, "sss", $user, $salt, $hpass) or die("bind param");

                    if (mysqli_stmt_execute($stmt)) {
                        echo "<h4>Success</h4>";
                    } else {
                        echo "<h4>Failed</h4>";
                    }
                    //$result = mysqli_stmt_get_result($stmt);
                } 

                else {
                    die("prepare failed");
                }
				}
                    
			?>
                <div class="field">
                    <a href="index.php" class="ui fluid button">Go back</a>
                </div>
		</div>
	</body>
</html>