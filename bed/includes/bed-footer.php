<footer class="main-footer pb-md-0">
    <div class="row justify-content-center">
        <div class="col-md-4 col-sm-6 col-6 mr-3">
            <div class="info-box border">
                <span class="info-box-icon bg-navy"><i class="far fa-bookmark"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Academic Year</span>
                    <?php $get_acadyear = mysqli_query($conn, "SELECT * FROM tbl_active_acadyears LEFT JOIN tbl_acadyears ON tbl_acadyears.ay_id = tbl_active_acadyears.ay_id");
                    while ($row = mysqli_fetch_array($get_acadyear)) { ?>

                    <span class="info-box-number"><?php echo $row['academic_year'];
                                                        ?></span>
                    <?php $_SESSION['active_acadyears'] = $row['academic_year'];
                    } ?>

                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>

        <?php
        if ($_SESSION['role'] == "Student") {
            $get_level_id = mysqli_query($conn, "SELECT * FROM tbl_schoolyears AS sy
        LEFT JOIN tbl_acadyears AS ay ON ay.ay_id = sy.ay_id
        WHERE student_id = '$stud_id' AND semester_id = '0' AND ay.academic_year = '$_SESSION[active_acadyears]'") or die(mysqli_error($conn));
            $result = mysqli_num_rows($get_level_id);
            if ($result > 0) { ?>

        <?php } else { ?>
        <div class="col-md-4 col-sm-6 col-6 mr-3">
            <div class="info-box border">
                <span class="info-box-icon bg-navy"><i class="far fa-flag"></i></span>

                <div class=" info-box-content">
                    <span class="info-box-text">Semester</span>
                    <?php $get_sem = mysqli_query($conn, "SELECT * FROM tbl_active_semesters LEFT JOIN tbl_semesters ON tbl_semesters.semester_id = tbl_active_semesters.semester_id");
                            while ($row = mysqli_fetch_array($get_sem)) { ?>
                    <span class="info-box-number"><?php echo $row['semester'];
                                                                ?></span>
                    <?php $_SESSION['active_semester'] = $row['semester'];
                            } ?>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <?php  }
        } else {
            ?>
        <div class="col-md-4 col-sm-6 col-6 mr-3">
            <div class="info-box border">
                <span class="info-box-icon bg-navy"><i class="far fa-flag"></i></span>

                <div class=" info-box-content">
                    <span class="info-box-text">Semester</span>
                    <?php $get_sem = mysqli_query($conn, "SELECT * FROM tbl_active_semesters LEFT JOIN tbl_semesters ON tbl_semesters.semester_id = tbl_active_semesters.semester_id");
                        while ($row = mysqli_fetch_array($get_sem)) { ?>
                    <span class="info-box-number"><?php echo $row['semester'];
                                                            ?></span>
                    <?php $_SESSION['active_semester'] = $row['semester'];
                        } ?>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <?php } ?>

    </div>
    <hr class="mt-0 pt-0">
    <strong><a href="#">SFAC Bacoor</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
        <b>Copyright</b>&copy; 2021
    </div>


</footer>

<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
</aside>
<!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="../../plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="../../plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
$.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="../../plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="../../plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="../../plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="../../plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="../../plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="../../plugins/moment/moment.min.js"></script>
<script src="../../plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="../../plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="../../plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="../../plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/adminlte.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../../dist/js/demo.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="../../dist/js/pages/dashboard.js"></script>
<!-- bs-custom-file-input -->
<script src="../../plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
<!-- SweetAlert2 -->
<script src="../../plugins/sweetalert2/sweetalert2.min.js"></script>
<!-- Select2 -->
<script src="../../plugins/select2/js/select2.full.min.js"></script>
<!-- InputMask -->
<script src="../../plugins/moment/moment.min.js"></script>
<script src="../../plugins/inputmask/jquery.inputmask.min.js"></script>
<!-- DataTables  & Plugins -->
<script src="../../plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="../../plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="../../plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="../../plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="../../plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="../../plugins/jszip/jszip.min.js"></script>
<script src="../../plugins/pdfmake/pdfmake.min.js"></script>
<script src="../../plugins/pdfmake/vfs_fonts.js"></script>
<script src="../../plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="../../plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="../../plugins/datatables-buttons/js/buttons.colVis.min.js"></script>

<!-- file  -->
<script>
$(function() {
    bsCustomFileInput.init();
    $('.select2').select2()

    //Datemask dd/mm/yyyy
    $('#datemask').inputmask('dd/mm/yyyy', {
        'placeholder': 'dd/mm/yyyy'
    })
    $('[data-mask]').inputmask()
    $('[data-toggle="tooltip"]').tooltip()


    $(document).ready(function() {
        $(window).scroll(function() {
            if ($(this).scrollTop() > 100) {
                $('#scroll').fadeIn();
            } else {
                $('#scroll').fadeOut();
            }
        });
        $('#scroll').click(function() {
            $("html, body").animate({
                scrollTop: 0
            }, 600);
            return false;
        });
    });

});

function currentTime() {
    var date = new Date(); /* creating object of Date class */
    var hour = date.getHours();
    var min = date.getMinutes();
    var sec = date.getSeconds();
    var midday = "AM";
    midday = (hour >= 12) ? "PM" : "AM";
    hour = updateTime(hour);
    hour = (hour == 0) ? 12 : ((hour > 12) ? (hour - 12) : hour);
    min = updateTime(min);
    sec = updateTime(sec);

    document.getElementById("clock").innerText = hour + ":" + min + ":" +
        sec + " " + midday; /* adding time to the div */
    var t = setTimeout(function() {
        currentTime()
    }, 1000); /* setting timer */

}

function updateTime(k) {
    if (k < 10) {
        return "0" + k;
    } else {
        return k;
    }
}


currentTime();
</script>

<!-- Page Back -->
<script>
function goBack() {
    window.history.back();
}
</script>



<!-- alert modal -->
<?php if (isset($_SESSION['error-pass'])) {
    echo "<script>
$(function() {
    var Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 2000
    });
    $('.swalDefaultError')
    Toast.fire({
        icon: 'error',
        title:  'Passwords do not match. Please try again.'
    });
});
</script>";
} elseif (isset($_SESSION['success'])) {
    echo "<script>
    $(function() {
        var Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 2000
        }); 
$('.swalDefaultSuccess') 
Toast.fire({
icon: 'success',
title: 'Successfully Added.'
})
}); 
</script>";
} elseif (isset($_SESSION['subject_exists'])) {
    echo "<script>
$(function() {
    var Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 2000
    });
    $('.swalDefaultError')
    Toast.fire({
        icon: 'error',
        title:  'Subject Already Exists!'
    });
});
</script>";
} elseif (isset($_SESSION['submit-success'])) {
    echo "<script>
    $(function() {
        var Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 2000
        }); 
$('.swalDefaultSuccess') 
Toast.fire({
icon: 'success',
title: 'Successfully Submitted.'
})
}); 
</script>";
} elseif (isset($_SESSION['update-success'])) {
    echo "<script>
    $(function() {
        var Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 2000
        }); 
$('.swalDefaultSuccess') 
Toast.fire({
icon: 'success',
title: 'Successfully Updated.'
})
}); 
</script>";
} elseif (isset($_SESSION['confirm'])) {
    echo "<script>
    $(function() {
        var Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 2000
        }); 
$('.swalDefaultSuccess') 
Toast.fire({
icon: 'success',
title: 'Successfully Confirmed.'
})
}); 
</script>";
} elseif (isset($_SESSION['cancel'])) {
    echo "<script>
    $(function() {
        var Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 2000
        }); 
$('.swalDefaultSuccess') 
Toast.fire({
icon: 'success',
title: 'Successfully Canceled.'
})
}); 
</script>";
} elseif (isset($_SESSION['approve'])) {
    echo "<script>
    $(function() {
        var Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 2000
        }); 
$('.swalDefaultSuccess') 
Toast.fire({
icon: 'success',
title: 'Successfully Approved.'
})
}); 
</script>";
} elseif (isset($_SESSION['disapprove'])) {
    echo "<script>
    $(function() {
        var Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 2000
        }); 
$('.swalDefaultSuccess') 
Toast.fire({
icon: 'success',
title: 'Successfully Disapproved.'
})
}); 
</script>";
}

unset($_SESSION['confirm']);
unset($_SESSION['cancel']);
unset($_SESSION['update-success']);
unset($_SESSION['error-pass']);
unset($_SESSION['success']);
unset($_SESSION['subject_exists']);
unset($_SESSION['submit-success']);
unset($_SESSION['approve']);
unset($_SESSION['disapprove']);

?>