<?php

class Tile
{
	//using x and y for grid (cartesian) coordinates
	var $x;
	var $y;
	var $state;

	function __construct($x, $y, $state=FALSE)
	{
		$this->x = $x;
		$this->y = $y;
		$this->state = $state;
	}
}