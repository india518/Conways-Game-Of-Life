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
				$html .= "<td class="
				      . ($this->grid[$x][$y]->state ? "true" : "false") 
				      . ">{$this->grid[$x][$y]->state}</td>";
			}
			$html .= "</tr>";
		}
		return $html;
	}

	//check neighbors to determine if a <td> lives/dies/respawns in the next gen
	function count_live_neighbors($tile)
	{
		$VECTORS = [[-1,-1],[-1,0],[-1,1],[0,-1],[0,1],[1,-1],[1,0],[1,1]];
		$count = 0;
		foreach($VECTORS as $vector)
		{
			//if the x or y location is not 'off of the grid', then it's a real,
			//neighboring tile
			if(!
				( ($tile->x+$vector[0]) < 0 || ($tile->y+$vector[1]) < 0
				|| ($tile->x+$vector[0]) >= $this->size
				|| ($tile->y+$vector[1]) >= $this->size) )
			{
				//find the tile on the board,
				// increment count if it is live
				// $neighbor variable is not necessary per se, but I need it for readability
				$neighbor = $this->grid[$tile->x+$vector[0]][$tile->y+$vector[1]];
				if ($neighbor->state)
				{
					$count++;
				}	
			}
		}
		return $count;
	}

	//advance next state of all tiles to current state

	//reset function
}