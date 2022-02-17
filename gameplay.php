<?php

require_once 'init.php';

require_once 'db_conn.php';

require_once 'functions.php';

$username = $_SESSION['username'];

if(isset($_POST['pre-game-otp'])){
  $pre_game_otp = validate($_POST['pre-game-otp']);

  if(!check_pre_game_otp_exists_for_username($username,$pre_game_otp)){

    $_SESSION['pre_game_otp_error'] = 'OTP code invalid';

    //$_SESSION['resend_otp'] = true;

    header('location: pre-game-verification.php');

    exit();

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

  

  <div id="end" class="container-quick-quiz flex-center flex-column">

    <h2 class="fs-700 ff-serif uppercase flex-center flex-column">QUICK POST-GAME QUIZ</h2>

    <p>You need to answer a final quiz to unlock the game ending. This is to determine your 

      knowledge on the subject matter of the game after gameplay. To proceed with the quiz, click 

      the button below.

    </p>

    <br>

    

    <!--<button type="submit" class="verify-button uppercase ff-serif text-dark bg-white">Start</button>-->

    <a href="post-game-quiz" class="start-button uppercase ff-serif text-dark bg-white">Start</a>

    <br><br><br><br>

</div>

  </body>

</html>
