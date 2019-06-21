<!DOCTYPE html>
<html lang="en">

<?php include_once __DIR__ . '/model/Result.php';

$mResult = new Result();

$id = 0;

if (!empty($_GET)) {
    $id = htmlentities($_GET['id'], ENT_QUOTES);
    $mResult->delete_student_result($id);
    header("location:result.php");
}

?>

</html>