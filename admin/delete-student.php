<!DOCTYPE html>
<html lang="en">

<?php include_once __DIR__ . '/model/Student.php';

$mStudent = new Student();

$id = 0;

if (!empty($_GET)) {
    $id = htmlentities($_GET['id'], ENT_QUOTES);
    $mStudent->delete_Student($id);
    header("location:index.php");
}

?>

</html>