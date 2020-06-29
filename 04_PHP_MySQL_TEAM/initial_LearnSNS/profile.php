<?php

?>
<?php include('layouts/header.php'); ?>
<body style="margin-top: 60px; background: #E4E6EB;">
    <?php include("navbar.php"); ?>
    <div class="container">
        <div class="row">
            <div class="col-xs-3 text-center">
                <img src="user_profile_img/misae.png" class="img-thumbnail" />
                <h2>野原みさえ</h2>
                <a href="follow.php">
                    <button class="btn btn-default btn-block">フォローする</button>
                </a>
            </div>

            <div class="col-xs-9">
                <ul class="nav nav-tabs">
                    <li class="active">
                        <a href="#tab1" data-toggle="tab">Followers</a>
                    </li>
                    <li>
                        <a href="#tab2" data-toggle="tab">Following</a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div id="tab1" class="tab-pane fade in active">
                        <div class="thumbnail">
                            <div class="row">
                                <div class="col-xs-2">
                                    <img src="user_profile_img/misae.png" width="80px">
                                </div>
                                <div class="col-xs-10">
                                    名前 <a href="profile.php" style="color: #7F7F7F;">野原みさえ</a>
                                    <br>
                                    2018-10-14 12:34:56からメンバー
                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="tab2" class="tab-pane fade">
                        <div class="thumbnail">
                            <div class="row">
                                <div class="col-xs-2">
                                    <img src="user_profile_img/misae.png" width="80px">
                                </div>
                                <div class="col-xs-10">
                                    名前 <a href="profile.php" style="color: #7F7F7F;">野原みさえ</a>
                                    <br>
                                    2018-10-14 12:34:56からメンバー
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<?php include('layouts/footer.php'); ?>
</html>