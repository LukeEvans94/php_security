<?php

$conn = new PDO('mysql:host=127.0.0.1;dbname=sql_injection','user','password');

if(isset($_POST['Email'])) {
    $email = $_POST['Email'];
}
    //$userQuery = $conn->query("SELECT * FROM users WHERE email = '{$email}'");
    $userQuery = $conn->prepare("SELECT * FROM users WHERE email = :email");
    $userQuery->execute([
        'email'=>$email
    ]);
if($userQuery->rowCount()){
    echo "user found";
}
?>

<!doctype html>
<html lane="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>
<form action="" method="post" autocomplete="off">
    <label for="name">
        Name
        <input type=text name ="name">
    </label>
    <label for="Email">
        Email
        <input type=text name ="Email">
    </label>
    <input type="submit">
</form>
</body>
</html>
