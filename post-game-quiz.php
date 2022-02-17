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

<body class="post-game-quiz">
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

  <div class="container-quick-quiz">
    <div id="post-game-quiz" class="justify-center flex-column fs-500 ff-sans-cond letter-spacing-3 uppercase">
        <div id="hud">
            <div id="hud-item">
                <p id="progressText" class="hud-prefix">
                    Question
                </p>

                <div id="progressBar">
                    <div id="progressBarFull"></div>
                </div>
            </div>

            <div id="hud-item">
                <p class="hud-prefix">
                    Score
                </p>
                <h1 class="hud-main-text" id="score">
                    0
                </h1>
            </div>
        </div>
        
        <div class="quiz-divider"></div>
        
        <h2 id="question">What is the answer to this question?</h2>

        <div class="choice-container">
            <p class="choice-prefix">A</p>
            <p class="choice-text" data-number="1">Choice 1</p>
        </div>

        <div class="choice-container">
            <p class="choice-prefix">B</p>
            <p class="choice-text" data-number="2">Choice 2</p>
        </div>

        <div class="choice-container">
            <p class="choice-prefix">C</p>
            <p class="choice-text" data-number="3">Choice 3</p>
        </div>

        <div class="choice-container">
            <p class="choice-prefix">D</p>
            <p class="choice-text" data-number="4">Choice 4</p>
        </div>
        <br><br>

    </div>
  </div>
  <script src="post-game-quiz.js"></script>
  </body>
</html>