<?php
/**
 * Created by PhpStorm.
 * User: monish.c
 * Date: 7/31/2015
 * Time: 5:24 PM
 */
require_once('connection.php');
$query="SELECT * FROM `user`";
$result=$connection->query($query);
//print_r($result);
//print($result->queryString);
?>

<html>
<head>
    <title>User Suggestions</title>
    <link rel="stylesheet" href="reply.css">
</head>
<body>
    <table>
        <tr>
            <th>ID</th>
            <th>NAME</th>
            <th>EMAIL</th>
            <th>CONTACT</th>
            <th>MESSAGE</th>
        </tr>
        <?php
            foreach($result as $row){
                echo '<tr>'.
                    '<td>'.$row[0].'</td>'.
                    '<td>'.$row[1].'</td>'.
                    '<td>'.$row[2].'</td>'.
                    '<td>'.$row[3].'</td>'.
                    '<td>'.$row[4].'</td>'.
                    '</tr>';
            }
        ?>
    </table>
</body>
</html>
