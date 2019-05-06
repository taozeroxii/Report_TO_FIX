<?php session_start();?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>จัดการสมาชิก</title>
    <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.min.css">
    
</head>

<body>

    <?php if(isset($_SESSION['username'])==""||isset($_SESSION['username'])==null) {
        echo "<script>window.location ='login.php';</script>";
    }?>


    <?php
            include_once('connect.php');
            $querydepartment = "SELECT * FROM department";
            $objquerydepartment = mysqli_query($conn,$querydepartment);
            
    
    ?>  


    <?php if($_SESSION['status']== 'ADMIN'||$_SESSION['status']== 'SUPERADMIN') {   
        $message = '';
    ?>


        <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand">โปรแกรมแจ้งซ่อม</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
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
                        <a class="dropdown-item" href="adduser.php">เพิ่มสมาชิก</a> 
                        <a class="dropdown-item" href="manageusers.php">จัดการสมาชิก</a> 
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
        <br>


        <!--  //////////////////////////////////////////// ค้นหา/////////////////////////////////////////////////////////     -->
        <form name="frmSearch" method="get" action="<?php echo $_SERVER['SCRIPT_NAME'];?>"> <!-- $_SERVER['SCRIPT_NAME']; คือการดึงชื่อเอกสารมา เมื่อกด form นี้ให้เกิดaction โหลดหน้าเดิม-->
            <div class="container" >
                    <div class="row">
                        <div class="col-lg-12">
                            <table class="table table-bordered">
                                <tr>
                                <th>
                                    <input name="txtKeyword" placeholder="ค้นหา" type="text" class="form-control"  id="txtKeyword" value="" >
                                </th>
                                <th><input type="submit"  class ="btn btn-info btn-lg btn-block" value="Search"> </th>
                                </tr>
                            </table>
                        </div>
                    </div>
            </div>
        </form>
        <!--  //////////////////////////////////////////////////////////////////////////////////////////////////////////////    -->





        <!--  ///////////////////////////////////////// แก้ไขข้อมูลเมื่อกดส่งฟอร์ม method post จาก Edit From//////////////////////////////     -->
        <?php
                if(isset($_POST['submit'])){
                    include_once('connect.php');
                

                    $selectcid = "SELECT * FROM users_account WHERE cid = '".$_POST["txtcid13"]."'";
                
                    $objQuery2 = mysqli_query($conn,$selectcid);
                    $objResult2 = mysqli_fetch_array($objQuery2);
                    if($objResult2)
                    {
                        $Update = "UPDATE `users_account` SET 
                        `username` ='".$_POST["txtuser"]."', 
                        `password` = '".$_POST["txtpassword"]."', 
                        `title_name_id` = '".$_POST["txtname"]."', 
                        `fname` = '".$_POST["txtfname"]."', 
                        `lname` = '".$_POST["txtlname"]."', 
                        `niname` = '".$_POST["txtniname"]."', 
                        `department_id` = '".$_POST["txtdepartment"]."', 
                        `status` = '".$_POST["txtstatus"]."', 
                        `phone_number` = '".$_POST["txtphonen"]."' 
                        WHERE `cid` = '".$_POST["txtcid13"]."';

                        ;";
                    
                        $updatequery = mysqli_query($conn,$Update);
                        if($updatequery) {
                            mysqli_close($conn);
                            echo "<script>alert('แก้ไขข้อมูลเรียบร้อย');window.reload=manageusers.php;</script>";
                        }
                
                
                    }else{  $message ="เลขบัตรประชาชนไม่ถูกต้อง"; }
                }  

                if(isset($_POST['delete'])){
                    include_once('connect.php');
                    $selectcids = "SELECT * FROM users_account WHERE cid = '".$_POST["txtciddel"]."'";
                    $objQueryUsers = mysqli_query($conn,$selectcids);
                    $ObjQuerfetch = mysqli_fetch_array($objQueryUsers);
            
                    if($ObjQuerfetch)
                    {
                        $Deleteuser  = "DELETE FROM `users_account` WHERE `cid` = '".$_POST["txtciddel"]."'";
                        $updatequery = mysqli_query($conn,$Deleteuser);
                        mysqli_close($conn);
                        echo "<script>alert('ลบข้อมูลเรียบร้อย');window.reload=manageusers.php;</script>";
                    }
                
                }

        ?>
      <!--  ///////////////////////////////////////// -------------------------------------------     /////////////////////////////     -->





      <!--  /////////////////// เชื่อมต่อ และquery จำนวนหน้าและและช่องแถบค้นหา GET METHOD FROM ค้นหา//////////////////     -->
        <?php
            $con = mysqli_connect('localhost', 'root', '', 'users');
            mysqli_set_charset($con, "utf8");
            $perpage = 10;
            if (isset($_GET['page'])) {
                $page = $_GET['page'];
            } else {
                $page = 1;
            }

            //query เอาเลขหน้า
            $start = ($page - 1) * $perpage;
            $sql = "select ua.status,ua.inuser_date,ua.cid,ua.username,ua.password,ua.fname,ua.lname,ua.niname,ua.phone_number,ua.title_name_id,ua.department_id,dt.department_name,tn.title_name
            from users_account ua 
            left join department dt on dt.department_id = ua.department_id  
            inner join title_name tn on ua.title_name_id = tn.title_name_id
            ORDER BY `inuser_date` DESC limit {$start} , {$perpage} ";



            if (isset($_GET['txtKeyword'])) {
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
               
            }
            $query = mysqli_query($con, $sql);
            ?>





            <div class="container" >
                <div class="row">
                    <div class="col-lg-12">
                        <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th style="text-align:center;"> วันที่เพิ่มแอคเค้าท์</th>
                                <th style="text-align:center;">เลขบัตรประชาชน</th>
                                <th style="text-align:center;"> ชื่อ-นามสกุล</th>  
                                <th style="text-align:center;">แผนก</th>                             
                                <th style="text-align:center;">สิทธิการใช้งาน</th>
                                <th style="text-align:center;">แก้ไข/ลบข้อมูล</th>
                            </tr> 
                        </thead>
                        <tbody>
                        <?php while ($result = mysqli_fetch_assoc($query)) { ?>
                            <tr>
                                <td style="text-align:center;"><?php echo $result['inuser_date']; ?></td>                              
                                <td style="text-align:center;"><?php echo $result['cid']; ?></td>
                                <td style="text-align:center;"><?php echo $result['fname']."       ";  echo $result['lname'];?></td>
                                <td style="text-align:center;"><?php echo $result['department_name']; ?></td>
                                <td style="text-align:center;"><?php echo $result['status']; ?></td>
                                <td style="text-align:center;">
                                    <button type="button" class="btn btn-warning " data-toggle="modal" data-target="#exampleModal<?php echo $result['cid'];?>" <?php if($_SESSION['status']!= $result['status']&& $result['status'] =='SUPERADMIN'){ echo 'disabled';}?>> 
                                    <img src="icon/edit.png" width="20" height="20"/> แก้ไขข้อมูล</button>
                                    <button type="button" class="btn btn-danger "  data-toggle="modal" data-target="#mymodel<?php echo $result['cid'];?>" <?php if($_SESSION['status']!= 'SUPERADMIN'){ echo 'disabled';}?> >
                                    <img src="icon/delete.png"  width="20" height="20"/> ลบข้อมูล</button>
                                    
                                </td>
                            </tr>

                                    <!--///////////////////////////////////////////// Modal DELETE เมื่อกดปุ่มลบ ///////////////////////////////////////////////////////-->    
                                        <div class="modal fade" id="mymodel<?php echo $result['cid'];?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                            <!-- Modal content-->
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title">ลบข้อมูลผู้ใช้งาน</h4> 
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                </div>
                                                <h5 style = 'text-align:center;'> <?php echo $result['cid'].'  '."คุณ : ".'   '.$result['fname'].'   '.$result['lname'];?></h2>
                                            
                                                <form action="#" method="POST">
                                                    <div class="modal-footer">
                                                        <input type="hidden" name = 'txtciddel' value = "<?php echo $result['cid'];?>"><!-- สร้างรinputล่อนหนหลอกไว้ส่งค่า cid ตอนกดปุ่ม del-->
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
                                                        <input type="submit" name ="delete" class ="btn btn-primary" value="ยืนยันลบ">
                                                    </div>
                                                </form>
                                            </div>
                                            </div>
                                        </div>
                                         <!--//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////--> 
                        

                                         <!--///////////////////////////////////////////// Modal EDIT เมื่อกดปุ่มแก้ไข ///////////////////////////////////////////////////////-->    
                                        <div class="modal fade" id="exampleModal<?php echo $result['cid'];?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">แก้ไขข้อมูลผู้ใช้งาน</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>

                                            <form action="#" method="POST">
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col">
                                                            <label for="form-control" >เลขบัตรประจำตัวประชาชน</label>
                                                            <input type="text" class="form-control"  name="txtcid13" value ="<?php  echo $result['cid'];?>" required>
                                                           
                                                        </div>
                                                        <div class="col">
                                                            <label>สิทธิการใช้งาน</label>
                                                            <select id="inputState" name="txtstatus" class="form-control" required>
                                                                <option selected value ="<?php  echo $result['status'];?>"><?php  echo $result['status'];?></option>
                                                                <?php if($_SESSION['status']== 'SUPERADMIN'){?>
                                                                <option value ="SUPERADMIN"<?php if($result['status']== 'SUPERADMIN'){echo 'hidden';}?>>SUPER ADMIN</option>
                                                                <?php }?>
                                                                <option value ="ADMIN"   <?php if($result['status']== 'ADMIN'){ echo 'hidden';}?>>ADMIN</option>
                                                                <option value ="USER"   <?php if($result['status']== 'USER'){ echo 'hidden';}?>>USER</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <hr>

                      
                                                    <div class="row">
                                                        <div class="col">  
                                                        <label>แผนก</label>
                                                            <select id="inputState" name="txtdepartment" class="form-control" required>
                                                                <option selected value ="<?php  echo $result['department_id'];?>"><?php  echo $result['department_name'];?></option>
                                                                <?php while($resultObjQuerfetchdepartment = mysqli_fetch_assoc($objquerydepartment)) { ?>
                                                                <option value ="<?php if($result['department_id']!=$resultObjQuerfetchdepartment['department_ID']) {echo $resultObjQuerfetchdepartment['department_ID'];?>">  <?php  echo $resultObjQuerfetchdepartment['department_name'];}?> </option>
                                                                <?php  }?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <hr>
                                                    
                                            
                                                    <div class="row">
                                                        <div class="col-3">  
                                                            <label>คำนำหน้า</label>
                                                            <select id="inputState" name="txtname" class="form-control" required>
                                                                <option value ="<?php  echo $result['title_name_id'];?>"><?php  echo $result['title_name'];?></option>
                                                            </select>           
                                                        </div>
                                                        <div class="col-4">
                                                            <label>ชื่อ</label>
                                                            <input type="text" class="form-control"  name="txtfname" value ="<?php  echo $result['fname'];?>" required>
                                                        </div>
                                                        <div class="col-5">
                                                            <label>นามสกุล</label>
                                                            <input type="text" class="form-control" name="txtlname" value ="<?php  echo $result['lname'];?>"required>
                                                        </div>
                                                    </div>
                                                    <hr>       
                                                    <?php if($_SESSION['status']=='SUPERADMIN'){ ?> 
                                                    <div class="row">
                                                        <div class="col">
                                                            <label>USERNAME</label>
                                                            <input type="text" class="form-control" placeholder="User" name="txtuser"  value ="<?php echo $result['username'];?>" required>
                                                        </div>
                                                        <div class="col">
                                                            <label>Password</label>
                                                            <input type="password"  maxlength="10" class="form-control" placeholder="txtpassword" name="txtpassword" value ="<?php echo $result['password'];?>" required>
                                                        </div>
                                                    </div>
                                                    <hr>   
                                                    <?php }?>                     

                                                    <div class="row">
                                                        <div class="col">
                                                            <label>ชื่อเล่น</label>
                                                            <input type="text" class="form-control" placeholder="ชื่อเล่น" name="txtniname"  value ="<?php echo $result['niname'];?>" required>
                                                        </div>
                                                        <div class="col">
                                                            <label>หมายเลขโทรศัพท์</label>
                                                            <input type="text"  maxlength="10" class="form-control" placeholder="หมายเลขโทรศัพท์" name="txtphonen" value ="<?php echo $result['phone_number'];?>" required>
                                                        </div>
                                                    </div>
                                                    <hr>
                                                </div>
                                        
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
                                                    <input type="submit" name ="submit" class ="btn btn-primary" value="ยืนยันแก้ไข">
                                                    <?php if($message != ""){ ?>
                                                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                                        <strong>ไม่สามารถแก้ไขได้! &nbsp; &nbsp;</strong>  <?php  echo $message; ?>
                                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                        </div>
                                                    <?php $message = "";} ?>
                                                </div>
                                                </div>
                                            </div>
                                        </div>
                                        </form>
                                          <!--///////////////////////////////////////////// ////////////////////// ///////////////////////////////////////////////////////-->  

                        <?php } ?>
                        </tbody>
                        </table>


      <!--  /////////////////// ส่วนของ paginatorทำ query มาใหม่และนับจำนวนแถว //////////////////     -->
            <?php
            $sql2 = "select * from users_account ";
              if (isset($_GET['txtKeyword'])) {
                if($_GET["txtKeyword"] != "" ){
                    $sql2  =  "SELECT * FROM users_account WHERE (cid LIKE '%".$_GET["txtKeyword"]."%' or status LIKE '%".$_GET["txtKeyword"]."%' or fname LIKE '%".$_GET["txtKeyword"]."%' or lname LIKE '%".$_GET["txtKeyword"]."%' )";
                }
                else{ $sql2 = "SELECT * FROM `users_account` ORDER BY `inuser_date` DESC";}
            }
            
            $query2 = mysqli_query($con, $sql2);
            $total_record = mysqli_num_rows($query2);
            $total_page = ceil($total_record / $perpage);
            ?>


                    <nav aria-label="Page navigation example">
                        <ul class="pagination">
                            <li class="page-item">
                                <a class="page-link"  href="manageusers.php?page=1" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span></a>
                            <li class="page-item">
                        <?php for($i=1;$i<=$total_page;$i++){ ?>
                            <li class="page-item"><a class="page-link"  href="manageusers.php?page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
                        <?php } ?>
                            <li class="page-item">
                                <a class="page-link"  href="manageusers.php?page=<?php echo $total_page;?>" aria-label="Next">
                                <span aria-hidden="true">&raquo;</span></a>
                            </li>
                        </ul>
                    </nav>
                </div>
                </div>
            </div> <!-- /container -->
     <!--  /////////////////// ส่วนของ paginatorทำ query มาใหม่และนับจำนวนแถว //////////////////     -->
     <?php }else{echo "<script>window.location ='index.php';</script>"; }?>


 

   

    
    <script src="node_modules/jquery/dist/jquery.min.js"></script>
    <script src="node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="node_modules/popper.js/dist/umd/popper.min.js"></script>
</body>
</html>