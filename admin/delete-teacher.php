<!DOCTYPE html>
<html lang="en">

<?php include_once __DIR__ . '/model/Teacher.php';

$mTeacher = new Teacher();

$id = 0;

if (!empty($_GET)) {

    $id = htmlentities($_GET['id'], ENT_QUOTES);
    $mTeacher->delete_teacher($id);

    header("location:teacher.php");
}

?>

</html>