<ul class="navbar-nav ml-auto">
    <!-- CLOCK -->
    <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link disabled text-light" id="clock"></a>
    </li>

    <li class="nav-item dropdown user-menu">
        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
            <?php
            if ($_SESSION['role'] == "Registrar") {
                $get_user = mysqli_query($conn, "SELECT * FROM tbl_registrars WHERE reg_id = '$reg_id'") or
                    die(mysqli_error($conn));
                while ($row = mysqli_fetch_array($get_user)) {
                    echo '<img src="data:image/jpeg;base64,' . base64_encode($row['img']) . '"
                        class="user-image img-circle elevation-2" alt="User Image">';
                }
            } elseif ($_SESSION['role'] == "Master Key") {
                $get_user = mysqli_query($conn, "SELECT * FROM tbl_master_key WHERE mk_id = '$mk_id'") or die(mysqli_error($conn));
                while ($row = mysqli_fetch_array($get_user)) {
                    echo '<img src="data:image/jpeg;base64,' . base64_encode($row['img']) . '" class="user-image img-circle elevation-2" alt="User Image">';
                }
            } elseif ($_SESSION['role'] == "Principal") {
                $get_user = mysqli_query($conn, "SELECT * FROM tbl_principals WHERE prin_id = '$prin_id'");
                while ($row = mysqli_fetch_array($get_user)) {
                    echo '<img src="data:image/jpeg;base64,' . base64_encode($row['img']) . '" class="user-image img-circle elevation-2" alt="User Image">';
                }
            } elseif ($_SESSION['role'] == "Accounting") {
                $get_user = mysqli_query($conn, "SELECT * FROM tbl_accountings WHERE acc_id = '$acc_id'");
                while ($row = mysqli_fetch_array($get_user)) {
                    echo '<img src="data:image/jpeg;base64,' . base64_encode($row['img']) . '" class="user-image img-circle elevation-2" alt="User Image">';
                }
            } elseif ($_SESSION['role'] == "Admission") {
                $get_user = mysqli_query($conn, "SELECT * FROM tbl_admissions WHERE admission_id = '$admission_id'");
                while ($row = mysqli_fetch_array($get_user)) {
                    echo '<img src="data:image/jpeg;base64,' . base64_encode($row['img']) . '" class="user-image img-circle elevation-2" alt="User Image">';
                }
            } elseif ($_SESSION['role'] == "Teacher") {
                $get_user = mysqli_query($conn, "SELECT * FROM tbl_teachers WHERE teacher_id = '$teacher_id'");
                while ($row = mysqli_fetch_array($get_user)) {
                    echo '<img src="data:image/jpeg;base64,' . base64_encode($row['img']) . '" class="user-image img-circle elevation-2" alt="User Image">';
                }
            } elseif ($_SESSION['role'] == "Adviser") {
                $get_user = mysqli_query($conn, "SELECT * FROM tbl_adviser WHERE ad_id = '$ad_id'");
                while ($row = mysqli_fetch_array($get_user)) {
                    echo '<img src="data:image/jpeg;base64,' . base64_encode($row['img']) . '" class="user-image img-circle elevation-2" alt="User Image">';
                }
            } elseif ($_SESSION['role'] == "Student") {
                $get_user = mysqli_query($conn, "SELECT * FROM tbl_students WHERE student_id = '$stud_id'") or die(mysqli_error($conn));
                while ($row = mysqli_fetch_array($get_user)) {
                    if (empty(base64_encode($row['img']))) {
                        echo '<img src="../../../assets/img/red_user.jpg" class="user-image img-circle elevation-2" alt="User Image">';
                    } else {
                        echo '<img src="data:image/jpeg;base64,' . base64_encode($row['img']) . '" class="user-image img-circle elevation-2" alt="User Image">';
                    }
                }
            }
            ?>
        </a>
        <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right rounded bg-lightblue">
            <!-- User image -->
            <li class="user-header bg-lightblue rounded-top">

                <?php
                if ($_SESSION['role'] == "Registrar") {
                    $get_user = mysqli_query($conn, "SELECT *, CONCAT(tbl_registrars.reg_fname, ' ', tbl_registrars.reg_mname, ' ', tbl_registrars.reg_lname) AS fullname FROM tbl_registrars WHERE reg_id = '$reg_id'") or
                        die(mysqli_error($conn));
                    while ($row = mysqli_fetch_array($get_user)) {
                        echo '<img src="data:image/jpeg;base64,' . base64_encode($row['img']) . '"
                        class="img-circle elevation-2" alt="User Image">
                        <p>
                    ' . $row['fullname'] . '
                    <small>' . $row['email'] . '</small>
                </p>
                        ';
                    }
                } elseif ($_SESSION['role'] == "Master Key") {
                    $get_user = mysqli_query($conn, "SELECT * FROM tbl_master_key WHERE mk_id = '$mk_id'") or die(mysqli_error($conn));
                    while ($row = mysqli_fetch_array($get_user)) {
                        echo '<img src="data:image/jpeg;base64,' . base64_encode($row['img']) . '" class="img-circle elevation-2" alt="User Image">
                        <p>
                    ' . $row['name'] . '
                    <small>' . $row['email'] . '</small>
                </p>
                ';
                    }
                } elseif ($_SESSION['role'] == "Principal") {
                    $get_user = mysqli_query($conn, "SELECT *, CONCAT(tbl_principals.prin_fname, ' ', tbl_principals.prin_mname, ' ', tbl_principals.prin_lname) AS fullname FROM tbl_principals WHERE prin_id = '$prin_id'");
                    while ($row = mysqli_fetch_array($get_user)) {
                        echo '<img src="data:image/jpeg;base64,' . base64_encode($row['img']) . '" class="img-circle elevation-2" alt="User Image">
                        <p>
                    ' . $row['fullname'] . '
                    <small>' . $row['email'] . '</small>
                </p>
                ';
                    }
                } elseif ($_SESSION['role'] == "Accounting") {
                    $get_user = mysqli_query($conn, "SELECT *, CONCAT(tbl_accountings.accounting_fname, ' ', tbl_accountings.accounting_mname, ' ', tbl_accountings.accounting_lname) AS fullname FROM tbl_accountings WHERE acc_id = '$acc_id'");
                    while ($row = mysqli_fetch_array($get_user)) {
                        echo '<img src="data:image/jpeg;base64,' . base64_encode($row['img']) . '" class="img-circle elevation-2" alt="User Image">
                        <p>
                        ' . $row['fullname'] . '
                        <small>' . $row['email'] . '</small>
                    </p>
                        ';
                    }
                } elseif ($_SESSION['role'] == "Admission") {
                    $get_user = mysqli_query($conn, "SELECT *, CONCAT(tbl_admissions.admission_fname, ' ', tbl_admissions.admission_mname, ' ', tbl_admissions.admission_lname) AS fullname FROM tbl_admissions WHERE admission_id = '$admission_id'");
                    while ($row = mysqli_fetch_array($get_user)) {
                        echo '<img src="data:image/jpeg;base64,' . base64_encode($row['img']) . '" class="img-circle elevation-2" alt="User Image">
                        <p>
                        ' . $row['fullname'] . '
                        <small>' . $row['email'] . '</small>
                    </p>';
                    }
                } elseif ($_SESSION['role'] == "Teacher") {
                    $get_user = mysqli_query($conn, "SELECT *, CONCAT(tbl_teachers.teacher_fname, ' ', tbl_teachers.teacher_mname, ' ', tbl_teachers.teacher_lname) AS fullname FROM tbl_teachers WHERE teacher_id = '$teacher_id'");
                    while ($row = mysqli_fetch_array($get_user)) {
                        echo '<img src="data:image/jpeg;base64,' . base64_encode($row['img']) . '" class="img-circle elevation-2" alt="User Image">
                        <p>
                        ' . $row['fullname'] . '
                        <small>' . $row['email'] . '</small>
                    </p>
                        ';
                    }
                } elseif ($_SESSION['role'] == "Adviser") {
                    $get_user = mysqli_query($conn, "SELECT *, CONCAT(tbl_adviser.ad_fname, ' ', tbl_adviser.ad_mname, ' ', tbl_adviser.ad_lname) AS fullname FROM tbl_adviser WHERE ad_id = '$ad_id'");
                    while ($row = mysqli_fetch_array($get_user)) {
                        echo '<img src="data:image/jpeg;base64,' . base64_encode($row['img']) . '" class="img-circle elevation-2" alt="User Image">
                        <p>
                        ' . $row['fullname'] . '
                        <small>' . $row['email'] . '</small>
                    </p>
                        ';
                    }
                } elseif ($_SESSION['role'] == "Student") {
                    $get_user = mysqli_query($conn, "SELECT *, CONCAT(tbl_students.student_fname, ' ', tbl_students.student_mname, ' ', tbl_students.student_lname) AS fullname FROM tbl_students WHERE student_id = '$stud_id'") or die(mysqli_error($conn));
                    while ($row = mysqli_fetch_array($get_user)) {
                        if (empty(base64_encode($row['img']))) {
                            echo '<img src="../../../assets/img/red_user.jpg" class="img-circle elevation-2" alt="User Image">';
                        } else {
                            echo '<img src="data:image/jpeg;base64,' . base64_encode($row['img']) . '" class="img-circle elevation-2" alt="User Image">';
                        }
                        if (empty($row['student_lname']) && empty($row['student_mname']) && empty($row['student_fname'])) {
                            echo '
                            <p> Hi! Welcome to SFAC Bacoor
                        ';
                        } else {
                            echo '
                            <p>
                        ' . $row['fullname'];
                        }
                        if (empty($row['email'])) {
                            echo ' <small>Please insert your email</small>
                </p>
            <li class="user-body bg-white rounded-0 border-bottom">
                <div class="row justify-content-center">
                    <div class="col-6 text-center">
                        <p>' . $row['stud_no'] . '</p>
                    </div>
                </div>
                <!-- /.row -->
            </li>';
                        } else {
                            echo '<small>' . $row['email'] . '</small>
            </p>
            <li class="user-body bg-white rounded-0 border-bottom mt-2">
                <div class="row justify-content-center">
                    <div class="col-6 text-center">
                        <p class="text-gray">' . $row['stud_no'] . '</p>
                    </div>
                </div>
                <!-- /.row -->
            </li>';
                        }
                    }
                }
                ?>

            </li>


            <!-- Menu Footer-->
            <li class="user-footer rounded-bottom text-center">
                <div class="row justify-content-center">

                    <a href="../bed-login/controllerLogin/ctrl.logout.php"
                        class="btn btn-default select-hover text-gray border col-10">Sign
                        out</a>
                </div>
            </li>
        </ul>
    </li>
</ul>

</nav>


<!-- /.navbar -->