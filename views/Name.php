<?php
	echo "<h3>$this->name</h3>";
	if ($this->headline_bio != "")
		echo "$this->headline_bio </br>";
	echo "Genres: ";
	$this->printArrayValues($this->genres);
	echo "</br>$this->birth - ";
	echo "$this->death</br></br>";
	echo "Discography:</br>";
	$this->displayAlbums();