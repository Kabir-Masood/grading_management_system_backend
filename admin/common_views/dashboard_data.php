
<?php include_once __DIR__ . '/../model/Admin.php' ?>
<?php include_once __DIR__ . '/../model/Student.php' ?>
<?php include_once __DIR__ . '/../model/Teacher.php' ?>
<?php include_once __DIR__ . '/../model/Batch.php' ?>
<div class="row">
    <div class="col-xl-3 col-sm-6 mb-3">
        <div class="card text-white bg-primary o-hidden h-100">
            <div class="card-body">
                <div class="card-body-icon">
                    <i class="fas fa-graduation-cap"></i>
                </div>
                <?php $student = new Student();?>
                <div class="mr-5"><?php echo count($student->get_all_student()) . " " ?>Student</div>
            </div>
            <a class="card-footer text-white clearfix small z-1" href="index.php">
                <span class="float-left">View Details</span>
                <span class="float-right">
                    <i class="fas fa-angle-right"></i>
                  </span>
            </a>
        </div>
    </div>
    <div class="col-xl-3 col-sm-6 mb-3">
        <div class="card text-white bg-warning o-hidden h-100">
            <div class="card-body">
                <div class="card-body-icon">
                    <i class="fas fa-chalkboard-teacher"></i>
                </div>
                <?php $teacher = new Teacher(); ?>
                <div class="mr-5"><?php echo count($teacher->get_all_teacher()). " "?> Teachers</div>
            </div>
            <a class="card-footer text-white clearfix small z-1" href="teacher.php">
                <span class="float-left">View Details</span>
                <span class="float-right">
                    <i class="fas fa-angle-right"></i>
                  </span>
            </a>
        </div>
    </div>
    <div class="col-xl-3 col-sm-6 mb-3">
        <div class="card text-white bg-success o-hidden h-100">
            <div class="card-body">
                <div class="card-body-icon">
                    <i class="fas fa-unlock-alt"></i>
                </div>
                <?php $admin = new Admin();?>
                <div class="mr-5"><?php echo count($admin->get_all_admin()). " "?> Admins</div>
            </div>
            <a class="card-footer text-white clearfix small z-1" href="admin.php">
                <span class="float-left">View Details</span>
                <span class="float-right">
                    <i class="fas fa-angle-right"></i>
                  </span>
            </a>
        </div>
    </div>
    <div class="col-xl-3 col-sm-6 mb-3">
        <div class="card text-white bg-danger o-hidden h-100">
            <div class="card-body">
                <div class="card-body-icon">
                    <i class="fas fa-swatchbook"></i>
                </div>
                <?php $batch = new Batch();?>
                <div class="mr-5"><?php echo count($batch->get_all_batch()) . " "?>batches</div>
            </div>
            <a class="card-footer text-white clearfix small z-1" href="batch.php">
                <span class="float-left">View Details</span>
                <span class="float-right">
                    <i class="fas fa-angle-right"></i>
                  </span>
            </a>
        </div>
    </div>
</div>