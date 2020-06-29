<?php

require_once('dbconnect.php');

$stmt = $dbh->prepare('SELECT * FROM users');
$stmt->execute();
$users = $stmt->fetchAll();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        .user-img {
            width: 250px;
            height: 250px;
            object-fit: contain;
            background-color: black;
        }
    </style>
</head>

<body>
    <form action="store.php" method="post" enctype="multipart/form-data">
        <input type="text" name="name">
        <input type="file" name="image">
        <input type="submit" value="送信">
    </form>

    <h1>ユーザー一覧</h1>
    <div>
        <?php foreach ($users as $user) : ?>
            <div>
                <h2><?= $user['name']; ?></h2>
                <img class="user-img" src="<?= $user['image_at'] ?>" alt="">
            </div>
        <?php endforeach; ?>
    </div>
</body>

</html>