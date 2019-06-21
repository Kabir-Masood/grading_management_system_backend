<?php include_once __DIR__ . '/../model/Course.php'; ?>

<?php
$course = new Course();

?>
<?php
if (!empty($_POST)) {

    $teacher_id = $_POST['id'];
    $result = $course->get_course_by_teacher($teacher_id);

    ?>
    <option value="0" disabled selected="selected" style="float: left; background-color: white">
        Select Course
    </option>
    <?php
    foreach ($result as $value) { ?>

        <option value="<?php echo $value['id']; ?>"><?php echo $value['course_name']; ?></option>

    <?php }


}
?>

