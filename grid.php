<?php

Class Grid
{
	var $grid;
	var $size;
	var $generation;

	function __construct($size)
	{
		$this->size = $size;
		$this->create_empty_grid($size);
		$this->generation = 0;
	}

	//create a 2-dim array of size $size
	//for now, grid will initially be full of non-live Tiles
	function create_empty_grid($size)
	{
		$grid = [];
		for($x=0; $x<$size; $x++)
		{
			$grid[$x] = [];
			for($y=0; $y<$size; $y++)
			{
				$tile = new Tile($x, $y);
				array_push($grid[$x], $tile);
			}
		}
		$this->grid = $grid;
	}
}