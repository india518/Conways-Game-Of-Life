<?php
	session_start();
	require('grid.php');
	require('tile.php');
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>The Game of Life!</title>
	<link rel="stylesheet" type="text/css" href="/css/bootstrap.min.css" />
	<link rel="stylesheet" type="text/css" href="/css/life.css" />
	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="/js/bootstrap.min.js"></script>
</head>
<body>
	<div class="container">
		<?php
			if(isset($_POST['size']) && isset($_POST['shape']))
			{
				switch($_POST['shape'])
				{
					case "glider":
						$shape = array([1,3],[2,3],[3,3],[3,2],[2,1]);
						break;
					case "lwss":
						$shape = array([1,1],[4,1],[5,2],[1,3],[5,3],[2,4],[3,4],[4,4],[5,4]);
						break;
					case "pulsar": //not finished!
						$shape = array([3,1],[4,1],[5,1],
							[1,3],[6,3],[1,4],[6,4],[1,5],[6,5],
							[3,7],[4,7],[5,7]);
						break;
					case "r_pentomino":
						$shape = array([6,5],[7,5],[5,6],[6,6],[6,7]);
						break;
					default: //boring blinker
						$shape = array([3,3],[3,4],[3,5]);
				}
				$grid = new Grid(intval($_POST['size']), $shape);
			}
			else if(isset($_SESSION['grid']))
			{
				$grid = unserialize($_SESSION['grid']);
			}
			else
			{
				//default 'game': create new grid, seed it with a shape
				$glider = array([1,3],[2,3],[3,3],[3,2],[2,1]);
				$grid = new Grid(25, $glider);
			}
		?>
		<h2>Conway's <a href="http://en.wikipedia.org/wiki/Conway's_Game_of_Life">Game of Life</a>!</h2>
		<h4>This is my attempt to implement the 'Game of Life' in PHP and JavaScript</4>
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
		<h5>Click <a href="game">here</a> to advance, or <a href="process">Restart</a> the game</h5>
		<!-- <table>
			<tbody>
				<?//= $grid->display_grid() ?>
			</tbody>
		</table> -->
	</div>
</body>
</html>