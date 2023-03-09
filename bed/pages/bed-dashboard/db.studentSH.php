<!-- Main content -->
<section class="content">
    <div class="container-fluid ">
        <!-- Small boxes (Stat box) -->
        <div class="row">

            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-info">
                    <div class="inner">

                        <?php
                        $get_stud =  mysqli_query($conn, "SELECT * FROM tbl_schoolyears
                        WHERE student_id = '$stud_id' AND semester_id = '$sem' AND ay_id = '$acad'") or die(mysqli_error($conn));
                        $confirm = mysqli_num_rows($get_level_id);

                        if ($confirm > 0) {
                            $get_enrolled_sub = mysqli_query($conn, "SELECT count(sub.subject_id) AS csub
                            FROM tbl_enrolled_subjects AS ensub
                            LEFT JOIN tbl_schedules AS sched ON sched.schedule_id = ensub.schedule_id
                            LEFT JOIN tbl_students AS stud ON stud.student_id = ensub.student_id
                            LEFT JOIN tbl_subjects_senior AS sub ON sub.subject_id = sched.subject_id
                            LEFT JOIN tbl_grade_levels AS gl ON gl.grade_level_id = sub.grade_level_id
                            LEFT JOIN tbl_teachers AS teach ON teach.teacher_id = sched.teacher_id
                            WHERE stud.student_id = $stud_id AND sched.semester = '$sem_n' AND sched.acadyear = '$acad_n'") or die(mysqli_error($conn));
                            while ($row = mysqli_fetch_array($get_enrolled_sub)) {
                        ?>
                        <h3><?php echo $row['csub']; ?></h3>
                        <?php }
                        } else { ?>
                        <h3>0</h3>
                        <?php } ?>
                        <p><small>Total No. of</small> Subjects</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-ios-book"></i>
                    </div>
                    <a href="db.scheduleSH.php" class="small-box-footer">View Details <i
                            class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
        </div>
        <!-- /.row -->
        <!-- Main row -->

        <!-- /.row (main row) -->
    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->