<?php
require('../bed-fpdf/fpdf.php');
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
    header('location: all_forms.php?stud_id=' . $stud_id . '&glvl_id=' . $glvl_id);
} else {

    $get_level_id = mysqli_query($conn, "SELECT * FROM tbl_schoolyears
WHERE student_id = '$stud_id' AND semester_id = '$sem_id' AND ay_id = '$ay_id'") or die(mysqli_error($conn));
    $result2 = mysqli_num_rows($get_level_id);

    if ($result2 > 0) {
    } else {
        header('location: ../bed-404/page404.php');
    }
}



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

    class PDF extends FPDF
    {
    }

    $pdf = new PDF('L', 'mm', array(165, 147));

    $pdf->SetLeftMargin(5);
    $pdf->SetRightMargin(5);
    $pdf->SetAutoPageBreak(true, 8);
    $pdf->AddPage();
    //--------------------------Principal---------------------------------//

    // CELL (Width, height, text border, Next line, align)
    $pdf->Image('../../../assets/img/logo.png', 33, 9, 10, 10);

    $pdf->SetTextColor(255, 0, 0);

    $pdf->SetFont('Arial', 'B', 11);

    $pdf->Cell(151, 5, 'SAINT FRANCIS OF ASSISI COLLEGE', 0, 1, 'C');

    $pdf->SetTextColor(0, 0, 0);
    $pdf->SetFont('Arial', '', 11, 'C');

    $test = utf8_decode("");
    $pdf->Cell(151, 5, '96 Bayanan ' . $test . ', City of Bacoor, Cavite', 0, 1, 'C');

    $pdf->Ln(1);
    $pdf->SetFont('Arial', '', 9);
    $pdf->Cell(145, 2, 'BASIC EDUCATION DEPARTMENT', 0, 0, 'C');



    $pdf->Ln(2);
    $pdf->SetFont('Arial', 'B', 9);
    $pdf->Rect(128, 21, 32, 6);
    $pdf->Cell(155, 4, 'PRINCIPAL\'S COPY', 0, 1, 'R');
    $pdf->Cell(155, 5, 'CERTIFICATE OF REGISTRATION AND STUDENTS INFORMATION', 0, 0, 'C');
    $pdf->Cell(10, 5, '', 0, 1);

    $pdf->Ln(1);
    $pdf->SetFont('Arial', '', 9);
    $pdf->Cell(8, 5, '', 0, 0);
    $pdf->Cell(30, 4, 'ACADEMIC YEAR: ', 0, 0);
    $pdf->Cell(35, 4, $row['academic_year'], 'B', 0, 'C');
    $pdf->Cell(10, 5, '', 0, 0);
    $pdf->Cell(28, 4, 'STUDENT TYPE: ', 0, 0);
    $pdf->Cell(40, 4, $row['stud_type'], 'B', 0, 'C');
    $pdf->Cell(10, 5, '', 0, 1);
    $pdf->Cell(12, 5, '', 0, 0);
    $pdf->Cell(26, 4, 'GRADE LEVEL: ', 0, 0);
    $pdf->Cell(35, 4, $row['grade_level'], 'B', 0, 'C');
    $pdf->Cell(20, 5, '', 0, 0);
    $pdf->Cell(18, 4, 'SECTION: ', 0, 0);
    if (!empty($row['section'])) {
        $pdf->Cell(40, 4, utf8_decode($row['section']), 'B', 1, 'C');
    } else {
        $pdf->Cell(40, 4, 'TBA', 'B', 1, 'C');
    }
    $pdf->Cell(20, 5, '', 0, 0);
    $pdf->Cell(18, 4, 'STRAND: ', 0, 0);
    $pdf->Cell(35, 4, $row['strand_name'], 'B', 0, 'C');
    $pdf->Cell(13, 5, '', 0, 0);
    $pdf->Cell(25, 4, 'STUDENT NO.: ', 0, 0);
    $pdf->Cell(40, 4, $row['stud_no'], 'B', 0, 'C');
    $pdf->Cell(8, 4, '', 0, 1);

    $pdf->Ln(2.5);
    $pdf->SetFont('Arial', '', 8);
    $pdf->Cell(11, 3, 'NAME:', 0, 0);
    $pdf->SetFont('Arial', '', 9);
    $pdf->Cell(40, 3, utf8_decode($row['student_lname']), 'B', 0, 'C');
    $pdf->Cell(10, 5, '', 0, 0);
    $pdf->Cell(40, 3, utf8_decode($row['student_fname']), 'B', 0, 'C');
    $pdf->Cell(10, 5, '', 0, 0);
    $pdf->Cell(40, 3, utf8_decode($row['student_mname']), 'B', 1, 'C');

    $pdf->Ln(1);
    $pdf->SetFont('Arial', '', 8);
    $pdf->Cell(13, 3, '', 0, 0);
    $pdf->Cell(40, 3, '(Family Name)', 0, 0, 'C');
    $pdf->Cell(59, 3, '(Given Name)', 0, 0, 'C');
    $pdf->Cell(35, 3, '(Middle Name)', 0, 1, 'C');

    $pdf->Ln(2);
    $pdf->SetFont('Arial', '', 8);
    $pdf->Cell(15, 3, 'ADDRESS:', 0, 0);
    $fontsize = 7;
    $tempFontSize = $fontsize;
    $cellwidth = 133;
    while ($pdf->GetStringWidth($row['address']) > $cellwidth) {
        $pdf->SetFontSize($tempFontSize -= 0.1);
    }
    $pdf->Cell(136, 3, $row['address'], 'B', 1, 'L');

    $pdf->Ln(2);
    $pdf->SetFont('Arial', '', 8);
    $pdf->Cell(10, 5, '', 0, 0);
    $pdf->Cell(22, 3, 'CONTACT NO.:', 0, 0);
    $pdf->SetFont('Arial', '', 9);
    $pdf->Cell(30, 3, $row['cellphone'], 'B', 0, 'C');

    $pdf->Cell(9, 5, '', 0, 0);
    $pdf->SetFont('Arial', '', 8);
    $pdf->Cell(16, 3, 'RELIGION:', 0, 0);
    $pdf->SetFont('Arial', '', 9);
    $pdf->Cell(30, 3, $row['religion'], 'B', 0, 'C');

    $pdf->Cell(4, 5, '', 0, 0);
    $pdf->SetFont('Arial', '', 8);
    $pdf->Cell(8, 3, 'AGE:', 0, 0);
    $pdf->SetFont('Arial', '', 9);
    $pdf->Cell(22, 3, $row['age'], 'B', 1, 'C');

    $pdf->Ln(1.5);
    $pdf->SetFont('Arial', '', 8);
    $pdf->Cell(5, 5, '', 0, 0);
    $pdf->SetFont('Arial', '', 8);
    $pdf->Cell(27, 3, 'PLACE OF BIRTH:', 0, 0);
    $fontsize = 11;
    $tempFontSize = $fontsize;
    $cellwidth = 27;
    while ($pdf->GetStringWidth($row['place_birth']) > $cellwidth) {
        $pdf->SetFontSize($tempFontSize -= 0.1);
    }
    $pdf->Cell(30, 3, $row['place_birth'], 'B', 0, 'C');

    $pdf->SetFont('Arial', '', 8);
    $pdf->Cell(10, 5, '', 0, 0);
    $pdf->Cell(15, 3, 'GENDER:', 0, 0);
    $pdf->Cell(30, 3, $row['gender_name'], 'B', 1, 'C');

    $pdf->Ln(1);
    $pdf->SetFont('Arial', '', 8);
    $pdf->Cell(9, 5, '', 0, 0);
    $pdf->Cell(23, 3, 'NATIONALITY:', 0, 0);
    $pdf->SetFont('Arial', '', 9);
    $pdf->Cell(30, 3, $row['nationality'], 'B', 0, 'C');

    $pdf->Cell(1, 5, '', 0, 0);
    $pdf->SetFont('Arial', '', 8);
    $pdf->Cell(24, 3, 'DATE OF BIRTH:', 0, 0);
    $pdf->SetFont('Arial', '', 9);
    $pdf->Cell(30, 3, $row['date_birth'], 'B', 0, 'C');
    $pdf->Cell(3, 3, '', 0, 0);

    $pdf->SetFont('Arial', 'B', 8);
    $pdf->Cell(43, 2, 'SCHOLARSHIP DISCOUNT:', 0, 1);

    $pdf->Ln(1.5);
    $pdf->SetFont('Arial', '', 8);
    $pdf->Cell(2, 5, '', 0, 0);
    $pdf->Cell(30, 3, 'NAME OF FATHER:', 0, 0);
    $pdf->SetFont('Arial', '', 9);
    $fontsize = 9;
    $tempFontSize = $fontsize;
    $cellwidth = 28;
    while ($pdf->GetStringWidth($row['fname']) > $cellwidth) {
        $pdf->SetFontSize($tempFontSize -= 0.1);
    }
    $pdf->Cell(30, 3, utf8_decode($row['fname']), 'B', 0, 'C');

    $pdf->SetFont('Arial', '', 8);
    $pdf->Cell(1, 5, '', 0, 0);
    $pdf->Cell(24, 3, 'F.OCCUPATION:', 0, 0);
    $pdf->SetFont('Arial', '', 9);
    $fontsize = 9;
    $tempFontSize = $fontsize;
    $cellwidth = 26;
    while ($pdf->GetStringWidth($row['focc']) > $cellwidth) {
        $pdf->SetFontSize($tempFontSize -= 0.1);
    }
    $pdf->Cell(30, 3, $row['focc'], 'B', 0, 'C');

    $pdf->SetFont('Arial', '', 8);
    $pdf->Cell(10, 5, '', 0, 0);
    $pdf->Rect(125, 74, 4, 4);
    $pdf->Cell(3, 3, '', 0, 0);
    $pdf->Cell(35, 3, 'ACADEMIC', 0, 1);

    $pdf->Ln(1.5);
    $pdf->SetFont('Arial', '', 8);
    $pdf->Cell(10, 5, '', 0, 0);
    $pdf->Cell(22, 3, 'CONTACT NO:', 0, 0);
    $pdf->SetFont('Arial', '', 9);
    $pdf->Cell(30, 3, $row['fcontact'], 'B', 0, 'C');

    $pdf->Cell(65, 5, '', 0, 0);
    $pdf->Rect(125, 78, 4, 4);
    $pdf->Cell(3, 3, '', 0, 0);
    $pdf->Cell(38, 3, 'CULTURAL', 0, 1);

    $pdf->Ln(1.3);
    $pdf->SetFont('Arial', '', 8);
    $pdf->Cell(3, 5, '', 0, 0);
    $pdf->Cell(29, 3, 'NAME OF MOTHER:', 0, 0);
    $pdf->SetFont('Arial', '', 9);
    $fontsize = 9;
    $tempFontSize = $fontsize;
    $cellwidth = 29;
    while ($pdf->GetStringWidth($row['mname']) > $cellwidth) {
        $pdf->SetFontSize($tempFontSize -= 0.1);
    }
    $pdf->Cell(30, 3, utf8_decode($row['mname']), 'B', 0, 'C');

    $pdf->SetFont('Arial', '', 8);
    $pdf->Cell(1, 3, '', 0, 0);
    $pdf->Cell(24, 3, 'M.OCCUPATION:', 0, 0);
    $pdf->SetFont('Arial', '', 9);
    $fontsize = 9;
    $tempFontSize = $fontsize;
    $cellwidth = 25;
    while ($pdf->GetStringWidth($row['mocc']) > $cellwidth) {
        $pdf->SetFontSize($tempFontSize -= 0.1);
    }
    $pdf->Cell(30, 3, $row['mocc'], 'B', 0, 'C');

    $pdf->SetFont('Arial', '', 8);
    $pdf->Cell(8, 5, '', 0, 0);
    $pdf->Rect(125, 82, 4, 4);
    $pdf->Cell(5, 3, '', 0, 0);
    $pdf->Cell(38, 3, 'ATHLETIC', 0, 1);

    $pdf->Ln(1.5);
    $pdf->SetFont('Arial', '', 8);
    $pdf->Cell(10, 3, '', 0, 0);
    $pdf->Cell(22, 3, 'CONTACT NO:', 0, 0);
    $pdf->SetFont('Arial', '', 9);
    $pdf->Cell(30, 3, $row['mcontact'], 'B', 0, 'C');

    $pdf->Cell(65, 5, '', 0, 0);
    $pdf->Rect(125, 86, 4, 4);
    $pdf->Cell(3, 3, '', 0, 0);
    $pdf->Cell(38, 3, 'SIBLING', 0, 1);

    $pdf->Ln(1);
    $pdf->SetFont('Arial', '', 8);
    $pdf->Cell(1, 3, '', 0, 0);
    $pdf->Cell(38, 3, 'LAST SCHOOL ATTENDED:', 0, 0);
    $fontsize = 8;
    $tempFontSize = $fontsize;
    $cellwidth = 65;
    while ($pdf->GetStringWidth($row['last_sch']) > $cellwidth) {
        $pdf->SetFontSize($tempFontSize -= 0.1);
    }
    $pdf->Cell(67, 3, $row['last_sch'], 'B', 0, 'C');

    $pdf->SetFont('Arial', '', 8);
    $pdf->Cell(15, 5, '', 0, 0);
    $pdf->Rect(125, 90, 4, 4);
    $pdf->Cell(9, 3, '', 0, 0);
    $pdf->Cell(38, 3, 'EMPLOYEE', 0, 1);

    $pdf->Ln(1);
    $pdf->SetFont('Arial', '', 8);
    $pdf->Cell(1, 5, '', 0, 0);
    $pdf->Cell(29, 3, 'SCHOOL ADDRESS:', 0, 0);
    $pdf->SetFont('Arial', '', 9);
    $pdf->Cell(76, 3, $row['sch_address'], 'B', 0, 'C');

    $pdf->Cell(23, 5, '', 0, 0);
    $pdf->Rect(125, 94, 4, 4);
    $pdf->Cell(1, 5, '', 0, 0);
    $pdf->Cell(38, 3, 'E.O.O.SCHLR.', 0, 1);

    $pdf->Ln(1);
    $pdf->SetFont('Arial', '', 8);
    $pdf->Cell(18, 5, '', 0, 0);
    $pdf->Cell(12, 3, 'E-MAIL:', 0, 0);
    $pdf->SetFont('Arial', '', 9);
    $pdf->Cell(76, 3, $row['email'], 'B', 0, 'C');

    $pdf->SetFont('Arial', 'B', 8);
    $pdf->Cell(10, 5, '', 0, 0);
    $pdf->Cell(38, 3, 'GOVERNMENT ASSISTANCE:', 0, 1);

    $pdf->Ln(1);
    $pdf->SetFont('Arial', 'B', 8);
    $pdf->Cell(1, 5, '', 0, 0);
    $pdf->Cell(60, 3, 'PERSON TO CONTACT IN CASE EMERGENCY', 0, 0);

    $pdf->SetFont('Arial', '', 8);
    $pdf->Cell(63, 5, '', 0, 0);
    $pdf->Rect(125, 103, 4, 4);
    $pdf->Cell(5, 3, '', 0, 0);
    $pdf->Cell(38, 3, 'ESC', 0, 1);

    $pdf->Ln(1);
    $pdf->SetFont('Arial', '', 8);
    $pdf->Cell(10, 3, 'NAME:', 0, 0);
    $pdf->SetFont('Arial', '', 9);
    $pdf->Cell(86, 3, utf8_decode($row['guardname']), 'B', 0, 'C');

    $pdf->Cell(28, 5, '', 0, 0);
    $pdf->Rect(125, 107, 4, 4);
    $pdf->Cell(5, 3, '', 0, 0);
    $pdf->Cell(38, 3, 'NTUP', 0, 1);

    $pdf->Ln(1);
    $pdf->SetFont('Arial', '', 8);
    $pdf->Cell(15, 3, 'ADDRESS:', 0, 0);
    $fontsize = 8;
    $tempFontSize = $fontsize;
    $cellwidth = 78;
    while ($pdf->GetStringWidth($row['gaddress']) > $cellwidth) {
        $pdf->SetFontSize($tempFontSize -= 0.1);
    }
    $pdf->Cell(81, 3, $row['gaddress'], 'B', 0, 'L');

    $pdf->SetFont('Arial', '', 8);
    $pdf->Cell(19, 5, '', 0, 0);
    $pdf->Rect(125, 111, 4, 4);
    $pdf->Cell(14, 3, '', 0, 0);
    $pdf->Cell(38, 3, 'WTUP', 0, 1);

    $pdf->Ln(1);
    $pdf->SetFont('Arial', '', 8);
    $pdf->Cell(35, 3, 'TELEPHONE NO.:', 0, 0);
    $pdf->SetFont('Arial', '', 9);
    $pdf->Cell(61, 3, $row['gcontact'], 'B', 0, 'C');

    $pdf->Cell(28, 5, '', 0, 0);
    $pdf->Rect(125, 115, 4, 4);
    $pdf->Cell(5, 3, '', 0, 0);
    $pdf->Cell(45, 3, 'NO VOUCHER', 0, 1);

    $pdf->Ln(1);
    $pdf->SetFont('Arial', '', 8);
    $pdf->Cell(35, 3, 'PARENT\'S OFFICE ADD: ', 0, 0);
    $pdf->Cell(61, 3, '', 'B', 0, 'C');

    $pdf->Cell(15, 3, '', 0, 0);
    $pdf->Rect(125, 119, 4, 4);
    $pdf->Cell(15, 3, '', 0, 0);
    $pdf->Cell(25, 3, '', 'B', 1, 'C');

    $pdf->Ln(1);
    $pdf->SetFont('Arial', '', 8);
    $pdf->Cell(35, 3, 'OFFICE CONTACT NO.:', 0, 0);
    $pdf->Cell(61, 3, '', 'B', 1, 'C');

    $pdf->Ln(1);
    $pdf->SetFont('Arial', '', 8);
    $pdf->Cell(35, 3, 'DATE OF ENROLLMENT', 0, 0);
    $pdf->SetFont('Arial', '', 9);
    $pdf->Cell(61, 3, $row['date_enrolled'], 'B', 0, 'C');
    $pdf->Cell(10, 3, '', 0, 0);
    $pdf->Cell(38, 3, 'Verified/Approved by:', 0, 1);
}
$get_prin = mysqli_query($conn, "SELECT * FROM tbl_principals");
while ($row = mysqli_fetch_array($get_prin)) {

    $pdf->Ln(1);
    $pdf->SetFont('Arial', '', 8);
    $pdf->Cell(35, 3, 'PARENT\'S SIGNATURE: ', 0, 0);
    $pdf->Cell(61, 3, '', 'B', 0, 'C');
    $pdf->Cell(5, 3, '', 0, 0);
    $pdf->Cell(5, 3, '', 0,0);
    $pdf->SetFont('Arial', '', 9);
    $pdf->Cell(45, 3, utf8_decode($row['prin_fname'] . ' ' . $row['prin_mname'] . ' ' . $row['prin_lname']), 'B', 1, 'C');

    $pdf->Ln(1);
    $pdf->SetFont('Arial', '', 8);
    $pdf->Cell(55, 3, '', 0, 0);

    $pdf->Cell(65, 3, '', 0, 0);
    $pdf->Cell(33, 3, 'Principal', 0, 0);
}

//=========================ACCOUNTING'S COPY==========================

$pdf->SetLeftMargin(5);
$pdf->SetRightMargin(5);
$pdf->SetAutoPageBreak(true, 8);
$pdf->AddPage();

$pdf->Image('../../../assets/img/logo.png', 33, 9, 10, 10);

$pdf->SetTextColor(255, 0, 0);

$pdf->SetFont('Arial', 'B', 11);

$pdf->Cell(151, 5, 'SAINT FRANCIS OF ASSISI COLLEGE', 0, 1, 'C');

$pdf->SetTextColor(0, 0, 0);
$pdf->SetFont('Arial', '', 11, 'C');

$test = utf8_decode("");
$pdf->Cell(151, 5, '96 Bayanan ' . $test . ', City of Bacoor, Cavite', 0, 1, 'C');

$pdf->Ln(1);
$pdf->SetFont('Arial', '', 9);
$pdf->Cell(145, 2, 'BASIC EDUCATION', 0, 0, 'C');

$pdf->Ln(1);
$pdf->SetFont('Arial', 'B', 9);
$pdf->Rect(119, 20, 36, 5);
$pdf->Cell(150, 3, 'ACCOUNTING\'S COPY', 0, 1, 'R');
$pdf->Cell(155, 4, 'PERSONAL INFORMATION', 1, 1, 'C');

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
    $pdf->SetFont('Arial', '', 9);
    $pdf->Cell(9, 3, 'LRN: ', 0, 0);
    $pdf->SetFont('Arial', '', 9);
    $pdf->Cell(30, 3, $row['lrn'], 'B', 0, 'C');
    $pdf->Cell(4, 3, '', 0, 0);
    $pdf->Cell(22, 3, 'Student Type: ', 0, 0);
    $pdf->SetFont('Arial', '', 9);
    $pdf->Cell(19, 3, $row['stud_type'], 'B', 0, 'C');
    $pdf->Cell(2, 3, '', 0, 0);
    $pdf->Cell(20, 3, 'Grade Level: ', 0, 0);
    $pdf->Cell(18, 3, $row['grade_level'], 'B', 0, 'C');
    $pdf->Cell(2, 3, '', 0, 0);
    $pdf->Cell(12, 3, 'Strand: ', 0, 0);
    $pdf->Cell(16, 3, $row['strand_name'], 'B', 0, 'C');
    $pdf->Cell(10, 5, '', 0, 1);

    $pdf->Ln(1);
    $pdf->Cell(24, 3, 'Academic Year:', 0, 0);
    $pdf->Cell(25, 3, $row['academic_year'], 'B', 0, 'C');
    $pdf->Cell(1, 3, '', 0, 0);
    $pdf->Cell(15, 3, 'Birthday:', 0, 0);
    $pdf->Cell(19, 3, $row['date_birth'], 'B', 0, 'C');
    $fontsize = 11;
    $tempFontSize = $fontsize;
    $cellwidth = 48;
    while ($pdf->GetStringWidth($row['place_birth']) > $cellwidth) {
        $pdf->SetFontSize($tempFontSize -= 0.1);
    }
    $pdf->Cell(14, 3, '', 0, 0);
    $pdf->Cell(8, 3, 'Age:', 0, 0);
    $pdf->Cell(18, 3, $row['age'], 'B', 0, 'C');
    $pdf->Cell(1, 3, '', 0, 0);
    $pdf->Cell(13, 3, 'Gender:', 0, 0);
    $pdf->Cell(16, 3, $row['gender_name'], 'B', 1, 'C');

    $pdf->Ln(2);
    $pdf->Cell(11, 3, 'NAME:', 0, 0);
    $pdf->Cell(40, 3, utf8_decode($row['student_lname']), 'B', 0, 'C');
    $pdf->Cell(10, 5, '', 0, 0);
    $pdf->Cell(40, 3, utf8_decode($row['student_fname']), 'B', 0, 'C');
    $pdf->Cell(10, 5, '', 0, 0);
    $pdf->Cell(43, 3, utf8_decode($row['student_mname']), 'B', 1, 'C');

    $pdf->Ln(1);
    $pdf->SetFont('Arial', '', 8);
    $pdf->Cell(13, 2, '', 0, 0);
    $pdf->Cell(42, 2, '(Family Name)', 0, 0, 'C');
    $pdf->Cell(50, 2, '(Given Name)', 0, 0, 'C');
    $pdf->Cell(50, 2, '(Middle Name)', 0, 1, 'C');

    $pdf->Ln(1);
    $pdf->Cell(13, 3, 'Address:', 0, 0);
    $fontsize = 9;
    $tempFontSize = $fontsize;
    $cellwidth = 135;

    while ($pdf->GetStringWidth($row['address']) > $cellwidth) {
        $pdf->SetFontSize($tempFontSize -= 0.1);
    }
    $pdf->Cell(141, 3, $row['address'], 'B', 1, 'L');

    $pdf->Ln(2);
    $pdf->SetFont('Arial', '', 8);
    $pdf->Cell(17, 3, 'Contact No.:', 0, 0);
    $pdf->SetFont('Arial', '', 9);
    $pdf->Cell(45, 3, $row['cellphone'], 'B', 0, 'C');
    $pdf->Cell(10, 3, '', 0, 0);
    $pdf->Cell(11, 3, 'E-Mail:', 0, 0);
    $pdf->SetFont('Arial', '', 9);
    $pdf->Cell(71, 3, utf8_decode($row['email']), 'B', 1, 'L');

    $pdf->Ln(2);
    $pdf->SetFont('Arial', 'B', 9);
    $pdf->Cell(155, 4, 'FINANCIAL DETAILS', 1, 1, 'C');
}

$pdf->Ln(1);
$pdf->SetFont('Arial', 'B', 8);
$pdf->Cell(43, 2, 'SCHOLARSHIP DISCOUNT:', 0, 0);
$pdf->Cell(15, 5, 'DATE', 1, 0, 'C');
$pdf->Cell(45, 5, 'PARTICULARS', 1, 0, 'C');
$pdf->Cell(25, 5, 'CREDIT', 1, 0, 'C');
$pdf->Cell(27, 5, 'BALANCE', 1, 1, 'C');

$pdf->SetFont('Arial', '', 8);
$pdf->Cell(5, 3, '', 0, 0);
$pdf->Rect(5, 68, 3, 3);
$pdf->Cell(38, 3, 'ACADEMIC:', 0, 0);
$pdf->Cell(15, 4, '', 1, 0, 'C');
$pdf->Cell(45, 4, '', 1, 0, 'C');
$pdf->Cell(25, 4, '', 1, 0, 'C');
$pdf->Cell(27, 4, '', 1, 1, 'C');

$pdf->Cell(5, 3, '', 0, 0);
$pdf->Rect(5, 72, 3, 3);
$pdf->Cell(38, 3, 'CULTURAL:', 0, 0);
$pdf->Cell(15, 4, '', 1, 0, 'C');
$pdf->Cell(45, 4, '', 1, 0, 'C');
$pdf->Cell(25, 4, '', 1, 0, 'C');
$pdf->Cell(27, 4, '', 1, 1, 'C');

$pdf->Cell(5, 3, '', 0, 0);
$pdf->Rect(5, 76, 3, 3);
$pdf->Cell(38, 3, 'ATHLETIC:', 0, 0);
$pdf->Cell(15, 4, '', 1, 0, 'C');
$pdf->Cell(45, 4, '', 1, 0, 'C');
$pdf->Cell(25, 4, '', 1, 0, 'C');
$pdf->Cell(27, 4, '', 1, 1, 'C');

$pdf->Cell(5, 3, '', 0, 0);
$pdf->Rect(5, 80, 3, 3);
$pdf->Cell(38, 3, 'SIBLING:', 0, 0);
$pdf->Cell(15, 4, '', 1, 0, 'C');
$pdf->Cell(45, 4, '', 1, 0, 'C');
$pdf->Cell(25, 4, '', 1, 0, 'C');
$pdf->Cell(27, 4, '', 1, 1, 'C');

$pdf->Cell(5, 3, '', 0, 0);
$pdf->Rect(5, 84, 3, 3);
$pdf->Cell(38, 3, 'EMPLOYEE:', 0, 0);
$pdf->Cell(15, 4, '', 1, 0, 'C');
$pdf->Cell(45, 4, '', 1, 0, 'C');
$pdf->Cell(25, 4, '', 1, 0, 'C');
$pdf->Cell(27, 4, '', 1, 1, 'C');

$pdf->Cell(5, 3, '', 0, 0);
$pdf->Rect(5, 88, 3, 3);
$pdf->Cell(38, 3, 'E.O.O.SCHLR.:', 0, 0);
$pdf->Cell(15, 4, '', 1, 0, 'C');
$pdf->Cell(45, 4, '', 1, 0, 'C');
$pdf->Cell(25, 4, '', 1, 0, 'C');
$pdf->Cell(27, 4, '', 1, 1, 'C');

$pdf->Cell(5, 3, '', 0, 0);
$pdf->Rect(5, 92, 3, 3);
$pdf->Cell(25, 3, '', 'B', 0, 'C');
$pdf->Cell(13, 3, '', 0, 0);
$pdf->Cell(15, 4, '', 1, 0, 'C');
$pdf->Cell(45, 4, '', 1, 0, 'C');
$pdf->Cell(25, 4, '', 1, 0, 'C');
$pdf->Cell(27, 4, '', 1, 1, 'C');

$pdf->Cell(43, 2, 'GOVERNMENT ASSISTANCE:', 0, 0);
$pdf->Cell(15, 4, '', 1, 0, 'C');
$pdf->Cell(45, 4, '', 1, 0, 'C');
$pdf->Cell(25, 4, '', 1, 0, 'C');
$pdf->Cell(27, 4, '', 1, 1, 'C');

$pdf->Cell(5, 3, '', 0, 0);
$pdf->Rect(5, 100, 3, 3);
$pdf->Cell(38, 3, 'ESC', 0, 0);
$pdf->Cell(15, 4, '', 1, 0, 'C');
$pdf->Cell(45, 4, '', 1, 0, 'C');
$pdf->Cell(25, 4, '', 1, 0, 'C');
$pdf->Cell(27, 4, '', 1, 1, 'C');

$pdf->Cell(5, 3, '', 0, 0);
$pdf->Rect(5, 104, 3, 3);
$pdf->Cell(38, 3, 'NTUP', 0, 0);
$pdf->Cell(15, 4, '', 1, 0, 'C');
$pdf->Cell(45, 4, '', 1, 0, 'C');
$pdf->Cell(25, 4, '', 1, 0, 'C');
$pdf->Cell(27, 4, '', 1, 1, 'C');

$pdf->Cell(5, 3, '', 0, 0);
$pdf->Rect(5, 108, 3, 3);
$pdf->Cell(38, 3, 'WTUP', 0, 0);
$pdf->Cell(15, 4, '', 1, 0, 'C');
$pdf->Cell(45, 4, '', 1, 0, 'C');
$pdf->Cell(25, 4, '', 1, 0, 'C');
$pdf->Cell(27, 4, '', 1, 1, 'C');

$pdf->Cell(5, 3, '', 0, 0);
$pdf->Rect(5, 112, 3, 3);
$pdf->Cell(38, 3, 'NO VOUCHER', 0, 0);
$pdf->Cell(15, 4, '', 1, 0, 'C');
$pdf->Cell(45, 4, '', 1, 0, 'C');
$pdf->Cell(25, 4, '', 1, 0, 'C');
$pdf->Cell(27, 4, '', 1, 1, 'C');

$pdf->Cell(5, 3, '', 0, 0);
$pdf->Rect(5, 116, 3, 3);
$pdf->Cell(25, 3, '', 'B', 0, 'C');
$pdf->Cell(13, 3, '', 0, 0);
$pdf->Cell(15, 4, '', 1, 0, 'C');
$pdf->Cell(45, 4, '', 1, 0, 'C');
$pdf->Cell(25, 4, '', 1, 0, 'C');
$pdf->Cell(27, 4, '', 1, 1, 'C');

$get_prin = mysqli_query($conn, "SELECT * FROM tbl_principals");
while ($row = mysqli_fetch_array($get_prin)) {

    $pdf->Ln(1);
    $pdf->Cell(50, 3, 'Date of Enrollment:', 0, 0);
    $pdf->Cell(35, 3, '', 'B', 0, 'C');
    $pdf->Cell(30, 3, '', 0, 0);
    $pdf->Cell(35, 3, utf8_decode($row['prin_fname'] . ' ' . $row['prin_mname'] . ' ' . $row['prin_lname']), 'B', 1, 'C');
}

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

    $pdf->Cell(35, 3, $row['date_enrolled'], 'B', 0, 'C');
    $pdf->Cell(20, 3, '', 0, 0);
    $pdf->Cell(53, 4, 'Enrolling Officer', 0, 0);

    $pdf->Cell(20, 3, '', 0, 0);
    $pdf->Cell(55, 4, 'Principal', 0, 0);
}


//-----------------------------------Registrar-------------------------------------//
$pdf->SetLeftMargin(5);
$pdf->SetRightMargin(5);
$pdf->SetAutoPageBreak(true, 8);
$pdf->AddPage();

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


    $pdf->Image('../../../assets/img/logo.png', 33, 9, 10, 10);

    $pdf->SetTextColor(255, 0, 0);

    $pdf->SetFont('Arial', 'B', 11);

    $pdf->Cell(151, 5, 'SAINT FRANCIS OF ASSISI COLLEGE', 0, 1, 'C');

    $pdf->SetTextColor(0, 0, 0);
    $pdf->SetFont('Arial', '', 11, 'C');

    $test = utf8_decode("");
    $pdf->Cell(151, 5, '96 Bayanan ' . $test . ', City of Bacoor, Cavite', 0, 1, 'C');

    $pdf->Ln(1);
    $pdf->SetFont('Arial', '', 9);
    $pdf->Cell(145, 2, 'BASIC EDUCATION DEPARTMENT', 0, 0, 'C');


    $pdf->Ln(2);
    $pdf->SetFont('Arial', 'B', 9);
    $pdf->Rect(126, 21, 34, 6);
    $pdf->Cell(155, 4, 'REGISTRAR\'S COPY', 0, 1, 'R');
    $pdf->Cell(155, 5, 'CERTIFICATE OF REGISTRATION AND STUDENTS INFORMATION', 0, 0, 'C');
    $pdf->Cell(10, 5, '', 0, 1);

    $pdf->Ln(1);
    $pdf->SetFont('Arial', '', 9);
    $pdf->Cell(8, 5, '', 0, 0);
    $pdf->Cell(30, 4, 'ACADEMIC YEAR: ', 0, 0);
    $pdf->Cell(35, 4, $row['academic_year'], 'B', 0, 'C');
    $pdf->Cell(10, 5, '', 0, 0);
    $pdf->Cell(28, 4, 'STUDENT TYPE: ', 0, 0);
    $pdf->Cell(40, 4, $row['stud_type'], 'B', 0, 'C');
    $pdf->Cell(10, 5, '', 0, 1);
    $pdf->Cell(12, 5, '', 0, 0);
    $pdf->Cell(26, 4, 'GRADE LEVEL: ', 0, 0);
    $pdf->Cell(35, 4, $row['grade_level'], 'B', 0, 'C');
    $pdf->Cell(20, 5, '', 0, 0);
    $pdf->Cell(18, 4, 'SECTION: ', 0, 0);
    if (!empty($row['section'])) {
        $pdf->Cell(40, 4, utf8_decode($row['section']), 'B', 1, 'C');
    } else {
        $pdf->Cell(40, 4, 'TBA', 'B', 1, 'C');
    }
    $pdf->Cell(20, 5, '', 0, 0);
    $pdf->Cell(18, 4, 'STRAND: ', 0, 0);
    $pdf->Cell(35, 4, $row['strand_name'], 'B', 0, 'C');
    $pdf->Cell(13, 5, '', 0, 0);
    $pdf->Cell(25, 4, 'STUDENT NO.: ', 0, 0);
    $pdf->Cell(40, 4, $row['stud_no'], 'B', 0, 'C');
    $pdf->Cell(8, 4, '', 0, 1);

    $pdf->Ln(2.5);
    $pdf->SetFont('Arial', '', 8);
    $pdf->Cell(11, 3, 'NAME:', 0, 0);
    $pdf->SetFont('Arial', '', 9);
    $pdf->Cell(40, 3, utf8_decode($row['student_lname']), 'B', 0, 'C');
    $pdf->Cell(10, 5, '', 0, 0);
    $pdf->Cell(40, 3, utf8_decode($row['student_fname']), 'B', 0, 'C');
    $pdf->Cell(10, 5, '', 0, 0);
    $pdf->Cell(40, 3, utf8_decode($row['student_mname']), 'B', 1, 'C');

    $pdf->Ln(1);
    $pdf->SetFont('Arial', '', 8);
    $pdf->Cell(13, 3, '', 0, 0);
    $pdf->Cell(40, 3, '(Family Name)', 0, 0, 'C');
    $pdf->Cell(59, 3, '(Given Name)', 0, 0, 'C');
    $pdf->Cell(35, 3, '(Middle Name)', 0, 1, 'C');

    $pdf->Ln(2);
    $pdf->SetFont('Arial', '', 8);
    $pdf->Cell(15, 3, 'ADDRESS:', 0, 0);
    $fontsize = 8;
    $tempFontSize = $fontsize;
    $cellwidth = 130;
    while ($pdf->GetStringWidth($row['address']) > $cellwidth) {
        $pdf->SetFontSize($tempFontSize -= 0.1);
    }
    $pdf->Cell(136, 3, $row['address'], 'B', 1, 'C');

    $pdf->Ln(2);
    $pdf->SetFont('Arial', '', 8);
    $pdf->Cell(10, 5, '', 0, 0);
    $pdf->Cell(22, 3, 'CONTACT NO.:', 0, 0);
    $pdf->SetFont('Arial', '', 9);
    $pdf->Cell(30, 3, $row['cellphone'], 'B', 0, 'C');

    $pdf->Cell(9, 5, '', 0, 0);
    $pdf->SetFont('Arial', '', 8);
    $pdf->Cell(16, 3, 'RELIGION:', 0, 0);
    $pdf->SetFont('Arial', '', 9);
    $pdf->Cell(30, 3, $row['religion'], 'B', 0, 'C');

    $pdf->Cell(4, 5, '', 0, 0);
    $pdf->SetFont('Arial', '', 8);
    $pdf->Cell(8, 3, 'AGE:', 0, 0);
    $pdf->SetFont('Arial', '', 9);
    $pdf->Cell(22, 3, $row['age'], 'B', 1, 'C');

    $pdf->Ln(1.5);
    $pdf->SetFont('Arial', '', 8);
    $pdf->Cell(5, 5, '', 0, 0);
    $pdf->SetFont('Arial', '', 8);
    $pdf->Cell(27, 3, 'PLACE OF BIRTH:', 0, 0);
    $fontsize = 11;
    $tempFontSize = $fontsize;
    $cellwidth = 27;
    while ($pdf->GetStringWidth($row['place_birth']) > $cellwidth) {
        $pdf->SetFontSize($tempFontSize -= 0.1);
    }
    $pdf->Cell(30, 3, $row['place_birth'], 'B', 0, 'C');

    $pdf->SetFont('Arial', '', 8);
    $pdf->Cell(10, 5, '', 0, 0);
    $pdf->Cell(15, 3, 'GENDER:', 0, 0);
    $pdf->Cell(30, 3, $row['gender_name'], 'B', 1, 'C');

    $pdf->Ln(1);
    $pdf->SetFont('Arial', '', 8);
    $pdf->Cell(9, 5, '', 0, 0);
    $pdf->Cell(23, 3, 'NATIONALITY:', 0, 0);
    $pdf->SetFont('Arial', '', 9);
    $pdf->Cell(30, 3, $row['nationality'], 'B', 0, 'C');

    $pdf->Cell(1, 5, '', 0, 0);
    $pdf->SetFont('Arial', '', 8);
    $pdf->Cell(24, 3, 'DATE OF BIRTH:', 0, 0);
    $pdf->SetFont('Arial', '', 9);
    $pdf->Cell(30, 3, $row['date_birth'], 'B', 0, 'C');
    $pdf->Cell(3, 3, '', 0, 0);

    $pdf->SetFont('Arial', 'B', 8);
    $pdf->Cell(43, 2, 'SCHOLARSHIP DISCOUNT:', 0, 1);

    $pdf->Ln(1.5);
    $pdf->SetFont('Arial', '', 8);
    $pdf->Cell(2, 5, '', 0, 0);
    $pdf->Cell(30, 3, 'NAME OF FATHER:', 0, 0);
    $pdf->SetFont('Arial', '', 9);
    $fontsize = 9;
    $tempFontSize = $fontsize;
    $cellwidth = 28;
    while ($pdf->GetStringWidth($row['fname']) > $cellwidth) {
        $pdf->SetFontSize($tempFontSize -= 0.1);
    }
    $pdf->Cell(30, 3, utf8_decode($row['fname']), 'B', 0, 'C');

    $pdf->SetFont('Arial', '', 8);
    $pdf->Cell(1, 5, '', 0, 0);
    $pdf->Cell(24, 3, 'F.OCCUPATION:', 0, 0);
    $pdf->SetFont('Arial', '', 9);
    $fontsize = 9;
    $tempFontSize = $fontsize;
    $cellwidth = 26;
    while ($pdf->GetStringWidth($row['focc']) > $cellwidth) {
        $pdf->SetFontSize($tempFontSize -= 0.1);
    }
    $pdf->Cell(30, 3, $row['focc'], 'B', 0, 'C');

    $pdf->SetFont('Arial', '', 8);
    $pdf->Cell(10, 5, '', 0, 0);
    $pdf->Rect(125, 74, 4, 4);
    $pdf->Cell(3, 3, '', 0, 0);
    $pdf->Cell(35, 3, 'ACADEMIC', 0, 1);

    $pdf->Ln(1.5);
    $pdf->SetFont('Arial', '', 8);
    $pdf->Cell(10, 5, '', 0, 0);
    $pdf->Cell(22, 3, 'CONTACT NO:', 0, 0);
    $pdf->SetFont('Arial', '', 9);
    $pdf->Cell(30, 3, $row['fcontact'], 'B', 0, 'C');

    $pdf->Cell(65, 5, '', 0, 0);
    $pdf->Rect(125, 78, 4, 4);
    $pdf->Cell(3, 3, '', 0, 0);
    $pdf->Cell(38, 3, 'CULTURAL', 0, 1);

    $pdf->Ln(1.3);
    $pdf->SetFont('Arial', '', 8);
    $pdf->Cell(3, 5, '', 0, 0);
    $pdf->Cell(29, 3, 'NAME OF MOTHER:', 0, 0);
    $pdf->SetFont('Arial', '', 9);
    $fontsize = 9;
    $tempFontSize = $fontsize;
    $cellwidth = 29;
    while ($pdf->GetStringWidth($row['mname']) > $cellwidth) {
        $pdf->SetFontSize($tempFontSize -= 0.1);
    }
    $pdf->Cell(30, 3, utf8_decode($row['mname']), 'B', 0, 'C');

    $pdf->SetFont('Arial', '', 8);
    $pdf->Cell(1, 3, '', 0, 0);
    $pdf->Cell(24, 3, 'M.OCCUPATION:', 0, 0);
    $pdf->SetFont('Arial', '', 9);
    $fontsize = 9;
    $tempFontSize = $fontsize;
    $cellwidth = 25;
    while ($pdf->GetStringWidth($row['mocc']) > $cellwidth) {
        $pdf->SetFontSize($tempFontSize -= 0.1);
    }
    $pdf->Cell(30, 3, $row['mocc'], 'B', 0, 'C');

    $pdf->SetFont('Arial', '', 8);
    $pdf->Cell(8, 5, '', 0, 0);
    $pdf->Rect(125, 82, 4, 4);
    $pdf->Cell(5, 3, '', 0, 0);
    $pdf->Cell(38, 3, 'ATHLETIC', 0, 1);

    $pdf->Ln(1.5);
    $pdf->SetFont('Arial', '', 8);
    $pdf->Cell(10, 3, '', 0, 0);
    $pdf->Cell(22, 3, 'CONTACT NO:', 0, 0);
    $pdf->SetFont('Arial', '', 9);
    $pdf->Cell(30, 3, $row['mcontact'], 'B', 0, 'C');

    $pdf->Cell(65, 5, '', 0, 0);
    $pdf->Rect(125, 86, 4, 4);
    $pdf->Cell(3, 3, '', 0, 0);
    $pdf->Cell(38, 3, 'SIBLING', 0, 1);

    $pdf->Ln(1);
    $pdf->SetFont('Arial', '', 8);
    $pdf->Cell(1, 3, '', 0, 0);
    $pdf->Cell(38, 3, 'LAST SCHOOL ATTENDED:', 0, 0);
    $fontsize = 8;
    $tempFontSize = $fontsize;
    $cellwidth = 65;
    while ($pdf->GetStringWidth($row['last_sch']) > $cellwidth) {
        $pdf->SetFontSize($tempFontSize -= 0.1);
    }
    $pdf->Cell(67, 3, $row['last_sch'], 'B', 0, 'C');

    $pdf->SetFont('Arial', '', 8);
    $pdf->Cell(15, 5, '', 0, 0);
    $pdf->Rect(125, 90, 4, 4);
    $pdf->Cell(9, 3, '', 0, 0);
    $pdf->Cell(38, 3, 'EMPLOYEE', 0, 1);

    $pdf->Ln(1);
    $pdf->SetFont('Arial', '', 8);
    $pdf->Cell(1, 5, '', 0, 0);
    $pdf->Cell(29, 3, 'SCHOOL ADDRESS:', 0, 0);
    $pdf->SetFont('Arial', '', 9);
    $pdf->Cell(76, 3, $row['sch_address'], 'B', 0, 'C');

    $pdf->Cell(23, 5, '', 0, 0);
    $pdf->Rect(125, 94, 4, 4);
    $pdf->Cell(1, 5, '', 0, 0);
    $pdf->Cell(38, 3, 'E.O.O.SCHLR.', 0, 1);

    $pdf->Ln(1);
    $pdf->SetFont('Arial', '', 8);
    $pdf->Cell(18, 5, '', 0, 0);
    $pdf->Cell(12, 3, 'E-MAIL:', 0, 0);
    $pdf->SetFont('Arial', '', 9);
    $pdf->Cell(76, 3, $row['email'], 'B', 0, 'C');

    $pdf->SetFont('Arial', 'B', 8);
    $pdf->Cell(10, 5, '', 0, 0);
    $pdf->Cell(38, 3, 'GOVERNMENT ASSISTANCE:', 0, 1);

    $pdf->Ln(1);
    $pdf->SetFont('Arial', 'B', 8);
    $pdf->Cell(1, 5, '', 0, 0);
    $pdf->Cell(60, 3, 'PERSON TO CONTACT IN CASE EMERGENCY', 0, 0);

    $pdf->SetFont('Arial', '', 8);
    $pdf->Cell(63, 5, '', 0, 0);
    $pdf->Rect(125, 103, 4, 4);
    $pdf->Cell(5, 3, '', 0, 0);
    $pdf->Cell(38, 3, 'ESC', 0, 1);

    $pdf->Ln(1);
    $pdf->SetFont('Arial', '', 8);
    $pdf->Cell(10, 3, 'NAME:', 0, 0);
    $pdf->SetFont('Arial', '', 9);
    $pdf->Cell(86, 3, utf8_decode($row['guardname']), 'B', 0, 'C');

    $pdf->Cell(28, 5, '', 0, 0);
    $pdf->Rect(125, 107, 4, 4);
    $pdf->Cell(5, 3, '', 0, 0);
    $pdf->Cell(38, 3, 'NTUP', 0, 1);

    $pdf->Ln(1);
    $pdf->SetFont('Arial', '', 8);
    $pdf->Cell(15, 3, 'ADDRESS:', 0, 0);
    $fontsize = 8;
    $tempFontSize = $fontsize;
    $cellwidth = 78;
    while ($pdf->GetStringWidth($row['gaddress']) > $cellwidth) {
        $pdf->SetFontSize($tempFontSize -= 0.1);
    }
    $pdf->Cell(81, 3, $row['gaddress'], 'B', 0, 'L');

    $pdf->SetFont('Arial', '', 8);
    $pdf->SetFont('Arial', '', 8);
    $pdf->Cell(19, 5, '', 0, 0);
    $pdf->Rect(125, 111, 4, 4);
    $pdf->Cell(14, 3, '', 0, 0);
    $pdf->Cell(38, 3, 'WTUP', 0, 1);

    $pdf->Ln(1);
    $pdf->SetFont('Arial', '', 8);
    $pdf->Cell(35, 3, 'TELEPHONE NO.:', 0, 0);
    $pdf->SetFont('Arial', '', 9);
    $pdf->Cell(61, 3, $row['gcontact'], 'B', 0, 'C');

    $pdf->Cell(28, 5, '', 0, 0);
    $pdf->Rect(125, 115, 4, 4);
    $pdf->Cell(5, 3, '', 0, 0);
    $pdf->Cell(45, 3, 'NO VOUCHER', 0, 1);

    $pdf->Ln(1);
    $pdf->SetFont('Arial', '', 8);
    $pdf->Cell(35, 3, 'PARENT\'S OFFICE ADD: ', 0, 0);
    $pdf->Cell(61, 3, '', 'B', 0, 'C');

    $pdf->Cell(15, 3, '', 0, 0);
    $pdf->Rect(125, 119, 4, 4);
    $pdf->Cell(15, 3, '', 0, 0);
    $pdf->Cell(25, 3, '', 'B', 1, 'C');

    $pdf->Ln(1);
    $pdf->SetFont('Arial', '', 8);
    $pdf->Cell(35, 3, 'OFFICE CONTACT NO.:', 0, 0);
    $pdf->Cell(61, 3, '', 'B', 1, 'C');

    $pdf->Ln(1);
    $pdf->SetFont('Arial', '', 8);
    $pdf->Cell(35, 3, 'DATE OF ENROLLMENT', 0, 0);
    $pdf->SetFont('Arial', '', 9);
    $pdf->Cell(61, 3, $row['date_enrolled'], 'B', 0, 'C');
    $pdf->Cell(10, 3, '', 0, 0);
    $pdf->Cell(38, 3, 'Verified/Approved by:', 0, 1);
}

$get_prin = mysqli_query($conn, "SELECT * FROM tbl_principals");
while ($row = mysqli_fetch_array($get_prin)) {

    $pdf->Ln(1);
    $pdf->SetFont('Arial', '', 8);
    $pdf->Cell(35, 3, "ENROLLING OFFICER: ", 0, 0);
    $pdf->Cell(61, 3, '', 'B', 0, 'C');
    $pdf->Cell(5, 3, '', 0, 0);
    $pdf->Cell(5, 3, '', 0,0);
    $pdf->SetFont('Arial', '', 9);
    $pdf->Cell(45, 3, utf8_decode($row['prin_fname'] . ' ' . $row['prin_mname'] . ' ' . $row['prin_lname']), 'B', 1, 'C');

    $pdf->Ln(1);
    $pdf->SetFont('Arial', '', 8);
    $pdf->Cell(55, 3, '', 0, 0);

    $pdf->Cell(65, 3, '', 0, 0);
    $pdf->Cell(33, 3, 'Principal', 0, 0);
}

//-----------------------------------STUDENT----------------------------//
$pdf->SetLeftMargin(13);
$pdf->SetRightMargin(10);
$pdf->SetAutoPageBreak(true, 8);
$pdf->AddPage();

$get_stud = mysqli_query($conn, "SELECT *, CONCAT(stud.student_fname, ' ', (stud.student_mname), ' ', stud.student_lname) AS fullname 
FROM tbl_schoolyears AS sy
LEFT JOIN tbl_students AS stud ON stud.student_id = sy.student_id
LEFT JOIN tbl_genders AS gen ON gen.gender_id = stud.gender_id
LEFT JOIN tbl_grade_levels AS gl ON gl.grade_level_id = sy.grade_level_id
LEFT JOIN tbl_strands AS std ON std.strand_id = sy.strand_id 
LEFT JOIN tbl_acadyears AS ay ON ay.ay_id = sy.ay_id
LEFT JOIN tbl_semesters AS sem ON sem.semester_id = sy.semester_id
WHERE sy.student_id = '$stud_id' AND sy.ay_id = '$ay_id' AND sy.semester_id = '$sem_id'") or die(mysqli_error($conn));
while ($row = mysqli_fetch_array($get_stud)) {


    $pdf->Image('../../../assets/img/logo.png', 33, 9, 10, 10);

    $pdf->SetTextColor(255, 0, 0);

    $pdf->SetFont('Arial', 'B', 11);

    $pdf->Cell(151, 5, 'SAINT FRANCIS OF ASSISI COLLEGE', 0, 1, 'C');

    $pdf->SetTextColor(0, 0, 0);
    $pdf->SetFont('Arial', '', 11, 'C');

    $test = utf8_decode("");
    $pdf->Cell(151, 5, '96 Bayanan ' . $test . ', City of Bacoor, Cavite', 0, 1, 'C');

    $pdf->Ln(1);
    $pdf->SetFont('Arial', '', 9);
    $pdf->Cell(145, 2, 'BASIC EDUCATION DEPARTMENT', 0, 0, 'C');

    $pdf->Ln(2);
    $pdf->Rect(121, 22, 33, 5);
    $pdf->SetFont('Arial', 'B', 9);
    $pdf->Cell(140, 4, 'STUDENT\'S COPY', 0, 1, 'R');
    $pdf->SetFont('Arial', '', 9);
    $pdf->Cell(142, 5, 'CERTIFICATE OF REGISTRATION AND STUDENTS INFORMATION', 1, 0, 'C');
    $pdf->Cell(10, 5, '', 0, 1);

    $pdf->Ln(1);
    $pdf->SetFont('Arial', '', 9);
    $pdf->Cell(2, 5, '', 0, 0);
    $pdf->Cell(30, 4, 'ACADEMIC YEAR: ', 0, 0);
    $pdf->Cell(35, 4, $row['academic_year'], 'B', 0, 'C');
    $pdf->Cell(5, 5, '', 0, 0);
    $pdf->Cell(28, 4, 'STUDENT TYPE: ', 0, 0);
    $pdf->Cell(40, 4, $row['stud_type'], 'B', 0, 'C');
    $pdf->Cell(10, 5, '', 0, 1);
    $pdf->Cell(6, 5, '', 0, 0);
    $pdf->Cell(26, 4, 'GRADE LEVEL: ', 0, 0);
    $pdf->Cell(35, 4, $row['grade_level'], 'B', 0, 'C');
    $pdf->Cell(15, 5, '', 0, 0);
    $pdf->Cell(18, 4, 'SECTION: ', 0, 0);
    if (!empty($row['section'])) {
        $pdf->Cell(40, 4, utf8_decode($row['section']), 'B', 1, 'C');
    } else {
        $pdf->Cell(40, 4, 'TBA', 'B', 1, 'C');
    }
    $pdf->Cell(15, 5, '', 0, 0);
    $pdf->Cell(17, 4, 'STRAND: ', 0, 0);
    $pdf->Cell(35, 4, $row['strand_name'], 'B', 0, 'C');
    $pdf->Cell(13, 5, '', 0, 0);
    $pdf->Cell(25, 4, 'STUDENT NO.: ', 0, 0);
    $pdf->Cell(40, 4, $row['stud_no'], 'B', 0, 'C');
    $pdf->Cell(10, 5, '', 0, 1);

    $pdf->Ln(.5);
    $pdf->SetFont('Arial', '', 8);
    $pdf->Cell(11, 3, 'NAME:', 0, 0);
    $pdf->SetFont('Arial', '', 9);
    $pdf->Cell(35, 3, utf8_decode($row['student_lname']), 'B', 0, 'C');
    $pdf->Cell(10, 5, '', 0, 0);
    $pdf->Cell(35, 3, utf8_decode($row['student_fname']), 'B', 0, 'C');
    $pdf->Cell(10, 5, '', 0, 0);
    $pdf->Cell(35, 3, utf8_decode($row['student_mname']), 'B', 1, 'C');

    $pdf->Ln(.5);
    $pdf->SetFont('Arial', '', 8);
    $pdf->Cell(13, 3, '', 0, 0);
    $pdf->Cell(35, 3, '(Family Name)', 0, 0, 'C');
    $pdf->Cell(50, 3, '(Given Name)', 0, 0, 'C');
    $pdf->Cell(50, 3, '(Middle Name)', 0, 1, 'C');

    $pdf->Ln(1);
    $pdf->SetFont('Arial', '', 8);
    $pdf->Cell(40, 4, 'COURSE NUMBER', 'T,L', 0, 'C');
    $pdf->Cell(10, 7, 'Units', 'T,L,B', 0, 'C');
    $pdf->Cell(15, 7, 'Days', 'T,L,B', 0, 'C');
    $pdf->Cell(20, 7, 'Time', 'T,L,B', 0, 'C');
    $pdf->Cell(10, 7, 'Room', 'T,L,R,B', 0, 'C');
    $pdf->Cell(17, 4, 'Final', 'T', 0, 'C');
    $pdf->Cell(0, 7, 'Professor', 1, 0, 'C');
    $pdf->Cell(0, 4, '', 0, 1);
    $pdf->Cell(40, 3, '(SUBJECTS)', 'L,B', 0, 'C');
    $pdf->Cell(55, 3, '', 0, 0);
    $pdf->Cell(17, 3, 'Rating', 'B', 0, 'C');

    $get_enrolled_sub = mysqli_query($conn, "SELECT *, CONCAT(teach.teacher_fname, ' ', LEFT(teach.teacher_mname,1), '. ', teach.teacher_lname) AS fullname FROM tbl_enrolled_subjects AS ensub
    LEFT JOIN tbl_schedules AS sched ON sched.schedule_id = ensub.schedule_id
    LEFT JOIN tbl_students AS stud ON stud.student_id = ensub.student_id
    LEFT JOIN tbl_subjects_senior AS sub ON sub.subject_id = sched.subject_id
    LEFT JOIN tbl_grade_levels AS gl ON gl.grade_level_id = sub.grade_level_id
    LEFT JOIN tbl_teachers AS teach ON teach.teacher_id = sched.teacher_id
    WHERE stud.student_id = '$stud_id' AND sched.semester = '$sem' AND sched.acadyear = '$acad' AND sub.strand_id = '$row[strand_id]'") or die(mysqli_error($conn));
    $y = $pdf->Gety();
    $xy = 3;
    $i = 1;
    while ($row2 = mysqli_fetch_array($get_enrolled_sub)) {
        $pdf->SetFont('Arial', '', '6');


        $pdf->SetXY(13, $y + $xy);
        $pdf->Cell(1, 3, $i, 0, 0, 'L');


        $fontsize = 6;
        $tempFontSize = $fontsize;
        $cellwidth = 30;
        while ($pdf->GetStringWidth($row2['subject_code']) > $cellwidth) {
            $pdf->SetFontSize($tempFontSize -= 0.1);
        }
        $pdf->Cell(39, 3, $row2['subject_code'], 0, 0, 'C');

        $pdf->Cell(10, 3, $row2['total_units'], 0, 0, 'C');

        $fontsize = 6;
        $tempFontSize = $fontsize;
        $cellwidth = 13;
        while ($pdf->GetStringWidth($row2['day']) > $cellwidth) {
            $pdf->SetFontSize($tempFontSize -= 0.1);
        }
        $pdf->Cell(15, 3, $row2['day'], 0, 0, 'C');

        $pdf->SetFont('Arial', '', '6');
        $fontsize = 6;
        $tempFontSize = $fontsize;
        $cellwidth = 18;
        while ($pdf->GetStringWidth($row2['time']) > $cellwidth) {
            $pdf->SetFontSize($tempFontSize -= 0.1);
        }
        $pdf->Cell(20, 3, $row2['time'], 0, 0, 'C');

        $pdf->SetFont('Arial', '', '6');
        $fontsize = 6;
        $tempFontSize = $fontsize;
        $cellwidth = 10;
        while ($pdf->GetStringWidth($row2['room']) > $cellwidth) {
            $pdf->SetFontSize($tempFontSize -= 0.1);
        }
        $pdf->Cell(10, 3, $row2['room'], 0, 0, 'C');

        $pdf->SetFont('Arial', '', '6');
        $pdf->Cell(17, 3, '', 0, 0, 'C');

        $fontsize = 6;
        $tempFontSize = $fontsize;
        $cellwidth = 27;
        while ($pdf->GetStringWidth($row2['fullname']) > $cellwidth) {
            $pdf->SetFontSize($tempFontSize -= 0.1);
        }
        if (!empty($row2['fullname'])) {
            $pdf->Cell(0, 3, utf8_decode($row2['fullname']), 0, 0, 'C');
            $pdf->SetFont('Arial', '', '9');
        } else {
            $pdf->Cell(0, 3, 'TBA', 0, 0, 'C');
            $pdf->SetFont('Arial', '', '9');
        }

        $xy += 3;
        $i++;
    }

    $pdf->Rect(13, 55, 40, 40);
    $pdf->Rect(63, 55, 15, 40);
    $pdf->Rect(98, 55, 10, 40);
    $pdf->Rect(125, 55, 30, 40);

    $pdf->SetXY(13, 90);
    $pdf->Cell(0, 5, '', 'B', 1);

    $pdf->Ln(1);
    $pdf->SetFont('Arial', 'B', 8);

    $pdf->Cell(142, 4, 'FINANCIAL DETAILS', 1, 1, 'C');

    $pdf->SetFont('Arial', '', 8);
    $pdf->Cell(20, 4, 'DATE', 1, 0, 'C');
    $pdf->Cell(55, 4, 'PARTICULARS', 1, 0, 'C');
    $pdf->Cell(30, 4, 'CREDIT', 1, 0, 'C');
    $pdf->Cell(37, 4, 'BALANCE', 1, 1, 'C');

    $pdf->Cell(20, 4, '', 1, 0, 'C');
    $pdf->Cell(55, 4, '', 1, 0, 'C');
    $pdf->Cell(30, 4, '', 1, 0, 'C');
    $pdf->Cell(37, 4, '', 1, 1, 'C');

    $pdf->Cell(20, 4, '', 1, 0, 'C');
    $pdf->Cell(55, 4, '', 1, 0, 'C');
    $pdf->Cell(30, 4, '', 1, 0, 'C');
    $pdf->Cell(37, 4, '', 1, 1, 'C');

    $pdf->Cell(20, 4, '', 1, 0, 'C');
    $pdf->Cell(55, 4, '', 1, 0, 'C');
    $pdf->Cell(30, 4, '', 1, 0, 'C');
    $pdf->Cell(37, 4, '', 1, 1, 'C');

    $pdf->Cell(20, 4, '', 1, 0, 'C');
    $pdf->Cell(55, 4, '', 1, 0, 'C');
    $pdf->Cell(30, 4, '', 1, 0, 'C');
    $pdf->Cell(37, 4, '', 1, 1, 'C');

    $pdf->Cell(20, 4, '', 1, 0, 'C');
    $pdf->Cell(55, 4, '', 1, 0, 'C');
    $pdf->Cell(30, 4, '', 1, 0, 'C');
    $pdf->Cell(37, 4, '', 1, 1, 'C');

    $pdf->Ln(2);
    $pdf->SetFont('Arial', 'B', 7.5);
    $pdf->Cell(75, 2, '', 0, 0);
    $pdf->Cell(0, 2, 'Verified / Approved by:', 0, 0, 'C');

    $pdf->Ln(4);
    $pdf->SetFont('Arial', 'B', 8);
    $pdf->Cell(40, 2, '', 'B', 0, 'C');
    $pdf->Cell(40, 2, '', 0, 0);
    $pdf->SetFont('Arial', '', 8);
}
$get_prin = mysqli_query($conn, "SELECT * FROM tbl_principals");
while ($row = mysqli_fetch_array($get_prin)) {
    $pdf->Cell(55, 3, utf8_decode($row['prin_fname'] . ' ' . $row['prin_mname'] . ' ' . $row['prin_lname']), 'B', 1, 'C');
    $pdf->Cell(25, 4, 'Name & Signature', 0, 0, 'C');
    $pdf->Cell(45, 2, '', 0, 0);
    $pdf->Cell(75, 4, 'Principal', 0, 0, 'C');
}


////-----------------------------------------------------END FRONT--------------------------------------------//



//---------------------------------PRINCIPAL BACK-------------------------------------//

//---------------------------------PRINCIPAL BACK-------------------------------------//

//---------------------------------PRINCIPAL BACK-------------------------------------//
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 6);
$pdf->SetTopMargin(13);
$pdf->SetLeftMargin(9);
$pdf->SetRightMargin(9);

$pdf->Ln(1);
$pdf->SetFont('Arial', 'B', 8);
$pdf->Cell(33, 3, 'RULES CONCERNING FEES', 0, 1);

$pdf->Ln(3);
$pdf->SetFont('Arial', 'B', 8);
$pdf->Cell(33, 3, 'PAYMENTS OF FEES', 0, 1);


$pdf->Ln(2);
$pdf->SetFont('Arial', '', 6);
$pdf->Cell(10, 4, 'All fees are computed on the semestral or school term basis and are payable in upon registration. The total fees may be paid by installment under the terms', 0, 1);
$pdf->Cell(10, 4, 'semester or Quarterly as shown in the mode of payment schedule which is available at the office of accountant', 0, 1);

$pdf->Ln(3);
$pdf->SetFont('Arial', 'B', 8);
$pdf->Cell(33, 3, 'DISCOUNT PRIVILEGES', 0, 1);

$pdf->Ln(2);
$pdf->SetFont('Arial', '', 8);
$pdf->Cell(33, 3, 'Discount on tuition fee only, may be given under the following conditions.', 0, 1);
$pdf->SetFont('Arial', '', 7);
$pdf->Cell(15, 3, '1. 10% discount on tuition fee if the total fees paid in upon registration (cash basic),', 0, 1);

$pdf->Cell(15, 3, '2. 5%, 10%, 15%, 20%, and 25% discount are given to second, third, fourth, fifth, and six brothers/sisters respectively, these condition', 0, 1);

$pdf->Cell(15, 3, 'are only granted base on a minimun of three (3) brothers/sisters who must enroll at the same time', 0, 1);

$pdf->Cell(15, 3, '1st honor -100% ', 0, 1);
$pdf->Cell(15, 3, '2nd honor -75% ', 0, 1);
$pdf->Cell(15, 3, '3rd honor -50% ', 0, 1);

$pdf->Ln(3);
$pdf->SetFont('Arial', 'B', 8);
$pdf->Cell(33, 3, 'ADJUSTMENT OF FEE TO WITHDRAWAL OF ENROLLMENT:', 0, 1);

$pdf->Ln(2);
$pdf->SetFont('Arial', '', 7);
$pdf->Cell(15, 3, 'Section VI, paragrap 137 & 139 of Manual of Regulations of Private Schools, Seventh Edition, 1970 of the Bureau of Private', 0, 1);

$pdf->Cell(15, 3, 'Schools, which is quoted below govern the refund or adjustment of fees:', 0, 1);


$pdf->Cell(7, 2.3, '', 0, 0);
$pdf->Cell(15, 3, '"137, When a student registers in a school, it is understood that he is enrolling for the entire school year for elementary and', 0, 1);
$pdf->Cell(15, 3, 'secondary courses, and for the entire semester for the collegiate courses. A student who transfers on otherwise withdraws, In writing,', 0, 1);

$pdf->Cell(15, 3, 'within two weeks after the beginning of classes and who has already paid the pertinent tuition and other school fees in full on any', 0, 1);

$pdf->Cell(15, 3, 'length longer than one month may be charged ten percent (10%) of the total amount due for the term if the withdraws within the first', 0, 1);

$pdf->Cell(15, 3, 'week of classes, or twenty percent (20%) if within the second week of classes, regardless of whether or not he has actually attended', 0, 1);

$pdf->Cell(15, 3, 'classes. The student may be charged all the school fees in full if the withdraw anytime after the second week of classes. However, if', 0, 1);

$pdf->Cell(15, 3, 'the transfer on withdrawal is due to a justifiable reason, the student shall be charged the pertinent fees up to an including the last month ', 0, 1);

$pdf->Cell(15, 3, 'of attended', 0, 1);


$pdf->Cell(7, 2.3, '', 0, 0);
$pdf->Cell(15, 3, '139. Full refund of fees shall be made for any course or level which has been discontinued by the school or not credited by', 0, 1);

$pdf->Cell(15, 3, 'the office thru no fault of the student.', 0, 1);

$pdf->Ln(3);
$pdf->SetFont('Arial', 'B', 8);
$pdf->Cell(33, 3, 'NON-PAYMENT OF ACCOUNT:', 0, 1);

$pdf->Ln(2);
$pdf->SetFont('Arial', '', 7);
$pdf->Cell(7, 2.3, '', 0, 0);
$pdf->Cell(15, 3, 'The administration reserves the right to suspend or drop from the rolls any student who has not paid in full his/her financial', 0, 1);

$pdf->Cell(15, 3, 'obligations on or before the scheduled dated of the third periodic examination. It is also reserves the right to withhold from a student', 0, 1);

$pdf->Cell(15, 3, 'the issuance of report card (form 138), honorable dismissal, certification, or other on other records, unless the student has fully', 0, 1);

$pdf->Cell(15, 3, 'settled his/her financial obligation or property with the college.', 0, 1);


//--------------------------------------------------------------- ACCOUNTING BACK------------------------------------//
//--------------------------------------------------------------- ACCOUNTING BACK------------------------------------//
//--------------------------------------------------------------- ACCOUNTING BACK------------------------------------//

$pdf->SetFont('Arial', 'B', 12);
$pdf->SetTopMargin(5);
$pdf->SetLeftMargin(5);
$pdf->AddPage();

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


    $pdf->SetFont('Arial', 'B', 14);
    $pdf->Cell(0, 6, 'INFORMATION', 0, 1, 'C');

    $pdf->SetFont('Arial', '', 10);
    $pdf->Cell(155, 5, "The student should fill in the information desired below and sign the promisory note.", 'B', 1, 'C');

    $pdf->Ln(.5);
    $pdf->SetFont('Arial', '', 8);
    $pdf->Cell(.1, 15, "", 'R', 0);
    $pdf->Cell(10, 3, 'NAME:', 0, 0);
    $pdf->Cell(144.9, 5, '', 'R', 1, 'C');
    $pdf->Cell(35, 5, utf8_decode($row['student_lname']), 0, 0, 'C');
    $pdf->Cell(35, 5, utf8_decode($row['student_fname']), 0, 0, 'C');
    $pdf->Cell(35, 5, utf8_decode($row['student_mname']), 0, 0, 'C');
    $pdf->Cell(50, 5, '', 'R', 1, 'C');

    $pdf->Cell(35, 5, "(Surname)", 0, 0, 'C');
    $pdf->Cell(35, 5, "(First Name)", 0, 0, 'C');
    $pdf->Cell(35, 5, "(Middle Name)", 0, 0, 'C');
    $pdf->Cell(50, 5, '', 'R', 1, 'C');


    $pdf->Ln(1);
    $pdf->SetFont('Arial', '', 9);
    $pdf->Cell(.1, 10.5, "", 'R', 0);
    $pdf->Cell(85, 4, "GENDER:", 'T', 0);
    $pdf->Cell(.1, 10, "", 'R', 0);
    $pdf->Cell(70, 4, "NATIONALITY:", 'T,R', 1);
    $pdf->Cell(35, 3, $row['gender_name'], 0, 0, 'C');
    $pdf->Cell(120.2, 3, $row['nationality'], 'R', 1, 'C');
    $pdf->Cell(155.2, 3, '', 'B,R', 1, 'C');


    $pdf->SetFont('Arial', '', 8);
    $pdf->Cell(.1, 12.5, "", 'R', 0);
    $pdf->Cell(155, 10, 'ADDRESS:', 'R', 1);
    $fontsize = 8;
    $tempFontSize = $fontsize;
    $cellwidth = 150;
    while ($pdf->GetStringWidth($row['address']) > $cellwidth) {
        $pdf->SetFontSize($tempFontSize -= 0.1);
    }
    $pdf->Cell(155.1, 3, $row['address'], 'B,R', 1, 'L');


    $pdf->SetFont('Arial', '', 9);
    $pdf->Cell(.1, 10.5, "", 'R', 0);
    $pdf->Cell(55, 6, "NAME OF FATHER", 'T', 0);
    $pdf->Cell(.1, 10.5, "", 'R', 0);
    $pdf->Cell(50, 6, "ADDRESS", 'T', 0, 'C');
    $pdf->Cell(.1, 10.5, "", 'R', 0);
    $pdf->Cell(50, 6, "TEL/CELLPHONE NO.", 'T,R', 1);
    $pdf->Cell(115, 5, utf8_decode($row['fname']), 0, 0, 'L');
    $pdf->Cell(40.3, 5, $row['fcontact'], 'R', 1, 'C');
    $pdf->Cell(155.3, 0, '', 'R', 1, 'C');


    $pdf->SetFont('Arial', '', 9);
    $pdf->Cell(.1, 12, "", 'R', 0);
    $pdf->Cell(55, 6, "NAME OF MOTHER", 'T', 0);
    $pdf->Cell(.1, 12, "", 'R', 0);
    $pdf->Cell(50, 6, "ADDRESS", 'T', 0, 'C');
    $pdf->Cell(.1, 12, "", 'R', 0);
    $pdf->Cell(50, 6, "TEL/CELLPHONE NO.", 'T,R', 1);
    $pdf->Cell(115, 5, utf8_decode($row['mname']), 0, 0, 'L');
    $pdf->Cell(40.3, 5, $row['mcontact'], 'R', 1, 'C');
    $pdf->Cell(155.3, 1, '', 'B,R', 1, 'C');



    $pdf->Ln(5);
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(0, 7, 'PROMISSORY NOTE', 0, 1, 'C');
    $pdf->Ln(1);
    $pdf->SetFont('Arial', '', 8);
    $pdf->Cell(150, 5, "I hereby acknowledge that I will abide by the rules and regulations of SFAC concerning fees. Being allowed solely", 0, 1);
    $pdf->Cell(150, 5, "for my convenience to pay my tuition and other fees by installment, I hereby promise to pay on demand the full", 0, 1);
    $pdf->Cell(150, 5, "unpaid balance of my account for the entire semester or school term, as the case may be, even if I should stop ", 0, 1);
    $pdf->Cell(150, 5, "studying or transfer to another school before the end of the semester or school term", 0, 1);


    $pdf->Cell(150, 4, "", 0, 1);
    $pdf->Cell(70, 6, "", 'B', 0);
    $pdf->Cell(40, 6, "", 0, 0);
    $pdf->Cell(40, 6, "", 'B', 1);

    $pdf->SetFont('Arial', '', 7);

    $pdf->Cell(70, 6, "Signature Over Printed Name", 0, 0, 'C');
    $pdf->Cell(40, 6, "", 0, 0);
    $pdf->Cell(40, 6, "Date Signed", 0, 0, 'C');
}

//-------------------------------------- REGISTRAR BACK --------------------------------------------------//

//-------------------------------------- REGISTRAR BACK --------------------------------------------------//

//-------------------------------------- REGISTRAR BACK --------------------------------------------------//
$pdf->AddPage();
$pdf->SetFont('Arial', '', 9);
$pdf->SetTopMargin(9);
$pdf->SetLeftMargin(9);
$pdf->SetRightMargin(9);

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

    $pdf->Cell(15, 2.3, '', 0, 0);
    $pdf->Cell(10, 4, "I", 0, 0);
    $pdf->SetFont('Arial', '', 9);
    $pdf->Cell(100, 4, utf8_decode($row['guardname']), 'B', 0, 'C');
    $pdf->Cell(1, 4, "", 'B', 0);
    $pdf->Cell(6, 2.3, '', 0, 0);
    $pdf->Cell(6, 4, "of", 0, 1);
    $pdf->SetFont('Arial', '', 9);
    $pdf->Cell(150, 6, "Name of Parents", 0, 1, 'C');


    $pdf->Ln(3);
    $pdf->Cell(150, 4, "", 0, 1);
    $pdf->Cell(70, 6, utf8_decode($row['fullname']), 'B', 0, 'C');
    $pdf->Cell(40, 6, "", 0, 0);
    $pdf->Cell(40, 6, utf8_decode($row['grade_level']), 'B', 1, 'C');

    $pdf->SetFont('Arial', '', 9);
    $pdf->Cell(70, 6, "Name of Student", 0, 0, 'C');
    $pdf->Cell(40, 6, "", 0, 0);
    $pdf->Cell(40, 6, "Grade Level", 0, 1, 'C');


    $pdf->Ln(5);
    $pdf->SetFont('Arial', '', 9);
    $pdf->Cell(5, 2.3, '', 0, 0);
    $pdf->Cell(10, 5, "I hereby declare that information provide in this form are true to best of my knowledge and that any", 0, 1);

    $pdf->Cell(5, 2.3, '', 0, 0);
    $pdf->Cell(10, 5, "false or malicious information in this form or any omission which is misleading will be sufficient", 0, 1);

    $pdf->Cell(5, 2.3, '', 0, 0);
    $pdf->Cell(10, 5, "grounds for immediate dismissal upon discovery, regardless when such discoveries shall be made.", 0, 1);


    $pdf->Ln(3);
    $pdf->Cell(50, 4, '', 0, 1);
    $pdf->Cell(50, 6, utf8_decode($row['guardname']), 'B', 0, 'C');
    $pdf->Cell(5, 2.3, '', 0, 0);
    $pdf->Cell(40, 6, '', 'B', 0);
    $pdf->Cell(5, 2.3, '', 0, 0);
    $pdf->Cell(10, 6, '', 0, 0);
    $pdf->Cell(40, 6, '', 'B', 1);

    $pdf->SetFont('Arial', '', 9);
    $pdf->Cell(50, 6, 'Parent/Guardian\'s Name', 0, 0, 'C');
    $pdf->Cell(15, 6, '', 0, 0);
    $pdf->Cell(20, 6, '', 0, 0, 'C');
    $pdf->Cell(95, 6, 'Date Signed:', 0, 1, 'C');


    $pdf->Ln(3);
    $pdf->Cell(50, 4, "", 0, 1);
    $pdf->Cell(50, 6, utf8_decode($row['fullname']), 'B', 0, 'C');
    $pdf->Cell(5, 2.3, '', 0, 0);
    $pdf->Cell(40, 6, '', 'B', 0);
    $pdf->Cell(5, 2.3, '', 0, 0);
    $pdf->Cell(10, 6, "", 0, 0);
    $pdf->Cell(40, 6, "", 'B', 1);

    $pdf->SetFont('Arial', '', 9);
    $pdf->Cell(50, 6, "Name of Student", 0, 0, 'C');
    $pdf->Cell(15, 6, "", 0, 0);
    $pdf->Cell(20, 6, "Signature", 0, 0, 'C');
    $pdf->Cell(95, 6, "Date Signed:", 0, 1, 'C');



    //------------------------------------------------------------ STUDENT BACK -------------------------------------------//
    //------------------------------------------------------------ STUDENT BACK -------------------------------------------//
    //------------------------------------------------------------ STUDENT BACK -------------------------------------------//

    $pdf->AddPage();
    $pdf->SetFont('Arial', 'B', 6);
    $pdf->SetTopMargin(13);
    $pdf->SetLeftMargin(9);
    $pdf->SetRightMargin(9);

    $pdf->Ln(1);
    $pdf->SetFont('Arial', 'B', 8);
    $pdf->Cell(33, 3, 'RULES CONCERNING FEES', 0, 1);

    $pdf->Ln(3);
    $pdf->SetFont('Arial', 'B', 8);
    $pdf->Cell(33, 3, 'PAYMENTS OF FEES', 0, 1);


    $pdf->Ln(2);
    $pdf->SetFont('Arial', '', 6);
    $pdf->Cell(10, 4, 'All fees are computed on the semestral or school term basis and are payable in upon registration. The total fees may be paid by installment under the terms', 0, 1);
    $pdf->Cell(10, 4, 'semester or Quarterly as shown in the mode of payment schedule which is available at the office of accountant', 0, 1);

    $pdf->Ln(3);
    $pdf->SetFont('Arial', 'B', 8);
    $pdf->Cell(33, 3, 'DISCOUNT PRIVILEGES', 0, 1);

    $pdf->Ln(2);
    $pdf->SetFont('Arial', '', 8);
    $pdf->Cell(33, 3, 'Discount on tuition fee only, may be given under the following conditions.', 0, 1);
    $pdf->SetFont('Arial', '', 7);
    $pdf->Cell(15, 3, '1. 10% discount on tuition fee if the total fees paid in upon registration (cash basic),', 0, 1);

    $pdf->Cell(15, 3, '2. 5%, 10%, 15%, 20%, and 25% discount are given to second, third, fourth, fifth, and six brothers/sisters respectively, these condition', 0, 1);

    $pdf->Cell(15, 3, 'are only granted base on a minimun of three (3) brothers/sisters who must enroll at the same time', 0, 1);

    $pdf->Cell(15, 3, '1st honor -100% ', 0, 1);
    $pdf->Cell(15, 3, '2nd honor -75% ', 0, 1);
    $pdf->Cell(15, 3, '3rd honor -50% ', 0, 1);

    $pdf->Ln(3);
    $pdf->SetFont('Arial', 'B', 8);
    $pdf->Cell(33, 3, 'ADJUSTMENT OF FEE TO WITHDRAWAL OF ENROLLMENT:', 0, 1);

    $pdf->Ln(2);
    $pdf->SetFont('Arial', '', 7);
    $pdf->Cell(15, 3, 'Section VI, paragrap 137 & 139 of Manual of Regulations of Private Schools, Seventh Edition, 1970 of the Bureau of Private', 0, 1);

    $pdf->Cell(15, 3, 'Schools, which is quoted below govern the refund or adjustment of fees:', 0, 1);

    $pdf->Cell(7, 2.3, '', 0, 0);
    $pdf->Cell(15, 3, '"137, When a student registers in a school, it is understood that he is enrolling for the entire school year for elementary and', 0, 1);
    $pdf->Cell(15, 3, 'secondary courses, and for the entire semester for the collegiate courses. A student who transfers on otherwise withdraws, In writing,', 0, 1);

    $pdf->Cell(15, 3, 'within two weeks after the beginning of classes and who has already paid the pertinent tuition and other school fees in full on any', 0, 1);

    $pdf->Cell(15, 3, 'length longer than one month may be charged ten percent (10%) of the total amount due for the term if the withdraws within the first', 0, 1);

    $pdf->Cell(15, 3, 'week of classes, or twenty percent (20%) if within the second week of classes, regardless of whether or not he has actually attended', 0, 1);

    $pdf->Cell(15, 3, 'classes. The student may be charged all the school fees in full if the withdraw anytime after the second week of classes. However, if', 0, 1);

    $pdf->Cell(15, 3, 'the transfer on withdrawal is due to a justifiable reason, the student shall be charged the pertinent fees up to an including the last month ', 0, 1);

    $pdf->Cell(15, 3, 'of attended', 0, 1);


    $pdf->Cell(7, 2.3, '', 0, 0);
    $pdf->Cell(15, 3, '"139. Full refund of fees shall be made for any course or level which has been discontinued by the school or not credited by ', 0, 1);

    $pdf->Cell(15, 3, 'the office thru no fault of the student.', 0, 1);

    $pdf->Ln(3);
    $pdf->SetFont('Arial', 'B', 8);
    $pdf->Cell(33, 3, 'NON-PAYMENT OF ACCOUNT:', 0, 1);

    $pdf->Ln(2);
    $pdf->SetFont('Arial', '', 7);
    $pdf->Cell(7, 2.3, '', 0, 0);
    $pdf->Cell(15, 3, 'The administration reserves the right to suspend or drop from the rolls any student who has not paid in full his/her financial', 0, 1);

    $pdf->Cell(15, 3, 'obligations on or before the scheduled dated of the third periodic examination. It is also reserves the right to withhold from a student', 0, 1);

    $pdf->Cell(15, 3, 'the issuance of report card (form 138), honorable dismissal, certification, or other on other records, unless the student has fully', 0, 1);

    $pdf->Cell(15, 3, 'settled his/her financial obligation or property with the college.', 0, 1);



    $pdf->Output();
}