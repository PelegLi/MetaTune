<?php

	function isChecked($item)
	{
		if (isset($_GET["searchItems"]) &&  $_GET["searchItems"] == $item)			
			return true;
	}

	function setPageTitle()
	{
		$title = "";
		if (isset($_GET["search_value"]))
			$title = " - " . htmlspecialchars($_GET["search_value"]);

		echo $title;
	}
	