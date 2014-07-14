<?php

Class Grid
{
	var $grid;
	var $size;
	var $generation;

	function __construct($size, $locations)
	{
		$this->size = $size;
		$this->create_starting_grid($size, $locations);
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

	//create and seed grid in one function
	//$locations is an array of where to place live tiles
	function create_starting_grid($size, $locations)
	{
		//have argument list contain coordinates for live tiles.
		//loop through array to place starting live tiles
		$grid = [];
		for($x=0; $x<$size; $x++)
		{
			$grid[$x] = [];
			for($y=0; $y<$size; $y++)
			{
				if(in_array([$x,$y], $locations))
				{
					array_push($grid[$x], new Tile($x, $y, TRUE));
				}
				else
				{
					array_push($grid[$x], new Tile($x, $y));
				}
			}
		}
		$this->grid = $grid;
	}

	//create html table to display tiles in grid
	function display_grid()
	{
		$size = count($this->grid);
		$html = "";
		for($x=0; $x<$size; $x++) //displaying by row, so x-coordinate first
		{
			$html .= "<tr>";
			for($y=0;$y<$size;$y++)
			{
				$html .= "<td class="
				      . ($this->grid[$x][$y]->state ? "true" : "false") 
				      . ">{$this->grid[$x][$y]->x}, {$this->grid[$x][$y]->y}</td>";
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

	//determine the next state of each tile
	function prepare_next_generation()
	{
		foreach($this->grid as $row)
		{
			foreach($row as $tile)
			{
				//var_dump($tile);
				$count = $this->count_live_neighbors($tile);
				//echo $count . "<br/>";
				switch($count)
				{
					case 2: //tile remains the same
						$tile->next_state = $tile->state;
						break;
					case 3: //tile stays or becomes alive
						$tile->next_state = TRUE;
						break;
					default: //tile stays or becomes dead
						$tile->next_state = FALSE;
				}
			}
		}
	}

	//advance next state of all tiles to current state
	function advance_generation()
	{
		foreach($this->grid as $row)
		{
			foreach($row as $tile)
			{
				$tile->state = $tile->next_state;
			}
		}
		//finally, update the generation counter
		$this->generation++;
	}
	
	//reset function
}