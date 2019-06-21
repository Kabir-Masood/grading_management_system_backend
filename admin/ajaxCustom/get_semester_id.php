<?php include_once __DIR__ . '/../model/CourseRegistration.php'; ?>

<?php
$courseRegister = new CourseRegistration();

?>
<?php
if (!empty($_POST)) {

    $student_id = $_POST['student_id'];
    $course_id = $_POST['course_id'];
    $result = $courseRegister->get_all_reg_by_student($student_id, $course_id);

      $semesterId = $result['semester_id'];

      ?>
    <input type="hidden" name="semester_id" value="<?php echo $semesterId ;?>">
<?php

    }



?>

