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
	<link rel="stylesheet" type="text/css" href="/css/life.css" />
</head>
<body>
	<?php
		if(isset($_SESSION['grid']))
		{
			$grid = unserialize($_SESSION['grid']);
		}
		else
		{
			//new 'game': create new grid
			//start small
			$starting_shape = array([0,1], [1,0], [2,1], [2,2]);
			$grid = new Grid(5, $starting_shape);
		}
	?>
	<h2>Generation <?= $grid->generation ?></h2>
	<h4>Refresh page to advance to the next generation</h4>
	<table>
		<tbody>
			<?= $grid->display_grid() ?>
		</tbody>
	</table>
	<?php
		$grid->prepare_next_generation();
	?>
	<p>advancing the next generation, and displaying it (for testing!)</p>
	<?php
		$grid->advance_generation();
		//store the grid in session for the page reload:
		$_SESSION['grid'] = serialize($grid);
		//session_unset('grid');
	?>
	<table>
		<tbody>
			<?= $grid->display_grid() ?>
		</tbody>
	</table>
	<h2>To restart game, click here:</h2>
	<form action="process.php" method="POST">
		<input type="submit" value="Start over" />
	</form>
</body>
</html>