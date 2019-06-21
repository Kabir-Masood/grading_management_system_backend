<!DOCTYPE html>
<html lang="en">

<?php include_once __DIR__ . '/model/Semester.php';

$mSemester = new Semester();

$id = 0;

if (!empty($_GET)) {
    $id = htmlentities($_GET['id'], ENT_QUOTES);
    $mSemester->delete_semester($id);
    header("location:semester.php");
}

?>

</html>