<?php
    session_start();
    include ('../conn.php');
?>
<!DOCTYPE html>
<html lang="en">
    <head>
    <meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		 <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

		<title>CHIKARA</title>
        <link rel ='icon' href = '../img/logo-tittle.png'>

		<!-- Google font -->
		<link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,700" rel="stylesheet">

        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
        <link href="css/styles.css" rel="stylesheet" />
		<!-- Bootstrap -->
		<link type="text/css" rel="stylesheet" href="css/bootstrap.css"/>
        <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css"> -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<!-- summernote -->
        <!-- <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script> -->
        <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
		<!-- Slick -->
		<link type="text/css" rel="stylesheet" href="css/slick.css"/>
		<link type="text/css" rel="stylesheet" href="css/slick-theme.css"/>

		<!-- nouislider -->
		<link type="text/css" rel="stylesheet" href="css/nouislider.min.css"/>

		<!-- Font Awesome Icon -->
		<link rel="stylesheet" href="css/font-awesome.min.css">

		<!-- Custom stlylesheet -->
		<link type="text/css" rel="stylesheet" href="css/style.css"/>
		<link type="text/css" rel="stylesheet" href="css/main.css"/>
		<link type="text/css" rel="stylesheet" href="css/header.css"/>
        <style>
            *{
                font-family: 'Montserrat', sans-serif !important;
            }
            .collapsed{
                cursor: context-menu;
                font-weight: bold;
            }
            .card-body{
                font-weight: bold;
            }
            .nav__user{
                position: relative;
                color: white;                
            }

            .nav__user:hover{
                color: #E95454;
            }

            .nav__user #button__user{
                display: block;
                width: 100%;
                cursor: pointer;
                font-family: 'Montserrat', sans-serif;
                font-weight: 500;
                margin-bottom: 0;
            }

            .menu__ngdung--1{
                color: black;
                padding: 10px 10px;
                cursor: pointer;
                border-bottom: 1px solid rgba(0, 0, 0, 0,2);
                width: 100%;
            }

            .menu__ngdung .menu__ngdung--2{
                color: black;
            }

            .menu__ngdung--1:hover{
                color: #E95454;
            }

            .nav__user .menu__ngdung{
                box-shadow: 0 2px 5px 0 rgb(0 0 0 / 16%), 0 2px 10px 0 rgb(0 0 0 / 12%);
                position: absolute;
                width: 170px;
                right: 0px;
                border-radius: 3px;
                display: none;
                background-color: white;
                z-index: 1;
            }
            .nav__user:hover .menu__ngdung{
                display: block;
            }
            li ul{
                list-style: none;
            }
        </style>
        <script>
            function approve (orderId, type){
                $.ajax({
                    url: 'actions/Orders/Approve.php',
                    type: 'POST',
                    data: 
                    {
                        'id': orderId,
                        'type': type,
                    },
                    success: function (response){
                        alert("Xác nhận đơn hàng thành công");
                        document.location.reload(true);
                    }
                });
            }

            function updateUser (userId, type){
                $.ajax({
                    url: 'actions/Users/Update.php',
                    type: 'POST',
                    data: 
                    {
                        'id': userId,
                        'type': type,
                    },
                    success: function (response){
                        document.location.reload(true);
                    }
                })
            }

            function delivery (orderId, type){
                var deliverId = document.querySelector("select[id='"+orderId+"']").value;
                $.ajax({
                    url: 'actions/Orders/Delivery.php',
                    type: 'POST',
                    data: 
                    {
                        'id': orderId,
                        'type': type,
                        'deliverId': deliverId
                    },
                    success: function (response){
                        alert("Chỉ định giao hàng thành công");
                        document.location.reload(true);
                    }
                });
            }

            function updateProduct (productId){
                $.ajax({
                    url:'layout/Products/ChangeProducts.php',
                    type: 'post',
                    data: {change_prd: productId},
                    success: function(response){
                        $('.modal-body--editproduct').html(response);
                        $('#editproduct').modal('show');
                    }
                });
            }

            function DeleteProduct(id, type){
                $.ajax({
                    url: 'actions/products/delete.php',
                    type: 'POST',
                    data: 
                    {   
                        'id': id,
                        'type': type,
                    },
                    success: function(response){
                        document.location.reload(true);
                    }
                });
            }


        </script>
    </head>
    <body class="sb-nav-fixed">
        <?php
            function countDigit($number){
                return strlen($number);
            }
    
            function displayPrice($input){
                $temp = substr_replace($input, '.', '-3', 0); 
                if (countDigit($input) > 6){
                    $temp = substr_replace($temp, '.', '-7', 0);
                }
                return $temp. "₫";
            }
        ?>
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="index.php">Quản trị WEBSITE</a>
            <!-- Sidebar Toggle-->
            <li class="nav__user" style="list-style-type: none">
                <label for="btn" id = "button__user">
                    <?php
                        $userId = $_SESSION["active"];
                        $result = $conn -> query("SELECT `name` FROM `usr` WHERE `id`='$userId'");
                        $row = $result -> fetch_assoc();
                        echo $row['name'];
                    ?>
                </label>                   
                <ul class="menu__ngdung">														
                    <li class="menu__ngdung--1">
                        <a href="../index.php" data-toggle="modal" class="menu__ngdung--2">Trở về Website</a>
                    </li>
                    <li class="menu__ngdung--1">
                        <a href="#change_user" data-toggle="modal" class="menu__ngdung--2">Thông tin tài khoản</a>
                    </li>
                    <li class="menu__ngdung--1">
                        <a href="#change_psw" data-toggle="modal" class="menu__ngdung--2">Đổi mật khẩu</a>
                    </li>	
                    <li class="menu__ngdung--1">							
                        <a href="../index.php" class="menu__ngdung--2">Đăng xuất</a>
                    </li>											
                </ul>
            </li>
        </nav>
        <div id="layoutSidenav">                
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <a class="nav-link collapsed" style=" text-decoration: none;">
                                Đơn hàng chưa xử lý
                            </a>
                            <div>
                                <nav class="sb-sidenav-menu-nested nav accordion">
                                    <a class="nav-link" href="index.php?newOr=user" aria-expanded="false">
                                        Users                                        
                                    </a>                                    
                                    <a class="nav-link" href="index.php?newOr=guest" aria-expanded="false">
                                        Guest                                        
                                    </a>                                  
                                </nav>
                            </div>
                            <a class="nav-link collapsed" style=" text-decoration: none;">
                                Đơn hàng chưa giao
                            </a>
                            <div>
                                <nav class="sb-sidenav-menu-nested nav accordion">
                                    <a class="nav-link" href="index.php?deli=user" aria-expanded="false">
                                        Users                                        
                                    </a>                                    
                                    <a class="nav-link" href="index.php?deli=guest" aria-expanded="false">
                                        Guest                                        
                                    </a>                                  
                                </nav>
                            </div>
                            <a class="nav-link collapsed" style=" text-decoration: none;">
                                Tables
                            </a>
                            <div>
                                <nav class="sb-sidenav-menu-nested nav accordion">
                                    <a class="nav-link" href="index.php?nav=usr" aria-expanded="false">
                                        Users                                        
                                    </a>                                    
                                    <a class="nav-link " href="index.php?nav=products" aria-expanded="false">
                                        Products                                        
                                    </a>                                
                                </nav>
                            </div>                            
                        </div>  
                    </div>             
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main> 
                <?php                    
                    if (isset($_GET["nav"]))
                    {
                        $nav = $_GET["nav"];
                        if ($nav == "usr")
                        {
                            include ("layout/User.php");
                        }
                        else if ($nav == "products")
                        {
                            include ("layout/Products.php");
                        }
                    }
                    else if (isset($_GET["newOr"]))
                    {
                        $type = $_GET["newOr"];
                        if ($type == "user")
                        {
                            include ("layout/NewOrders/User.php");
                        }
                        else if ($type == "guest")
                        {
                            include ("layout/NewOrders/Guest.php");
                        }
                    }
                    else if (isset($_GET["deli"]))
                    {
                        $type = $_GET["deli"]; 
                        if ($type == "user")
                        {
                            include ("layout/OrderNotDelivery/User.php");
                        }
                        else if ($type == "guest")
                        {
                            include ("layout/OrderNotDelivery/Guest.php");
                        }
                    }
                    else{
                        include ("layout/NewOrders/User.php");

                    }
                ?>
                </main>                
            </div>
        </div>
        <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script> -->
        <script src="js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/chart-area-demo.js"></script>
        <script src="assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
        <script src="js/datatables-simple-demo.js"></script>

        </script>
        <!-- info user -->
		<!--edituser-->
		<script type='text/javascript'>
            $(document).ready(function(){
                $('.user').click(function(){
                    var getid = $(this).data('id');
                    $.ajax({
                        url:'actions/Users/Edit.php',
                        type: 'post',
                        data: {getid: getid},
                        success: function(response){
                            $('.modal-body--changeusr').html(response);
                            $('#myModal').modal('show');
                        }
                    });
                })

                $('.orders').click(function(){
                    var getid = $(this).data('id');
                    $.ajax({
                        url:'actions/Orders/Edit.php',
                        type: 'post',
                        data: {getid: getid},
                        success: function(response){
                            $('.modal-body--editorders').html(response);
                            $('#myModal').modal('show');
                        }
                    });
                });
            });
            $('#summernote').summernote({
                placeholder: 'Hello stand alone ui',
                tabsize: 2,
                height: 120,
                toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'underline', 'clear']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                ['insert', ['link', 'picture', 'video']],
                ['view', ['fullscreen', 'codeview', 'help']]
                ]
            });
		</script>
    </body>
</html>