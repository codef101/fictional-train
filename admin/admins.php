<?php
include('includes/header.php');
include('includes/functions.php');
   if(isset($_GET['did']))
   {
       $did=$_GET['did'];
       $date=date('Y-m-d');
       $sql_get="SELECT * FROM `admin` WHERE `id`=$did";
       $get_res=$con->query($sql_get);
       $get_admin=$get_res->fetch_assoc();
       $can=canDeleteAdmins($get_admin['admin_role']);
       if (!$can){
           ?>
           <script>
               window.location.href='index.php'
           </script>
           <?php
           exit();
       }
       $admin_email=$get_admin['email'];
       $sql="DELETE FROM `admin` WHERE `id`=$did";
       $res=$con->query($sql);
       if($res)
       {
           $action= 'Deleted Admin: '.$admin_email.'';
           logEntry($action,$_SESSION['uid'],$con);
           ?>
           <script>
               window.location.href='admins.php'
           </script>
           <?php
       }

   }
?>
    <div class="row pt-3">
        <div class="col-12">
            <div class="card bg-dark text-white">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                    <h3 class="card-title">Admins</h3>
                        <a href="addAdmins.php" class="btn btn-sm btn-primary <?php if(!isset($_SESSION['is_s_admin'])){echo 'disabled';} ?>">Add New Admin</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                    <table id="tabletest" class="table table-dark table-striped table-hover">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Action</th>
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
                            <td class="d-flex">
                                <a href="editAdmins.php?id=<?php echo $r['id']; ?>" class="btn btn-sm  btn-primary <?php if(!$can_update){echo 'disabled';} ?>"><i class="far fa-edit"></i></a>
                                <a href="admins.php?did=<?php echo $r['id']; ?>" class="btn btn-sm ml-1  btn-danger delete-confirm <?php if(!$can_delete){echo 'disabled';} ?>"><i class="fas fa-trash-alt"></i></a>
                            </td>
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
                   window.location.href=url
               }
            })
        });

    </script>

<?php
include('includes/footer.php')
?>
