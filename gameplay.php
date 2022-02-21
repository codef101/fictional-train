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
  
  <!-- Table Styling -->
  
  <style>
    #game-commands {
      border-collapse: collapse;
    }

    #game-commands td, #customers th {
      border: 2px solid #151552;
      padding: 8px;
    }
    
    #game-commands td {
      background-color: hsl( var(--clr-light) );
      color: black;
      text-align: left;
    }

    #game-commands th {
      padding-top: 12px;
      padding-bottom: 12px;
      text-align: center;
      background-color: #151552;
      color: white;
    }
    
  </style>



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
    
    <div class="fs-400 ff-sans-cond letter-spacing-3 uppercase" style="color: #D2D8F9; margin-bottom: 10px;">GAME COMMANDS LIST</div>
    
    <!-- GAME COMMANDS LIST -->
    <table id="game-commands" style="width: 100%; margin: 20px 0;">
      
      <tr>
       <th>Actions</th>
       <th>Commands</th>
      </tr>
      
      <tr>
        <td>Activate Full Screen Mode</td>
        <td>F4</td>
      </tr>
      
      <tr>
        <td>Return to Normal Screen Mode</td>
        <td>ESC</td>
      </tr>
      
      <tr>
        <td>Progress Through Dialogue</td>
        <td>ENTER, SPACE, or Z</td>
      </tr>
      
      <tr>
        <td>Select Character’s Choice of Action</td>
        <td>Up or Down Arrow Keys → ENTER or CLICK</td>
      </tr>
      
      <tr>
        <td>Move</td>
        <td>Arrow Keys</td>
      </tr>
      
      <tr>
        <td>Run</td>
        <td>Shift + Arrow Keys</td>
      </tr>
      
      <tr>
        <td>Interact</td>
        <td>ENTER, SPACE, or Z</td>
      </tr>
      
      <tr>
        <td>Open Game Menu<br><br>
          <i>*can only be done while navigating town map</i>
        </td>
        <td>X</td>
      </tr>
      
      <tr>
        <td>Return to Previous Screen in Game Menu</td>
        <td>ESC</td>
      </tr>
      
      <tr>
        <td>Exit Game Menu</td>
        <td>ESC</td>
      </tr>
      
      <tr>
        <td>Modify Game Options</td>
        <td>X → Options</td>
      </tr>
      
      <tr>
        <td>Save Game Progress</td>
        <td>X → Save → Select any of the save file slots</td>
      </tr>
      
      <tr>
        <td>Continue Game From Save File (From Title Screen)</td>
        <td>Continue → Select save file</td>
      </tr>
      
      <tr>
        <td>Continue Game From Save File (From Ongoing Gameplay)</td>
        <td>X → Return to Title → Continue → Select save file</td>
      </tr>

    </table>
    
    <!-- END OF GAME COMMANDS LIST -->
    
    <!-- GAME -->
    
    <div class="demo-box" style="margin-bottom: 10px">
        <table title="Content" id="content">
            <tr>
                <td>
                    <div class="fs-400 ff-sans-cond letter-spacing-3 uppercase flex-center" style="color: #D2D8F9; margin: 20px 0;">IN OUR RED STILETTOS GAME
                      <iframe height=628 width=820 src="iors-game/www/index.html"></iframe>
                    </div>
                </td>
            </tr>
        </table>
    </div>
    
    <!-- END OF GAME -->

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
