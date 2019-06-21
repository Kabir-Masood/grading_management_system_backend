<!DOCTYPE html>
<html lang="en">

<?php include_once __DIR__ . '/model/Batch.php';

$mBatch = new Batch();

$id = 0;

if (!empty($_GET)) {
    $id = htmlentities($_GET['id'], ENT_QUOTES);
    $mBatch->delete_batch($id);
    header("location:batch.php");
}

?>

</html>