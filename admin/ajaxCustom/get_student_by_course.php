<?php include_once __DIR__ . '/../model/CourseRegistration.php'; ?>

<?php
$student = new CourseRegistration();

?>
<?php
if (!empty($_POST)) {

    $course_id = $_POST['id'];
    $result = $student->get_all_reg_student_by_course($course_id);

    ?>
    <option value="0" disabled selected="selected" style="float: left; background-color: white">
        Select Student
    </option>
    <?php
    foreach ($result as $value) { ?>

        <option value="<?php echo $value['student_id']; ?>"><?php echo $value['full_name']; ?></option>

    <?php }


}
?>

