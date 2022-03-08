<?php
error_reporting(E_ALL ^ E_WARNING); 
include('includes/header.php');
include('includes/functions.php');
   if(isset($_REQUEST['did']) && intval($_REQUEST['did']) > 0){
       $did=$_REQUEST['did'];
       $date=date('Y-m-d');
       $sql_get="SELECT * FROM `admin` WHERE `id`=$did";
       $get_res=$con->query($sql_get);
       $get_admin=$get_res->fetch_assoc();
       $can=canDeleteAdmins($_SESSION['role']);
       if (!$can){
           header("location:admins");
       }
      
       if($can){
            if($get_admin['admin_role'] != $_SESSION['role']){
                $condition = false;
            }
            if($get_admin['admin_role'] == $_SESSION['role']){
                $sql = "SELECT * FROM `admin` WHERE `admin_role` = ".$_SESSION['role'];
                $res=$con->query($sql);
                $condition = $res->num_rows == 1;
            }
            if($condition && $_SESSION['role'] == 0 ){
                $_REQUEST['last_delete'] = "One Super Admin Required";
                header("location:admins");
            }else{
                $_REQUEST['last_delete'] = false;
                $admin_email=$get_admin['email'];
                $sql="DELETE FROM `admin` WHERE `id`=$did";
                $res=$con->query($sql);
                if($res){
                   $action= 'Deleted Admin: '.$admin_email.'';
                   logEntry($action,$_SESSION['uid'],$con);
                   if(intval($_SESSION['uid'])==intval($did)){
                       $action='Delete Supper Admin: '.$admin_email.' itself and Logged out.';
                       logEntry($action,$_SESSION['uid'],$con);
                       session_destroy();header("location:admins");
                   }
                   header("location:admins");
                }
            } 
        }
   }
?>
    <div class="row pt-3">
        <div class="col-12">
            <div class="card bg-dark text-white">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                       <h3 class="card-title">Admins</h3>
                       <?php if(isset($_SESSION['is_s_admin']) && $_SESSION['is_s_admin']){ ?>
                               <a href="addAdmins" class="btn btn-sm btn-primary">Add new Admin</a>
                       <?php } ?>
                    </div>
                </div>
                <div class="card-body">
                    <?php if(isset($_REQUEST['last_delete']) && $_REQUEST['last_delete']){ ?>
                        <p class="alert alert-danger text-center">
                            <?php 
                                echo $_REQUEST['last_delete']; 
                                unset($_REQUEST)
                            ?>
                        </p>
                    <?php } ?>
                    <div class="table-responsive">
                    <table id="tabletest" class="table table-dark table-striped table-hover">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Email</th>
                            <th>Role</th>
                            <?php if(isset($_SESSION['is_s_admin']) && $_SESSION['is_s_admin']){ ?>
                                    <th>Action</th>
                            <?php } ?>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $sql="SELECT * FROM `admin` WHERE  `deleted_at` IS NULL";
                        $res=$con->query($sql);
                        $i=1;
                        while ($r=$res->fetch_assoc()){
                            $can_delete=canDeleteAdmins($r['admin_role']);
                            $can_update=canUpdateAdmins($r['admin_role']);
                            $role= null;
                            if($r['admin_role'] == 0)
                            {
                                $role="Super Admin";
                            }
                            if($r['admin_role'] == 1)
                            {
                                $role="Admin";
                            }
                            if($r['admin_role'] == 2)
                            {
                                $role="Manager";
                            }
                        ?>
                        <tr>
                            <td><?php echo $i; ?></td>
                            <td><?php echo ucwords($r['first_name']); ?></td>
                            <td><?php echo ucwords($r['last_name']); ?></td>
                            <td><?php echo $r['email']; ?></td>
                            <td><?php echo $role; ?></td>
                            <?php if(isset($_SESSION['is_s_admin']) && $_SESSION['is_s_admin']){ ?>
                               <td class="d-flex">
                                    <a href="editAdmins?id=<?php echo $r['id']; ?>" class="btn btn-sm  btn-primary"><i class="far fa-edit"></i></a>
                                    <form method="post" id="delete_user">
                                        <input type="hidden" name="did" value="<?php echo $r['id']; ?>"/>    
                                        <a href="admins" class="btn btn-sm ml-1  btn-danger delete-confirm"><i class="fas fa-trash-alt"></i></a>
                                    </form>
                               </td>
                            <?php } ?>
                        </tr>
                        <?PHP  $i++; } ?>
                        </tbody>
                    </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $('.delete-confirm').on('click', function (event) {
            event.preventDefault();
            const url = $(this).attr('href');
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Confirm delete'
            }).then((result) => {
               if (result.isConfirmed) {
                   $('#delete_user').submit()
               }
            })
        });

    </script>

<?php
include('includes/footer.php')
?>
