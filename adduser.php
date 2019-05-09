<?php session_start();?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>add users</title>
    <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css?family=Prompt" rel="stylesheet">
</head>

<body  style="font-family: 'Prompt', sans-serif;">


    <!--////////////    script หากมีการกด submit ที่ form ชื่อ form1   /////////////////   -->
    <script language="javascript">
    function fncSubmit()
    {
        if(document.form1.txtpassword.value != document.form1.txtconpassword.value)
        {
            alert('Confirm Password Not Match');
            document.form1.txtconpassword.focus();		
            return false;
        }	
        document.form1.submit();
    }
    function chkNumber(ele)
    {
        var vchar = String.fromCharCode(event.keyCode);
        if ((vchar<'0' || vchar>'9') && (vchar != '.')) return false;
        ele.onKeyPress=vchar;
    }
    </script>




    <!--///////////////////////////////////   PHP QUERY    /////////////////////////////////   -->
    <?php if(isset($_SESSION['username'])==""||isset($_SESSION['username'])==null) {
        echo "<script>window.location ='login.php';</script>"; }
        $message = "";
        $cidexits ='';//ไว้เช็คเวลากดsubmit แล้วเจอเลขบัตรซ้ำให้สถานะเปลี่ยนและดึงค่าที่postมาใส่inputอีกครั้ง

        /////////////////////////////////     QUERY คำนำหน้าชื่อและแผนก   //////////////////////////////
        include_once('connect.php');
        mysqli_set_charset($conn, "utf8");
        $querytitlename =  "SELECT title_name_id,title_name FROM  title_name";
        $objQuerytitlename = mysqli_query($conn,$querytitlename);

        $querydepartment =  "SELECT * FROM  department";
        $objQuerydepartment = mysqli_query($conn,$querydepartment);
    
        ///////////////////////////////////////////////////////////////////////////////////////////////
        


        ///////////////////////////////////// เมื่อกดยืนยันข้อมูล /////////////////////////////////////////
        if(isset($_POST['submit'])){
            include_once('connect.php');
            mysqli_set_charset($conn, "utf8");


            $strSQL = "SELECT * FROM users_account WHERE cid = '".$_POST["txtcid"]."' OR username = '".$_POST["txtuser"]."' ";
            $objQuery = mysqli_query($conn,$strSQL);
            $objResult = mysqli_fetch_array($objQuery);
            if($objResult)
            {
            $message ="มีหมายเลขบัตรประชาชนหรือชื่อเข้าใช้หนี้อยู่ในระบบแล้วกรุณากรอกข้อมูลอีกครั้ง";
            $cidexits ='1';
            }


            else{
                $sql = "INSERT INTO users_account (cid, username, password,title_name_id, fname, lname, niname,department_id,phone_number,status,inuser_date) 
                    VALUES ('".$_POST["txtcid"]."','".$_POST["txtuser"]."','".$_POST["txtpassword"]."'
                    ,'".$_POST["txtname"]."'
                    ,'".$_POST["txtfname"]."'
                    ,'".$_POST["txtlname"]."'
                    ,'".$_POST["txtniname"]."'
                    ,'".$_POST["txtdepartment"]."'
                    ,'".$_POST["txtphonen"]."'
                    ,'".$_POST["txtstatus"]."'
                    ,NOW()
                    )";

                $query = mysqli_query($conn,$sql);

                if($query) {
                    echo "<script>alert('เพิ่มผู้ใช้งานเรียบร้อย');window.location=adduser.php;</script>";
                }
            }
            mysqli_close($conn);
    }  
    ?>
    <!--///////////////////////////////////       /////////////////////////////////   -->





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
                        <a class="dropdown-item" href="#">เพิ่มสมาชิก</a>
                        <a class="dropdown-item" href="manageusers.php">จัดการสมาชิก</a> 
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
                
            
                
                <form action="#" method="POST" name ="form1" OnSubmit="return fncSubmit();">
                    <div class="card">
                        <div class="card-header text-center">เพิ่มผู้ใช้งาน</div>
                        <div class="card-body">

                    
                        <hr>
                            <div class="row">
                                <div class="col">
                                <label for="form-control">เลขบัตรประจำตัวประชาชน</label>
                                <input type="text" maxlength="13" minlength="13" OnKeyPress="return chkNumber(this)" class="form-control" name="txtcid" value ="<?php if($cidexits=='1') echo $_POST['txtcid'];?>" required>
                                </div>
                                <div class="col">
                                <label>สิทธิการใช้งาน</label>
                                <select id="inputState" name="txtstatus" class="form-control" required>
                                    <option selected value ="">เลือกประเภท...</option>
                                    <?php if($_SESSION['status']== 'SUPERADMIN'){?>
                                        <option value ="SUPERADMIN">SUPER ADMIN</option>
                                    <?php }?>
                                    <option value ="ADMIN">ADMIN</option>
                                    <option value ="USER">USER</option>
                                </select>
                                </div>
                            </div>
                            <hr>
    
                            <div class="row">
                                <div class="col-2">
                                <label>คำนำหน้าชื่อ</label>
                                <select id="inputState" name="txtname" class="form-control" required>
                                    <option selected value ="">คำนำหน้า...</option>
                                    <?php while ($objResulttitlename = mysqli_fetch_assoc($objQuerytitlename)) { ?>
                                    <option value ="<?php echo $objResulttitlename['title_name_id'] ;?>">
                                        <?php echo $objResulttitlename['title_name'] ;?>
                                    </option>
                                    <?php } ?>
                                </select>
                                </div>
                                <div class="col-3">
                                    <label for="form-control">ชื่อ</label>
                                    <input type="text" class="form-control"  name="txtfname" value ="<?php if($cidexits=='1') echo $_POST['txtfname'];?>" required>
                                </div>
                                <div class="col-3">
                                    <label for="form-control">นามสกุล</label>
                                    <input type="text" class="form-control" name="txtlname" value ="<?php if($cidexits=='1') echo $_POST['txtlname'];?>"required>
                                </div>
                                <div class="col-4">
                                <label>แผนก</label>
                                <select id="inputState" name="txtdepartment" class="form-control" required>
                                    <option selected value ="">แผนก...</option>
                                    <?php while ($objResultdepartment = mysqli_fetch_assoc($objQuerydepartment)) { ?>
                                    <option value ="<?php echo $objResultdepartment['department_ID'] ;?>">
                                        <?php echo $objResultdepartment['department_name'] ;?>
                                    </option>
                                <?php } ?>
                                </select>
                                </div>
                            </div>
                            <hr>


                            <div class="row">
                                <div class="col">
                                <label>username</label>
                                <input type="text" class="form-control" placeholder="ชื่อเข้าใช้งาน" name="txtuser" value ="<?php if($cidexits=='1') echo $_POST['txtuser'];?>" required>
                                </div>
                                <div class="col">
                                <label>password</label>
                                <input type="password" class="form-control" placeholder="รหัสผ่าน" name="txtpassword"required>
                                </div>
                                <div class="col">
                                <label>confirmpassword</label>
                                <input type="password" class="form-control" placeholder="ยืนยันรหัสผ่าน" name="txtconpassword" required>
                                </div>
                            </div>
                            <hr>


                            <div class="row">
                                <div class="col">
                                <label>ชื่อเล่น</label>
                                <input type="text" class="form-control" placeholder="ชื่อเล่น" name="txtniname"  value ="<?php if($cidexits=='1') echo $_POST['txtniname'];?>" required>
                                </div>
                                <div class="col">
                                <label>หมายเลขโทรศัพท์</label>
                                <input type="text" OnKeyPress="return chkNumber(this)" minlength="3" maxlength="10" class="form-control" placeholder="หมายเลขโทรศัพท์" name="txtphonen" value ="<?php if($cidexits=='1') echo $_POST['txtphonen'];?>" required>
                                </div>
                            </div>
                            <hr>

                        </div>
                        <div class="card-footer text-center">
                            <input type="submit" name ="submit" class ="btn btn-outline-info" value="ยืนยัน">
                            <input type="reset" name ="reset" class ="btn btn-outline-warning" value="ยกเลิก">
                        </div>
                    </div>
                 </form>


                 <?php if($message != ""){ ?>
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <strong>ไม่สามารถเพิ่มข้อมูลได้! &nbsp; &nbsp;</strong>  <?php  echo $message; ?>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        </div>
                 <?php $message = "";} ?>

            </div>
        </div>
    </div>






    <script src="node_modules/jquery/dist/jquery.min.js"></script>
    <script src="node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="node_modules/popper.js/dist/umd/popper.min.js"></script>
</body>
</html>