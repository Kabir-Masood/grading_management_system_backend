<!DOCTYPE html>
<html lang="en">

<?php include_once __DIR__ . '/model/Course.php';

$mCourse = new Course();

$id = 0;

if (!empty($_GET)) {
    $id = htmlentities($_GET['id'], ENT_QUOTES);
    $mCourse->delete_course($id);
    header("location:course.php");
}

?>

</html>