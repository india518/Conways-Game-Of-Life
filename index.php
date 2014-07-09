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
		$grid->grid[0][0] = new Tile(0,0,TRUE);
		$grid->grid[0][1] = new Tile(0,1,TRUE);
		$grid->grid[1][0] = new Tile(1,0,TRUE);
		//$grid->grid[1][1] = new Tile(1,1,TRUE);
	?>
	<form action="process.php" method="POST">
		<input type="submit" value="Start over" />
	</form>
	<h1>Generation PUT_GENERATION_NUMBER_HERE</h1>
	<h4>Refresh page to advance to the next generation</h4>
	<table>
		<tbody>
			<?= $grid->display_grid() ?>
		</tbody>
	</table>
	<?php
		//testing functions for Grid
		echo $grid->count_live_neighbors($grid->grid[0][0]) . "<br>";
		echo $grid->count_live_neighbors($grid->grid[1][1]) . "<br>";
		echo $grid->count_live_neighbors($grid->grid[2][2]) . "<br>";
		echo $grid->count_live_neighbors($grid->grid[0][2]) . "<br>";
	?>
</body>
</html>