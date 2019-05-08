<?php session_start();?>
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
    <?php if(isset($_SESSION['username'])==""||isset($_SESSION['username'])==null) {
        echo "<script>window.location ='login.php';</script>";
    }?>



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
                    <?php } ?>
                    <div class="dropdown-divider"></div>
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

    <br>
    <center><h1>หน้าจอแสดงสถานะการแจ้งซ่อม</h1></center>
    <div class="container-fluid " >
    <hr>
                <div class="row">
                    <div class="col-lg-12">
                        <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th style="text-align:center;" > # </th>
                                <th style="text-align:center;" > รหัสใบแจ้ง</th>
                                <th style="text-align:center;">ชื่อ-นามสกุล ผู้แจ้ง </th>
                                <th style="text-align:center;">ชื่อ-นามสกุล ผู้แจ้ง </th>
                                <th style="text-align:center;">ประเภท</th>  
                                <th style="text-align:center;">สถนานะดำเนินการ</th>                             
                                <th style="text-align:center;">สถานที่</th>
                                <th style="text-align:center;">แก้ไข/ลบข้อมูล</th>
                            </tr> 
                        </thead>


                        <tbody>
                        <tr>
                            <td><center><button class = "btn btn-info"  data-toggle="modal" data-target="#exampleModal">รับ</button></center> </td>
                            <td> </td>
                            <td> </td>
                            <td> </td>
                            <td> </td>
                            <td> </td>
                            <td> </td>
                            <td><center> <button type="button" class="btn btn-warning"> 
                                    <img src="icon/edit.png" width="20" height="20"/> แก้ไขข้อมูล</button>
                                    <button type="button" class="btn btn-danger " >
                                    <img src="icon/delete.png"  width="20" height="20"/> ลบข้อมูล</button>
                                    </center></td>
                        </tr>
                   
                        <tbody>


                        </table>
                    </div>
                </div>
                     
   
    


 <!--///////////////////////////////////////////// Modal DELETE เมื่อกดปุ่มลบ ///////////////////////////////////////////////////////-->    
 <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModal" aria-hidden="true">
                                            <div class="modal-dialog">
                                            <!-- Modal content-->
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title">รับงานนี้</h4> 
                                                   
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                </div>
                                                <div class="modal-body">
                                                <p>รหัส: A560500001</p> 
                                                <p>วันที่: 2019-05-08</p>
                                                <p>ประเภท: อุปกรณ์คอมพิวเตอร์ </p>
                                                <p>สถานที่แจ้ง:  แผนก สูติ  ห้อง สูตินรีเวชกรรม ชั้น 4 อาคาร 114 เตียง  </p>
                                                <?php echo  'ชื่อผูู้กดรับงาน: '.$_SESSION['fname'].$_SESSION['lname'].' ( '.$_SESSION['niname'].' )'?>
                                              </div>
                                            
                                                <form action="#" method="POST">
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
                                                        <input type="submit" name ="delete" class ="btn btn-primary" value="ยืนยัน">
                                                    </div>
                                                </form>
                                            </div>
                                            </div>
                                        </div>
                                         <!--//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////--> 







    <script src="bootstrap/js/bootstrap.min.js"></script>

    <script src="node_modules/jquery/dist/jquery.min.js"></script>
    <script src="node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="node_modules/popper.js/dist/umd/popper.min.js"></script>
</body>
</html>
