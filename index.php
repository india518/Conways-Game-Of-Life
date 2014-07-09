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
		$grid = new Grid(3);

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
</body>
</html>