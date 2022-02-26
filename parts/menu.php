<?php 

require_once 'init.php';



$request = explode('/', $_SERVER['REQUEST_URI']);

$page = end($request);



$game_in = in_array($page, array('pre-game-quiz','end-pre-game','pre-game-verification','gameplay','post-game-quiz','end-post-game'));



?>



<ul id="primary-navigation" data-visible="false" class="primary-navigation underline-indicators flex">

	<li class="<?php echo empty($page) ? 'active' : ''; ?>"><a class="ff-sans-cond uppercase text-white letter-spacing-2" href="/"><span aria-hidden="true">00</span>Home</a>

    <li class="<?php echo $page=='characters' ? 'active' : ''; ?>"><a class="ff-sans-cond uppercase text-white letter-spacing-2" href="characters"><span aria-hidden="true">01</span>Characters</a>

    <li class="<?php echo ($page=='game' || $game_in) ? 'active' : ''; ?>"><a class="ff-sans-cond uppercase text-white letter-spacing-2" href="<?php if(isset($_SESSION['check_url']) && $_SESSION['check_url'] == "gameplay"){echo "gameplay";}else{echo "game"; }?>"><span aria-hidden="true">02</span>Game</a>

    <li class="<?php echo $page=='about' ? 'active' : ''; ?>"><a class="ff-sans-cond uppercase text-white letter-spacing-2" href="about"><span aria-hidden="true">03</span>About</a>

</ul>

