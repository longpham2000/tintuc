<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation" style="background: #545251;">
        <div class="container">

            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">

                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">Tin Tức</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                

                <form class="navbar-form navbar-left" role="search">
			        <div class="form-group">
			          <input type="text" class="form-control" placeholder="Search" id="id_search">
			        </div>
			        <button type="button" class="btn btn-default" id="id_button">Tìm Kiếm</button>
			    </form>

			    <ul class="nav navbar-nav pull-right">
                    <?php
                     if(isset($_SESSION['user_name'])){
                        ?>
                        <li>
                            <a>
                                <span class ="glyphicon glyphicon-user"></span>
                                <?=$_SESSION['user_name']?>
                            </a>
                        </li>

                        <li>
                            <a href="dangxuat.php">Đăng xuất</a>
                        </li>
                        <?php
                    }else{
                        ?>
                            <li>
                                <a  href="dangky.php">Đăng ký</a>
                            </li>
                            <li>
                                <a  href="dangnhap.php">Đăng nhập</a>
                            </li>
                        <?php
                    }

                    ?>
                    
                    

                </ul>
            </div>



            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>