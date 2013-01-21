<?php

	function isChecked($item)
	{
		if (isset($_GET["searchItems"]) &&  $_GET["searchItems"] == $item)			
			return true;
	}
	