<?php 

	require_once "SearchItem.php";
	
	class Album extends SearchItem
	{
		public $title;
		public $releaseDate;
		public $views;
		public $artists = array();		
		public $genres = array();
		public $tracks = array();
		public $dataClusters = array("info", "tracks");
		
		public function __construct()
		{
			if (func_num_args() > 0)
			{
				$this->id = func_get_args(0)[0];
				$this->title = func_get_args(0)[1];
				$this->releaseDate = parent::rectifyDate(func_get_args(0)[2], "Album");
			}
		}

		public function displayItemData()
		{
			echo "<h3>$this->title</h3>";
			$this->displayArtists();
			echo "</br>Release date: $this->releaseDate </br>";
			echo "Genres: ";
			$this->printArrayValues($this->genres);	
			echo "</br>";
			$this->displayTracks();
		}
		
		public function parseJSON($json_decoded, $dataCluster)
		{
			switch ($dataCluster)
			{
				case "info":
					$this->id = $json_decoded['album']['ids']['albumId'];
					$this->title = $json_decoded['album']['title'];
					if (isset($json_decoded['album']['primaryArtists']))
						foreach ($json_decoded['album']['primaryArtists'] as $artist)
						{
							$newArtist = new Name($artist['id'], $artist['name']);
							$this->artists[] = $newArtist;
						}
					if (isset($json_decoded['album']['genres']))
						foreach ($json_decoded['album']['genres'] as $genre)
							$this->genres[] = $genre['name'];
					$this->releaseDate = parent::rectifyDate($json_decoded['album']['originalReleaseDate'], "Album");
					break;
					
				case "tracks":
					$this->views = $json_decoded['view']['total'];
					$this->tracks = $json_decoded['tracks'];
					if (isset($json_decoded['tracks']))
						foreach ($json_decoded['tracks'] as $track)
						{
							$newTrack = new Track($track['ids']['trackId'], $track['title']);
							$this->tracks[] = $newTrack;
						}
					break;
			}
		}
	}

?>