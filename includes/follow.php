<?php
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    $user_id = $_SESSION["id-user"];
    if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["user_id"]) && isset($_POST["follow-profile"]))
    {
        $db = mysqli_connect("localhost","root","","social");
        $friend = $_POST["user_id"];
        $sql = "INSERT INTO friends (user_id, friend_id) VALUES ('$user_id', '$friend')";
        $q = mysqli_query($db, $sql);
        if(!$q)
            echo(mysqli_error($db));
        header("location: ../user/profile/profile.php?id=".$friend);
    } 
    if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["user_id"]) && isset($_POST["Follow"]))
    {
        $db = mysqli_connect("localhost","root","","social");
        $friend = $_POST["user_id"];
        $sql = "INSERT INTO friends (user_id, friend_id) VALUES ('$user_id', '$friend')";
        $q = mysqli_query($db, $sql);
        if(!$q)
            echo(mysqli_error($db));

    } 
    elseif ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["user_id"]) && isset($_POST["Unfollow"]))
    {
        $db = mysqli_connect("localhost","root","","social");
        $friend = $_POST["user_id"];
        $sql = "DELETE FROM friends WHERE user_id = $user_id AND friend_id = $friend";
        $q = mysqli_query($db, $sql);
        if(!$q)
            echo(mysqli_error($db));
        if(isset($_POST["return"]))
        {
            header("location: ../user/profile/profile.php?id=$user_id&list-friends=Friends");
        }
    }
    $db = mysqli_connect("localhost","root","","social");
    $sql = "SELECT * FROM users WHERE id <> $user_id";
    $result = mysqli_query($db, $sql);
    $users = array();
    $user = array();
    if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            $id = $row["id"];
            $sql = "SELECT * FROM friends WHERE user_id = $user_id AND friend_id = $id";
            $q = mysqli_query($db, $sql);
            array_push($user, $id, $row["firstname"], $row["lastname"], mysqli_num_rows($q) == 0);
            array_push($users, $user);
            $user = array();
        }
        echo '<div class="userProfile">';
        echo '<div class="photos">';
        for($u = 0; $u < count($users); $u++) 
        {
            echo '<a href="#"><span class="profile-photo"></span></a>';
        }
        echo '</div>';
        echo '<div class="username">';
        for($u = 0; $u < count($users); $u++) 
        {
            echo '<a href="../user/profile/profile.php?id='. $users[$u][0] .'"><span class="user-name">'. $users[$u][1] .' '. $users[$u][2] .'</span></a>';
        }
        echo '</div>';
        echo '<div class="follow">';
        for($u = 0; $u < count($users); $u++) 
        {
            echo '<form action="" method="POST">';
            echo '<input type="hidden" name="user_id" value="'. $users[$u][0] .'">';
            if($users[$u][3])
                echo '<input type="submit" name="Follow" value="Follow" id="fbtn">';
            else
                echo '<input type="submit" name="Unfollow" value="Unfollow" id="fbtn">';
            echo '</form>';
        }
        echo '</div>';
        echo '</div>';
    }
    mysqli_close($db);
?>