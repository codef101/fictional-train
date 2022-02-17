<?php
require_once 'init.php';
require_once 'db_conn.php';
require_once 'functions.php';
$username = $_SESSION['username'];
if(isset($_POST['post-game-otp'])){
  $pre_game_otp = validate($_POST['post-game-otp']);
  if(!check_post_game_otp_exists_for_username($username,$pre_game_otp)){
    $_SESSION['post_game_otp_error'] = 'OTP code invalid';
    //$_SESSION['resend_otp'] = true;
    header('location: post-game-verification.php');
    exit();
  }
}else{
    
  //send email contain otp code
    $_SESSION['post_game_otp_error'] = 'please type OTP code here';
    //$_SESSION['resend_otp'] = true;
    header('location: post-game-verification.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <link rel="icon" type="image/png" sizes="32x32" href="./assets/favicon-stiletto.png">
  <!-- Google fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Barlow+Condensed:wght@400;700&family=Bellefair&family=Barlow:wght@400;700&display=swap"
      rel="stylesheet">
      
  <!-- Our custom CSS -->
  <link rel="stylesheet" href="index.css">
  <title>In Our Red Stilettos | Game</title>
  <script src="navigation.js" defer></script>
  <script src="tabs.js" defer></script>

</head>

<body class="actual-game">
  <a class="skip-to-content" href="#main">Skip to content</a>
  <header class="primary-header flex">
    <div>
      <img src="./assets/shared/stiletto-logo.png" alt="In Our Red Stilettos Logo" class="logo">
    </div>
    <button class="mobile-nav-toggle" aria-controls="primary-navigation"><span class="sr-only" aria-expanded="false">Menu</span></button>
    <nav> 
        <?php include 'parts/menu.php'; ?>
    </nav>
  </header>

  </body>
</html>