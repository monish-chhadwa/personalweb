<?php
if(isset($_GET['code'])){
	$url='https://api.instagram.com/oauth/access_token';
	$data= array('client_id'=> 'b8fb9251a28d4ddd9d91ff8f300ce056',
    	'client_secret'=> '54bdfb9c694e49f48d31d3afcd62e7f2',
    	'grant_type'=> 'authorization_code',
    	'redirect_uri'=> 'http://localhost/projects/mapinstagram/processing.php',
    	'code' => $_GET['code']);
	$string=http_post_fields($url,$data);
	echo $string;
}
?>
