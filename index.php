<?php
	require('grid.php');
	require('tile.php');
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Game of Life</title>
	<link rel="stylesheet" type="text/css" href="life.css" />
</head>
<body>
	<?php
		//start small
		$grid = new Grid(5);
		//initializing a shape:
		//$grid->grid[0][0] = new Tile(0,0,TRUE);
		$grid->grid[0][1] = new Tile(0,1,TRUE);
		$grid->grid[1][0] = new Tile(1,0,TRUE);
		$grid->grid[1][2] = new Tile(1,2,TRUE);
		$grid->grid[2][2] = new Tile(2,2,TRUE);
	?>
	<h2>To restart game, click here:</h2>
	<form action="process.php" method="POST">
		<input type="submit" value="Start over" />
	</form>
	<h2>Generation <?= $grid->generation ?></h2>
	<h4>Refresh page to advance to the next generation</h4>
	<table>
		<tbody>
			<?= $grid->display_grid() ?>
		</tbody>
	</table>
	<?php
		//testing functions for Grid
		echo "0,0: " . $grid->count_live_neighbors($grid->grid[0][0]) . "<br>";
		echo "0,1: " . $grid->count_live_neighbors($grid->grid[0][1]) . "<br>";
		echo "1,0: " . $grid->count_live_neighbors($grid->grid[1][0]) . "<br>";
		echo "1,1: " . $grid->count_live_neighbors($grid->grid[1][1]) . "<br>";
		echo "1,2: " . $grid->count_live_neighbors($grid->grid[1][2]) . "<br>";
		echo "2,1: " . $grid->count_live_neighbors($grid->grid[2][1]) . "<br>";
		echo "2,2: " . $grid->count_live_neighbors($grid->grid[2][2]) . "<br>";

		echo "the next state of these tiles:<br>";
		$grid->prepare_next_generation();
		echo "0,0: " . $grid->grid[0][0]->next_state . "<br>";
		echo "1,1: " . $grid->grid[1][1]->next_state . "<br>";
		echo "1,2: " . $grid->grid[1][2]->next_state . "<br>";
		echo "2,1: " . $grid->grid[2][1]->next_state . "<br>";
		echo "2,2: " . $grid->grid[2][2]->next_state . "<br>";

		echo "advancing the next generation, and displaying it (for testing!)";
		$grid->advance_generation();
	?>
	<table>
		<tbody>
			<?= $grid->display_grid() ?>
		</tbody>
	</table>
</body>
</html>