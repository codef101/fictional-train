<?php

require_once 'init.php';

require_once 'db_conn.php';

require_once 'functions.php';

$username = $_SESSION['username'];

if(!isset($_SESSION['pre_game_otp_error']) && !isset($_POST['resend-otp'])){
    if(isset($_POST['pre-game-email']) && !empty($_POST['pre-game-email'])){
      $email = validate($_POST['pre-game-email']);
      $regex = '/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/';
      if(!preg_match($regex, $email)){
        $_SESSION['pre_game_email_error'] = 'Invalid Email';
        header("Location: end-pre-game");
        exit();
      }
      if(strlen($email)>40){

        $_SESSION['pre_game_email_error'] = 'Email length should not exceed 40 characters';

          header("Location: end-pre-game");

          exit();

      }

      if(filter_var($email, FILTER_VALIDATE_EMAIL)){
        $result = save_pre_game_email($username,$email);
        if($result){
          $otp_code = generate_random_otp_code();
          if($otp_code){
            $result = '';
            $result = save_pre_game_otp_for_username($username,$otp_code);
            if($result){
              $email = get_pre_game_email_for_username($username);
              send_otp($email,$username,$otp_code);
            }
          }
        } 
      }else{
        $_SESSION['pre_game_email_error'] = 'Please provide valid email address to send OTP code';
        header('location: end-pre-game');
      }
    }else{

      $_SESSION['pre_game_email_error'] = 'Please provide email address to send OTP code';

      header('location: end-pre-game');

    }

}

if(isset($_POST['resend-otp'])){
  $otp_code = generate_random_otp_code();
  if($otp_code){
    $result = '';
    $result = save_pre_game_otp_for_username($username,$otp_code);
    if($result){
      $email = get_pre_game_email_for_username($username);
      send_otp($email,$username,$otp_code);
      $_SESSION['otp_code_sent'] = 'OTP code sent to email.';
    }
  }
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



<body class="end-quiz">

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



  <div id="end" class="container-quick-quiz flex-center flex-column">

      <h2 class="fs-700 ff-serif uppercase flex-center flex-column">ONE-TIME PIN CODE SENT</h2>

      <p>The one-time PIN code has been sent to your email address. Please enter it below to proceed.

      </p>

      <br>

      

      <form action="gameplay" method="post" class="fs-400 ff-sans-cond letter-spacing-3 uppercase">

          <div style="color:red"><?php echo isset($_SESSION['pre_game_otp_error']) ? $_SESSION['pre_game_otp_error'] :''; 

          unset($_SESSION['pre_game_otp_error']); ?></div>

          <label for="pre-game-otp">One-time PIN code</label><br><br>

          <input type="text" id="pre-game-otp" name="pre-game-otp" placeholder="TYPE HERE"><br>

          <br>

          <button type="submit" class="verify-button uppercase ff-serif text-dark bg-white">Verify</button>

      </form>

      <form action="pre-game-verification" method="post" class="fs-400 ff-sans-cond letter-spacing-3 uppercase">

              <input type="hidden" name="resend-otp" value="true"/>

               <div style="color:green"><?php echo isset($_SESSION['otp_code_sent']) ? $_SESSION['otp_code_sent'] :''; 

          unset($_SESSION['otp_code_sent']); ?></div>

              <button type="submit" class="verify-button uppercase ff-serif text-dark bg-white">Resend OTP</button>

          </form>

          <br><br><br><br>

  </div>

  <!--<script src="end-pre-game.js"></script>-->

  </body>

</html>
