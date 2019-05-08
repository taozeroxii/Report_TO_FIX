<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>หน้าแรก</title>
    <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.min.css">
</head>

<body>
    <?php if (isset($_SESSION['username']) == "" || isset($_SESSION['username']) == null) {
        echo "<script>window.location ='login.php';</script>";
    } ?>



    <!--  /////////////////// เชื่อมต่อ และquery จำนวนหน้าและและช่องแถบค้นหา GET METHOD FROM ค้นหา//////////////////     -->
    <?php
    $con = mysqli_connect('localhost', 'root', '', 'test');
    mysqli_set_charset($con, "utf8");
    $perpage = 10;
    if (isset($_GET['page'])) {
        $page = $_GET['page'];
    } else {
        $page = 1;
    }

    //query เอาเลขหน้า
    $start = ($page - 1) * $perpage;
    $sql = "select * from repair_report rp
            inner join users_account ua on ua.cid = rp.user_cid
            ORDER BY rp.repair_report_id desc limit {$start} , {$perpage} ";


    /* if (isset($_GET['txtKeyword'])) {
                if($_GET["txtKeyword"] != "" ){
                    $sql  =  "SELECT ua.status,ua.inuser_date,ua.cid,ua.username,ua.password,ua.fname,ua.lname,ua.niname,ua.phone_number,ua.title_name_id,ua.department_id,dt.department_name,tn.title_name
                    from users_account ua 
                    left join department dt on dt.department_id = ua.department_id  
                    inner join title_name tn on ua.title_name_id = tn.title_name_id
                    WHERE (ua.cid LIKE '%".$_GET["txtKeyword"]."%' or status LIKE '%".$_GET["txtKeyword"]."%' or ua.fname LIKE '%".$_GET["txtKeyword"]."%' or ua.lname LIKE '%".$_GET["txtKeyword"]."%' )";
                }

                else{ $sql = "select ua.status,ua.inuser_date,ua.cid,ua.username,ua.password,ua.fname,ua.lname,ua.niname,ua.phone_number,ua.title_name_id,ua.department_id,dt.department_name,tn.title_name
                    from users_account ua 
                    left join department dt on dt.department_id = ua.department_id  
                    inner join title_name tn on ua.title_name_id = tn.title_name_id
                    ORDER BY `inuser_date` DESC limit {$start} , {$perpage} ";}
               
            }*/
    $query = mysqli_query($con, $sql);

    ///////////////////////////////////// เมื่อกดรับงาน ส่ง POST เข้ามาทำงาน //////////////////////////////// 
    if (isset($_POST['confirmjob'])) { //หากกดยืนยันรับงาน 
       //echo $_POST['admin_name'].$_POST['status_fix'].$_POST["repair_report_id"];
       include_once('connect.php');
       mysqli_set_charset($conn, "utf8");
       
        $addadminjob = "UPDATE `repair_report` SET 
       `adminget` = '".$_POST["admin_name"]."', 
       `status_fix` = '".$_POST["status_fix"]."'
        WHERE `repair_report_id` = '".$_POST["repair_report_id"]."'
        ";
      

        if ( $Queryaddadminjob){
            echo "<script>alert('กดรับเรียบร้อยแล้ว');window.location = index.php</script>";
            $Queryaddadminjob =  mysqli_query($conn, $addadminjob);
        }
        else{echo "connect fail";}
        mysqli_close($conn);

    }
    ?>






    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand">โปรแกรมแจ้งซ่อม</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="#">หน้าหลัก </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="fromtofix.php">กรอกข้อมูล</a>
                </li>
            </ul>



            <ul class="navbar-nav ml-auto">
                <?php if (isset($_SESSION['username'])) {  ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            ยินดีต้อนรับคุณ: <?php echo $_SESSION['fname'];
                                                echo " " . $_SESSION['lname']; ?>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="#"> <span class="badge badge-success"><?php echo $_SESSION['status'] ?> </span></a>
                            <?php if ($_SESSION['status'] == 'ADMIN' || $_SESSION['status'] == 'SUPERADMIN') { ?>
                                <a class="dropdown-item" href="adduser.php">เพิ่มสมาชิก</a>
                                <a class="dropdown-item" href="manageusers.php">จัดการสมาชิก</a>
                            <?php } ?>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="changepassword.php">เปลี่ยนรหัสผ่าน</a>
                            <a class="dropdown-item" href="logout.php">ออกจากระบบ</a>
                        </div>
                    </li>
                <?php } else {  ?>
                    <li class="nav-item">
                        <a class="nav-link " href="login.php" tabindex="-1" aria-disabled="true">login</a>
                    </li>
                <?php } ?>
            </ul>
        </div>
    </nav>
    <br>







    <center>
        <h1>หน้าจอแสดงสถานะการแจ้งซ่อม</h1>
    </center>

    <div class="container-fluid ">
        <hr>
        <div class="row">
            <div class="col-lg-12">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <?php if ($_SESSION['status'] == 'ADMIN' || $_SESSION['status'] == 'SUPERADMIN' && $_SESSION['department_id'] == 'dep999') { ?>
                                <th style="text-align:center;"> # </th>
                            <?php } ?>
                            <th style="text-align:center;"> รหัสใบแจ้ง</th>
                            <th style="text-align:center;">ชื่อ-นามสกุล ผู้แจ้ง </th>
                            <th style="text-align:center;">ชื่อ ผู้รับแจ้ง </th>
                            <th style="text-align:center;">ประเภท</th>
                            <th style="text-align:center;">สถานะดำเนินการ</th>
                            <th style="text-align:center;">สถานที่</th>
                            <th style="text-align:center;">แก้ไข/ลบข้อมูล</th>
                        </tr>
                    </thead>


                    <tbody>
                        <?php while ($result = mysqli_fetch_assoc($query)) { ?>
                            <tr>
                                <?php if ($_SESSION['status'] == 'ADMIN' || $_SESSION['status'] == 'SUPERADMIN' && $_SESSION['department_id'] == 'dep999') { ?>
                                    <td>
                                        <center>
                                            <button class="btn btn-info" data-toggle="modal" data-target="#exampleModal<?php echo $result['repair_report_id']; ?>"  <?php if ($result['status_fix'] != 'รอดำเนินการ') { echo 'disabled';}?>>รับ</button>
                                            <button class="btn btn-secondary" <?php if ($result['status_fix'] != 'อยู่ระหว่างดำเนินการ') { echo 'disabled';} ?>>ปิดงาน</button>
                                        </center>
                                    </td>
                                <?php } ?>
                                <td style="text-align:center;"><?php echo $result['repair_report_id']; ?> </td>
                                <td style="text-align:center;"><?php echo $result['fname'] . '    ' . $result['lname']; ?> </td>
                                <td style="text-align:center;"><?php echo $result['adminget'] ?></td>
                                <td style="text-align:center;"><?php echo $result['type_repair']; ?> </td>
                                <td style="text-align:center;"><?php echo $result['status_fix']; ?> </td>
                                <td><?php echo $result['address']; ?> </td>
                                <td>
                                    <center><button type="button" class="btn btn-warning">
                                            <img src="icon/edit.png" width="20" height="20" /> แก้ไขข้อมูล</button>
                                        <button type="button" class="btn btn-danger ">
                                            <img src="icon/delete.png" width="20" height="20" /> ลบข้อมูล</button>
                                    </center>
                                </td>
                            </tr>
                            <!--///////////////////////////////////////////// Modal DELETE เมื่อกดปุ่มลบ ///////////////////////////////////////////////////////-->
                            <div class="modal fade" id="exampleModal<?php echo $result['repair_report_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModal" aria-hidden="true">
                                <div class="modal-dialog">
                                    <!-- Modal content-->
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title">รับงานนี้</h4>
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        </div>
                                        <div class="modal-body">
                                            <p>รหัส: <?php echo $result['repair_report_id']; ?></p>
                                            <p>ผู้แจ้ง: <?php echo $result['fname'] . '    ' . $result['lname']; ?></p>
                                            <p>วันที่: <?php echo $result['date_in']; ?></p>
                                            <p>ประเภท: <?php echo $result['type_repair']; ?> </p>
                                            <p>สถานที่แจ้ง: <?php echo $result['address']; ?> </p>
                                            <?php echo  'ชื่อผูู้กดรับงาน: ' . $_SESSION['fname'] . $_SESSION['lname'] . ' ( ' . $_SESSION['niname'] . ' )' ?>
                                        </div>

                                        <form action="#" method="POST">
                                            <div class="modal-footer">
                                                <input type="hidden" name="admin_name" value="<?php echo $_SESSION['fname'] . '  ( ' . $_SESSION['niname'] . ')' ?>">
                                                <input type="hidden" name="repair_report_id" value="<?php echo $result['repair_report_id']; ?>">
                                                <input type="hidden" name="status_fix" value="อยู่ระหว่างดำเนินการ">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
                                                <input type="submit" name="confirmjob" class="btn btn-primary" value="ยืนยัน">
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!--//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->


                        <?php } ?>
                    <tbody>
                </table>
            </div>
        </div>

        <script src="bootstrap/js/bootstrap.min.js"></script>

        <script src="node_modules/jquery/dist/jquery.min.js"></script>
        <script src="node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
        <script src="node_modules/popper.js/dist/umd/popper.min.js"></script>
</body>
</html>
