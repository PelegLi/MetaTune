<?php
	echo "<h3>$this->title</h3>";
	echo "Genres: ";
	$this->printArrayValues($this->genres);
	$this->removeDuplicateAlbums($this->albums);
	echo "</br>Appears in $this->views album";
	if ($this->views > 1) echo "s";
		echo ":</br>";
	$this->displayAlbums();