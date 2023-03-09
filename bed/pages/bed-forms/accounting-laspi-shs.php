<?php
require '../bed-fpdf/fpdf.php';
require '../../includes/conn.php';

$stud_id = $_GET['stud_id'];
if (!empty($_GET['glvl_id'])) {
    $glvl_id = $_GET['glvl_id'];
}

$get_ay = mysqli_query($conn, "SELECT * FROM tbl_active_acadyears AS aay
LEFT JOIN tbl_acadyears AS ay ON ay.ay_id = aay.ay_id");
while ($row = mysqli_fetch_array($get_ay)) {
    $ay_id = $row['ay_id'];
    $acad = $row['academic_year'];
}

$get_sem = mysqli_query($conn, "SELECT * FROM tbl_active_semesters AS asem
LEFT JOIN tbl_semesters AS sem ON sem.semester_id = asem.semester_id");
while ($row = mysqli_fetch_array($get_sem)) {
    $sem_id = $row['semester_id'];
    $sem = $row['semester'];
}

$get_level_id = mysqli_query($conn, "SELECT * FROM tbl_schoolyears
WHERE student_id = '$stud_id' AND semester_id = '0' AND ay_id = '$ay_id'") or die(mysqli_error($conn));
$result = mysqli_num_rows($get_level_id);
if ($result > 0) {
    header('location: accounting-laspi-k10.php?stud_id=' . $stud_id . '&glvl_id=' . $glvl_id);
} else {

    $get_level_id = mysqli_query($conn, "SELECT * FROM tbl_schoolyears
    WHERE student_id = '$stud_id' AND semester_id = '$sem_id' AND ay_id = '$ay_id'") or die(mysqli_error($conn));
    $result2 = mysqli_num_rows($get_level_id);

    if ($result2 > 0) {
        //header('location: all_formsSH.php?stud_id=' . $stud_id . '&glvl_id=' . $glvl_id);
    } else {
        header('location: ../bed-404/page404.php');
    }
}

class PDF extends FPDF
{

    // Page header

}

$pdf = new PDF('P', 'mm', 'Letter');
//left top right
$pdf->SetMargins(6.5, 7, 6.5);
$pdf->AddPage();

// Logo(x axis, y axis, height, width)
$pdf->Image('../../../assets/img/logo.jpg', 35, 5, 20, 20);
 $pdf->Image('../../../assets/img/logo1.jpg', 169, 5, 20, 20);
// text color
$pdf->SetTextColor(255, 0, 0);
// font(font type,style,font size)
$pdf->SetFont('Arial', 'B', 17);
// Dummy cell
$pdf->Cell(50);
// //cell(width,height,text,border,end line,[align])
$pdf->Cell(110, 5, 'Saint Francis of Assisi College', 0, 0, 'C');
// Line break
$pdf->Ln(5);
$pdf->SetTextColor(0, 0, 0);
$pdf->SetFont('Arial', '', 10, 'C');
// dummy cell
$pdf->Cell(50);
// //cell(width,height,text,border,end line,[align])

$pdf->Cell(110, 3, 'Las Pinas - Taguig - Cavite - Alabang - Laguna', 0, 0, 'C');
// Line break
$pdf->Ln(4);
$pdf->SetFont('Arial', 'b', 10, 'C');
$pdf->Cell(202, 3, 'BASIC EDUCATION DEPARTMENT', 0, 1, 'C');

$pdf->Ln(5);
$pdf->SetFont('Arial', '', 8);
$pdf->Rect(53, 23, 5, 5); // box
$pdf->Cell(50, 5, '', 0, 0);
$pdf->Cell(30, 3, 'Student\'s Copy', 0, 0, 'C');

$pdf->Rect(88, 23, 5, 5); // box
$pdf->Cell(8, 5, '', 0, 0);
$pdf->Cell(30, 3, 'Principal\'s Copy', 0, 0, 'L');

$pdf->Rect(133, 23, 5, 5); // box
$pdf->Cell(15, 5, '', 0, 0);
$pdf->Cell(35, 3, 'Registrar\'s Copy', 0, 1, 'c');

$pdf->Ln(2);
$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(203, 6, 'PERSONAL INFORMATION', 1, 1, 'C');

$get_stud = mysqli_query($conn, "SELECT *, CONCAT(stud.student_fname, ' ', (stud.student_mname), ' ', stud.student_lname) AS fullname
FROM tbl_schoolyears AS sy
LEFT JOIN tbl_students AS stud ON stud.student_id = sy.student_id
LEFT JOIN tbl_genders AS gen ON gen.gender_id = stud.gender_id
LEFT JOIN tbl_grade_levels AS gl ON gl.grade_level_id = sy.grade_level_id
LEFT JOIN tbl_strands AS std ON std.strand_id = sy.strand_id
LEFT JOIN tbl_acadyears AS ay ON ay.ay_id = sy.ay_id
LEFT JOIN tbl_semesters AS sem ON sem.semester_id = sy.semester_id
WHERE sy.student_id = $stud_id AND sy.ay_id = '$ay_id' AND sy.semester_id = '$sem_id'") or die(mysqli_error($conn));
while ($row = mysqli_fetch_array($get_stud)) {

    $pdf->Ln(1);
    $pdf->SetFont('Arial', '', 8);
    $pdf->Cell(20, 4, 'School Year: ', 0, 0);
    $pdf->SetFont('Arial', 'B', 8);
    $pdf->Cell(20, 4, $row['academic_year'], 0, 0, 'L'); // for data
    $pdf->Cell(5, 4, '', 0, 0); // space between sy and st
    $pdf->SetFont('Arial', '', 8);
    $pdf->Cell(23, 4, 'Student Type: ', 0, 0);
    $pdf->SetFont('Arial', 'B', 8);
    $pdf->Cell(10, 4, $row['stud_type'], 0, 0, 'L'); // for data
    $pdf->Cell(8, 3, '', 0, 0); // space between st to grade
    $pdf->SetFont('Arial', '', 8);
    $pdf->Cell(13, 4, 'Grade: ', 0, 0);
    $pdf->SetFont('Arial', 'B', 8);
    $pdf->Cell(14, 4, $row['grade_level'], 0, 0, 'L'); // for data
    $pdf->Cell(1, 3, '', 0, 0); // space
    $pdf->SetFont('Arial', '', 8);
    $pdf->Cell(25, 4, 'Section/Strand: ', 0, 0);
    $fontsize = 8;
    $tempFontSize = $fontsize;
    $cellwidth = 25;
    while ($pdf->GetStringWidth($row['section'] . '/' . $row['strand_name']) > $cellwidth) {
        $pdf->SetFontSize($tempFontSize -= 0.1);
    }
    $pdf->SetFont('Arial', 'B', 8);
    $pdf->Cell(27, 4, $row['section'] . '/' . $row['strand_name'], 0, 0, 'L'); // for data
    $pdf->Cell(1, 3, '', 0, 0); // space
    $pdf->SetFont('Arial', '', 8);
    $pdf->Cell(10, 4, 'LRN: ', 0, 0);
    $pdf->SetFont('Arial', 'B', 8);
    $pdf->Cell(26, 4, $row['lrn'], 0, 0, 'L');
    $pdf->Cell(10, 4, '', 0, 1);

    $pdf->Ln(1);
    $pdf->SetFont('Arial', '', 8);
    $pdf->Cell(20, 4, 'Full Name: ', 0, 0);
    $pdf->SetFont('Arial', 'B', 8);
    $fontsize = 8;
    $tempFontSize = $fontsize;
    $cellwidth = 60;
    while ($pdf->GetStringWidth($row['fullname']) > $cellwidth) {
        $pdf->SetFontSize($tempFontSize -= 0.1);
    }
    $pdf->Cell(64, 4, utf8_decode($row['fullname']), 0, 0, 'L'); // for data
    $pdf->Cell(2, 4, '', 0, 0); // space
    $pdf->SetFont('Arial', '', 8);
    $pdf->Cell(13, 4, 'Gender: ', 0, 0);
    $pdf->SetFont('Arial', 'B', 8);
    $pdf->Cell(13, 4, $row['gender_name'], 0, 0, 'L'); // for data
    $pdf->Cell(2, 3, '', 0, 0); // space
    $pdf->SetFont('Arial', '', 8);
    $pdf->Cell(15, 4, 'Birthday:', 0, 0);
    $pdf->SetFont('Arial', 'B', 8);
    $pdf->Cell(19, 4, $row['date_birth'], 0, 0, 'L'); // for data
    $pdf->Cell(2, 3, '', 0, 0); // space
    $pdf->SetFont('Arial', '', 8);
    $pdf->Cell(9, 4, 'Age: ', 0, 0);
    $pdf->SetFont('Arial', 'B', 8);
    $pdf->Cell(6, 4, $row['age'], 0, 0, 'L'); // for data
    $pdf->Cell(2, 3, '', 0, 0); // space
    $pdf->SetFont('Arial', '', 8);
    $pdf->Cell(14, 4, 'Religion:', 0, 0);
    $pdf->SetFont('Arial', 'B', 8);
    $fontsize = 8;
    $tempFontSize = $fontsize;
    $cellwidth = 21;
    while ($pdf->GetStringWidth($row['religion']) > $cellwidth) {
        $pdf->SetFontSize($tempFontSize -= 0.1);
    }
    $pdf->Cell(22, 4, $row['religion'], 0, 1, 'L'); // for data

    $pdf->Ln(1);
    $pdf->SetFont('Arial', '', 8);
    $pdf->Cell(15, 4, 'Address: ', 0, 0);
    $pdf->SetFont('Arial', 'B', 8);
    $fontsize = 8;
    $tempFontSize = $fontsize;
    $cellwidth = 68;
    while ($pdf->GetStringWidth($row['address']) > $cellwidth) {
        $pdf->SetFontSize($tempFontSize -= 0.1);
    }

    $pdf->Cell(69, 4, $row['address'], 0, 0, 'L'); // for data
    $pdf->Cell(2, 4, '', 0, 0); // space
    $pdf->SetFont('Arial', '', 8);
    $pdf->Cell(23, 4, 'Contact No(s): ', 0, 0);
    $pdf->SetFont('Arial', 'B', 8);
    $pdf->Cell(29, 4, $row['cellphone'], 0, 0, 'L'); // for data
    $pdf->Cell(6, 3, '', 0, 0); // space
    $pdf->SetFont('Arial', '', 8);
    $pdf->Cell(13, 4, 'Email: ', 0, 0);
    $pdf->SetFont('Arial', 'B', 8);
    $fontsize = 8;
    $tempFontSize = $fontsize;
    $cellwidth = 44;
    while ($pdf->GetStringWidth($row['email']) > $cellwidth) {
        $pdf->SetFontSize($tempFontSize -= 0.1);
    }
    $pdf->Cell(46, 4, $row['email'], 0, 1, 'L'); // for data
    $pdf->Ln(1);
    $pdf->SetFont('Arial', '', 8);
    $pdf->Cell(32, 4, 'School Last Attended: ', 0, 0);
    $pdf->SetFont('Arial', 'B', 8);
    $fontsize = 8;
    $tempFontSize = $fontsize;
    $cellwidth = 52;
    while ($pdf->GetStringWidth($row['last_sch']) > $cellwidth) {
        $pdf->SetFontSize($tempFontSize -= 0.1);
    }
    $pdf->Cell(53, 4, $row['last_sch'], 0, 0, 'L'); // for data
    $pdf->Cell(1, 4, '', 0, 0); // space
    $pdf->SetFont('Arial', '', 8);
    $pdf->Cell(30, 4, 'Year Last Attended: ', 0, 0);
    $pdf->SetFont('Arial', 'B', 8);
    $pdf->Cell(19, 4, $row['sch_year'], 0, 0, 'L'); // for data
    $pdf->Cell(9, 3, '', 0, 0); // space
    $pdf->SetFont('Arial', '', 8);
    $pdf->Cell(25, 4, 'School Address: ', 0, 0);
    $pdf->SetFont('Arial', 'B', 8);
    $fontsize = 8;
    $tempFontSize = $fontsize;
    $cellwidth = 32;
    while ($pdf->GetStringWidth($row['sch_address']) > $cellwidth) {
        $pdf->SetFontSize($tempFontSize -= 0.1);
    }

    $pdf->Cell(33, 4, $row['sch_address'], 0, 1, 'L'); // for data

    $pdf->Ln(1);
    $pdf->SetFont('Arial', 'B', 9);
    $pdf->Cell(39, 6, '', 1, 0, 'C'); // father line
    $pdf->Cell(49, 6, 'FATHER', 1, 0, 'C');
    $pdf->Cell(55, 6, 'MOTHER', 1, 0, 'C');
    $pdf->SetFont('Arial', 'B', 7.5);
    $pdf->Cell(60, 6, 'LEGAL GUARDIAN: Parent(Mother or Father)', 1, 1, 'C');

    $pdf->SetFont('Arial', '', 8);
    $pdf->Cell(39, 6, 'Full Name:', 1, 0, 'C'); // name line
    $fontsize = 8;
    $tempFontSize = $fontsize;
    $cellwidth = 48;
    while ($pdf->GetStringWidth($row['fname']) > $cellwidth) {
        $pdf->SetFontSize($tempFontSize -= 0.1);
    }
    $pdf->Cell(49, 6, utf8_decode($row['fname']), 1, 0, 'C');
    $pdf->SetFont('Arial', '', 8);
    $fontsize = 8;
    $tempFontSize = $fontsize;
    $cellwidth = 54;
    while ($pdf->GetStringWidth($row['mname']) > $cellwidth) {
        $pdf->SetFontSize($tempFontSize -= 0.1);
    }
    $pdf->Cell(55, 6, utf8_decode($row['mname']), 1, 0, 'C');
    $pdf->SetFont('Arial', '', 8);
    $fontsize = 8;
    $tempFontSize = $fontsize;
    $cellwidth = 59;
    while ($pdf->GetStringWidth($row['guardname']) > $cellwidth) {
        $pdf->SetFontSize($tempFontSize -= 0.1);
    }
    $pdf->Cell(60, 6, utf8_decode($row['guardname']), 1, 1, 'C');
    $pdf->SetFont('Arial', '', 8);
    $pdf->Cell(39, 6, 'Contact Number(s):', 1, 0, 'C'); // cont line
    $pdf->Cell(49, 6, $row['fcontact'], 1, 0, 'C');
    $pdf->Cell(55, 6, $row['mcontact'], 1, 0, 'C');
    $pdf->Cell(60, 6, $row['gcontact'], 1, 1, 'C');

    $pdf->Cell(39, 6, 'Email:', 1, 0, 'C');
    $fontsize = 8;
    $tempFontSize = $fontsize;
    $cellwidth = 48;
    while ($pdf->GetStringWidth($row['femail']) > $cellwidth) {
        $pdf->SetFontSize($tempFontSize -= 0.1);
    }
    $pdf->Cell(49, 6, $row['femail'], 1, 0, 'C');
    $pdf->SetFont('Arial', '', 8);
    $fontsize = 8;
    $tempFontSize = $fontsize;
    $cellwidth = 54;
    while ($pdf->GetStringWidth($row['memail']) > $cellwidth) {
        $pdf->SetFontSize($tempFontSize -= 0.1);
    }
    $pdf->Cell(55, 6, $row['memail'], 1, 0, 'C');
    $pdf->SetFont('Arial', '', 8);
    $fontsize = 8;
    $tempFontSize = $fontsize;
    $cellwidth = 59;
    while ($pdf->GetStringWidth($row['gemail']) > $cellwidth) {
        $pdf->SetFontSize($tempFontSize -= 0.1);
    }
    $pdf->Cell(60, 6, $row['gemail'], 1, 1, 'C');
    $pdf->SetFont('Arial', '', 8);
    $pdf->Cell(39, 10, 'Complete Address:', 1, 0, 'C');
    $pdf->Cell(49, 10, '', 1, 0, 'C');
    $pdf->Cell(55, 10, '', 1, 0, 'C');
    $pdf->SetFont('Arial', '', 8);
    $fontsize = 8;
    $tempFontSize = $fontsize;
    $cellwidth = 59;
    while ($pdf->GetStringWidth($row['gaddress']) > $cellwidth) {
        $pdf->SetFontSize($tempFontSize -= 0.1);
    }
    $pdf->Cell(60, 10, $row['gaddress'], 1, 1, 'C');

    $pdf->Ln(1);
    $pdf->SetFont('Arial', 'B', 9);
    $pdf->Cell(203, 6, 'LIST OF SUBJECTS', 1, 1, 'C');

    $pdf->SetFont('Arial', 'B', 8);
    $pdf->Cell(101.5, 6, 'First Semester', 1, 0, 'C');
    $pdf->Cell(101.5, 6, 'Second Semester', 1, 1, 'C');

    $pdf->Cell(25, 6, 'Subject Code', 'T,L,B', 0, 'C');
    $pdf->Cell(76.5, 6, 'Subjects', 'T,L,B', 0, 'C');
    $pdf->Cell(25, 6, 'Subject Code', 'T,L,B', 0, 'C');
    $pdf->Cell(76.5, 6, 'Subjects', 'T,L,R,B', 0, 'C');
    $pdf->Cell(0, 4, '', 0, 1);

    $pdf->Ln(1);
    $xy = 109;
    $xy2 = 109;

    $get_enrolled_sub = mysqli_query($conn, "SELECT * FROM tbl_enrolled_subjects AS ensub
        LEFT JOIN tbl_schedules AS sched ON sched.schedule_id = ensub.schedule_id
        LEFT JOIN tbl_students AS stud ON stud.student_id = ensub.student_id
        LEFT JOIN tbl_subjects_senior AS sub ON sub.subject_id = sched.subject_id
        LEFT JOIN tbl_grade_levels AS gl ON gl.grade_level_id = sub.grade_level_id
        LEFT JOIN tbl_semesters AS sem ON sem.semester_id = sub.semester_id
        WHERE stud.student_id = '$stud_id' AND sem.semester = 'First Semester' AND sched.acadyear = '$acad' AND sub.strand_id = '$row[strand_id]'") or die(mysqli_error($conn));

    while ($row2 = mysqli_fetch_array($get_enrolled_sub)) {
        $pdf->SetXY(6.5, $xy);
        $pdf->SetFont('Arial', '', 8);
        $pdf->Cell(25, 5, $row2['subject_code'], 1, 0, 'L');
        $fontsize = 8;
        $tempFontSize = $fontsize;
        $cellwidth = 75;
        while ($pdf->GetStringWidth($row2['subject_description']) > $cellwidth) {
            $pdf->SetFontSize($tempFontSize -= 0.1);
        }
        $pdf->Cell(76.5, 5, $row2['subject_description'], 1, 0, 'L');
        $xy += 5;
    }

    $get_enrolled_sub2 = mysqli_query($conn, "SELECT * FROM tbl_enrolled_subjects AS ensub
        LEFT JOIN tbl_schedules AS sched ON sched.schedule_id = ensub.schedule_id
        LEFT JOIN tbl_students AS stud ON stud.student_id = ensub.student_id
        LEFT JOIN tbl_subjects_senior AS sub ON sub.subject_id = sched.subject_id
        LEFT JOIN tbl_grade_levels AS gl ON gl.grade_level_id = sub.grade_level_id
        LEFT JOIN tbl_semesters AS sem ON sem.semester_id = sub.semester_id
        WHERE stud.student_id = '$stud_id' AND sem.semester = 'Second Semester' AND sched.acadyear = '$acad' AND sub.strand_id = '$row[strand_id]'") or die(mysqli_error($conn));

    while ($row3 = mysqli_fetch_array($get_enrolled_sub2)) {
        $pdf->SetXY(108, $xy2);
        $pdf->SetFont('Arial', '', 8);
        $pdf->Cell(25, 5, $row3['subject_code'], 1, 0, 'L');
        $fontsize = 8;
        $tempFontSize = $fontsize;
        $cellwidth = 75;
        while ($pdf->GetStringWidth($row3['subject_description']) > $cellwidth) {
            $pdf->SetFontSize($tempFontSize -= 0.1);
        }
        $pdf->Cell(76.5, 5, $row3['subject_description'], 1, 0, 'L');
        $xy2 += 5;
    }

    // echo $xy;

    $addbox = (159 - $xy) / 5;
    $x = 0;
    $laney = $xy;

    for ($x; $x <= $addbox; $x++) {
        $pdf->SetXY(6.5, $laney);
        $pdf->Cell(25, 5, '', 1, 0, 'L');
        $pdf->Cell(76.5, 5, '', 1, 0, 'L');
        $laney += 5;

    }

    $addbox2 = (159 - $xy2) / 5;
    $x2 = 0;
    $laney2 = $xy2;

    for ($x2; $x2 <= $addbox2; $x2++) {

        $pdf->SetXY(108, $laney2);
        $pdf->Cell(25, 5, '', 1, 0, 'L');
        $pdf->Cell(76.5, 5, '', 1, 0, 'L');
        $laney2 += 5;

    }

    // box in all subject
    // $pdf->Rect(6.5, 115, 25, 35);
    // $pdf->Rect(31.5, 115, 76.5, 35);
    // $pdf->Rect(108, 115, 25, 35);
    // $pdf->Rect(132.99, 115, 76.5, 35);

    $pdf->Ln(5);
    $pdf->SetFont('Arial', 'I', 8);
    $pdf->Cell(25, 4, '* elective', 0, 0);
    $pdf->Cell(28, 4, '** modular ', 0, 0);
    $pdf->Cell(14, 4, '*** research', 0, 1);

    $pdf->Ln(.5);
    $pdf->SetFont('Arial', 'B', 9);
    $pdf->Cell(203, 5, 'CREDENTIALS SUBMITTED', 1, 1, 'C');

    $pdf->Ln(1);
    $pdf->SetFont('Arial', '', 8);
    $pdf->Rect(8, 175.5, 5, 3); // box
    $pdf->Cell(14, 4, '', 0, 0);
    $pdf->Cell(15, 5, 'PSA Birth Certificate', 0, 0, 'C');

    $pdf->Rect(44, 175.5, 5, 3); // box
    $pdf->Cell(21, 4, '', 0, 0);
    $pdf->Cell(15, 5, 'Report Card (F-138)', 0, 0, 'C');

    $pdf->Rect(81, 175.5, 5, 3); // box
    $pdf->Cell(25, 4, '', 0, 0);
    $pdf->Cell(18, 5, 'Permanent Record (F-138)', 0, 0, 'C');

    $pdf->Rect(127, 175.5, 5, 3); // box
    $pdf->Cell(15, 4, '', 0, 0);
    $pdf->Cell(16, 5, 'GMC', 0, 0, 'C');

    $pdf->Rect(142, 175.5, 5, 3); // box
    $pdf->Cell(9, 4, '', 0, 0);
    $pdf->Cell(9, 5, '2pcs 2x2 ID Pic', 0, 0, 'C');

    $pdf->Rect(171, 175.5, 5, 3); // box
    $pdf->Cell(10, 4, '', 0, 0);
    $pdf->Cell(17, 5, 'NCAE', 0, 0, 'C');

    $pdf->Rect(189, 175.5, 5, 3); // box
    $pdf->Cell(7, 4, '', 0, 0);
    $pdf->Cell(12, 5, '', 'B', 1, 'C');

    $pdf->Ln(1);
    $pdf->SetFont('Arial', 'B', 9);
    $pdf->Cell(203, 5, 'GOVERNMENT ASSISTANCE', 1, 1, 'C');

    $pdf->Ln(1);
    $pdf->SetFont('Arial', '', 8);
    $pdf->Rect(8, 187, 5, 3); // box
    $pdf->Cell(4, 4, '', 0, 0);
    $pdf->Cell(16, 4, 'ESC', 0, 0, 'C');

    $pdf->Rect(44, 187, 5, 3); // box
    $pdf->Cell(25, 4, '', 0, 0);
    $pdf->Cell(25, 4, 'VOUCHER (NTU)', 0, 0, 'C');
    $pdf->Cell(25, 4, '', 'B', 0, 'C');

    $pdf->Rect(108, 187, 5, 3); // box
    $pdf->Cell(12, 4, '', 0, 0);
    $pdf->Cell(30, 4, 'VOUCHER (WTU)', 0, 0, 'C');
    $pdf->Cell(25, 4, '', 'B', 0, 'C');

    $pdf->Rect(175, 187, 5, 3); // box
    $pdf->Cell(12, 4, '', 0, 0);
    $pdf->Cell(27, 4, 'NO VOUCHER', 0, 1, 'C');

    $pdf->Ln(1);
    $pdf->Cell(203, 3, 5, '', 1, 1, 'C');

    $pdf->Ln(1);
    $pdf->SetFont('Arial', '', 8);
    $pdf->Cell(27, 4, 'Processed by: ', 0, 0, 'C');

    $pdf->Cell(34, 4, '', 0, 0);
    $pdf->Cell(25, 4, 'Verified by: ', 0, 0, 'C');

    $pdf->Cell(30, 4, '', 0, 0);
    $pdf->Cell(20, 4, 'Approved by: ', 0, 0, 'C');

    $pdf->Cell(25, 4, '', 0, 0);
    $pdf->Cell(20, 4, 'Date: ', 0, 1, 'C');

    $pdf->Cell(10, 4, '', 0, 0, 'C'); // lagayan ng data
    $pdf->Cell(17, 4, '', 0, 0);
    $pdf->Cell(30, 5, '', 'B', 0, 'C'); // line for officer
    $pdf->Cell(14, 4, '', 0, 0, 'C'); // lagayan ng data
    $pdf->Cell(11, 4, '', 0, 0);
    $pdf->Cell(30, 5, '', 'B', 0, 'C'); // line for admission off

    $pdf->SetFont('Arial', '', 8);
    $pdf->Cell(25, 4, '', 0, 0);
    $pdf->Cell(30, 5, '', 'B', 0, 'C'); // line for admission off
    $pdf->Cell(15, 17, '', 0, 0, 'C'); // NAME OF SCHOOL HEAD

    $pdf->Cell(20, 4, '', 0, 0);
    $pdf->Cell(15, 10, '', 0, 1, 'C'); // DATA FOR DATE

    $pdf->Ln(-5);
    $pdf->SetFont('Arial', '', 8);
    $pdf->Cell(30, 4, '', 0, 0);
    $pdf->Cell(27, 4, 'Enrolling Officer ', 0, 0, 'C');

    $pdf->Cell(28, 4, '', 0, 0);
    $pdf->Cell(25, 4, 'Admission Officer', 0, 0, 'C');

    $pdf->Cell(30, 4, '', 0, 0);
    $pdf->Cell(25, 4, 'School Head', 0, 1, 'C');

    $pdf->Ln(0);
    $pdf->SetFont('Arial', 'B', 9);
    $pdf->Rect(6.5, 209, 203, 20);
    $pdf->Cell(200, 7, 'REMARKS', 0, 1, 'L');
    $pdf->Cell(10, 4, '', 0, 0);
    $pdf->Cell(190, 3, '', 'B', 1, 'C'); // line
    $pdf->Cell(10, 4, '', 0, 0);
    $pdf->Cell(190, 5, '', 'B', 1, 'C'); // line
    $pdf->Cell(10, 4, '', 0, 0);

    $pdf->Ln(6.5);
    $pdf->SetFont('Arial', 'B', 9);
    $pdf->Cell(203, 5, 'Admission Requirements', 1, 1, 'C');
    $pdf->Cell(4, 4, '', 0, 0);
    $pdf->Ln(1);
    $pdf->SetFont('Arial', 'B', 9);
    $pdf->Cell(75, 3, 'New / Transferee Student ', 0, 0, 'C');
    $pdf->Cell(50, 3, 'Old Students ', 0, 0, 'C');
    $pdf->Cell(80, 3, 'Foreign Students ', 0, 0, 'C');
    $pdf->Cell(4, 4, '', 0, 0);

    $pdf->Ln(2);
    $pdf->SetFont('Arial', '', 7);
    $pdf->Cell(75, 6, 'Original Report Card(F-138) ', 0, 0, 'C');
    $pdf->Cell(50, 6, 'Original Report Card(F-138) ', 0, 0, 'C');
    $pdf->Cell(80, 6, 'Evaluate Report Card or its Equivalent ', 0, 0, 'C');

    $pdf->Ln(2);
    $pdf->SetFont('Arial', '', 7);
    $pdf->Cell(75, 8, 'Original Certificate of Good Moral Character ', 0, 0, 'C');
    $pdf->Cell(50, 8, 'Clearance Form ', 0, 0, 'C');
    $pdf->Cell(80, 8, 'Certified True Copy of PSA Birth Certificate/Passport ', 0, 0, 'C');

    $pdf->Ln(2);
    $pdf->SetFont('Arial', '', 7);
    $pdf->Cell(75, 10, 'Certified True Copy of PSA Birth Certificate ', 0, 0, 'C');
    $pdf->Cell(50, 10, ' ', 0, 0, 'C');
    $pdf->Cell(80, 10, 'Certificate of Eligibility for Admission from DepEd ', 0, 0, 'C');

    $pdf->Ln(2);
    $pdf->SetFont('Arial', '', 7);
    $pdf->Cell(75, 12, '2 pcs 2 X 2 ID Picture', 0, 0, 'C');
    $pdf->Cell(50, 12, ' ', 0, 0, 'C');
    $pdf->Cell(80, 12, 'Certified true copy of the Alien Certificate of Registration', 0, 0, 'C');

    $pdf->Ln(2);
    $pdf->SetFont('Arial', '', 7);
    $pdf->Cell(75, 13, 'NCAE Result (if applicable)', 0, 0, 'C');
    $pdf->Cell(50, 13, ' ', 0, 0, 'C');
    $pdf->Cell(80, 13, '2 pcs 2 X 2 ID Picture', 0, 0, 'C');

    $pdf->Image('../../../assets/img/footer1.jpg', 60, 260, 150, 10);

    $pdf->Image('../../../assets/img/footer2.jpg', 5, 260, 60, 10);

}

$pdf->AddPage();

$pdf->SetFont('Arial', 'B', 6);
$pdf->SetTopMargin(10);
$pdf->SetLeftMargin(9);
$pdf->SetRightMargin(9);

$pdf->Ln(2);
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(100, 0, '', 0, 1, 'R');
$pdf->Cell(200, 5, 'GENERAL ADMISSIONS POLICY', 0, 0, 'C');
$pdf->Cell(10, 5, '', 0, 1);

$pdf->SetFont('Arial', '', 9);
$pdf->Cell(15, 3, 'A. Enrollment at Saint Francis of Assisi College means  that the learner,  his/her parents and guardians fully agree, with and abide ', 0, 1);
$pdf->SetFont('Arial', '', 9);
$pdf->Cell(15, 3, 'by its policies, rules and regulations.', 0, 1);

$pdf->Cell(15, 3, 'B. SFAC has the authority and prerogative to promulgate reasonable norms, rules and regulations necessary or the maintenance', 0, 1);

$pdf->Cell(15, 3, 'of good discipline of all learners. (2010 Revised Manual of Regulations for Private Schools in Basic Education, Article 132)', 0, 1);

$pdf->Cell(15, 3, 'C. Parents/guardians are expected to fully cooperate and help the school in implementing the existing policies, rules and regulation.', 0, 1);

$pdf->Cell(15, 3, ' (Art.II, Chapter 2, Sec. 8 of Education Act of 1982)', 0, 1);

$pdf->Ln(2);
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(100, 0, '', 0, 1, 'R');
$pdf->Cell(200, 5, 'Privacy Policy (Pursuant to RA  10173 or the Data Privacy Act of 2012)', 0, 0, 'C');
$pdf->Cell(10, 5, '', 0, 1);

$pdf->Ln(2);
$pdf->SetFont('Arial', '', 9);
$pdf->Cell(15, 3, 'a. The school shall use student personal data for academic and/or regulatory purposes ONLY.', 0, 1);

$pdf->Cell(15, 3, 'b. SFAC may post (through official social media accounts, website, etc.) pictures/videos  of students taken during official school', 0, 1);

$pdf->Cell(15, 3, 'activities whether inside or outside the school without prior consent from the parents/guardians. ', 0, 1);

$pdf->Cell(15, 3, 'c. Any complaints must be officially directed to appropriate school officials. Posts through social media , ', 0, 1);
$pdf->Cell(15, 3, 'websites, written or printed by student, parent or guardian that can directly or indirectly ruin the school\'s reputation shall be a ground ', 0, 1);

$pdf->Cell(15, 3, 'for termination of enrollment contract and possible filing of legal measures.', 0, 1);

$pdf->Ln(2);
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(100, 0, '', 0, 1, 'R');
$pdf->Cell(200, 5, 'School fees', 0, 0, 'C');
$pdf->Cell(10, 5, '', 0, 1);

$pdf->Ln(2);
$pdf->SetFont('Arial', '', 9);
$pdf->Cell(15, 3, 'a. The schedule of approved tuition and other school fees shall be available at the Accounting Office and Office of the Principal.', 0, 1);

$pdf->Cell(15, 3, 'b. The tuition and other school fees shall be subject to change upon due notice in accordance with the guidelines and approval', 0, 1);

$pdf->Cell(15, 3, 'of the Department of Education.', 0, 1);

$pdf->Cell(15, 3, 'c. Reservation fee, miscellaneous and other school fees  are non-refundable and non-transfrerrable. ', 0, 1);

$pdf->Cell(15, 3, 'c. A 10 % discount on tuition fee can be availed if total school fees will be paid in full (cash basis) upon registraton.', 0, 1);

$pdf->Cell(15, 3, 'd. Sibling discount of 5%, 10%,15 %,  20% and 25% on tuition fee can be given to the 1st , 2nd, 3rd, 4th, 5th and 6th sibling respectively ', 0, 1);

$pdf->Cell(15, 3, 'e. Academic discount of 100 %, 75% and 50 % on tuition fee can be granted to the 1st honor, 2nd honor and 3rd honor respectively.', 0, 1);

$pdf->Cell(15, 3, 'f. "When a learner registers in a school, it is understood that he is enrolling for the entire school year for basic education or  for the entire ', 0, 1);

$pdf->Cell(15, 3, 'g. A learner who transfers or otherwise withdraws, in writing, within two weeks after the beginning of classes and who has already paid ', 0, 1);

$pdf->Cell(15, 3, 'the pertinent tuition and other school fees in full or for any length of time longer than one month', 0, 1);

$pdf->Cell(15, 3, 'will be charged according to the policies on the refund of  tuition and other school fees.� (Art, XIII Sec. 66 of the Manual of Regulations) ', 0, 1);

$pdf->Cell(15, 3, 'for  Private Schools for college". (Art. XIII Sec. 62.a of the Manual of Regulations for Private Schools) ', 0, 1);

$pdf->Cell(7, 2.3, '', 0, 0);
$pdf->Cell(15, 3, 'g.1. l0% of the total amount for the term (that is full amount charged for one school year If he withdraws within the', 0, 1);

$pdf->Cell(15, 3, 'first week of classes regardless of whether or not he has actually attended classes. ', 0, 1);

$pdf->Cell(7, 2.3, '', 0, 0);
$pdf->Cell(15, 3, 'g.2. 20% of the total amount for the term if he withdraws  within the second week of classes regardless of whether ', 0, 1);

$pdf->Cell(15, 3, ' or not he has actually attended classes. ', 0, 1);

$pdf->Cell(7, 2.3, '', 0, 0);
$pdf->Cell(15, 3, 'g.3. A pupil may be charged all the school fee in full if he withdraws anytime  after the second week of classes regardless', 0, 1);

$pdf->Cell(15, 3, ' of whether or not he has actually attended classes. ', 0, 1);

$pdf->Cell(15, 3, 'h. One (1) week before the major examination, the parent/guardian must coordinate with the accounting office personally for accounts', 0, 1);

$pdf->Cell(15, 3, 'that cannot be settled before the deadline.  ', 0, 1);

$pdf->Cell(15, 3, 'i. SFAC reserves the rights to send financial and/or academic notifications via email, sms or calls to parents and guardians whose ', 0, 1);

$pdf->Cell(15, 3, 'contact details appear on this form. ', 0, 1);

$pdf->Cell(15, 3, 'j. Learners  who dropped from the roll without prior notice and written withdrawal are considered not cleared. Academic records ', 0, 1);

$pdf->Cell(15, 3, 'other credentials are withheld. Accounts will remain active until formal letter of dropping will be submitted.', 0, 1);

$pdf->Cell(15, 3, 'k. Failure to settle the account on or before the deadline will result in automatic conversion to the next mode of payment with', 0, 1);

$pdf->Cell(15, 3, ' higher amount. (e.g. unsettled semestral payment on the scheduled deadline means automatic conversion of the payment mode into.', 0, 1);

$pdf->Cell(15, 3, ' quarterly basis.', 0, 1);

$pdf->Cell(15, 3, 'l. Due date for cash basis payment is before the opening of classes, failure to settle account before the deadline means conversion of ', 0, 1);

$pdf->Cell(15, 3, 'payment mode to semestral basis.', 0, 1);

$pdf->Ln(2);
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(100, 0, '', 0, 1, 'R');
$pdf->Cell(200, 5, 'TESDA NCII Assessment', 0, 0, 'C');
$pdf->Cell(10, 5, '', 0, 1);

$pdf->Ln(2);
$pdf->SetFont('Arial', '', 9);
$pdf->Cell(15, 3, 'a. All Senior High School (SHS) students enrolled in Technical-Vocational-Livelihood (TVL) track shall undergo and pass the TESDA NCII', 0, 1);

$pdf->Cell(15, 3, 'ssessment in line with their enrolled specialization. The TESDA NCII Assessment will form part of their requirements for graduation.', 0, 1);

$pdf->Ln(1);

$pdf->Ln(2);
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(100, 0, '', 0, 1, 'R');
$pdf->Cell(200, 5, 'Enrollment Agreement', 0, 0, 'C');
$pdf->Cell(5, 5, '', 0, 1);

$pdf->Ln(2);
$pdf->SetFont('Arial', '', 9);
$pdf->Cell(200, 3, 'This is to certify that all information supplied in this form is true and accurate to the best of my knowledge and that  any  false or malicious', 0, 1, 'C');

$pdf->Cell(200, 3, 'information  in  this  form  or  any  omission which is misleading  will  be  sufficient  grounds  for  immediate  dismissal of my child upon  ', 0, 1, 'C');

$pdf->Cell(200, 3, 'discovery, regardless  when  such  discoveries  shall   be made.', 0, 1, 'C');

$pdf->Ln(2);
$pdf->SetFont('Arial', '', 9);
$pdf->Cell(200, 3, 'We further agree that we have read and will comply with the terms and conditions specified in this Enrollment Agreement and all SFAC', 0, 1, 'C');

$pdf->Cell(200, 3, 'academic standards and policies for as long as our child is enrolled. We understand that our child is responsible for adhering to all of the ', 0, 1, 'C');

$pdf->Cell(200, 3, 'Terms and Conditions set forth by the school. We also agree to abide by all rules and regulations described in the Student Handbook', 0, 1, 'C');

$pdf->Cell(200, 3, 'existing school policies.', 0, 1, 'C');

$pdf->Ln(3);
$pdf->Cell(200, 4, "", 0, 1);
$pdf->Cell(15, 6, "", 0, 0);
$pdf->Cell(70, 6, "", 'B', 0);
$pdf->Cell(30, 6, "", 0, 0);
$pdf->Cell(70, 6, "", 'B', 1);

$pdf->SetFont('Arial', '', 9);
$pdf->Cell(100, 6, "Signature over Printed Name of Parent/Guardian", 0, 0, 'C');
$pdf->Cell(30, 6, '', 0, 0);
$pdf->Cell(40, 6, "Signature over Printed Name of Student", 0, 1, 'C');

$pdf->Ln(6);
$pdf->SetFont('Arial', '', 9);
$pdf->Cell(10, 5, '', 0, 0);
$pdf->Cell(22, 3, 'Date:', 0, 0);
$pdf->Cell(30, 3, '', 'B', 0, 'C');

$pdf->Cell(10, 5, '', 0, 0);
$pdf->Cell(16, 3, 'Date:', 0, 0);
$pdf->Cell(30, 3, '', 'B', 1, 'C');

$pdf->Output();
