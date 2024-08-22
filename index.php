
<?php include('dashboard/config/config.php'); ?>
<?php 
    session_start();
    if(isset($_POST['submit'])){
        $email =  $_POST['email'];
        $pass =  $_POST['password'];
        $hass = hash('sha1', $_POST['password']);

        $sql = "SELECT * FROM users";
        
        $qry = $conn->query($sql);

        $result = $qry->fetch_assoc();
        $userid = $result['id'];
        $username = $result['name'];
        $usertype = $result['usertype'];
        if($email==$result['email'] && $hass==$result['password']){
            $_SESSION['userid']= $userid;
            $_SESSION['name']= $username;
            $_SESSION['usertype']=$usertype;
            header("Location:dashboard");
        }else{
            $msg = "<div class='alert alert-danger'>Email or Password not match!</div>";
            header("Location: index.php?msg=".$msg);
        }
        
    }

?>

<!DOCTYPE html>
<html>
    
<head>
    <title>POS Login</title>
    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link href="css/datepicker.css" rel="stylesheet">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" integrity="sha384-gfdkjb5BdAXd+lj+gudLWI+BXq4IuLW5IT+brZEZsLFm++aCMlF1V92rMkPaX4PP" crossorigin="anonymous">
    
    <style>
            body,
        html {
            margin: 0;
            padding: 0;
            height: 100%;
            background: #60a3bc !important;
        }
        .user_card {
            height: 400px;
            width: 350px;
            margin-top: auto;
            margin-bottom: auto;
            background: #f39c12;
            position: relative;
            display: flex;
            justify-content: center;
            flex-direction: column;
            padding: 10px;
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
            -webkit-box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
            -moz-box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
            border-radius: 5px;

        }
        .brand_logo_container {
            position: absolute;
            height: 170px;
            width: 170px;
            top: -75px;
            border-radius: 50%;
            background: #60a3bc;
            padding: 10px;
            text-align: center;
        }
        .brand_logo {
            height: 150px;
            width: 150px;
            border-radius: 50%;
            border: 2px solid white;
        }
        .form_container {
            margin-top: 100px;
        }
        .login_btn {
            width: 100%;
            background: #c0392b !important;
            color: white !important;
        }
        .login_btn:focus {
            box-shadow: none !important;
            outline: 0px !important;
        }
        .login_container {
            padding: 0 2rem;
        }
        .input-group-text {
            background: #c0392b !important;
            color: white !important;
            border: 0 !important;
            border-radius: 0.25rem 0 0 0.25rem !important;
        }
        .input_user,
        .input_pass:focus {
            box-shadow: none !important;
            outline: 0px !important;
        }
        .custom-checkbox .custom-control-input:checked~.custom-control-label::before {
            background-color: #c0392b !important;
        }
    </style>
</head>
<!--Coded with love by Mutiullah Samim-->
<body>
    <div class="container h-100">
        <div class="d-flex justify-content-center h-100">
            <div class="user_card">
                <div class="d-flex justify-content-center">
                    <div class="brand_logo_container">
                        <img src="logo.png" class="brand_logo" alt="Logo">
                    </div>
                </div>
                
                <div class="d-flex justify-content-center form_container">
                    <form method="POST" action="">
                    <h6><?php if(isset($_GET['msg'])){echo $_GET['msg'];} ?></h6>
                        <div class="input-group mb-3 mt-4">
                            <div class="input-group-append">
                                <span class="input-group-text"><i class="fas fa-user"></i></span>
                            </div>
                            <input id="email" type="email" class="form-control" name="email" autocomplete="off" autofocus>

                                
                        </div>
                        <div class="input-group mb-2">
                            <div class="input-group-append">
                                <span class="input-group-text"><i class="fas fa-key"></i></span>
                            </div>
                            <input id="password" type="password" class="form-control" name="password" autocomplete="off">

                               
                        </div>
                        <div class="d-flex justify-content-center mt-3 login_container">
                           <button type="submit" name="submit" class="btn btn-primary">
                                Login
                            </button>
                            
                        </div>
                    </form>
                    
                </div>
                
            </div>
        </div>
    </div>



   
<!-- Required Js -->
<script src="dashboard/assets/js/vendor-all.min.js"></script>
    <script src="dashboard/assets/js/plugins/bootstrap.min.js"></script>
	<script src="dashboard/assets/js/pcoded.min.js"></script>

<!-- Apex Chart -->
<script src="dashboard/assets/js/plugins/apexcharts.min.js"></script>


<!-- custom-chart js -->
<script src="dashboard/assets/js/pages/dashboard-main.js"></script>

<!-- jquery validator script  -->
<script src="dashboard/assets/js/jquery.validate.min.js"></script>

<!-- data tables -->

<script src="https://cdn.datatables.net/2.0.3/js/dataTables.min.js"></script>
</body>

</html>

