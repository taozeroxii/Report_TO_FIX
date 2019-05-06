<?php session_start();?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>เข้าสู่ระบบ</title>
    <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.min.css">
</head>

<body>

    <?php 
        include_once('connect.php');

        if(isset($_POST['submit'])){
            $username = $_POST['username'];
            $password = $conn->real_escape_string ($_POST['password']);

            $sql = "SELECT * FROM `users_account` WHERE `username` =  '".$username."'  AND `password` = '".$password."'";//query เช็ค user password ตรงไหม

            $result = $conn->query($sql);
          
            if($result->num_rows>0){
                $accoutUsser = $result->fetch_assoc();
                $_SESSION['cid'] =  $accoutUsser['cid'];
                $_SESSION['username'] =  $accoutUsser['username'];
                $_SESSION['password'] =  $accoutUsser['password'];
                $_SESSION['fname'] =  $accoutUsser['fname'];
                $_SESSION['lname'] =  $accoutUsser['lname'];
                $_SESSION['status'] =  $accoutUsser['status'];
                $_SESSION['title_name_id'] =  $accoutUsser['title_name_id'];
                $_SESSION['department_id'] =  $accoutUsser['department_id'];
                
                header('location:index.php');
       
            }else{  echo "<script>alert('Username หรือ password ผิดพลาด');window.location ='login.php';</script>"; }
        }
    ?>
    


    <div class="cotainer">
    <br><br><br>
        <div class="row">
            <div class="col-10 col-sm-10 col-md-6 col-lg-6 col-xl-3 mx-auto mt-5">
                <form action="#" method="POST">
                <div class="card">
                    <div class="card-header text-center">เข้าสู่ระบบแจ้งซ่อม</div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="username">USER NAME</label>
                            <input type="text" class="form-control" id="username" name ="username" required>
                        </div>
                        <div class="form-group">
                            <label for="password">PASSWORD</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        <input type="submit" name ="submit" class ="btn btn-primary" value="LOGIN">
                        <input type="reset" name ="set" class ="btn btn-warning" value="RESET">
                    </div>
                    <div class="text-center"></div>
                 </div>
                 </form>
            </div>
        </div>
        
    </div>
    



    <script src="node_modules/jquery/dist/jquery.min.js"></script>
    <script src="node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="node_modules/popper.js/dist/umd/popper.min.js"></script>
</body>
</html>