<?php 
  session_start();
  $db=mysqli_connect("localhost","root","","social");
  $req="select post,user_id,dateAdded from posts";
  $res=mysqli_query($db,$req);

  
  
 

    
   


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/5135f01309.js" crossorigin="anonymous"></script>
    <script src="../../js/home.js"></script>
    <link rel="stylesheet" href="explore.css">
    <title>Explore</title>
    
</head>
<body>
  
    <nav>
        <ul>
            <span class="logo"><a href="../index.php"><li></li></a></span>
            <li><a href="#">About</a></li>
            <li><a href="#">Help</a></li> 
            <li><input type="search" placeholder="Search" onkeypress="handle(event)" id="search"></li>
            <a class="me"href="#"><?php echo $_SESSION['name']; ?><span class="profile-photo"></span></a>
        </ul>
      </nav>
    <div class="showall">
        <?php while ($row_post = mysqli_fetch_array($res,MYSQLI_NUM)) {?>
            <?php
            $req2="select firstname,lastname from users where id='$row_post[1]'";
            $res2=mysqli_query($db,$req2);
            $row2=mysqli_fetch_array($res2,MYSQLI_NUM);    
            
            ?>
        <div class="post">
                    <div class="post-header">
                        <div class="post-author">
                            <a href="#"><span class="profile-photo"></span></a> 
                            <div class="name-date">
                                <a href="#"><span class="user-name"><?php echo $row2[0]." ".$row2[1]?></span></a> 
                                <span class="post-date"><?php echo $row_post[2]?></span>
                            </div>
    
                        </div>
                        <div class="post-options">
                            <i class="fa-solid fa-lg fa-ellipsis" ></i>
                        </div>  
                    </div>  
                    <div class="post-content">
                        <p>
                            <?php
                            echo $row_post[0];

                            ?>
                        </p>
                    </div>
                    <div class="post-react">
                        <i onclick="like(this)" class="fa-solid fa-heart fa-xl"></i>
                        <i class="fa-solid fa-message fa-lg" ></i>
                        
                    </div>
                </div>
                <?php }?>
        </div>
</body>

</html>