<?php
include('./classes/DB.php');
if (isset($_GET['id'])) {
    DB::query('DELETE FROM users WHERE id=:id', array(':id'=>$_GET['id'])); 
    echo 'Successfully Deleted User!';   
    }
?>