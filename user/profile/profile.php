<?php 
    session_start();
    $user_id = $_SESSION['id-user'];
    $name = $_SESSION['name'];
    if(isset($_GET['id']))
    {
        $id = $_GET['id'];
        $db = mysqli_connect("localhost","root","","social");
        $sql ="SELECT * from users where id='$id'";
        $q = mysqli_query($db, $sql);
        if($q)
        {
            if(mysqli_num_rows($q) > 0)
            {
                $row = mysqli_fetch_assoc($q);
                $firstname = $row['firstname'];
                $lastname = $row['lastname'];
            }
            else
            {
                die("Page Not Found");
            }
        }
    }
    else if(isset($_GET['list-friends']) && isset($_GET['user_id']))
    {
        $id = $_GET['user_id'];
        $db = mysqli_connect("localhost","root","","social");
        $sql ="SELECT * from users where id='$id'";
        $q = mysqli_query($db, $sql);
        if($q)
        {
            if(mysqli_num_rows($q) > 0)
            {
                $row = mysqli_fetch_assoc($q);
                $firstname = $row['firstname'];
                $lastname = $row['lastname'];
            }
            else
            {
                die("Page Not Found");
            }
        }
    }
    else
    {
        header("location: ../../index.php");
    }
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/5135f01309.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="profile.css">
    <title>Profile</title>
</head>
<body>
<nav>
    <ul>
        <span class="logo"><li><a href="../index.php"></a></li></span>
        <li><a href="#">About</a></li>
        <li><a href="#">Help</a></li> 
        <li><input type="search" placeholder="Search"></li>
        <?php
            echo '<a class="me" href="profile.php?id='. $user_id .'">'. $name .'<span class="profile-photo"></span></a>';
        ?>
    </ul>
    </nav>
    <div class="container">
        <div class="user-card">
            <div class="pic-name">
                <a href="#"><span class="profile-photo"></span></a> 
                <?php
                    echo $firstname . ' ' . $lastname;
                ?>
            </div>
            <div class="user-details">
                <ul>
                    <li><i class="fa-solid fa-briefcase"></i>&nbsp;&nbsp;Student</li>
                    <li><i class="fa-solid fa-building"></i>&nbsp;&nbsp;Iset Sousse</li> 
                    <li><i class="fa-solid fa-location-dot"></i>&nbsp;&nbsp;Monastir</li> 
                    <li><i class="fa-solid fa-globe"></i>&nbsp;&nbsp;Tunisia</li>
                     
                </ul>
              
            </div>
        </div>
        <div class="profile-header">
            <ul>
                <li>Posts</li>
                <li><form action="" method="GET">
                        <?php

                                echo '<input type="hidden" name="user_id" value="'.$id.'">';
                        ?>
                        <input type="submit" name="list-friends" value="Friends" class="follow">
                    </form>
                </li>
            </ul>
            <?php
                if(isset($_GET['id']) && $_GET['id'] != $_SESSION['id-user'])
                {
                    $id = $_GET['id'];
                    $sql = "SELECT * FROM friends WHERE user_id = $user_id AND friend_id = $id";
                    $q = mysqli_query($db, $sql);
                    if(mysqli_num_rows($q) == 0)
                    {
                    ?>
                    <form action="../../includes/follow.php" method="POST">
                        <?php
                            echo '<input type="hidden" name="user_id" value="'. $id .'">';
                        ?>
                        <input type="submit" name="follow-profile" value="Follow" class="follow">
                    </form>
                    <?php
                    }
                }
            ?>
        </div>
        <div>
            <?php
                if (isset($_GET['list-friends']))
                {
                    $db = mysqli_connect("localhost","root","","social");
                    $user_id = $_GET['user_id'];
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
                        for($u = 0; $u < count($users); $u++) 
                        {
                            if(!$users[$u][3])
                                echo '<a href="#"><span class="profile-photo"></span></a>';
                        }
                        for($u = 0; $u < count($users); $u++) 
                        {
                            if(!$users[$u][3])
                                echo '<a href="profile.php?id='. $users[$u][0] .'"><span class="user-name">'. $users[$u][1] .' '. $users[$u][2] .'</span></a>';
                        }
                        for($u = 0; $u < count($users); $u++) 
                        {
                            if(!$users[$u][3])
                            {
                                echo '<form action="../../includes/follow.php" method="POST">';
                                echo '<input type="hidden" name="user_id" value="'. $users[$u][0] .'">';
                                echo '<input type="hidden" name="return" value="hsan">';
                                echo '<input type="submit" name="Unfollow" value="Unfollow" id="fbtn">';
                                echo '</form>';
                            }
                            
                        }
                    }
                }
            ?>
        </div>
    </div>
</body>
</html>