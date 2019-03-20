<?php
	require_once("connection.php");
	session_start();//For Captcha
	function test_input($data)
	{
	  $data = trim($data);
	  $data = stripslashes($data);
	  $data = htmlspecialchars($data);
	  return $data;
	}

	$nameErr = $emailErr = $contErr = $messageErr = $captchaErr= "";
	$name = $email = $contact = $message = $response= "";
	$confirm_code=md5(uniqid(rand()));

	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		if (empty($_POST["name"]))
			$nameErr = "Name is required";
		else{
			$name = test_input($_POST["name"]);
			// check if name only contains letters.Don't forget names like Mr. or O'Reilly
			if (!preg_match("/^[a-zA-Z. ']{3,30}$/",$name))
			  $nameErr = "Invalid name.(min 3 chars and max 30 chars)";
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

		if (empty($_POST["contact"]))
			$contErr = "Please provide your contact no.";
		else{
			$contact = $_POST["contact"];
			if (!preg_match('/\d{10}/',$contact))
				$contErr = "Only 10-digit mobile nos.are allowed!";
		}

		if (empty($_POST["message"]))
			$messageErr = "Message cannot be empty!";
		else {
			$message = test_input($_POST["message"]);
			if (!preg_match('/(.|\n){1,3000}/',$contact))
				$messageErr = "Message can contain at max 3000 characters!";
		}

		if($_POST['captcha']!=$_SESSION['security_code'])
			$captchaErr="Invalid Captcha";

		if($nameErr=="" && $emailErr=="" && $contErr=="" && $messageErr=="" && $captchaErr==""){
			$query = "SELECT COUNT(*) FROM `user` WHERE `email` = '$email'";
			$result=$connection->query($query);
			if(!$result){
				print('Query execution failed!');
				die();
			}
			if($result->fetchColumn()!=0){
				$emailErr="Email Already Exists!";
			}
			else{
				$query="INSERT INTO `user` VALUES ('','$name','$email','$contact','$message')";
				if($connection->query($query)){
					$response="Response recorded successfully! Thankyou!";
					$name = $email = $contact = $message = "";
				}
				else{
					$response="Internal Server Error. Please try again after some time!";
					$name = $email = $contact = $message = "";
				}
			}
		}
	}
?>

<html>
<head>
	<title>Contact Form</title>
	<link rel="stylesheet" href="mainStyle.css"></link>
	<script type="text/javascript" src="validation.js"></script>
<!--	<script type="text/javascript" src="captchajax.js"></script>-->
	<script type="text/javascript">
		function clear1() {
			var x = document.getElementsByTagName('input');
			var i;
			for (i = 0; i < x.length-1; i++) {//-1 is done because submit button value should not change
				//console.log(x[i]);
				x[i].value = "";
				x[i].removeAttribute('class');
				//x[i].nextElementSibling.innerHTML=''
			}
			x = document.getElementsByTagName('span');
			for (i = 0; i < x.length-1; i++) {
				x[i].innerHTML = "";
			}
			document.getElementsByTagName('textarea')[0].value="";
		}
		function reloadCaptcha(){
			document.getElementById('captcha').setAttribute('src','captcha.php');
		}
	</script>
</head>


<body onload="mainFunction()">
	<div id="container1">
		<div id="container2">

			<div id="header">
				<div id="imgContainer"><img src="images/logo.gif"></div>
				<div id="title">
					<h1>Contact Us</h1>
					<h2>We had love to here from you</h2>
				</div>
			</div>

			<div id="note">
				<h2>No matter how broad or niche your website is, we will always have advertisers relevant to your content.<br>
				We had love to hear from you!</h2>
			</div>

			<form method="POST" action="index.php" autocomplete="off" onsubmit="return true">
				<input type="text" placeholder="Your name" name="name" value="<?php echo $name;?>">
				 <span><?php echo $nameErr;?></span><br/><br/>
				<input type="text" placeholder="Your email" name="email" value="<?php echo $email;?>">
				 <span><?php echo $emailErr;?></span><br/><br/>
				<input type="text" placeholder="Enter 10 digit mobile no" name="contact" value="<?php echo $contact;?>">
				 <span><?php echo $contErr;?></span><br/><br/>
				<textarea rows="5" placeholder="Your message" name="message"><?php echo $message;?></textarea>
				 <span><?php echo $messageErr;?></span><br/><br/>
				<div id="captchadiv">
					<div id="imageDiv"><img id="captcha" src="captcha.php"></div>
					<div id="textDiv">
						<button type="button" onclick="reloadCaptcha();">Refresh</button><br/><br/>
						<input type="text" name="captcha" id="captchaInput" size="5" maxlength="5">
					</div>
					<span><?php echo $captchaErr;?></span><br/><br/>
				</div>

				<input type="submit">
				<button type="button" onclick="clear1()">Clear</button><br/>
			    <span id="response"><?php echo $response?></span>
			</form>

		</div>
	</div>

</body>
</html>