<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Todoアプリ</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>

<body>
  <div class="col-sm-6 col-md-4 col-lg-3 py-3 py-3">
    <div class="card">
        <img src="https://picsum.photos/200" class="card-img-top" alt="...">
        <div class="card-body">
            <h5 class="card-title">みかんの値段</h5>
            <p class="card-text">
                ここに値段
            </p>
            <div class="text-right d-flex justify-content-end">
                <a href="#" class="btn text-success">EDIT</a>
                <form action="delete.php" method="post">
                    <input type="hidden" name="id" value="">
                    <button type="submit" class="btn text-danger">DELETE</button>
                </form>
            </div>
        </div>
    </div>
  </div>
  <div class="col-sm-6 col-md-4 col-lg-3 py-3 py-3">
    <div class="card">
        <img src="https://picsum.photos/200" class="card-img-top" alt="...">
        <div class="card-body">
            <h5 class="card-title">りんごの値段</h5>
            <p class="card-text">
                 ここに値段
            </p>
            <div class="text-right d-flex justify-content-end">
                <a href="#" class="btn text-success">EDIT</a>
                <form action="delete.php" method="post">
                    <input type="hidden" name="id" value="">
                    <button type="submit" class="btn text-danger">DELETE</button>
                </form>
            </div>
        </div>
    </div>
  </div>
</body>