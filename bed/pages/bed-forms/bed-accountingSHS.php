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
    header('location: bed-accounting.php?stud_id=' . $stud_id . '&glvl_id=' . $glvl_id);
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

    $pdf->Image('../../../assets/img/logo.png', 25, 9, 15, 15);
    $pdf->Image('../../../assets/img/logo1.png', 125, 9, 15, 15);

    $pdf->SetTextColor(255, 0, 0);

    $pdf->SetFont('Arial', 'B', 11);

    $pdf->Cell(155, 5, 'SAINT FRANCIS OF ASSISI COLLEGE', 0, 1, 'C');

    $pdf->SetTextColor(0, 0, 0);
    $pdf->SetFont('Arial', '', 11, 'C');

    $test = utf8_decode("");
    $pdf->Cell(155, 5, 'Las Pinas' . $test . ', Taguig, Cavite, Alabang, Laguna', 0, 1, 'C');

    $pdf->Ln(1);
    $pdf->SetTextColor(0, 0, 0);
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(155, 2, 'BASIC EDUCATION DEPARTMENT', 0, 0, 'C');

    $pdf->Ln(1);
    $pdf->SetFont('Arial', 'B', 9);
    $pdf->Cell(150, 7.5, 'Registration Form for Accounting Office', 0, 1, 'C');

    $pdf->Ln(1);
    $pdf->SetFont('Arial', 'B', 9);
    $pdf->Cell(155, 5, 'PERSONAL INFORMAION', 1, 1, 'C');

    $pdf->Ln(1);
    $pdf->SetFont('Arial', '', 9);
    $pdf->Cell(9, 3, 'Learner Reference Number (LRN): ', 0, 0);
    $pdf->Cell(20, 1, $row['lrn'], 0, 1);

    $pdf->Ln(1);
    $pdf->Cell(10, 8, 'SY:', 0, 0);
    $pdf->Cell(20, 8, $row['academic_year'], 0, 0, 'C');
    $pdf->Cell(1, 8, '', 0, 0);

    $pdf->Cell(22, 8, 'Student Type:', 0, 0);
    $pdf->SetFont('Arial', '', 9);
    $pdf->Cell(19, 8, $row['stud_type'], 0, 0, 'C');
    $pdf->Cell(5, 8, '', 0, 0);

    $pdf->Cell(15, 8, 'Grade:', 0, 0);
    $pdf->Cell(15, 8, $row['grade_level'], 0, 0, 'C');
    $pdf->Cell(6, 8, '', 0, 0);

    $pdf->Cell(20, 8, 'Section/Strand: ', 0, 0);
    $pdf->Cell(5, 8, '', 0, 0);
    if (!empty($row['section'])) {
        $pdf->Cell(15, 8, utf8_decode($row['section']) . ' - ' . $row['strand_name'], 0, 0, 'C');
    } else {
        $pdf->Cell(15, 8, 'TBA - ' . $row['strand_name'], 0, 0, 'C');
    }

    $pdf->Cell(20, 5.5, '', 0, 1);

    $pdf->Ln(1);
    $pdf->Cell(18, 3, 'Full Name:', 0, 0);
    $pdf->Cell(60, 3, utf8_decode($row['fullname']), 0, 0, 'L');
    $pdf->Cell(4, 8, '', 0, 0);

    $pdf->Cell(15, 3, 'Birthday:', 0, 0);
    $pdf->Cell(15, 3, $row['date_birth'], 0, 0, 'C');
    $pdf->Cell(4, 8, '', 0, 0);

    $pdf->Cell(10, 3, 'Age:', 0, 0);
    $pdf->Cell(10, 3, $row['age'], 0, 0, 'C');
    $pdf->Cell(20, 3.5, '', 0, 1);

    $pdf->Ln(1);
    $pdf->Cell(105, 3, 'Address:', 0, 0);
    $fontsize = 9;
    $tempFontSize = $fontsize;
    $cellwidth = 130;

    while ($pdf->GetStringWidth($row['address']) > $cellwidth) {
        $pdf->SetFontSize($tempFontSize -= 0.1);
    }

    $pdf->Cell(8, 8, '', 0, 0);
    $pdf->Cell(15, 3, 'Gender:', 0, 0);
    $pdf->Cell(15, 3, $row['gender_name'], 0, 0, 'C');

    $pdf->Cell(20, 3.5, '', 0, 1);

    $pdf->Ln(1);
    $pdf->Cell(20, 3, 'Contact No.:', 0, 0);
    $pdf->Cell(30, 3, $row['cellphone'], 0, 0, 'C');
    $pdf->Cell(20, 3.5, '', 0, 0);

    $pdf->Cell(20, 3, 'E-Mail:', 0, 0);
    $pdf->Cell(50, 3, $row['email'], 0, 0, 'C');

    $pdf->Cell(20, 3.5, '', 0, 1);

    $pdf->Ln(2);
    $pdf->SetFont('Arial', 'B', 9);
    $pdf->Cell(155, 4, 'FINANCIAL DETAILS', 1, 1, 'C');
    $pdf->Cell(20, 2, '', 0, 1);

    $pdf->Ln(1);
    $pdf->Cell(55, 1, 'Payment Scheme', 0, 0, 'C');

    $pdf->Cell(50, 1, 'Scholarship Discounts', 0, 0, 'C');

    $pdf->Cell(50, 1, 'Goverment Assistance', 0, 0, 'C');

    $pdf->Cell(20, 3.5, '', 0, 1);

    $pdf->Ln(2);
    $pdf->SetFont('Arial', '', 8);
    $pdf->Rect(16, 70, 3, 3);
    $pdf->Cell(8, 2, '', 0, 0);
    $pdf->Cell(20, 0, 'Cash', 0, 0, 'C');

    $pdf->Rect(66, 70, 3, 3);
    $pdf->Cell(36, 2, '', 0, 0);
    $pdf->Cell(18, 0, 'ACADEMIC', 0, 0, 'C');
    $pdf->Cell(18, 2, '', 'B', 0, 'C');
    $pdf->Cell(4, 2, '%', 0, 0, 'C');

    $pdf->Rect(117, 70, 3, 3, 'c');
    $pdf->Cell(2, 2, '', 0, 0);
    $pdf->Cell(31, 0, 'ESC', 0, 0, 'C');
    $pdf->Cell(20, 2, '', 'B', 1);

    $pdf->Ln(2);
    $pdf->SetFont('Arial', '', 8);
    $pdf->Rect(16, 74, 3, 3, 'c');
    $pdf->Cell(11, 2, '', 0, 0);
    $pdf->Cell(20, 0, 'Semestral', 0, 0, 'C');

    $pdf->Rect(66, 74, 3, 3, 'c');
    $pdf->Cell(28, 2, '', 0, 0);
    $pdf->Cell(23, 0, 'Cultural', 0, 0, 'C');
    $pdf->Cell(18, 2, '', 'B', 0, 'C');
    $pdf->Cell(4, 2, '%', 0, 0);

    $pdf->Rect(117, 74, 3, 3, 'c');
    $pdf->Cell(10, 2, '', 0, 0);
    $pdf->Cell(23, 0, 'Voucher (NTU)', 0, 0, 'C');
    $pdf->Cell(20, 2, '', 'B', 1);

    $pdf->Ln(2);
    $pdf->SetFont('Arial', '', 8);
    $pdf->Rect(16, 78, 3, 3, 'c');
    $pdf->Cell(11, 2, '', 0, 0);
    $pdf->Cell(20, 0, 'Trimestral', 0, 0, 'C');

    $pdf->Rect(66, 78, 3, 3, 'c');
    $pdf->Cell(28, 2, '', 0, 0);
    $pdf->Cell(23, 0, 'Athletic', 0, 0, 'C');
    $pdf->Cell(18, 2, '', 'B', 0, 'C');
    $pdf->Cell(4, 2, '%', 0, 0);

    $pdf->Rect(117, 78.5, 3, 3, 'c');
    $pdf->Cell(10, 2, '', 0, 0);
    $pdf->Cell(23, 0, 'Voucher (WTU)', 0, 0, 'C');
    $pdf->Cell(20, 2, '', 'B', 1);

    $pdf->Ln(2);
    $pdf->SetFont('Arial', '', 8);
    $pdf->Rect(16, 82, 3, 3, 'c');
    $pdf->Cell(10, 2, '', 0, 0);
    $pdf->Cell(20, 0, 'Quaterly', 0, 0, 'C');

    $pdf->Rect(66, 82, 3, 3, 'c');
    $pdf->Cell(28, 2, '', 0, 0);
    $pdf->Cell(24, 0, 'Sibling', 0, 0, 'C');
    $pdf->Cell(18, 2, '', 'B', 0, 'C');
    $pdf->Cell(4, 2, '%', 0, 0);

    $pdf->Rect(117, 82.5, 3, 3, 'c');
    $pdf->Cell(10, 2, '', 0, 0);
    $pdf->Cell(23, 0, 'No Voucher', 0, 0, 'C');
    $pdf->Cell(20, 2, '', 'B', 1);

    $pdf->Ln(2);
    $pdf->SetFont('Arial', '', 8);
    $pdf->Rect(16, 86, 3, 3, 'c');
    $pdf->Cell(15, 2, '', 0, 0);
    $pdf->Cell(30, 2, '', 'B', 0, 'C'); // line

    $pdf->Rect(66, 86, 3, 3, 'c');
    $pdf->Cell(16, 2, '', 0, 0);
    $pdf->Cell(21, 0, 'Employee', 0, 0, 'C');
    $pdf->Cell(18, 2, '', 'B', 0, 'C');
    $pdf->Cell(4, 2, '%', 0, 0);

    $pdf->Rect(117, 86.5, 3, 3, 'c');
    $pdf->Cell(12, 2, '', 0, 0);
    $pdf->Cell(18, 2, '', 'B', 0, 'C'); // line
    $pdf->Cell(3, 2, '', 0, 0);
    $pdf->Cell(20, 2, '', 'B', 1);

    $pdf->Ln(2);
    $pdf->SetFont('Arial', '', 8);

    $pdf->Rect(16, 90, 3, 3, 'c');
    $pdf->Cell(15, 2, '', 0, 0);
    $pdf->Cell(30, 2, '', 'B', 0, 'C');

    $pdf->Rect(66, 90, 3, 3, 'c');
    $pdf->Cell(15, 2, '', 0, 0);
    $pdf->Cell(18, 0, 'EOO', 0, 1, 'C');

    $pdf->Ln(3);
    $pdf->SetFont('Arial', 'B', 8);

    $pdf->Cell(15, 4, 'Date ', 1, 0, 'C');
    $pdf->Cell(45, 4, 'Particulars', 1, 0, 'C');
    $pdf->Cell(30, 4, 'Credit', 1, 0, 'C');
    $pdf->Cell(30, 4, 'Debit', 1, 0, 'C');
    $pdf->Cell(34.5, 4, 'Remarks', 1, 1, 'C');

    $pdf->Cell(15, 4, '', 1, 0, 'C');
    $pdf->Cell(45, 4, '', 1, 0, 'C');
    $pdf->Cell(30, 4, '', 1, 0, 'C');
    $pdf->Cell(30, 4, '', 1, 0, 'C');
    $pdf->Cell(34.5, 4, '', 1, 1, 'C');

    $pdf->Cell(15, 4, '', 1, 0, 'C');
    $pdf->Cell(45, 4, '', 1, 0, 'C');
    $pdf->Cell(30, 4, '', 1, 0, 'C');
    $pdf->Cell(30, 4, '', 1, 0, 'C');
    $pdf->Cell(34.5, 4, '', 1, 1, 'C');

    $pdf->Cell(15, 4, '', 1, 0, 'C');
    $pdf->Cell(45, 4, '', 1, 0, 'C');
    $pdf->Cell(30, 4, '', 1, 0, 'C');
    $pdf->Cell(30, 4, '', 1, 0, 'C');
    $pdf->Cell(34.5, 4, '', 1, 1, 'C');

    $pdf->Cell(15, 4, '', 1, 0, 'C');
    $pdf->Cell(45, 4, '', 1, 0, 'C');
    $pdf->Cell(30, 4, '', 1, 0, 'C');
    $pdf->Cell(30, 4, '', 1, 0, 'C');
    $pdf->Cell(34.5, 4, '', 1, 1, 'C');

    $pdf->Cell(15, 4, '', 1, 0, 'C');
    $pdf->Cell(45, 4, '', 1, 0, 'C');
    $pdf->Cell(30, 4, '', 1, 0, 'C');
    $pdf->Cell(30, 4, '', 1, 0, 'C');
    $pdf->Cell(34.5, 4, '', 1, 1, 'C');

    $pdf->Cell(15, 4, '', 1, 0, 'C');
    $pdf->Cell(45, 4, '', 1, 0, 'C');
    $pdf->Cell(30, 4, '', 1, 0, 'C');
    $pdf->Cell(30, 4, '', 1, 0, 'C');
    $pdf->Cell(34.5, 4, '', 1, 1, 'C');

    $pdf->Cell(15, 4, '', 1, 0, 'C');
    $pdf->Cell(45, 4, '', 1, 0, 'C');
    $pdf->Cell(30, 4, '', 1, 0, 'C');
    $pdf->Cell(30, 4, '', 1, 0, 'C');
    $pdf->Cell(34.5, 4, '', 1, 1, 'C');

    $pdf->Cell(15, 4, '', 1, 0, 'C');
    $pdf->Cell(45, 4, '', 1, 0, 'C');
    $pdf->Cell(30, 4, '', 1, 0, 'C');
    $pdf->Cell(30, 4, '', 1, 0, 'C');
    $pdf->Cell(34.5, 4, '', 1, 1, 'C');
}

$pdf->AddPage();

$pdf->SetFont('Arial', 'B', 6);
$pdf->SetTopMargin(5);
$pdf->SetLeftMargin(5);

$pdf->Ln(2);
$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(155, 4, '', 0, 1, 'R');
$pdf->Cell(155, 5, 'RULES ON SCHOOL FEES', 0, 0, 'C');
$pdf->Cell(10, 5, '', 0, 1);

$pdf->SetFont('Arial', '', 7);
$pdf->Cell(15, 3, 'A. The schedule of approved tuition and other school fees shall be available at the Accounting Office and Office of the Principal.', 0, 1);

$pdf->Cell(15, 3, 'B. The tuition and other school fees shall be subject to change upon due notice in accordance with the guidelines and approval of DepEd.', 0, 1);

$pdf->Cell(15, 3, 'C. A 10 % discount on tuition fee can be availed if total school fees will be paid in full (cash basis) upon registraton.', 0, 1);

$pdf->Cell(15, 3, 'D. Sibling discount of 5%, 10%,15 %,  20% and 25% on tuition fee can be given to the 1st , 2nd, 3rd, 4th, 5th and 6th sibling respectively ', 0, 1);

$pdf->Cell(15, 3, 'for a minumum of 3-sibling enrollment.', 0, 1);

$pdf->Cell(15, 3, 'E. Academic discount of 100 %, 75% and 50 % on tuition fee can be granted to the 1st honor, 2nd honor and 3rd honor respectively. ', 0, 1);

$pdf->Cell(15, 3, 'F. “When a learner registers in a school, it is understood that he is enrolling for the entire school year for basic education or  for ', 0, 1);

$pdf->Cell(15, 3, 'the entire semester for college”. (Art. XIII Sec. 62.a of the Manual of Regulations for Private Schools)  ', 0, 1);

$pdf->Cell(15, 3, 'G. A learner who transfers or otherwise withdraws, in writing, within two weeks after the beginning of classes and who has already paid', 0, 1);

$pdf->Cell(15, 3, 'paid the pertinent tuition and other school fees in full or for any length of time longer than one month will be charged according to the ', 0, 1);

$pdf->Cell(15, 3, 'policies on the refund of  tuition and other school fees.” (Art, XIII Sec. 66 of the Manual of   Regulations for  Private Schools) ', 0, 1);

$pdf->Cell(7, 2.3, '', 0, 0);
$pdf->Cell(15, 3, 'g.1. l0% of the total amount for the term (that is full amount charged for one school year) if he withdraws within the First week of ', 0, 1);

$pdf->Cell(15, 3, 'classes regardless of whether or not he has actually attended classes.', 0, 1);

$pdf->Cell(7, 2.3, '', 0, 0);
$pdf->Cell(15, 3, 'g.2.20% of the total amount for the term if he withdraws  within the second week of classes regardless of whether  or not he has', 0, 1);

$pdf->Cell(15, 3, ' actually attended classes. ', 0, 1);

$pdf->Cell(7, 2.3, '', 0, 0);
$pdf->Cell(15, 3, 'g.3. A pupil may be charged all the school fee in full if he withdraws anytime  after the second week of classes regardless ', 0, 1);

$pdf->Cell(15, 3, ' of whether or not he has actually attended classes. ', 0, 1);

$pdf->Cell(15, 3, 'H. of whether or not he has actually attended classes. One (1) week before the major examination, the parent/guardian must coordinate ', 0, 1);

$pdf->Cell(15, 3, 'with the accounting office personally for accounts that cannot be settled before the deadline.', 0, 1);

$pdf->Cell(15, 3, 'I. SFAC reserves the rights to send financial and/or academic notifications via email, sms or calls to parents and guardians whose', 0, 1);

$pdf->Cell(15, 3, ' contact details appear on this form.', 0, 1);

$pdf->Cell(15, 3, 'J. Learners  who dropped from the roll without prior notice and written withdrawal are considered not cleared. Academic records and ', 0, 1);

$pdf->Cell(15, 3, 'Jother credentials are withheld. Accounts will remain active until formal letter of dropping will be submitted.', 0, 1);

$pdf->Cell(15, 3, 'K. Failure to settle the account on or before the deadline will result in automatic conversion to the next mode of payment with higher amount.', 0, 1);

$pdf->Cell(15, 3, '(e.g. unsettled semestral payment on the scheduled deadline means automatic conversion of the payment mode into quarterly basis.', 0, 1);

$pdf->Cell(15, 3, 'L. Due date for cash basis payment is before the opening of classes, failure to settle account before the deadline means conversion of ', 0, 1);

$pdf->Cell(15, 3, 'payment mode to semestral basis.', 0, 1);

$pdf->Ln(3);
$pdf->SetFont('Arial', 'B', 9);

$pdf->Cell(82, 4, 'ATTESTATION', 1, 0, 'C');

$pdf->Rect(5, 105, 82, 35);

$pdf->Ln(1);
$pdf->SetFont('Arial', '', 7);
$pdf->Cell(20, 10, '  By signing, we agree to and will comply with the terms and conditions', 0, 0, '');

$pdf->Ln(2);
$pdf->Cell(20, 12, 'specified in the Enrollment Agreement and all SFAC academic standards', 0, 0, '');
$pdf->Ln(3);
$pdf->Cell(20, 12, '       and policies for as long as our child is enrolled in this institution.', 0, 0, '');

$pdf->Ln(1);
$pdf->SetFont('Arial', '', 7);
$pdf->Cell(18, 12, '', 0, 0);
$pdf->Cell(45, 12, '', 'B', 0, 0);

$pdf->Ln(5);
$pdf->Cell(80, 20, 'Parents Signature Over Printed Name', 0, 0, 'C');
$pdf->Cell(28, 1, '', 0, 0);

$pdf->Ln(15);
$pdf->Cell(10, 2, 'DATE:', 0, 0);
$pdf->Cell(20, 2, '', 'B', 0, 0);

$pdf->SetXY(75, 105);
$pdf->Ln(1);
$pdf->SetFont('Arial', '', 7);
$pdf->Cell(90, 3, '', 0, 0);
$pdf->Cell(20, 0, '  Processed By:', 0, 0);
$pdf->Cell(40, 2, '', 'B', 0, 0);

$pdf->Ln(5);
$pdf->SetFont('Arial', '', 7);
$pdf->Cell(120, 3, '', 0, 0);
$pdf->Cell(120, 5, 'Accounting Officer', 0, 0);

$pdf->Ln(15);
$pdf->SetFont('Arial', '', 7);
$pdf->Cell(90, 10, '', 0, 0);
$pdf->Cell(20, 0, '  Approved By:', 0, 0, '');

$pdf->SetFont('Arial', 'B', 7);
$pdf->Cell(120, 0, 'MARIA LUZ ALMA O. OSIO', 0, 0);

$pdf->Ln(1);
$pdf->SetFont('Arial', '', 7);
$pdf->Cell(120, 3, '', 0, 0);
$pdf->Cell(120, 5, 'Director for Finance', 0, 0);

$pdf->Output();
