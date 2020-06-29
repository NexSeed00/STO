<?php

?>
<?php include('layouts/header.php'); ?>
<body style="margin-top: 60px">
    <div class="container">
        <div class="row">
            <div class="col-xs-8 col-xs-offset-2 thumbnail">
                <h2 class="text-center content_header">LearnSNS</h2>
                <div class="text-center">
                  <div>
                    <p>ログインはこちらから</p>
                    <a href="signin.php">
                      <input type="submit" class="btn btn-info" value="Sign-IN">
                    </a>
                  </div>
                  <hr>
                  <div style="margin-top: 20px">
                    <p>登録はこちらから</p>
                    <a href="register/signup.php">
                      <input type="submit" class="btn btn-success" value="Sign-UP">
                    </a>
                  </div>
                </div>
            </div>
        </div>
    </div>
</body>
<?php include('layouts/footer.php'); ?>
</html>
