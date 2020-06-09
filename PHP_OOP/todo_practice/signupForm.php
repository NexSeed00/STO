<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>サインアップ | Todoアプリ</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>

<body>
    <div class="container-fulid">
        <div class="row">
            <div class="col-12">
                <nav class="navbar navbar-dark bg-dark">
                    <a href="index.php" class="navbar-brand">Todo</a>
                </nav>
            </div>
        </div>

        <div class="row mt-4 px-4">
            <div class="col-12">
                <form action="signup.php" method="post">
                    <div class="form-group">
                        <input type="email" class="form-control" name="email" placeholder="email">
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" name="password" placeholder="password">
                    </div>
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary">REGISTER</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>