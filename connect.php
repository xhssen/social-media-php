<?php 
session_start();
$db=mysqli_connect("localhost","root","","social");

if (isset($_POST['login'])) {
    $mail=$_POST['mail'];
    $pass=$_POST['pass'];
    $cmd="select * from users where email='$mail' and password='$pass';";
    $res=mysqli_query($db,$cmd);
    if ( mysqli_num_rows($res) > 0 ) {
        $row=mysqli_fetch_array($res);
        $_SESSION['id-user']=$row[0];
        $_SESSION['name']=$row[1];
        $_SESSION['photo']=$row[9];
        echo "<h2>"."You Logged In"."</h2>"; 
        header('Location:/social/index.php'); 
    }
    else {
        echo "<h2>"."Something Wrong: Check Your Info Or Maybe You Don't Have An Account!"."</h2>";
        header('refresh: 3,../social');
        
    }
} elseif( isset($_POST['signup']) ) {
    $mail=$_POST['mail'];
    $pass=$_POST['pass'];
    $fname=$_POST['firstname'];
    $lname=$_POST['lastname'];
    $dob=$_POST['dob'];
    
    $profile_pic="assets/default.png";
    $cmd="select email from users where email='$mail';";
    $res=mysqli_query($db,$cmd);
    if ( mysqli_num_rows($res) <= 0 ) {
        $cmd2="insert into users(firstname,lastname,email,password,dob,image) values('$fname','$lname','$mail','$pass','$dob','$profile_pic')";
        $q = mysqli_query($db,$cmd2);
        if (!$q)
            die (mysqli_error($db));
         echo "<h2>"."You Registered Successfuly"."</h2>";
         header('Location:/social/index.php'); 
    } else {
        echo "<h2>"."Account With This Email Is Already Registered"."</h2>";
    }
} else {
    header('Location:/social/index.php');    
}

?>