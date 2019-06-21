<!DOCTYPE html>
<html lang="en">

<?php include_once __DIR__ . '/model/Admin.php';

$mAdmin = new Admin();

$id = 0;

if (!empty($_GET)) {
    $id = htmlentities($_GET['id'], ENT_QUOTES);
    $mAdmin->delete_admin($id);
    header("location:admin.php");
}

?>

</html>