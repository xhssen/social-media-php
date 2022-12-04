<?php 
  session_start();
  $user_id = $_SESSION['id-user'];
  $name = $_SESSION['name'];
  $db=mysqli_connect("localhost","root","","social");
  
  if ( empty($_SESSION['name']) ) header("Location: http://localhost/social/");
  if ( isset($_POST['add-post-content']) ) {
      $id=$_SESSION['id-user'];
      $add_post_content=$_POST['add-post-content'];
      $req="insert into posts(user_id,post) values($id,'$add_post_content')";
      mysqli_query($db,$req);
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/5135f01309.js" crossorigin="anonymous"></script>
    <script src="../js/home.js"></script>
    <link rel="stylesheet" href="home.css">
    <title>Home Page</title>
    
</head>
<body>
    <nav>
        <ul>
            <span class="logo"><a href="../index.php"><li></li></a></span>
            <li><a href="#">About</a></li>
            <li><a href="#">Help</a></li> 
            <li><input type="search" placeholder="Search" onkeypress="handle(event)" id="search"></li>
            <?php
                echo '<a class="me" href="../user/profile/profile.php?id='. $user_id .'">'. $name .'<span class="profile-photo"></span></a>';
            ?>
        </ul>
    </nav>
    <div class="container">
        <div class="Leftside-bar">
            <ul>
                <li><a href="profile.php?id=<?php echo $_SESSION['id-user'];?>"><i class="fa-solid fa-house fa-lg" ></i>&nbsp;&nbsp;Home</a></li>
                <li><a href="#"><i class="fa-solid fa-book-atlas fa-lg"></i>&nbsp;&nbsp;Explore</a></li> 
                <li><a href="profile/profile.php"><i class="fa-regular fa-user fa-lg"></i>&nbsp;&nbsp;Profile</a></li> 
                <li><a href="#"><i class="fa-solid fa-users fa-lg"></i>&nbsp;Friends</a></li> 
                <li><a href="logout/logout.php"><i class="fa-solid fa-right-from-bracket fa-lg"></i>&nbsp;Log out</a></li> 
            </ul>
        </div>

        <div class="main-feed">
            <div class="add-post-container">
                <form action="" metho 876d="post" class="add-post">
                    <input type="text" name="add-post-content" placeholder="Add New Post">
                    <!-- <i class="fa-solid fa-circle-plus fa-2xl"></i> -->
                    <input type="submit" value="Publish">
                </form>
                
            </div>
            <div class="post">
                <div class="post-header">
                    <div class="post-author">
                        <a href="#"><span class="profile-photo"></span></a> 
                        <div class="name-date">
                            <a href="#"><span class="user-name">Long Username</span></a> 
                            <span class="post-date">1 Hour Ago</span>
                        </div>
                    </div>
                    <div class="post-options">
                        <i class="fa-solid fa-lg fa-ellipsis" ></i>
                    </div>  
                </div>  
                <div class="post-content">
                    <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit thaq momlev gm Voluptatum illum placeat laborum, ipsum deserunt consectetur id animi ea nihil officiis aspernatur, repudiandae, aliquid quod ipsam magni dolorem maxime obcaecati ex!</p>
                </div>
                <div class="post-react">
                    <i onclick="like(this)" class="fa-solid fa-heart fa-xl"></i>
                    <i class="fa-solid fa-message fa-lg" ></i>
                    
                </div>
            </div>

        </div>

        <div class="Rightside-bar">
            
            <div class="suggestedList">

                <div class="listTitle">
                    <p>Suggested List</p>
                </div>
                <div class="listUsers">
                    <?php
                        include "../includes/follow.php";
                    ?>
                </div>
            </div>
        </div>
    </div>
    <script>
        function handle(e){
            search-=document.getElementById("address").setAttribute('value', search);
            document.getElementById("").setAttribute('value', search);
        }
    </script>
</body>
</html>