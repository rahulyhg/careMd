<?php 

/**
 * Color helper function
 */
class ColorHelper
{
	
	function __construct()
	{
	}


	function rand_color() {
    	return '#' . str_pad(dechex(mt_rand(0, 0xFFFFFF)), 6, '0', STR_PAD_LEFT);
	}
}

 ?>