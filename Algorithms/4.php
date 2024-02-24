<?php

function numIslands($grid)
{
	$count = 0;
	
	for ($i = 0; $i < count($grid); $i++) {
		for ($j = 0; $j < count($grid[0]); $j++) {
			if ($grid[$i][$j] === "1") {
				dfs($i, $j, $grid);
				$count++;
			}
		}
	}
	
	return $count;
}

function dfs($row, $column, &$grid)
{
	if($row < 0 || $column < 0 || $row >= count($grid) || $column >= count($grid[0]) || $grid[$row][$column] === "0" ) {
		return;
	}
		
	$grid[$row][$column] = "0";
	
	dfs($row + 1, $column, $grid);
	dfs($row - 1, $column, $grid);
	dfs($row, $column + 1, $grid);
	dfs($row, $column - 1, $grid);
};

    
    
	$grid = [
		["1","1","1","1","0"],
		["1","1","0","1","0"],
		["1","1","0","0","0"],
		["0","0","0","1","0"],
	];
	 
	 echo numIslands($grid);