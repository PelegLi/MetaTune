<?php
	echo "<h3>$this->title</h3>";
	$this->displayArtists();
	echo "</br>Release date: $this->releaseDate </br>";
	echo "Genres: ";
	$this->printArrayValues($this->genres);	
	echo "</br>";
	$this->displayTracks();