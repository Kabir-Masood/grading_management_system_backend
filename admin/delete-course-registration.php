<!DOCTYPE html>
<html lang="en">

<?php include_once __DIR__ . '/model/CourseRegistration.php';

$mCourseReg = new CourseRegistration();

$id = 0;

if (!empty($_GET)) {
    $id = htmlentities($_GET['id'], ENT_QUOTES);
    $mCourseReg->delete_course_registration($id);
    header("location:course-registration.php");
}

?>

</html>