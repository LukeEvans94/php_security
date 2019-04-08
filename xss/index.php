<?php
$conn = new PDO('mysql:host=127.0.0.1;dbname=sql_injection','user','password');
unset($_POST);
if(isset($_POST['submit'])){
    $name = $_POST['name'];
    $body = $_POST['body'];
    $commentQuery = $conn->prepare("INSERT INTO comments(name,body) values (:name,:body)");
    $commentQuery->execute(['name' =>$name,'body'=>$body]);

    $commentObject = $conn->query("SELECT * FROM comments");
    $commentObject->setFetchMode(PDO::FETCH_OBJ);
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
</head>
<body>

<div class="col-sm-6 col-sm-offset-3">
    <h3 class="text-center">Make your comment</h3>
    <form action="" method="post" autocomplete="off">
        <div class="form-group">
            <label for="Name">Name</label>
            <input type="text" name="name" class="form-control">
        </div>
        <div class="form-group">
            <label for="comment">Comment</label>
            <textarea name="body" id="" cols="30" rows="10" class="form-control"></textarea>
        </div>
        <input type="submit" name="submit">
    </form>

    <table class="table">
        <thead>
        <tr>
            <th>Name</th>
            <th>Body</th>
        </tr>
        </thead>
        <tbody>
        <?php
            while ($comment = $commentObject->fetch()){
                echo "<tr>";
                echo "<td>$comment->name</td>";
                echo "<td>$comment->body</td>";
                echo "</tr>";
            }
        ?>
        </tbody>
    </table>
</div>
</body>
</html>