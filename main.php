<?php
    include('./classes/DB.php');

    $Allusers=DB::query('SELECT * FROM users ');

?>


<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="styles.css">
</head>
<body>

<div class="topnav">
  <a class="active" href="main.php">Home</a>
  <a href="Create-New-User.php">Add New User</a>

</div>

<div class="panel panel-default">
    <div class="panel-heading">
       All Users
    </div>
    <div class="panel-body">
        <table class="table table-hover">
            <thead>
                <th>UserName</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Edit</th>
                <th>Delete</th>
            </thead>
            <tbody>
                 <?php if(count($Allusers)>0) { ?>              
                    <?php foreach($Allusers as $user):  ?>
                    <tr>
                         <td><?php echo $user[1] ?></td>
                        <td><?php echo $user[2] ?></td>
                        <td><?php echo $user[3] ?></td>
                        <td><a href="Update-User.php?id=<?php echo $user[0] ?>" class="btn btn-xs btn-info">Edit</a></td>
                        <td><a href="delete-user.php?id=<?php echo $user[0] ?>" class="btn btn-xs btn-danger">Delete</a></td>
                    </tr>
                 <?php endforeach; ?>
                 <?php } else { ?>
                    <th colspan="5" class="text-center">No Post Published Yet !!</th>
                <?php  } ?>
            </tbody>
        </table>
    </div> 
</div>

</body>
</html>

