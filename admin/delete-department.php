<!DOCTYPE html>
<html lang="en">

<?php include_once __DIR__ . '/model/Department.php';

$mDepartment = new Department();

$id = 0;

if (!empty($_GET)) {
    $id = htmlentities($_GET['id'], ENT_QUOTES);
    $mDepartment->delete_department($id);
    header("location:department.php");
}

?>

</html>