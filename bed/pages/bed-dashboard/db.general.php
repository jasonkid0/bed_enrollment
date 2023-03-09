 <?php
    $active_ay = mysqli_query($conn, "SELECT * FROM tbl_active_acadyears");
    while ($row = mysqli_fetch_array($active_ay)) {
        $ay_id = $row['ay_id'];
    } ?>

 <?php $active_ay = mysqli_query($conn, "SELECT * FROM tbl_active_semesters");
    while ($row = mysqli_fetch_array($active_ay)) {
        $sem_id = $row['semester_id'];
    } ?>


 <!-- Main content -->
 <section class="content">
     <div class="container-fluid ">
         <!-- Small boxes (Stat box) -->
         <div class="row">
             <div class="col-lg-3 col-6">
                 <!-- small box -->
                 <div class="small-box bg-info">
                     <div class="inner">
                         <?php $stud_count = mysqli_query($conn, "SELECT count(student_id) AS total_stud FROM tbl_schoolyears
                         WHERE ay_id = '$ay_id' AND remark = 'Approved' AND (semester_id = '$sem_id' OR semester_id = '0')") or die(mysqli_error($conn));
                            while ($row = mysqli_fetch_array($stud_count)) { ?>
                         <h3><?php echo $row['total_stud']; ?></h3>
                         <?php } ?>
                         <p><small>Total No. of</small> Enrolled Students</p>
                     </div>
                     <div class="icon">
                         <i class="ion ion-ios-people"></i>
                     </div>
                     <a href="db.enrolledStudents.php" class="small-box-footer">View Details <i
                             class="fas fa-arrow-circle-right"></i></a>
                 </div>
             </div>
             <!-- ./col -->
             <div class="col-lg-3 col-6">
                 <!-- small box -->
                 <div class="small-box bg-success">
                     <div class="inner">
                         <?php $stud_count = mysqli_query($conn, "SELECT count(student_id) AS total_stud FROM tbl_schoolyears
                         WHERE ay_id = '$ay_id' AND remark = 'Approved' AND stud_type = 'New' AND (semester_id = '$sem_id' OR semester_id = '0')") or die(mysqli_error($conn));
                            while ($row = mysqli_fetch_array($stud_count)) { ?>
                         <h3><?php echo $row['total_stud']; ?></h3>
                         <?php } ?>
                         <p><small class="black">Total No. of</small> Enrolled New Students</p>
                     </div>
                     <div class="icon">
                         <i class="ion ion-person-stalker"></i>
                     </div>
                     <a href="db.newStudents.php" class="small-box-footer">View Details <i
                             class="fas fa-arrow-circle-right"></i></a>
                 </div>
             </div>
             <!-- ./col -->
             <div class="col-lg-3 col-6">
                 <!-- small box -->
                 <div class="small-box bg-olive">
                     <div class="inner">
                         <?php $stud_count = mysqli_query($conn, "SELECT count(student_id) AS total_stud FROM tbl_schoolyears
                         WHERE ay_id = '$ay_id' AND remark = 'Approved' AND stud_type = 'Old' AND (semester_id = '$sem_id' OR semester_id = '0')") or die(mysqli_error($conn));
                            while ($row = mysqli_fetch_array($stud_count)) { ?>
                         <h3><?php echo $row['total_stud']; ?></h3>
                         <?php } ?>
                         <p><small>Total No. of</small> Enrolled Old Students</p>
                     </div>
                     <div class="icon">
                         <i class="ion ion-ios-people"></i>
                     </div>
                     <a href="db.oldStudents.php" class="small-box-footer">View Details <i
                             class="fas fa-arrow-circle-right"></i></a>
                 </div>
             </div>
             <!-- ./col -->
             <div class="col-lg-3 col-6">
                 <!-- small box -->
                 <div class="small-box" style="background-color:#f9a100">
                     <div class="inner">
                         <?php $stud_count = mysqli_query($conn, "SELECT count(student_id) AS total_stud FROM tbl_schoolyears
                         WHERE ay_id = '$ay_id' AND (remark = 'Pending' OR remark = 'Canceled') AND (semester_id = '$sem_id' OR semester_id = '0')") or die(mysqli_error($conn));
                            while ($row = mysqli_fetch_array($stud_count)) { ?>
                         <h3 class="text-gray-dark"><?php echo $row['total_stud']; ?></h3>
                         <?php } ?>

                         <p class="text-gray-dark"><small class="text-gray-dark">Total No. of</small>
                             Pending Enrollees</p>
                     </div>
                     <div class="icon">
                         <i class="ion ion-ios-clock"></i>
                     </div>
                     <a href="db.pendingEnrollees.php" class="small-box-footer text-gray-dark">View Details <i
                             class="fas fa-arrow-circle-right"></i></a>
                 </div>
             </div>

             <div class="col-lg-3 col-6">
                 <!-- small box -->
                 <div class="small-box bg-danger">
                     <div class="inner">
                         <?php $stud_count = mysqli_query($conn, "SELECT count(student_id) AS total_stud FROM tbl_schoolyears
                         WHERE ay_id = '$ay_id' AND remark = 'Dropped'") or die(mysqli_error($conn));
                            while ($row = mysqli_fetch_array($stud_count)) { ?>
                         <h3 class="text-white"><?php echo $row['total_stud']; ?></h3>
                         <?php } ?>

                         <p><small>Total No. of</small> Dropped Students</p>
                     </div>
                     <div class="icon">
                         <i class="ion ion-minus-circled"></i>
                     </div>
                     <a href="#" class="small-box-footer">View Details <i class="fas fa-arrow-circle-right"></i></a>
                 </div>
             </div>
             <div class="col-lg-3 col-6">
                 <!-- small box -->
                 <div class="small-box bg-gray">
                     <div class="inner">
                         <?php $stud_count = mysqli_query($conn, "SELECT count(or_id) AS total_stud FROM tbl_online_reg WHERE remark = 'Pending'") or die(mysqli_error($conn));
                            while ($row = mysqli_fetch_array($stud_count)) { ?>
                         <h3 class="text-white"><?php echo $row['total_stud']; ?></h3>
                         <?php } ?>

                         <p><small>Total No. of</small> Online Inquiries</p>
                     </div>
                     <div class="icon">
                         <i class="fas fa-globe"></i>
                     </div>
                     <a href="../bed-online-enrollment/online_list.php" class="small-box-footer">View Details <i
                             class="fas fa-arrow-circle-right"></i></a>
                 </div>
             </div>
             <div class="col-lg-3 col-6">
             </div>
             <div class="col-lg-3 col-6">
             </div>
             <!-- small box -->
             <div class="col-lg-3 col-6">
                 <!-- small box -->
                 <div class="small-box bg-gray-dark">
                     <div class="inner">
                         <?php $stud_count = mysqli_query($conn, "SELECT count(student_id) AS total_stud FROM tbl_schoolyears
                         WHERE ay_id = '$ay_id' AND semester_id = '$sem_id' AND strand_id = '4' AND remark = 'Approved' AND grade_level_id = '14'") or die(mysqli_error($conn));
                            while ($row = mysqli_fetch_array($stud_count)) { ?>
                         <h3 class="text-white"><?php echo $row['total_stud']; ?></h3>
                         <?php } ?>

                         <p><small>Total No. of Enrolled</small> Grade 11 Students <br> in (STEM)</p>
                     </div>
                     <div class="icon">
                         <i class="fas fa-atom"></i>
                     </div>
                     <a href="list.enrolledSTEM11.php" class="small-box-footer">View Details <i
                             class="fas fa-arrow-circle-right"></i></a>
                 </div>
             </div>

             <div class="col-lg-3 col-6">
                 <!-- small box -->
                 <div class="small-box bg-gray-dark">
                     <div class="inner">
                         <?php $stud_count = mysqli_query($conn, "SELECT count(student_id) AS total_stud FROM tbl_schoolyears
                         WHERE ay_id = '$ay_id' AND semester_id = '$sem_id' AND strand_id = '4' AND remark = 'Approved' AND grade_level_id = '15'") or die(mysqli_error($conn));
                            while ($row = mysqli_fetch_array($stud_count)) { ?>
                         <h3 class="text-white"><?php echo $row['total_stud']; ?></h3>
                         <?php } ?>

                         <p><small>Total No. of Enrolled</small> Grade 12 Students <br> in (STEM)</p>
                     </div>
                     <div class="icon">
                         <i class="fas fa-atom"></i>
                     </div>
                     <a href="list.enrolledSTEM12.php" class="small-box-footer">View Details <i
                             class="fas fa-arrow-circle-right"></i></a>
                 </div>
             </div>

             <div class="col-lg-3 col-6">
                 <!-- small box -->
                 <div class="small-box bg-lightblue">
                     <div class="inner">
                         <?php $stud_count = mysqli_query($conn, "SELECT count(student_id) AS total_stud FROM tbl_schoolyears
                         WHERE ay_id = '$ay_id' AND semester_id = '$sem_id' AND remark = 'Approved' AND strand_id = '1' AND grade_level_id = '14'") or die(mysqli_error($conn));
                            while ($row = mysqli_fetch_array($stud_count)) { ?>
                         <h3 class="text-white"><?php echo $row['total_stud']; ?></h3>
                         <?php } ?>

                         <p><small>Total No. of Enrolled</small> Grade 11 Students <br> in (ABM)</p>
                     </div>
                     <div class="icon">
                         <i class="fas fa-chart-line"></i>
                     </div>
                     <a href="list.enrolledABM11.php" class="small-box-footer">View Details <i
                             class="fas fa-arrow-circle-right"></i></a>
                 </div>
             </div>

             <div class="col-lg-3 col-6">
                 <!-- small box -->
                 <div class="small-box bg-lightblue">
                     <div class="inner">
                         <?php $stud_count = mysqli_query($conn, "SELECT count(student_id) AS total_stud FROM tbl_schoolyears
                         WHERE ay_id = '$ay_id' AND semester_id = '$sem_id' AND remark = 'Approved' AND strand_id = '1' AND grade_level_id = '15'") or die(mysqli_error($conn));
                            while ($row = mysqli_fetch_array($stud_count)) { ?>
                         <h3 class="text-white"><?php echo $row['total_stud']; ?></h3>
                         <?php } ?>

                         <p><small>Total No. of Enrolled</small> Grade 12 Students <br> in (ABM)</p>
                     </div>
                     <div class="icon">
                         <i class="fas fa-chart-line"></i>
                     </div>
                     <a href="list.enrolledABM12.php" class="small-box-footer">View Details <i
                             class="fas fa-arrow-circle-right"></i></a>
                 </div>
             </div>

             <div class="col-lg-3 col-6">
                 <div class="small-box bg-maroon">
                     <div class="inner">
                         <?php $str_count = mysqli_query($conn, "SELECT count(student_id) AS total_stud FROM tbl_schoolyears
                         WHERE ay_id = '$ay_id' AND remark = 'Approved' AND strand_id = '2' AND grade_level_id = '14' ") or die(mysqli_error($conn));
                            while ($row = mysqli_fetch_array($str_count)) { ?>
                         <h3 class="text-white"><?php echo $row['total_stud']; ?></h3>
                         <?php } ?>

                         <p><small>Total No. of</small> Enrolled Grade 11 Students <br> in (GAS)</p>
                     </div>
                     <div class="icon">
                         <i class="fab fa-black-tie"></i>
                     </div>
                     <a href="list.EnrolledGASg11.php" class="small-box-footer">View Details <i
                             class="fas fa-arrow-circle-right"></i></a>
                 </div>
             </div>


             <div class="col-lg-3 col-6">
                 <!-- small box -->
                 <div class="small-box bg-maroon">
                     <div class="inner">
                         <?php $str_count = mysqli_query($conn, "SELECT count(student_id) AS total_stud FROM tbl_schoolyears
                         WHERE ay_id = '$ay_id' AND remark = 'Approved' AND strand_id = '2' AND grade_level_id = '15' ") or die(mysqli_error($conn));
                            while ($row = mysqli_fetch_array($str_count)) { ?>
                         <h3 class="text-white"><?php echo $row['total_stud']; ?></h3>
                         <?php } ?>

                         <p><small>Total No. of</small> Enrolled Grade 12 Students <br> in (GAS)</p>
                     </div>
                     <div class="icon">
                         <i class="fab fa-black-tie"></i>
                     </div>
                     <a href="list.EnrolledGASg12.php" class="small-box-footer">View Details <i
                             class="fas fa-arrow-circle-right"></i></a>
                 </div>
             </div>

             <div class="col-lg-3 col-6">
                 <!-- small box -->
                 <div class="small-box bg-purple">
                     <div class="inner">
                         <?php $stud_count = mysqli_query($conn, "SELECT count(student_id) AS total_stud FROM tbl_schoolyears
                         WHERE ay_id = '$ay_id' AND semester_id = '$sem_id' AND remark = 'Approved' AND strand_id = '3' AND grade_level_id = '14' ") or die(mysqli_error($conn));
                            while ($row = mysqli_fetch_array($stud_count)) { ?>
                         <h3 class="text-white"><?php echo $row['total_stud']; ?></h3>
                         <?php } ?>

                         <p><small>Total No. of</small> Enrolled Students<br>in Grade 11 HUMSS</p>
                     </div>
                     <div class="icon">
                         <i class="fas fa-balance-scale"></i>
                     </div>
                     <a href="db.g11humss.student.php" class="small-box-footer">View Details <i
                             class="fas fa-arrow-circle-right"></i></a>
                 </div>
             </div>
             <div class="col-lg-3 col-6">
                 <!-- small box -->
                 <div class="small-box bg-purple">
                     <div class="inner">
                         <?php $stud_count = mysqli_query($conn, "SELECT count(student_id) AS total_stud FROM tbl_schoolyears
                         WHERE ay_id = '$ay_id' AND semester_id = '$sem_id' AND remark = 'Approved' AND strand_id = '3' AND grade_level_id = '15' ") or die(mysqli_error($conn));
                            while ($row = mysqli_fetch_array($stud_count)) { ?>
                         <h3 class="text-white"><?php echo $row['total_stud']; ?></h3>
                         <?php } ?>

                         <p><small>Total No. of</small> Enrolled Students<br>in Grade 12 HUMSS</p>
                     </div>
                     <div class="icon">
                         <i class="fas fa-balance-scale"></i>
                     </div>
                     <a href="db.g12humss.student.php" class="small-box-footer">View Details <i
                             class="fas fa-arrow-circle-right"></i></a>
                 </div>
             </div>
             <div class="col-lg-3 col-6">
                 <!-- small box -->
                 <div class="small-box bg-navy">
                     <div class="inner">
                         <?php $stud_count = mysqli_query($conn, "SELECT count(student_id) AS total_stud FROM tbl_schoolyears
                         WHERE ay_id = '$ay_id' AND semester_id = '$sem_id' AND remark = 'Approved' AND strand_id = '5' AND grade_level_id = '14' ") or die(mysqli_error($conn));
                            while ($row = mysqli_fetch_array($stud_count)) { ?>
                         <h3 class="text-white"><?php echo $row['total_stud']; ?></h3>
                         <?php } ?>

                         <p><small>Total No. of</small> Enrolled Students<br>in Grade 11 TVL - HE</p>
                     </div>
                     <div class="icon">
                         <i class="fas fa-utensils"></i>
                     </div>
                     <a href="db.g11tvl.student.php" class="small-box-footer">View Details <i
                             class="fas fa-arrow-circle-right"></i></a>
                 </div>
             </div>
             <div class="col-lg-3 col-6">
                 <!-- small box -->
                 <div class="small-box bg-navy">
                     <div class="inner">
                         <?php $stud_count = mysqli_query($conn, "SELECT count(student_id) AS total_stud FROM tbl_schoolyears
                         WHERE ay_id = '$ay_id' AND semester_id = '$sem_id' AND remark = 'Approved' AND strand_id = '5' AND grade_level_id = '15' ") or die(mysqli_error($conn));
                            while ($row = mysqli_fetch_array($stud_count)) { ?>
                         <h3 class="text-white"><?php echo $row['total_stud']; ?></h3>
                         <?php } ?>

                         <p><small>Total No. of</small> Enrolled Students<br>in Grade 12 TVL - HE</p>
                     </div>
                     <div class="icon">
                         <i class="fas fa-utensils"></i>
                     </div>
                     <a href="db.g12tvl.student.php" class="small-box-footer">View Details <i
                             class="fas fa-arrow-circle-right"></i></a>
                 </div>
             </div>

             <div class="col-lg-3 col-6">
             </div>
             <div class="col-lg-3 col-6">
             </div>

             <div class="col-lg-3 col-6">
                 <div class="small-box bg-blue">
                     <div class="inner">
                         <?php $stud_count = mysqli_query($conn, "SELECT count(student_id) AS total_stud FROM tbl_schoolyears
                         WHERE ay_id = '$ay_id' AND remark = 'Approved' AND grade_level_id = '13' ") or die(mysqli_error($conn));
                            while ($row = mysqli_fetch_array($stud_count)) { ?>
                         <h3><?php echo $row['total_stud']; ?></h3>
                         <?php } ?>
                         <p><small>Total No. of</small> Enrolled Students <br> in Grade 10</p>
                     </div>
                     <div class="icon">
                         <i class="fas fa-book-reader"></i>
                     </div>
                     <a href="list.enrolledG10.php" class="small-box-footer">View Details <i
                             class="fas fa-arrow-circle-right"></i></a>
                 </div>
             </div>

             <div class="col-lg-3 col-6">
                 <div class="small-box bg-blue">
                     <div class="inner">
                         <?php $stud_count = mysqli_query($conn, "SELECT count(student_id) AS total_stud FROM tbl_schoolyears
                         WHERE ay_id = '$ay_id' AND remark = 'Approved' AND grade_level_id = '12' ") or die(mysqli_error($conn));
                            while ($row = mysqli_fetch_array($stud_count)) { ?>
                         <h3><?php echo $row['total_stud']; ?></h3>
                         <?php } ?>
                         <p><small>Total No. of</small> Enrolled Students <br> in Grade 9</p>
                     </div>
                     <div class="icon">
                         <i class="fas fa-book-reader"></i>
                     </div>
                     <a href="list.enrolledG9.php" class="small-box-footer">View Details <i
                             class="fas fa-arrow-circle-right"></i></a>
                 </div>
             </div>


             <div class="col-lg-3 col-6">
                 <div class="small-box bg-blue">
                     <div class="inner">
                         <?php $stud_count = mysqli_query($conn, "SELECT count(student_id) AS total_stud FROM tbl_schoolyears
                         WHERE ay_id = '$ay_id' AND remark = 'Approved' AND grade_level_id = '11' ") or die(mysqli_error($conn));
                            while ($row = mysqli_fetch_array($stud_count)) { ?>
                         <h3><?php echo $row['total_stud']; ?></h3>
                         <?php } ?>
                         <p><small>Total No. of</small> Enrolled Students <br> in Grade 8</p>
                     </div>
                     <div class="icon">
                         <i class="fas fa-book-reader"></i>
                     </div>
                     <a href="list.enrolledG8.php" class="small-box-footer">View Details <i
                             class="fas fa-arrow-circle-right"></i></a>
                 </div>
             </div>

             <div class="col-lg-3 col-6">
                 <div class="small-box bg-blue">
                     <div class="inner">
                         <?php $stud_count = mysqli_query($conn, "SELECT count(student_id) AS total_stud FROM tbl_schoolyears
                         WHERE ay_id = '$ay_id' AND remark = 'Approved' AND grade_level_id = '10' ") or die(mysqli_error($conn));
                            while ($row = mysqli_fetch_array($stud_count)) { ?>
                         <h3><?php echo $row['total_stud']; ?></h3>
                         <?php } ?>
                         <p><small>Total No. of</small> Enrolled Students <br> in Grade 7</p>
                     </div>
                     <div class="icon">
                         <i class="fas fa-book-reader"></i>
                     </div>
                     <a href="list.enrolledG7.php" class="small-box-footer">View Details <i
                             class="fas fa-arrow-circle-right"></i></a>
                 </div>
             </div>

             <div class="col-lg-3 col-6">
                 <div class="small-box bg-blue">
                     <div class="inner">
                         <?php $stud_count = mysqli_query($conn, "SELECT count(student_id) AS total_stud FROM tbl_schoolyears
                         WHERE ay_id = '$ay_id' AND remark = 'Approved' AND grade_level_id = '9' ") or die(mysqli_error($conn));
                            while ($row = mysqli_fetch_array($stud_count)) { ?>
                         <h3><?php echo $row['total_stud']; ?></h3>
                         <?php } ?>
                         <p><small>Total No. of</small> Enrolled Students <br> in Grade 6</p>
                     </div>
                     <div class="icon">
                         <i class="fas fa-book-reader"></i>
                     </div>
                     <a href="list.enrolledG6.php" class="small-box-footer">View Details <i
                             class="fas fa-arrow-circle-right"></i></a>
                 </div>
             </div>

             <div class="col-lg-3 col-6">
                 <!-- small box -->
                 <div class="small-box bg-primary">
                     <div class="inner">
                         <?php $str_count = mysqli_query($conn, "SELECT count(student_id) AS total_stud FROM tbl_schoolyears
                         WHERE ay_id = '$ay_id' AND remark = 'Approved' AND grade_level_id = '8' ") or die(mysqli_error($conn));
                            while ($row = mysqli_fetch_array($str_count)) { ?>
                         <h3 class="text-white"><?php echo $row['total_stud']; ?></h3>
                         <?php } ?>

                         <p><small>Total No. of</small> Enrolled Students <br>in Grade 5</p>
                     </div>
                     <div class="icon">
                         <i class="fas fa-book-reader"></i>
                     </div>
                     <a href="list.Enrolledg5.php" class="small-box-footer">View Details <i
                             class="fas fa-arrow-circle-right"></i></a>
                 </div>
             </div>

             <div class="col-lg-3 col-6">
                 <!-- small box -->
                 <div class="small-box bg-primary">
                     <div class="inner">
                         <?php $str_count = mysqli_query($conn, "SELECT count(student_id) AS total_stud FROM tbl_schoolyears
                         WHERE ay_id = '$ay_id' AND remark = 'Approved' AND grade_level_id = '7' ") or die(mysqli_error($conn));
                            while ($row = mysqli_fetch_array($str_count)) { ?>
                         <h3 class="text-white"><?php echo $row['total_stud']; ?></h3>
                         <?php } ?>

                         <p><small>Total No. of</small> Enrolled Students <br>in Grade 4</p>
                     </div>
                     <div class="icon">
                         <i class="fas fa-book-reader"></i>
                     </div>
                     <a href="list.Enrolledg4.php" class="small-box-footer">View Details <i
                             class="fas fa-arrow-circle-right"></i></a>
                 </div>
             </div>

             <div class="col-lg-3 col-6">
                 <!-- small box -->
                 <div class="small-box bg-blue">
                     <div class="inner">
                         <?php $str_count = mysqli_query($conn, "SELECT count(student_id) AS total_stud FROM tbl_schoolyears
                         WHERE ay_id = '$ay_id' AND remark = 'Approved' AND grade_level_id = '6' ") or die(mysqli_error($conn));
                            while ($row = mysqli_fetch_array($str_count)) { ?>
                         <h3 class="text-white"><?php echo $row['total_stud']; ?></h3>
                         <?php } ?>

                         <p><small>Total No. of</small> Enrolled Students <br>in Grade 3</p>
                     </div>
                     <div class="icon">
                         <i class="fas fa-book-reader"></i>
                     </div>
                     <a href="list.Enrolledg3.php" class="small-box-footer">View Details <i
                             class="fas fa-arrow-circle-right"></i></a>
                 </div>
             </div>

             <div class="col-lg-3 col-6">
                 <!-- small box -->
                 <div class="small-box bg-blue">
                     <div class="inner">
                         <?php $stud_count = mysqli_query($conn, "SELECT count(student_id) AS total_stud FROM tbl_schoolyears
                         WHERE ay_id = '$ay_id' AND remark = 'Approved' AND grade_level_id = '5' ") or die(mysqli_error($conn));
                            while ($row = mysqli_fetch_array($stud_count)) { ?>
                         <h3 class="text-white"><?php echo $row['total_stud']; ?></h3>
                         <?php } ?>

                         <p><small>Total No. of</small> Enrolled Students<br>in Grade 2</p>
                     </div>
                     <div class="icon">
                         <i class="fas fa-book-reader"></i>
                     </div>
                     <a href="db.g2student.php" class="small-box-footer">View Details <i
                             class="fas fa-arrow-circle-right"></i></a>
                 </div>
             </div>

             <div class="col-lg-3 col-6">
                 <!-- small box -->
                 <div class="small-box bg-blue">
                     <div class="inner">
                         <?php $stud_count = mysqli_query($conn, "SELECT count(student_id) AS total_stud FROM tbl_schoolyears
                         WHERE ay_id = '$ay_id' AND remark = 'Approved' AND grade_level_id = '4' ") or die(mysqli_error($conn));
                            while ($row = mysqli_fetch_array($stud_count)) { ?>
                         <h3 class="text-white"><?php echo $row['total_stud']; ?></h3>
                         <?php } ?>

                         <p><small>Total No. of</small> Enrolled Students<br>in Grade 1</p>
                     </div>
                     <div class="icon">
                         <i class="fas fa-book-reader"></i>
                     </div>
                     <a href="db.g1student.php" class="small-box-footer">View Details <i
                             class="fas fa-arrow-circle-right"></i></a>
                 </div>
             </div>

             <div class="col-lg-3 col-6">
             </div>
             <div class="col-lg-3 col-6">
             </div>

             <div class="col-lg-3 col-6">
                 <!-- small box -->
                 <div class="small-box bg-pink">
                     <div class="inner">
                         <?php $stud_count = mysqli_query($conn, "SELECT count(student_id) AS total_stud FROM tbl_schoolyears
                         WHERE ay_id = '$ay_id' AND semester_id = '0' AND remark = 'Approved' AND grade_level_id = '3'") or die(mysqli_error($conn));
                            while ($row = mysqli_fetch_array($stud_count)) { ?>
                         <h3 class="text-white"><?php echo $row['total_stud']; ?></h3>
                         <?php } ?>

                         <p><small>Total No. of</small> Enrolled Students <br> in (Kinder)</p>
                     </div>
                     <div class="icon">
                         <i class="fas fa-book-reader"></i>
                     </div>
                     <a href="list.enrolledKinder.php" class="small-box-footer">View Details <i
                             class="fas fa-arrow-circle-right"></i></a>
                 </div>
             </div>

             <div class="col-lg-3 col-6">
                 <!-- small box -->
                 <div class="small-box bg-pink">
                     <div class="inner">
                         <?php $stud_count = mysqli_query($conn, "SELECT count(student_id) AS total_stud FROM tbl_schoolyears
                         WHERE ay_id = '$ay_id' AND semester_id = '0' AND remark = 'Approved' AND grade_level_id = '2'") or die(mysqli_error($conn));
                            while ($row = mysqli_fetch_array($stud_count)) { ?>
                         <h3 class="text-white"><?php echo $row['total_stud']; ?></h3>
                         <?php } ?>

                         <p><small>Total No. of</small> Enrolled Students <br> in (Pre-kinder)</p>
                     </div>
                     <div class="icon">
                         <i class="fas fa-book-reader"></i>
                     </div>
                     <a href="list.enrolledPreK.php" class="small-box-footer">View Details <i
                             class="fas fa-arrow-circle-right"></i></a>
                 </div>
             </div>

             <div class="col-lg-3 col-6">
                 <!-- small box -->
                 <div class="small-box bg-pink">
                     <div class="inner">
                         <?php $stud_count = mysqli_query($conn, "SELECT count(student_id) AS total_stud FROM tbl_schoolyears
                         WHERE ay_id = '$ay_id' AND semester_id = '0' AND remark = 'Approved' AND grade_level_id = '1'") or die(mysqli_error($conn));
                            while ($row = mysqli_fetch_array($stud_count)) { ?>
                         <h3 class="text-white"><?php echo $row['total_stud']; ?></h3>
                         <?php } ?>

                         <p><small>Total No. of</small> Enrolled Students <br> in (Nursery)</p>
                     </div>
                     <div class="icon">
                         <i class="fas fa-book-reader"></i>
                     </div>
                     <a href="list.enrolledNurs.php" class="small-box-footer">View Details <i
                             class="fas fa-arrow-circle-right"></i></a>
                 </div>
             </div>

         </div>
         <!-- /.row -->
         <!-- Main row -->

         <!-- /.row (main row) -->
     </div><!-- /.container-fluid -->
 </section>
 <!-- /.content -->