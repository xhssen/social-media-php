
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="signup.css">
    <title>Sign Up</title>
</head>
<body>
 
<div class="container">
  <div class="left">
    <div class="header">
      <h2 class="animation a5">The Place You Need To Connect</h2>
      <!-- <h4 class="animation a5">Signing up here is fast and free</h4> -->
    </div>
    <form action="../connect.php" method="POST" class="form">
      <div class="text-input">
        <input type="text" class="form-field animation a5" placeholder="First Name" name="firstname">
        <input type="text" class="form-field animation a5" placeholder="Last Name" name="lastname">
      </div>
      <input type="email" class="form-field animation a5" placeholder="Email Address" name="mail">
      <input type="password" class="form-field animation a5" placeholder="Password" name="pass">
      <input class="form-field animation a4" type="date" name="dob">
      <div class="file-img"><br>
        <input type="file" id="actual-btn" hidden/>
        <label for="actual-btn">Choose Your Photo Profile</label>
        <span id="file-chosen">No Photo chosen</span>
      </div><br>
      <h5>By clicking Agree & Join, you agree to User Agreement, Privacy Policy, and Cookie Policy</h5>
      <p class="animation a5"><a href="../">Have An Account?</a></p>
      <input type="submit" class="animation a6" value="Agree & Join" name="signup">
     

  </form>

  </div>
  <div class="right"></div>
</div>
<script>
  const actualBtn = document.getElementById('actual-btn');

  const fileChosen = document.getElementById('file-chosen');

  actualBtn.addEventListener('change', function(){
    fileChosen.textContent = this.files[0].name
})
</script>
</body>
</html>



