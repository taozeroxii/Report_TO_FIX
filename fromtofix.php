<?php session_start();?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>แจ้งซ่อม</title>
    <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css?family=Prompt" rel="stylesheet">
</head>

<body  style="font-family: 'Prompt', sans-serif;">

    <?php if(isset($_SESSION['username'])==""||isset($_SESSION['username'])==null) {
        echo "<script>alert('โปรดเข้าสู่ระบบก่อนดำเนินการแจ้งข้อมูล');window.location ='login.php';</script>";
    }?>



    <?php 
        //////////////////////////////////        QUERY        //////////////////////////////////////////////
        include_once('connect.php');
        mysqli_set_charset($conn, "utf8");
        $querytitlename =  "SELECT *FROM  title_name";
        $objQuerytitlename = mysqli_query($conn,$querytitlename);

        $Querydptest =  "select * from department dp
        inner join buliding_room  br on dp.buliding_room_id  = br.buliding_room_id 
        inner join buliding_floor bf on bf.buliding_floor_id  = br.buliding_floor_id
        inner join buliding bd on bd.buliding_id = bf.buliding_id
        where dp.department_id = '".$_SESSION['department_id']."'
        
        ";
         $objQuerydptest = mysqli_query($conn,$Querydptest);

        ///////////////////////////////////////////////////////////////////////////////////////////////
    ?>

    <?php if(isset($_POST['submit'])){
       /* echo $_SESSION['cid'];
        echo $_POST['txtstatusfix'];
        echo $_POST['txtaddress'].' ';
        echo $_POST['txtadddate'].' ';
        echo $_POST['txtcallbackphone'].'<br>';
        echo $_POST['txtrepair_repord_id'];*/

        $sql = "INSERT INTO repair_report (repair_report_id,user_cid,address,status_fix,date_in,type_repair,callback_phone,repair_report_text,buliding_room_id) 
        VALUES ('".$_POST["txtrepair_repord_id"]."'
        ,'".$_SESSION["cid"]."'
        ,'".$_POST["txtaddress"]."'
        ,'".$_POST["txtstatusfix"]."'
        ,'".$_POST["txtadddate"]."'
        ,'".$_POST["txttyperepair"]."'
        ,'".$_POST["txtcallbackphone"]."'
        ,'".$_POST["txtreportrepair"]."'
        ,'".$_POST["buliding_room_id"]."'
        )";

    $query = mysqli_query($conn,$sql);
    
        if( $query){
            echo "<script>alert('เพิ่มผู้ใช้งานเรียบร้อย');window.location=adduser.php;</script>";
            // LINE API NOTIFY//
            function send_line_notify($message, $token)
            { $ch = curl_init(); curl_setopt( $ch, CURLOPT_URL, "https://notify-api.line.me/api/notify"); curl_setopt( $ch, CURLOPT_SSL_VERIFYHOST, 0); curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, 0); curl_setopt( $ch, CURLOPT_POST, 1); curl_setopt( $ch, CURLOPT_POSTFIELDS, "message=$message"); curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, 1); $headers = array( "Content-type: application/x-www-form-urlencoded", "Authorization: Bearer $token", ); curl_setopt($ch, CURLOPT_HTTPHEADER, $headers); curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1); $result = curl_exec( $ch ); curl_close( $ch ); return $result;
            }
            $message = 'รหัสแจ้ง: '.$_POST["txtrepair_repord_id"]."\r\nผู้แจ้ง: "
            .$_SESSION["fname"]." ".$_SESSION["lname"]."\r\nวันที่ :"
            .$_POST["txtadddate"]."\r\nประเภท: ".$_POST["txttyperepair"].
            "\r\nอาการ: ".$_POST["txtreportrepair"]."\r\nติดต่อกลับ: ".$_POST["txtcallbackphone"]
            ."\r\nสถานที่: ".$_POST["txtaddress"];
            $token = 'JM1KlQ87yxrkoRZ1bGpyHscYMiiqMO4rzyBC5EBzkhj';
            send_line_notify($message, $token);
        }



    } 
    //กำหนดค่า pk ของการแจ้งซ่อมโดยให้A นำหน้าตามด้วยปีและเดือนที่ลงข้อมูลเลขจะรัน + 1 ต่อจากค่าสุดท้ายใน sql
    $code = "A";
    $yearMonth = substr(date("Y")+543, -2).date("m");
     
    //query MAX ID 
    $sql = "SELECT MAX(repair_report_id) AS last_id FROM repair_report";
    $qry = mysqli_query($conn,$sql);
    $rs = mysqli_fetch_assoc($qry);
    $maxId = substr($rs['last_id'], -5);  //ข้อมูลนี้จะติดรหัสตัวอักษรด้วย ตัดเอาเฉพาะตัวเลขท้ายนะครับ
    //$maxId = 237;   //<--- บรรทัดนี้เป็นเลขทดสอบ ตอนใช้จริงให้ ลบ! ออกด้วยนะครับ
    $maxId = ($maxId + 1); 
    
    $maxId = substr("00000".$maxId, -5);
    $nextId = $code.$yearMonth.$maxId;
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
                <li class="nav-item active">
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
                <div class="col-10 col-sm-10 col-md-6 col-lg-6 col-xl-6 mx-auto mt-5">
                    
                
                    
                    <form action="#" method="POST">
                    <div class="card">
                        <div class="card-header text-center">แบบฟอร์มแจ้งซ่อม</div>
                        <div class="card-body">


                        <div class="row">
                                <div class="col-9">  
                                    <?php while($resultss = mysqli_fetch_assoc($objQuerydptest)){ ?>
                                    <label for="form-control">จุดใช้งาน</label>
                                    <select id="txtbulidingroomid" class="form-control"  disabled>
                                        <option selected value = '<?php echo $resultss['buliding_room_id']?>'>
                                        <?php echo 'แผนก '.$resultss['department_name'].'  ห้อง '.$resultss['room_name'].' '.$resultss['buliding_floor_name'].' อาคาร '.$resultss['buliding_name'];?></option>
                                    </select>
                                    <input type="hidden" name = 'txtaddress' class="form-control" value = " <?php echo 'แผนก '.$resultss['department_name'].'  ห้อง '.$resultss['room_name'].' '.$resultss['buliding_floor_name'].' อาคาร '.$resultss['buliding_name'];?> ">
                                    <input type="hidden" name = 'buliding_room_id' class="form-control" value = "<?php echo $resultss['buliding_room_id']?> ">
                                    <?php } ?>
                                </div>

                                <div class="col-3">         
                               
                                    <label for="form-control">เลขที่ใบแจ้ง</label>
                                    <input type="text"  class="form-control " value = "<?php  echo $nextId ?>" disabled>
                                    <input type="hidden" name = 'txtrepair_repord_id'  class="form-control " value = "<?php  echo $nextId ?>">
                                    <input type="hidden" name = 'txtstatusfix'  class="form-control " value = "รอดำเนินการ">
                                </div>
                        </div>
                        
                    
                        <hr>
                            <div class="row">
                                <div class="col">
                                    <label for="form-control">เลขบัตรประชาชน</label>
                                    <input type="text" name='txtcid' class="form-control" value = "<?php echo $_SESSION['cid']; ?>" disabled>
                                </div>
                                <div class="col">
                                    <label for="form-control">ชื่อ-นามสกุล</label>
                                    <input type="text" class="form-control" value = "<?php echo $_SESSION['fname'];echo ' '.$_SESSION['lname']; ?>" disabled>
                                </div>
                                <div class="col">
                                    <label for="form-control">สถานะผู้ใช้งาน</label>
                                    <input type="text" class="form-control" value = "<?php echo $_SESSION['status']; ?>" disabled>
                                </div>
                                <div class="col-3">
                                <label>ประเภทการแจ้ง</label>
                                    <select id="inputState" name = 'txttyperepair' class="form-control" required>
                                        <option selected value = ''>เลือกประเภทการแจ้ง</option>
                                        <option  value = 'อุปกรณ์คอมพิวเตอร์'>อุปกรณ์คอมพิวเตอร์</option>
                                        <option value = 'โปรแกรม'>โปรแกรม</option>
                                        <option  value = 'อินเทอร์เน็ต'>อินเทอร์เน็ต</option>
                                    </select>
                                </div>                               
                            </div>
                           
                            <hr>
    

                            



                            <div class="row">
                                <div class="col">
                                    <label for="exampleFormControlTextarea1">อาการเสียเบื้องต้น</label>
                                    <textarea name = 'txtreportrepair' class="form-control" id="exampleFormControlTextarea1" rows="4" placeholder="อาการ..." required></textarea>
                                </div>                              
                                <div class="col">
                                        
                                    <label for="form-control">วันที่แจ้ง</label>
                                    <?php 
                                     date_default_timezone_set("Asia/Bangkok"); //ตั้งโซนเวลา
                                    $month = date('m');
                                    $day = date('d');
                                    $year = (date('Y')+543); 
                                    $TIME =  date("h:i:sa"); 
                                    $today = $day . '-' . $month . '-' . $year.'  '.$TIME ;
                                    ?>
                                    <input type="datetime-asia" name='txtadddate' class="form-control" value ="<?php echo $today; ?>">   
                                    <label for="form-control">หมายเลขติดต่อกลับ</label>
                                    <input type="text" name ='txtcallbackphone' class="form-control" placeholder="หมายเลขติดต่อกลับ" value ="<?php echo $_SESSION['phone_number']?>">               
                                </div>                  
                            </div>
                            <hr>

                        </div>
                        <div class="card-footer text-center">
                            <input type="submit" name ="submit" class ="btn btn-info" value="ยืนยัน">
                            <input type="reset" name ="reset" class ="btn btn-warning" value="ยกเลิก">
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