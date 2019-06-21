<!DOCTYPE html>
<html lang="en">

<?php include_once __DIR__ . '/model/Program.php';

$mProgram = new Program();

$id = 0;

if (!empty($_GET)) {
    $id = htmlentities($_GET['id'], ENT_QUOTES);
    $mProgram->delete_program($id);
    header("location:program.php");
}

?>

</html>