<?php
	require_once("connection.php");

	function test_input($data)
	{
	  $data = trim($data);
	  $data = stripslashes($data);
	  $data = htmlspecialchars($data);
	  return $data;
	}

	$fnameErr = $lnameErr = $emailErr = $passErr = $conpassErr =$contErr="";
	$fname = $lname = $email  = $password = $conpass = $contact = "";
	$confirm_code=md5(uniqid(rand()));

	if ($_SERVER["REQUEST_METHOD"] == "POST")
	{
	  //Note that last name is Optional
	  $lname=test_input($_POST['lname']);
	  if(!preg_match("/^[a-zA-Z\.']{0,20}$/",$lname))
		$lnameErr = "Invalid last name.(max 20 chars)";

	  if (empty($_POST["fname"]))
		$fnameErr = "Name is required";
	  else{
		$fname = test_input($_POST["fname"]);
		// check if name only contains letters.Don't forget names like Mr. or O'Reilly
		if (!preg_match("/^[a-zA-Z\.']{3,20}$/",$fname))
		  $fnameErr = "Invalid first name.(min 3 chars and max 20 chars)";
	  }

	  if (empty($_POST["email"]))
		$emailErr = "Email is required";
	  else{
		$email = test_input($_POST["email"]);
		$email=strtolower($email);
		//See explaination in notes
		if (!preg_match("/^(([\w#\-_~!$&'()*+,;=:]+\.)+[\w#\-_~!$&'()*+,;=:]+|[\w#\-_~!$&'()*+,;=:]{2,}|[a-zA-Z]{1})@([a-zA-Z0-9]+[\w-]+\.)+[a-zA-Z]{1}[a-zA-Z0-9]{1,23}$/i",$email))
		  $emailErr = "Invalid email format";
	  }

	  if (empty($_POST["password"]))
		$passErr = "Password is required";
	  else{
		$password = test_input($_POST["password"]);
		if (!preg_match("/^[A-Za-z0-9!@#$%^&*()_]{6,20}$/",$password))
			$passErr = "Invalid password.Atleast 6 characters required!";
	  }

	  if (empty($_POST["conpass"]))
		$conpassErr = "Confirm your password";
	  else{
		$conpass = test_input($_POST["conpass"]);
		if ($conpass!=$password)
			$conpassErr = "Passwords don't match!";
	  }

	  if (empty($_POST["contact"]))
		$contErr = "Please provide your contact no.";
	  else{
		$contact = $_POST["contact"];
		if (!preg_match('/\d{10}/',$contact))
			$contErr = "Only 10-digit mobile nos.are allowed!";
	  }

	  if($fnameErr=="" && $lnameErr=="" && $emailErr=="" && $passErr=="" && $conpassErr=="" && $contErr=="" ){
		$encpass=sha1($password);
		$query = "SELECT COUNT(*) FROM `user` WHERE `email` = '$email'";
			$result=$connection->query($query);
		if(!$result){
			print('Query execution failed!');
			die();
		}

			if($result->fetchColumn()== 1){
				$emailErr="Email Already Exists!";
			}
			else{
				$query="INSERT INTO `user` VALUES ('','$fname','$lname','$email','$password','$contact','$_POST[sex]')";
			$connection->query($query);
			}
	  }
	}
?>

<html>
<head>
	<title>Contact Form</title>
	<link rel="stylesheet" href="mainStyle.css"></link>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script type="text/javascript" src="validation.js"></script>
</head>


<body>
	<div id="form">
		<!--<div class="left">
			First Name:<br/><br/>
			Last Name:<br/><br/>
			Email:<br/><br/>
			Password:<br/><br/>
			Confirm Password:<br/><br/>
			Contact:<br/><br/>
			Sex:<br/><br/>
		</div>-->

		<form method="POST" action="index.php">
			<input type="text" placeholder="Your name" name="fname" value="<?php echo $fname;?>"><br/><br/>
			<input type="text" placeholder="Enter your last name(Optional)" name="lname" value="<?php echo $lname;?>"><br/><br/>
			<input type="text" placeholder="Your email" name="email" value="<?php echo $email;?>"><br/><br/>
			<input type="text" placeholder="Your email" name="email" value="<?php echo $email;?>"><br/><br/>
			<input type="password" placeholder="See tip below" name="password" value="<?php echo $password;?>"><br/><br/>
			<input type="password" placeholder="Confirm your password" name="conpass"><br/><br/>
			<input type="text" placeholder="Enter 10 digit mobile no" name="contact" value="<?php echo $contact;?>"><br/><br/>
			<input type="radio" value="m" name="sex" checked="checked">Male
			<input type="radio" value="f" name="sex">Female
			<input type="radio" value="o" name="sex">Other<br/><br/>
			<input type="submit" disabled>
		</form>
		
		<div class="error" style="display: none;"><!--Span is created for jquery to insert its error message into-->
			<span id="fnameErr"><?php echo $fnameErr;?></span><br/><br/>
			<span id="lnameErr"><?php echo $lnameErr;?></span><br/><br/>
			<span id="emailErr"><?php echo $emailErr;?></span><br/><br/>
			<span id="passErr"><?php echo $passErr;?></span><br/><br/>
			<span id="conpassErr"><?php echo $conpassErr;?></span><br/><br/>
			<span id="contErr"><?php echo $contErr;?></span><br/><br/>
		</div>
		
	</div>
</body>
</html>