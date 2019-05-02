<?php session_start();?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>แก้สถานะ</title>
    <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.min.css">
</head>

<body>
    <?php if(isset($_SESSION['username'])==""||isset($_SESSION['username'])==null) {
        echo "<script>alert('โปรดเข้าสู่ระบบก่อนดำเนินการแจ้งข้อมูล');window.location ='login.php';</script>";
    }?>
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
                <li class="nav-item ">
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
                        <?php if($_SESSION['status']== 'admin') { ?>
                        <a class="dropdown-item" href="adduser.php">เพิ่มสมาชิก</a>
                        <a class="dropdown-item" href="manageusers.php">จัดการสมาชิก</a> 
                        <?php }?>
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




        <div class="cotainer">
            <div class="row">
                <div class="col-10 col-sm-10 col-md-6 col-lg-6 col-xl-6 mx-auto mt-5">
                    
                
                    
                    <form action="#" method="POST">
                    <div class="card">
                        <div class="card-header text-center">แก้ไขข้อมูล</div>
                        <div class="card-body">


                    
                        <hr>
                            <div class="row">
                                <div class="col">
                                    <label for="form-control">เลขบัตรประจำตัวประชาชน</label>
                                    <input type="text" class="form-control" value = "<?php echo $_SESSION['cid']; ?>" disabled>
                                </div>
                                <div class="col">
                                    <label for="form-control">ชื่อ-นามสกุล</label>
                                    <input type="text" class="form-control" value = "<?php echo $_SESSION['fname'];echo ' '.$_SESSION['lname']; ?>" disabled>
                                </div>
                                <div class="col">
                                    <label for="form-control">สถานะผู้ใช้งาน</label>
                                    <input type="text" class="form-control" value = "<?php echo $_SESSION['status']; ?>" disabled>
                                </div> 
                            </div>
                            <hr>
    
                            <div class="row">
                                
                                <div class="col">
                                    <label>หน่วยงาน</label>
                                    <input type="text" class="form-control" placeholder="หน่วยงาน">
                                </div>
                                <div class="col">
                                <label>ประเภทการแจ้ง</label>
                                    <select id="inputState" class="form-control">
                                        <option selected>เลือกประเภทการแจ้ง</option>
                                        <option>อุปกรณ์คอมพิวเตอร์</option>
                                        <option>โปรแกรม</option>
                                        <option>อินเทอร์เน็ต</option>
                                    </select>
                                </div>                               
                            </div>
                            <hr>


                            <div class="row">
                                <div class="col">
                                <label>ตึก/อาคาร</label>
                                <input type="text" class="form-control" placeholder="กรุณากรอกชื่ออาคารหรือตึก">
                                </div>
                                <div class="col">
                                <label>ชั้น/ห้อง</label>
                                <input type="text" class="form-control" placeholder="กรุณากรอกชั้น">
                                </div>
                            </div>
                            <hr>


                            <div class="row">
                                <div class="col">
                                    <label for="exampleFormControlTextarea1">อาการเสียเบื้องต้น</label>
                                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="4" placeholder="อาการ..."></textarea>
                                </div>                              
                                <div class="col">
                                    <label for="form-control">วันที่แจ้ง</label>
                                    <input type="date" class="form-control" placeholder="วันที่">
                                    <label for="form-control">วันที่ดำเนินการเสร็จ</label>
                                    <input type="date" class="form-control" placeholder="วันที่ดำเนินการเสร็จ">
                                </div>
                                <div class="col">
                                    <label for="form-control">หมายเลขติดต่อกลับ</label>
                                    <input type="text" class="form-control" placeholder="หมายเลขติดต่อกลับ">
                                </div>
                            </div>


                            <hr>
                            <div class="row">
                                <div class="col">
                                    <label>ผู้รับแจ้ง</label>
                                    <select id="inputState" class="form-control">
                                            <option selected>เลือกผู้รับแจ้ง</option>
                                            <option>เอก</option>
                                            <option>โอ</option>
                                            <option>ดอย</option>
                                            <option>มาร์ค</option>
                                            <option>เต๋า</option>
                                        </select>
                                </div>
                                <div class="col">
                                    <label>ผู้รับแจ้ง</label>
                                    <select id="inputState" class="form-control">
                                            <option selected>เลือกผู้รับแจ้ง</option>
                                            <option>เอก</option>
                                            <option>โอ</option>
                                            <option>ดอย</option>
                                            <option>มาร์ค</option>
                                            <option>เต๋า</option>
                                        </select>
                                </div>    
                            </div>
                            <hr>


                        </div>
                        <div class="card-footer text-center">
                            <input type="submit" name ="ยืนยัน" class ="btn btn-outline-info" value="ยืนยัน">
                            <input type="reset" name ="ยกเลิก" class ="btn btn-outline-warning" value="ยกเลิก">
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