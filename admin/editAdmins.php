<?php
include('includes/header.php');
include('includes/functions.php');
if(!$_SESSION['is_s_admin'])
{
    ?>
    <script>
        window.location.href='index.php';
    </script>
    <?php
}
$fname = null;
$lname = null;
$email = null;
$password = null;
$cpassword = null;
$fname_err = null;
$lname_err = null;
$email_err = null;
$password_err = null;
$cpassword_err = null;
$role= null;
$role_err= null;
if(isset($_GET['id']))
{
    $id=$_GET['id'];
    $sql="SELECT * FROM `admin` WHERE `id`=$id";
    $res=$con->query($sql);
    $admin=$res->fetch_assoc();
    $fname=$admin['first_name'];
    $lname=$admin['last_name'];
    $email=$admin['email'];
    $role =$admin['admin_role'];
}
else
{
    ?>
   <script>
       window.location.href='admins.php';
   </script>
   <?php
}
$yes = null;
$error = null;
if (isset($_POST['register'])) {
    $fname = trim($_POST['fname']);
    $lname = trim($_POST['lname']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $cpassword = trim($_POST['cpassword']);
    $role=$_POST['role'];
    $valid = true;
    if (empty($fname)) {
        $valid = false;
        $fname_err = "First Name is required";
    }
    if (ctype_alpha(str_replace(' ', '', $fname)) === false)  {
        $fname_err = 'First Name must contain letters and spaces only';
        $valid=false;
    }
    if (empty($lname)) {
        $valid = false;
        $lname_err = "Last Name is required";
    }
    if (ctype_alpha(str_replace(' ', '', $lname)) === false)  {
        $lname_err = 'Last Name must contain letters and spaces only';
        $valid=false;
    }
    if (empty($email)) {
        $valid = false;
        $email_err = "Email is required";
    }
    if (empty($password)) {
        $valid = false;
        $password_err = "Password is required";
    }
    if (strlen($password) < 8)
    {
        $valid=false;
        $password_err="Password must be at least 8 characters in length";
    }
    if (strlen($password) > 16)
    {
        $valid=false;
        $password_err="Password must not exceed 16 characters";
    }
    if(preg_match('@[^\w]@', $password)){
        $valid=false;
        $password_err="Only letters and numbers allowed";
    }
    if (empty($cpassword)) {
        $valid = false;
        $cpassword_err = "Confirm Password is required";
    }
    if ($password != $cpassword) {
        $valid = false;
        $cpassword_err = "Password does not match";
    }
    if($role == 0)
    {
        $sql = "SELECT * FROM `admin` WHERE `admin_role` = 0 AND `id` !=$id";
        $res=$con->query($sql);
        if($res->num_rows == 2)
        {
            $valid =false;
            $role_err="Only 2 super admins allowed";
        }
    }
    if ($valid) {
          $sql = "SELECT * FROM `admin` WHERE `email` = '$email' AND `id` !=$id";
          $res=$con->query($sql);
        if ($res->num_rows == 0) {
            $date=date('Y-m-d H:i:s');
              $pass=hash('sha256',$password);
              $sql = "UPDATE `admin` SET `first_name`='$fname',`last_name`='$lname',`email`='$email',`password`='$pass',`admin_role`=$role, `updated_at`='$date' WHERE `id`=$id";
              $res=$con->query($sql);
            if ($res === true) {
                $action='Updated Admin: '.$email;
                logEntry($action,$_SESSION['uid'],$con);
                $yes = "Updated successfully";
            } else {
                $error = "Admin update error. Try again.";
            }
        } else {
            $valid = false;
            $email_err = "Email is already taken";
        }
    }
}
?>
<div class="row pt-3">
    <div class="col-md-6 offset-md-3">
        <div class="card card-dark bg-dark text-white">
            <div class="card-header">
                <div class="d-flex justify-content-between">
                    <h3 class="card-title">Edit Admin</h3>
                    <a class="btn btn-sm btn-secondary" href="admins.php">Back</a>
                </div>
            </div>
            <form action="#" method="post">
                <div class="card-body">
                    <?php if ($yes != null) { ?>
                        <p class="alert alert-success"><?php echo $yes; ?></p>
                    <?php } ?>
                    <?php if ($error != null) { ?>
                        <p class="alert alert-danger"><?php echo $error; ?></p>
                    <?php } ?>
                <div class="mb-3">
                    <div class="form-group">
                        <label>First Name</label>
                        <input type="text" class="form-control" placeholder="First name" name="fname"  value="<?php echo $fname; ?>">
                        <span class="text-danger"><?php echo $fname_err; ?></span>
                    </div>
                </div>
                <div class="mb-3">
                    <div class="form-group">
                        <label>Last Name</label>
                        <input type="text" class="form-control" placeholder="Last name" name="lname"  value="<?php echo $lname; ?>">
                        <span class="text-danger"><?php echo $lname_err; ?></span>
                    </div>
                </div>
                <div class="mb-3">
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" class="form-control" placeholder="Email" name="email"  value="<?php echo $email; ?>">
                        <span class="text-danger"><?php echo $email_err; ?></span>
                    </div>
                </div>
                <div class="mb-3">
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" class="form-control" placeholder="Password" name="password" >
                        <span class="text-danger"><?php echo $password_err; ?></span>
                    </div>
                </div>
                <div class="mb-3">
                    <div class="form-group">
                        <label>Confirm Password</label>
                        <input type="password" class="form-control" placeholder="Confirm password" name="cpassword">
                        <span class="text-danger"><?php echo $cpassword_err ?></span>
                    </div>
                </div>
                    <div class="mb-3">
                        <div class="form-group">
                            <label>Role</label><br>
                            <select class="select" name="role">
                                <option value="0" <?php if($role == 0){echo "selected";} ?>>Super Admin</option>
                                <option value="1"  <?php if($role == 1){echo "selected";} ?>>Admin</option>
                            </select>
                            <span class="text-danger"> <?php echo $role_err; ?></span>
                        </div>
                    </div>
                <div class="row">
                    <div class="col-12">
                        <button type="submit" name="register" class="btn btn-primary ">Submit</button>
                    </div>

                </div>
                </div>
            </form>
        </div>
    </div>
</div>

<?php
include('includes/footer.php');
?>
