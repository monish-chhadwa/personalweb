<?php
/**
 * Created by PhpStorm.
 * User: monish.c
 * Date: 8/11/2015
 * Time: 3:29 PM
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Hello Publisher!</title>
    <link rel="stylesheet" href="mainStyle.css"/>
    <script type="text/javascript" src="script1.js"></script>
</head>
<body>
    <main>
        <h2>Choose your template:</h2>
        <input type="radio" name="template" value="1"><iframe src="template1.html" class="horizontal"></iframe>
        <input type="radio" name="template" value="2"><iframe src="template2.html" class="horizontal"></iframe>
        <input type="radio" name="template" value="3"><iframe src="template3.html" class="vertical"></iframe>
        <input type="radio" name="template" value="4"><iframe src="template4.html" class="vertical"></iframe>
        <h2>Choose no.of ads: </h2>
        <select id="noOfAds"></select>
    </main>
</body>
</html>
