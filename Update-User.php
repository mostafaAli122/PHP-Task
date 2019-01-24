<?php
include('./classes/DB.php');
if(isset($_GET['id'])){
    $userInfo=DB::query('SELECT * FROM users WHERE id=:id', array(':id'=>$_GET['id']));    


}
if (isset($_POST['updateuser']) ) {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $id=$_POST['id'];
//check if id doesn't exit in the users table
if (DB::query('SELECT id FROM users WHERE id=:id', array(':id'=>$id))) {
        if (strlen($username) >= 3 && strlen($username) <= 32) {
            if (preg_match('/[a-zA-Z0-9_]+/', $username)) {
                if (strlen($password) >= 6 && strlen($password) <= 60) {
                    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                        if (!DB::query('SELECT email FROM users WHERE email=:email', array(':email'=>$email))) {
                            DB::query('UPDATE  users set name = :username , password = :password , phone = :phone ,email = :email WHERE id= :id',array(':id'=>$id,':username'=>$username,':password'=>password_hash($password, PASSWORD_BCRYPT) , ':phone'=>$phone , ':email'=>$email));
                           echo "Successfully Updated User Info!";
                        } else {
                           echo 'Email in use!';
                        }
                    } else {
                       echo 'Invalid email!';
                    }
                } else {
                   echo 'Invalid password!';
                }
            } else {
               echo 'Invalid username';
            }
        } else {
           echo 'Invalid username';
        }
     }else{
       echo 'user ID doesn\'t exist';
     }
}
?>

<h1>Update Existing User</h1>
<form action="Update-User.php" method="post">
<input type="hidden" name="id" value="<?php echo $userInfo[0][0]?>" ><p />
<input type="text" name="username" value="<?php echo $userInfo[0][1]?>" placeholder="Username ..."><p />
<input type="password" name="password" value="" placeholder="Password ..."><p />
<input type="email" name="email" value="<?php echo $userInfo[0][2]?>" placeholder="someone@somesite.com"><p />
<input type="text" name="phone" value="<?php echo $userInfo[0][3]?>" placeholder="Phone..."><p />
<input type="submit" name="updateuser" value="Update User">
</form>