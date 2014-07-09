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
		for($y=0; $y<$size; $y++) //building each row, so y-coordinate first
		{
			$grid[$y] = [];
			for($x=0; $x<$size; $x++)
			{
				$tile = new Tile($x, $y);
				array_push($grid[$y], $tile);
			}
		}
		$this->grid = $grid;
	}

	//create html table to display tiles in grid
	function display_grid()
	{
		$size = count($this->grid);
		$html = "";
		for($y=0; $y<$size; $y++) //building each row, so y-coordinate first
		{
			$html .= "<tr>";
			for($x=0;$x<$size;$x++)
			{
				//$html .= "<td>{$this->grid[$x][$y]->x} {$this->grid[$x][$y]->y}</td>";
				$html .= "<td class=" . ($this->grid[$x][$y]->state ? "true" : "false") . ">{$this->grid[$x][$y]->state}</td>";
			}
			$html .= "</tr>";
		}
		return $html;
	}
}