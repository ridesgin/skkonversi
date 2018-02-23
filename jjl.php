<?php
$connect    = new mysqli ('localhost', 'root', '', 'mydb');

$query      = mysqli_query($connect, "SELECT * FROM instansi");
$row        = mysqli_fetch_array($query);
echo $row['id_instansi'];
?>

<html>
    <head>
        <meta charset="utf-8">
        <title>Login dengan password_hash dan password_verify</title>
    </head>
    <body>
        
    </body>
</html>