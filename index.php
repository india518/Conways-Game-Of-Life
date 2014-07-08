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
	<form action="process.php" method="POST">
		<input type="submit" value="Start over" />
	</form>
	<h1>Generation PUT_GENERATION_NUMBER_HERE</h1>
	<h4>Refresh page to advance to the next generation</h4>
	<h5>A test of tiles</h5>
	<?php
		$tile11 = new Tile(1,1); // "dead" tile
		$tile67 = new Tile(6,7, TRUE) // "live" tile
	?>
	<p>Info on our "dead" tile:</p>
	<ul>
		<li>x co-ordinate: <?= $tile11->x ?></li>
		<li>y co-ordinate: <?= $tile11->y ?></li>
		<li>state: <?php echo $tile11->state ? "ALIVE" : "DEAD" ?>
	</ul>

	<p>Info on our "live" tile:</p>
	<ul>
		<li>x co-ordinate: <?= $tile67->x ?></li>
		<li>y co-ordinate: <?= $tile67->y ?></li>
		<li>state: <?php echo $tile67->state ? "ALIVE" : "DEAD" ?>
	</ul>

	<table>
		<tbody>
		</tbody>
	</table>
</body>
</html>