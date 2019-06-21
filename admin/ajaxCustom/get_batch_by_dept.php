<?php include_once __DIR__ . '/../model/Batch.php'; ?>

<?php
$batch = new Batch();

?>
<?php
if (!empty($_POST)) {

    $dpt_id = $_POST['id'];
    $result = $batch->get_all_batch_by_deptID($dpt_id);

    ?>
    <option value="0" disabled selected="selected" style="float: left; background-color: white">
        Select Batch
    </option>
    <?php
    foreach ($result as $value) { ?>

        <option value="<?php echo $value['id']; ?>"><?php echo $value['batch_name']; ?></option>

    <?php }


}
?>