<?php
include('includes/header.php');
include('includes/functions.php');
$questions=0;
$archived=0;
$admins=0;
$sql="SELECT * FROM `admin`";
$res=$con->query($sql);
$admins=$res->num_rows;
$sql="SELECT * FROM `questions` WHERE `deleted_at` IS NULL";
$res=$con->query($sql);
$questions=$res->num_rows;
$sql="SELECT * FROM `questions` WHERE `deleted_at` IS NOT NULL";
$res=$con->query($sql);
$archived=$res->num_rows;
?>
    <div class="row pt-3">
        <div class="col-lg-4 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
                <div class="inner">
                    <h3><?php echo $questions; ?></h3>

                    <p>Questions</p>
                </div>
                <div class="icon">
                    <i class="fas fa-question-circle"></i>
                </div>
                <a href="questions" class="small-box-footer">More info</a>
            </div>
        </div>
        <div class="col-lg-4 col-6">
            <!-- small box -->
            <div class="small-box bg-success"> 
                <div class="inner">
                    <h3><?php echo $archived; ?></h3>

                    <p>Archived</p>
                </div>
                <div class="icon">
                    <i class="ion ion-stats-bars"></i>
                </div>
                <a href="archive" class="small-box-footer">More info</a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-4 col-12">
            <!-- small box -->
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3><?php echo $admins; ?></h3>

                    <p>Admins</p>
                </div>
                <div class="icon">
                    <i class="ion ion-person-add"></i>
                </div>
                <a href="admins" class="small-box-footer">More info</a>
            </div>
    </div>
<?php
include('includes/footer.php')
?>
