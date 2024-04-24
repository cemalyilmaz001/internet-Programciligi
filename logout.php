<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="images/favicon.ico">
    <title>Document</title>
</head>
<body>

<?php
session_start();
unset($_SESSION["uye"]);
header("location: index.php");

?>
    
</body>
</html>