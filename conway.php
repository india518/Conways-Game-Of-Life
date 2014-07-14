<?php
	session_start();
	require('grid.php');
	require('tile.php');
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Game of Life</title>
	<link rel="stylesheet" type="text/css" href="/css/bootstrap.min.css" />
	<link rel="stylesheet" type="text/css" href="/css/life.css" />
	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
</head>
<body>
	<div class="container">
		<?php
			if(isset($_SESSION['grid']))
			{
				$grid = unserialize($_SESSION['grid']);
			}
			else
			{
				//new 'game': create new grid, seed it with a shape
				//$starting_shape = array([0,1], [1,0], [2,1], [2,2]);
				$glider = array([1,3],[2,3],[3,3],[3,2],[2,1]);
				$grid = new Grid(25, $glider);
			}
		?>
		<h2>Conways <a href="http://en.wikipedia.org/wiki/Conway's_Game_of_Life">Game of Life</a>!</h2>
		<h4>This is my attempt to implement the Game of Life in PHP</4>
		<h5>Refresh page to advance to the next generation, or <a href="process.php">Restart</a> the game</h5>
		<h5>Current Generation: <?= $grid->generation ?></h5>
		<table>
			<tbody>
				<?= $grid->display_grid() ?>
			</tbody>
		</table>
		<?php
			$grid->prepare_next_generation();
			$grid->advance_generation();
			//store the grid in session for the page reload:
			$_SESSION['grid'] = serialize($grid);
			//session_unset('grid');
		?>
		<!-- <table>
			<tbody>
				<?//= $grid->display_grid() ?>
			</tbody>
		</table> -->
	</div>
</body>
</html>