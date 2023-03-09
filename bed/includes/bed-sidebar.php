<!-- Main Sidebar Container -->
<aside class="main-sidebar main-sidebar-custom sidebar-dark-red elevation-4">
    <!-- Brand Logo -->
    <a href="../bed-dashboard/index.php" class="brand-link text-md text-light pt-3 pb-3">
        <img src="../../../assets/img/logo.png" alt="SFAC Logo" class="brand-image img-circle elevation-3"
            style="opacity: .9">
        <span class="brand-text font-weight-light">SFAC Bacoor</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel pt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <?php
                if ($_SESSION['role'] == "Master Key") {
                    $get_user = mysqli_query($conn, "SELECT * FROM tbl_master_key WHERE mk_id = '$mk_id'");
                    while ($row = mysqli_fetch_array($get_user)) {
                        echo '<img src="data:image/jpeg;base64,' . base64_encode($row['img']) . '" class="img-circle elevation-2 zoom" alt="User image" style="width: 39px; height: 39px;">
                        </div>
                    <div class="info">
                     <a class="d-block">' . $row['name'];
                    }
                } elseif ($_SESSION['role'] == "Registrar") {
                    $get_user = mysqli_query($conn, "SELECT *, CONCAT(tbl_registrars.reg_lname, ', ', tbl_registrars.reg_fname, ' ', LEFT(tbl_registrars.reg_mname,1), '.' ) AS fullname FROM tbl_registrars WHERE reg_id = '$reg_id'");
                    while ($row = mysqli_fetch_array($get_user)) {
                        echo '<img src="data:image/jpeg;base64,' . base64_encode($row['img']) . '" class="img-circle elevation-2 zoom" alt="User image" style="width: 39px; height: 39px;">
                        </div>
                    <div class="info">
                     <a class="d-block">' . $row['fullname'];
                    }
                } elseif ($_SESSION['role'] == "Principal") {
                    $get_user = mysqli_query($conn, "SELECT *, CONCAT(tbl_principals.prin_lname, ', ', tbl_principals.prin_fname, ' ', LEFT(tbl_principals.prin_mname,1), '.') AS fullname FROM tbl_principals WHERE prin_id = '$prin_id'");
                    while ($row = mysqli_fetch_array($get_user)) {
                        echo '<img src="data:image/jpeg;base64,' . base64_encode($row['img']) . '" class="img-circle elevation-2 zoom" alt="User image" style="width: 39px; height: 39px;">
                        </div>
                    <div class="info">
                     <a class="d-block">' . $row['fullname'];
                    }
                } elseif ($_SESSION['role'] == "Accounting") {
                    $get_user = mysqli_query($conn, "SELECT *, CONCAT(tbl_accountings.accounting_lname, ', ', tbl_accountings.accounting_fname, ' ', LEFT(tbl_accountings.accounting_mname,1), '.') AS fullname FROM tbl_accountings WHERE acc_id = '$acc_id'");
                    while ($row = mysqli_fetch_array($get_user)) {
                        echo '<img src="data:image/jpeg;base64,' . base64_encode($row['img']) . '" class="img-circle elevation-2 zoom" alt="User image" style="width: 39px; height: 39px;">
                        </div>
                    <div class="info">
                     <a class="d-block">' . $row['fullname'];
                    }
                } elseif ($_SESSION['role'] == "Admission") {
                    $get_user = mysqli_query($conn, "SELECT *, CONCAT(tbl_admissions.admission_lname, ', ', tbl_admissions.admission_fname, ' ', LEFT(tbl_admissions.admission_mname,1), '.') AS fullname FROM tbl_admissions WHERE admission_id = '$admission_id'");
                    while ($row = mysqli_fetch_array($get_user)) {
                        echo '<img src="data:image/jpeg;base64,' . base64_encode($row['img']) . '" class="img-circle elevation-2 zoom" alt="User image" style="width: 39px; height: 39px;">
                        </div>
                    <div class="info">
                     <a class="d-block">' . $row['fullname'];
                    }
                } elseif ($_SESSION['role'] == "Teacher") {
                    $get_user = mysqli_query($conn, "SELECT *, CONCAT(tbl_teachers.teacher_lname, ', ', tbl_teachers.teacher_fname, ' ', LEFT(tbl_teachers.teacher_mname,1), '.') AS fullname FROM tbl_teachers WHERE teacher_id = '$teacher_id'");
                    while ($row = mysqli_fetch_array($get_user)) {
                        echo '<img src="data:image/jpeg;base64,' . base64_encode($row['img']) . '" class="img-circle elevation-2 zoom" alt="User image" style="width: 39px; height: 39px;">
                        </div>
                    <div class="info">
                     <a class="d-block">' . $row['fullname'];
                    }
                } elseif ($_SESSION['role'] == "Adviser") {
                    $get_user = mysqli_query($conn, "SELECT *, CONCAT(tbl_adviser.ad_lname, ', ', tbl_adviser.ad_fname, ' ', LEFT(tbl_adviser.ad_mname,1), '.') AS fullname FROM tbl_adviser WHERE ad_id = '$ad_id'");
                    while ($row = mysqli_fetch_array($get_user)) {
                        echo '<img src="data:image/jpeg;base64,' . base64_encode($row['img']) . '" class="img-circle elevation-2 zoom" alt="User image" style="width: 39px; height: 39px;">
                        </div>
                    <div class="info">
                    <a class="d-block">' . $row['fullname'];
                    }
                } elseif ($_SESSION['role'] == "Student") {
                    $get_user = mysqli_query($conn, "SELECT *, CONCAT(tbl_students.student_lname, ', ', tbl_students.student_fname, ' ', LEFT(tbl_students.student_mname,1), '.') AS fullname FROM tbl_students WHERE student_id = '$stud_id'");
                    while ($row = mysqli_fetch_array($get_user)) {
                        if (empty(base64_encode($row['img']))) {
                            echo '<img src="../../../assets/img/red_user.jpg" class="img-circle elevation-2 zoom" alt="User image" style="width: 39px; height: 39px;">
                            </div>';
                        } else {
                            echo '<img src="data:image/jpeg;base64,' . base64_encode($row['img']) . '" class="img-circle elevation-2 zoom" alt="User image" style="width: 39px; height: 39px;">
                        </div>';
                        }
                        if (empty($row['student_lname'])) {
                            echo '<div class="info">
                            <a class="d-block">' . $row['stud_no'];
                        } else {
                            echo '
                    <div class="info">
                    <a class="d-block">' . $row['fullname'];
                        }
                    }
                } ?>


                </a>
                <p class="mb-0 text-sm text-white-50"><em>(<?php echo $_SESSION['role'] ?>)</em></p>
            </div>
        </div>

        <!-- SidebarSearch Form -->
        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

                <!-- MASTER KEY SIDEBAR -->
                <?php
                if ($_SESSION['role'] == "Master Key") {
                    echo '<li class="nav-item menu-open">
                    <a href="../bed-dashboard/index.php" id="loadfile" class="nav-link active">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="../bed-master_key/list.principal.php" class="nav-link">
                        <i class="nav-icon fas fa-table"></i>
                        <p>
                            Principals List
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="../bed-master_key/list.registrar.php" class="nav-link">
                        <i class="nav-icon fas fa-table"></i>
                        <p>
                            Registrars List
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="../bed-master_key/list.accounting.php" class="nav-link">
                        <i class="nav-icon fas fa-table"></i>
                        <p>
                            Accounting List
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="../bed-master_key/list.admission.php" class="nav-link">
                        <i class="nav-icon fas fa-table"></i>
                        <p>
                            Admission List
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="../bed-master_key/list.adviser.php" class="nav-link">
                        <i class="nav-icon fas fa-table"></i>
                        <p>
                            Advisers List
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="../bed-master_key/list.teacher.php" class="nav-link">
                        <i class="nav-icon fas fa-table"></i>
                        <p>
                            Teachers List
                        </p>
                    </a>
                </li>
                <li class="nav-header">ADD NEW USER</li>
                <li class="nav-item">
                    <a href="../bed-master_key/add.principal.php" class="nav-link">
                        <i class="nav-icon fas fa-user-plus"></i>
                        <p>
                            Add Principal
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="../bed-master_key/add.registrar.php" class="nav-link">
                        <i class="nav-icon fas fa-user-plus"></i>
                        <p>
                            Add Registrar
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="../bed-master_key/add.accounting.php" class="nav-link">
                        <i class="nav-icon fas fa-user-plus"></i>
                        <p>
                            Add Accounting
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="../bed-master_key/add.admission.php" class="nav-link">
                        <i class="nav-icon fas fa-user-plus"></i>
                        <p>
                            Add Admission
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="../bed-master_key/add.adviser.php" class="nav-link">
                        <i class="nav-icon fas fa-user-plus"></i>
                        <p>
                            Add Adviser
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="../bed-master_key/add.teacher.php" class="nav-link">
                        <i class="nav-icon fas fa-user-plus"></i>
                        <p>
                            Add Teacher
                        </p>
                    </a>
                </li>';


                    // END OF MASTER KEY


                } elseif ($_SESSION['role'] == "Registrar") {
                    echo '<li class="nav-item menu-open">
                    <a href="../bed-dashboard/index.php" id="loadfile" class="nav-link active">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-sign-in-alt"></i>
                        <p>
                            Enrollment
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="../bed-student/list.enrolledStud.php" class="nav-link">
                                <i class="fa fa-list-alt nav-icon"> </i>
                                <p>
                                    Confirmed Students
                                </p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-cog"></i>
                        <p>
                            Maintenance
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="../bed-student/list.student.php" class="nav-link">
                                <i class="fa fa-restroom nav-icon"></i>
                                <p> Student List</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="../bed-master_key/list.adviser.php" class="nav-link">
                                <i class="fas fa-chalkboard nav-icon"></i>
                                <p>
                                    Adviser List
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-book"></i>
                                <p>
                                    Subjects List
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="../bed-subjects/list.subjectSH.php" class="nav-link">
                                        <i class="fa fa-list-alt nav-icon"></i>
                                        <p> Senior</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="../bed-subjects/list.subjectPJH.php" class="nav-link">
                                        <i class="fa fa-list-alt nav-icon"></i>
                                        <p> Primary - Junior</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </li>

                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-folder"></i>
                        <p>
                            Forms
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="../bed-forms/pre-en-plain.php" class="nav-link">
                                <i class="fa fa-file-pdf nav-icon"></i>
                                <p> Pre-Enrollment</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="../bed-forms/allformsnodata.php" class="nav-link">
                                <i class="fa fa-file-pdf nav-icon"></i>
                                <p> Reg Form</p>
                            </a>
                        </li>

                    </ul>
                </li>

                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-binoculars"></i>
                        <p>
                            View Subjects
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>

                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="../bed-hedCurr/abm.php" class="nav-link">
                                <i class="fa fa-file-alt nav-icon"> </i>
                                <p class="ml-1"> ABM</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="../bed-hedCurr/gas.php" class="nav-link">
                                <i class="fa fa-file-alt nav-icon"> </i>
                                <p class="ml-1"> GAS</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="../bed-hedCurr/humss.php" class="nav-link">
                                <i class="fa fa-file-alt nav-icon"> </i>
                                <p class="ml-1"> HUMSS</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="../bed-hedCurr/stem.php" class="nav-link">
                                <i class="fa fa-file-alt nav-icon"> </i>
                                <p class="ml-1"> STEM</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="../bed-hedCurr/tvl.php" class="nav-link">
                                <i class="fa fa-file-alt nav-icon"> </i>
                                <p class="ml-1"> TVL</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-file-medical"></i>
                        <p>
                            Data Entry
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="../bed-student/add.student.php" class="nav-link">
                                <i class="fa fa-user-plus nav-icon"></i>
                                <p> Add Students</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="../bed-master_key/add.adviser.php" class="nav-link">
                                <i class="fa fa-user-plus nav-icon"></i>
                                <p>
                                    Add Adviser
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="../bed-master_key/add.adviser.php" class="nav-link">
                                <i class="fa fa-user-plus nav-icon"></i>
                                <p>
                                    Add Sections
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="fa fa-book-medical nav-icon"></i>
                                <p>
                                    Add Subjects
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="../bed-subjects/add.sub.senior.php" class="nav-link">
                                        <i class="fa fa-plus nav-icon"></i>
                                        <p> Senior</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="../bed-subjects/add.sub.k-10.php" class="nav-link">
                                        <i class="fa fa-plus nav-icon"></i>
                                        <p> Primary - Junior</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </li>
                ';
                }

                // END REGISTRAR


                elseif ($_SESSION['role'] == "Principal") {
                    echo '
                <li class="nav-item menu-open">
                    <a href="../bed-dashboard/index.php" id="loadfile" class="nav-link active">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="../bed-principal/list.adviser.php" class="nav-link">
                        <i class="nav-icon fas fa-table"></i>
                        <p>
                            Advisers List
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="../bed-principal/list.teacher.php" class="nav-link">
                        <i class="nav-icon fas fa-table"></i>
                        <p>
                            Teachers List
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-binoculars"></i>
                        <p>
                            View Subjects
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>

                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="../bed-hedCurr/abm.php" class="nav-link">
                                <i class="fa fa-file-alt nav-icon"> </i>
                                <p class="ml-1"> ABM</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="../bed-hedCurr/gas.php" class="nav-link">
                                <i class="fa fa-file-alt nav-icon"> </i>
                                <p class="ml-1"> GAS</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="../bed-hedCurr/humss.php" class="nav-link">
                                <i class="fa fa-file-alt nav-icon"> </i>
                                <p class="ml-1"> HUMSS</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="../bed-hedCurr/stem.php" class="nav-link">
                                <i class="fa fa-file-alt nav-icon"> </i>
                                <p class="ml-1"> STEM</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="../bed-hedCurr/tvl.php" class="nav-link">
                                <i class="fa fa-file-alt nav-icon"> </i>
                                <p class="ml-1"> TVL</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-header">ADD NEW USER</li>
                <li class="nav-item">
                    <a href="../bed-principal/add.adviser.php" class="nav-link">
                        <i class="nav-icon fas fa-user-plus"></i>
                        <p>
                            Add Adviser
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="../bed-principal/add.teacher.php" class="nav-link">
                        <i class="nav-icon fas fa-user-plus"></i>
                        <p>
                            Add Teacher
                        </p>
                    </a>
                </li>';
                } elseif ($_SESSION['role'] == "Admission") {
                    echo '<li class="nav-item menu-open">
                    <a href="../bed-dashboard/index.php" id="loadfile" class="nav-link active">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-tasks"></i>
                        <p>
                            Enrollment
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="../bed-student/list.enrolledStud.php" class="nav-link">
                                <i class="fa fa-ellipsis-h nav-icon"> </i>
                                <p>
                                    Pending Students
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="../bed-online-enrollment/online_list.php" class="nav-link">
                                <i class="fas fa-globe-asia nav-icon"> </i>
                                <p>
                                    Online Inquiries
                                </p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-cog"></i>
                        <p>
                            Maintenance
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="../bed-student/list.student.php" class="nav-link">
                                <i class="fa fa-restroom nav-icon"></i>
                                <p> Student List</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-file-medical"></i>
                        <p>
                            Data Entry
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="../bed-student/add.student.php" class="nav-link">
                                <i class="fa fa-user-plus nav-icon"></i>
                                <p> Add Students</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-clock"></i>
                        <p>
                            Class Schedule
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="../bed-schedules/list.subSchedSH.php" class="nav-link">
                                <i class="fa fa-list-alt nav-icon"> </i>
                                <p>
                                    Senior
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="../bed-schedules/list.subSchedPJH.php" class="nav-link">
                                <i class="fa fa-list-alt nav-icon"> </i>
                                <p>
                                    Primary - Junior
                                </p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-hand-holding-medical"></i>
                        <p>
                            Offer/Open Subjects
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="../bed-subjects/list.offerSubSH.php" class="nav-link">
                                <i class="fa fa-list-alt nav-icon"> </i>
                                <p>
                                    Senior
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="../bed-subjects/list.offerSubPJH.php" class="nav-link">
                                <i class="fa fa-list-alt nav-icon"> </i>
                                <p>
                                    Primary - Junior
                                </p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-binoculars"></i>
                        <p>
                            View Subjects
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>

                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="../bed-hedCurr/abm.php" class="nav-link">
                                <i class="fa fa-file-alt nav-icon"> </i>
                                <p class="ml-1"> ABM</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="../bed-hedCurr/gas.php" class="nav-link">
                                <i class="fa fa-file-alt nav-icon"> </i>
                                <p class="ml-1"> GAS</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="../bed-hedCurr/humss.php" class="nav-link">
                                <i class="fa fa-file-alt nav-icon"> </i>
                                <p class="ml-1"> HUMSS</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="../bed-hedCurr/stem.php" class="nav-link">
                                <i class="fa fa-file-alt nav-icon"> </i>
                                <p class="ml-1"> STEM</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="../bed-hedCurr/tvl.php" class="nav-link">
                                <i class="fa fa-file-alt nav-icon"> </i>
                                <p class="ml-1"> TVL</p>
                            </a>
                        </li>
                    </ul>
                </li>
                ';
                    // END ADMISSION

                } elseif ($_SESSION['role'] == "Accounting") {
                    echo '<li class="nav-item menu-open">
                    <a href="../bed-dashboard/index.php" id="loadfile" class="nav-link active">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-sign-in-alt"></i>
                        <p>
                            Enrollment
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="../bed-student/list.enrolledStud.php" class="nav-link">
                                <i class="fa fa-list-alt nav-icon"> </i>
                                <p>
                                    Confirmed Students
                                </p>
                            </a>
                        </li>
                    </ul>
                </li>

                ';

                    //END ACCOUNTING


                } elseif ($_SESSION['role'] == "Teacher") {
                    echo '<li class="nav-item menu-open">
                    <a href="../bed-dashboard/index.php" id="loadfile" class="nav-link active">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>';
                } elseif ($_SESSION['role'] == "Adviser") {
                    echo '<li class="nav-item menu-open">
                    <a href="../bed-dashboard/index.php" id="loadfile" class="nav-link active">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-tasks"></i>
                        <p>
                            Enrollment
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="../bed-student/list.enrolledStud.php" class="nav-link">
                                <i class="fa fa-ellipsis-h nav-icon"> </i>
                                <p>
                                    Pending Students
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="../bed-online-enrollment/online_list.php" class="nav-link">
                                <i class="fas fa-globe-asia nav-icon"> </i>
                                <p>
                                    Online Inquiries
                                </p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-cog"></i>
                        <p>
                            Maintenance
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="../bed-student/list.student.php" class="nav-link">
                                <i class="fa fa-restroom nav-icon"></i>
                                <p> Students List</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="../bed-master_key/list.teacher.php" class="nav-link">
                                <i class="fas fa-chalkboard nav-icon"></i>
                                <p>
                                    Teacher List
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-book"></i>
                                <p>
                                    Subjects List
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="../bed-subjects/list.subjectSH.php" class="nav-link">
                                        <i class="fa fa-list-alt nav-icon"></i>
                                        <p> Senior High</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="../bed-subjects/list.subjectPJH.php" class="nav-link">
                                        <i class="fa fa-list-alt nav-icon"></i>
                                        <p> Primary - Junior High</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-folder"></i>
                        <p>
                            Forms
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="fa fa-file-pdf nav-icon"></i>
                                <p> Pre-Enrollment</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="../bed-forms/regform.php" class="nav-link">
                                <i class="fa fa-file-pdf nav-icon"></i>
                                <p> Registration</p>
                            </a>
                        </li>

                    </ul>
                </li>

                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-binoculars"></i>
                        <p>
                            View Subjects
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="../bed-hedCurr/abm.php" class="nav-link">
                                <i class="fa fa-file-alt"> </i>
                                <p> ABM</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="fa fa-file-alt"> </i>
                                <p> GAS</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="../bed-hedCurr/humss.php" class="nav-link">
                                <i class="fa fa-file-alt"> </i>
                                <p> HUMSS</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="../bed-hedCurr/stem.php" class="nav-link">
                                <i class="fa fa-file-alt"> </i>
                                <p> STEM</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="../bed-hedCurr/tvl.php" class="nav-link">
                                <i class="fa fa-file-alt"> </i>
                                <p> TVL</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-file-medical"></i>
                        <p>
                            Data Entry
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="../bed-principal/add.teacher.php" class="nav-link">
                                <i class="nav-icon fas fa-user-plus"></i>
                                <p>
                                    Add Teacher
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="../bed-student/add.student.php" class="nav-link">
                                <i class="fa fa-user-plus nav-icon"></i>
                                <p> Add Student</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="fa fa-book-medical nav-icon"></i>
                                <p>
                                    Add Subject
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="../bed-subjects/add.sub.senior.php" class="nav-link">
                                        <i class="fa fa-plus nav-icon"></i>
                                        <p> Senior High</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="../bed-subjects/add.sub.k-10.php" class="nav-link">
                                        <i class="fa fa-plus nav-icon"></i>
                                        <p> Primary - Junior High</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </li>
            </ul>

            ';
                } elseif ($_SESSION['role'] == "Student") {
                    echo '
            <li class="nav-item menu-open">
                <a href="../bed-dashboard/index.php" id="loadfile" class="nav-link active">
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                    <p>
                        Dashboard
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="../bed-student/edit.infoStud.php" class="nav-link">
                    <i class="nav-icon fas fa-id-card"></i>
                    <p>
                        Personal Info
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="../bed-student/add.enroll.php" class="nav-link">
                    <i class="nav-icon fas fa-globe"></i>
                    <p>';
                    $get_active_sem = mysqli_query($conn, "SELECT * FROM tbl_active_semesters");
                    while ($row = mysqli_fetch_array($get_active_sem)) {
                        $sem = $row['semester_id'];
                    }
                    $get_active_acad = mysqli_query($conn, "SELECT * FROM tbl_active_acadyears");
                    while ($row = mysqli_fetch_array($get_active_acad)) {
                        $acad = $row['ay_id'];
                    }
                    $get_level_id = mysqli_query($conn, "SELECT * FROM tbl_schoolyears
                        WHERE student_id = '$stud_id' AND semester_id = '0' AND ay_id = '$acad'") or
                        die(mysqli_error($conn));
                    $result = mysqli_num_rows($get_level_id);
                    if ($result > 0) {
                        echo 'Enrollment Info.</p>
                </a>
            </li>';
                    } else {

                        $get_level_id = mysqli_query($conn, "SELECT * FROM tbl_schoolyears
            WHERE student_id = '$stud_id' AND semester_id = '$sem' AND ay_id = '$acad'") or
                            die(mysqli_error($conn));
                        $result2 = mysqli_num_rows($get_level_id);

                        if ($result2 > 0) {
                            echo 'Enrollment Info.</p>
            </a>
            </li>';
                        } else {
                            echo 'Enroll Now</p>
            </a>
            </li>';
                        }
                    }
                }

                // END STUDENT
                ?>


            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->

    <!-- sidebar custom -->
    <div class="sidebar-custom justify-content-center">
        <?php if ($_SESSION['role'] == "Master Key") {
            echo ' <a href="#" class="btn btn-link ml-2"><i class="fas fa-cog text-gray"></i></a>

        <a href="../bed-master_key/edit.master.php" class="btn btn-link pos-right mr-2 text-gray" data-toggle="tooltip"
            data-placement="top" title="Edit Profile"><i class="fas fa-user-edit"></i></a>';
        } elseif ($_SESSION['role'] == "Registrar") {
            echo ' <a href="../bed-date/add.date.php" class="btn btn-link ml-1 mr-4" data-toggle="tooltip"
            data-placement="top" title="Add Academic Year"><i class="fas fa-calendar-plus text-gray"></i></a>

        <a href="../bed-date/set.date.php" class="btn btn-link ml-4 mr-auto" data-toggle="tooltip" data-placement="top"
            title="Set Academic Year & Semester"><i class="fas fa-calendar-alt text-gray"></i></a>

        <a href="../bed-master_key/edit.registrar.php?reg_id= ' . $reg_id . '"
            class="btn btn-link pos-right mr-1 text-gray" data-toggle="tooltip" data-placement="top"
            title="Edit Profile"><i class="fas fa-user-edit"></i></a>';
        } elseif ($_SESSION['role'] == "Student") {
            echo ' <a href="#" class="btn btn-link ml-2"><i class="fas fa-cog text-gray"></i></a>

        <a href="../bed-student/edit.student.php" class="btn btn-link pos-right mr-2 text-gray" data-toggle="tooltip" data-placement="top" title="Edit Profile"><i
                class="fas fa-user-edit"></i></a>';
        } elseif ($_SESSION['role'] == "Adviser") {
            echo ' <a href="../bed-date/add.date.php" class="btn btn-link ml-1 mr-4"><i class="fas fa-calendar-plus text-gray"></i></a>
            <a href="../bed-date/set.date.php" class="btn btn-link ml-4 mr-auto"><i class="fas fa-calendar-alt text-gray"></i></a>
        <a href="../bed-master_key/edit.adviser.php?ad_id= ' . $ad_id . '"
        class="btn btn-link pos-right mr-1 text-gray"><i class="fas fa-user-edit"></i></a>';
        } elseif ($_SESSION['role'] == "Principal") {
            echo ' <a href="../bed-master_key/edit.principal.php?prin_id= ' . $prin_id . '"
            class="btn btn-link pos-right mr-1 text-gray" data-toggle="tooltip" data-placement="top"
            title="Edit Profile"><i class="fas fa-user-edit"></i></a>';
        } elseif ($_SESSION['role'] == "Admission") {
            echo ' <a href="../bed-date/add.date.php" class="btn btn-link ml-1 mr-4"><i
                class="fas fa-calendar-plus text-gray" data-toggle="tooltip" data-placement="top"
                title="Add Academic Year"></i></a>
        <a href="../bed-date/set.date.php" class="btn btn-link ml-4 mr-auto"><i class="fas fa-calendar-alt text-gray"
                data-toggle="tooltip" data-placement="top" title="Set Academic Year & Semester"></i></a>
        <a href="../bed-master_key/edit.admission.php?admission_id= ' . $admission_id . '"
            class="btn btn-link pos-right mr-1 text-gray" data-toggle="tooltip" data-placement="top"
            title="Edit Profile"><i class="fas fa-user-edit"></i></a>';
        } elseif ($_SESSION['role'] == "Accounting") {
            echo ' <a href="#" class="btn btn-link ml-2"><i class="fas fa-cog text-gray"></i></a>

        <a href="../bed-master_key/edit.accounting.php?acc_id= ' . $acc_id . '"
            class="btn btn-link pos-right mr-1 text-gray" data-toggle="tooltip" data-placement="top"
            title="Edit Profile"><i class="fas fa-user
            -edit"></i></a>';
        } elseif ($_SESSION['role'] == "Teacher") {
            echo ' <a href="../bed-date/add.date.php" class="btn btn-link ml-1 mr-4" data-toggle="tooltip"
            data-placement="top" title="Add Academic Year"><i class="fas fa-calendar-plus text-gray"></i></a>
        <a href="../bed-date/set.date.php" class="btn btn-link ml-4 mr-auto" data-toggle="tooltip" data-placement="top"
            title="Set Academic Year & Semester"><i class="fas fa-calendar-alt text-gray"></i></a>
        <a href="../bed-master_key/edit.teacher.php?teacher_id= ' . $teacher_id . '"
            class="btn btn-link pos-right mr-1 text-gray" data-toggle="tooltip" data-placement="top"
            title="Edit Profile"><i class="fas fa-user-edit"></i></a>';
        }
        ?>

    </div>
    <!-- sidebar custom -->
</aside>