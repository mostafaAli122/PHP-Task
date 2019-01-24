<?php
include('./classes/DB.php');
if (isset($_POST['createnewuser'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        
        if (!DB::query('SELECT name FROM users WHERE name=:username', array(':username'=>$username))) {
                if (strlen($username) >= 3 && strlen($username) <= 32) {
                        if (preg_match('/[a-zA-Z0-9_]+/', $username)) {
                                if (strlen($password) >= 6 && strlen($password) <= 60) {
                                if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                                if (!DB::query('SELECT email FROM users WHERE email=:email', array(':email'=>$email))) {
                                        DB::query('INSERT INTO users VALUES (\'\', :name,  :email, :phone , :password)', array(':name'=>$username, ':password'=>password_hash($password, PASSWORD_BCRYPT), ':email'=>$email,':phone'=>$phone));
                                        echo "Successfully Creating New User!";
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
        } else {
                echo 'User already exists!';
        }
}
?>

<h1>Adding New User</h1>
<form action="Create-New-User.php" method="post">
<input type="text" name="username" value="" placeholder="Username ..."><p />
<input type="password" name="password" value="" placeholder="Password ..."><p />
<input type="email" name="email" value="" placeholder="someone@somesite.com"><p />
<input type="text" name="phone" value="" placeholder="Phone..."><p />
<input type="submit" name="createnewuser" value="Create User">
</form>