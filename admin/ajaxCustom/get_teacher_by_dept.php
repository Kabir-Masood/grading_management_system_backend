<?php include_once __DIR__ . '/../model/Teacher.php'; ?>

<?php
$teacher = new Teacher();

?>
<?php
if (!empty($_POST)) {

    $dpt_id = $_POST['id'];
    $result = $teacher->get_all_teacher_by_deptID($dpt_id);

    ?>
    <option value="0" disabled selected="selected" style="float: left; background-color: white">
        Select Teacher
    </option>
    <?php
    foreach ($result as $value) { ?>

        <option value="<?php echo $value['id']; ?>"><?php echo $value['full_name']; ?></option>

    <?php }


}
?>

