<?php session_start();?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Index</title>
    <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css?family=Prompt" rel="stylesheet">
</head>

<body  style="font-family: 'Prompt', sans-serif;">
    <script language="javascript">
        function fncSubmit()
        {
            if(document.form1.txtnewpassword.value != document.form1.txtconpassword.value)
            {
                alert('พาสเวิร์ดใหม่ไม่ตรงกัน');
                document.form1.txtconpassword.focus();		
                return false;
            }	
            document.form1.submit();
        }
    </script>

    <?php 
           include_once('connect.php');
           mysqli_set_charset($conn, "utf8");
   
           if(isset($_POST['submit'])){
                $ciduser = $_SESSION['cid'];
                $password = $_POST['txtpassword'];
                $newpassword = $_POST['txtnewpassword'];
                $query ="";
                $strSQL = "SELECT * FROM users_account WHERE cid = '".$_SESSION['cid']."' ";
                $objQuery = mysqli_query($conn,$strSQL);
                $objResult = mysqli_fetch_array($objQuery);
                if($objResult)
                {
                    if ( $password == $_SESSION['password']) {
                        $sqlupdate = "UPDATE `users_account` SET `password` = '".$newpassword ."' WHERE `cid` = '".$ciduser."'";
                        $query = mysqli_query($conn,$sqlupdate);
                        if($query) {
                            echo "<script>alert('เปลี่ยนรหัสผ่านเรียบร้อยแล้ว');window.location=changepassword.php;</script>";
                        }
                    }
                    else { echo "<script> alert('พาสเวิร์ดไม่ถูกต้อง');</script>";} 
                }
            }
           
           
           mysqli_close($conn);
    ?>




     <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand">โปรแกรมแจ้งซ่อม</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item ">
                    <a class="nav-link" href="index.php">หน้าหลัก </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="fromtofix.php">กรอกข้อมูล</a>
                </li>
            </ul>


            <ul class="navbar-nav ml-auto">
                <?php if(isset($_SESSION['username'])){  ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        ยินดีต้อนรับคุณ: <?php echo $_SESSION['fname'];echo " ".$_SESSION['lname'];?>
                        </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="#"> <span class="badge badge-success"><?php echo $_SESSION['status']?> </span></a>
                    <?php if($_SESSION['status']== 'ADMIN'||$_SESSION['status']== 'SUPERADMIN') { ?>
                        <a class="dropdown-item" href="adduser.php">เพิ่มสมาชิก</a>
                        <a class="dropdown-item" href="manageusers.php">จัดการสมาชิก</a> 
                    <?php }?>
                        <div class="dropdown-divider"></div><!--เส้นขั้นกลาง-->
                        <a class="dropdown-item" href="changepassword.php">เปลี่ยนรหัสผ่าน</a>    
                        <a class="dropdown-item" href="logout.php">ออกจากระบบ</a>
                    </div>
                    </li>
                <?php }else{  ?>
                    <li class="nav-item">
                        <a class="nav-link " href="login.php" tabindex="-1" aria-disabled="true">login</a>
                    </li>
                <?php } ?>
            </ul>
        </div>
        </nav>



    <div class="cotainer">
        <div class="row">
            <div class="col-10 col-sm-10 col-md-6 col-lg-6 col-xl-3 mx-auto mt-5">
                <form action="#" method="POST"name ="form1" OnSubmit="return fncSubmit();">
                <div class="card">
                    <div class="card-header text-center">เปลี่ยนรหัสผ่าน</div>
                    <div class="card-body">
                        <div class="form-group">
                            <label>รหัสผ่านเก่า</label>
                            <input type="password" class="form-control" id="txtpassword" name ="txtpassword" required>
                        </div>
                        <div class="form-group">
                            <label>รหัสผ่านใหม่</label>
                            <input type="password" class="form-control" id="txtnewpassword" name="txtnewpassword" required>
                        </div>
                        <div class="form-group">
                            <label for="password">ยืนยันรหัสผ่าน</label>
                            <input type="password" class="form-control" id="txtconpassword" name="txtconpassword" required>
                        </div>
                    
                    </div>
                    <div class="card-footer text-center">
                        <input type="submit" name ="submit" class ="btn btn-outline-info" value="ยืนยัน">
                    </div>
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