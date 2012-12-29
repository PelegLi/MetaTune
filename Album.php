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
		
		public function __construct()
		{
			parent::setDataClusters(array("info", "tracks"));
			if (func_num_args() > 0)
			{
				$this->id = func_get_args(0)[0];
				$this->title = func_get_args(0)[1];
				$this->releaseDate = func_get_args(0)[2];
			}
		}

		public function displayItemData()
		{
			echo "<h3>$this->title</h3>";
			$this->printArrayValues($this->artists);
			echo "</br>Release date: $this->releaseDate </br>";
			echo "Genres: ";
			$this->printArrayValues($this->genres);	
			echo $this->displayTracks();
		}
		
		public function displayTracks()
		{			
			echo "</br>";
			$count = 1;
			$urlPreFix = "allmusicapi.php?searchItems=Track&idSearch=id&search_value=";
			foreach ($this->tracks as $track)
				if (isset($track->id) && isset($track->title))
				{
					echo "<a href=$urlPreFix$track->id>$track->title</a>";
					if ($count < count($this->tracks))
						echo "</br> ";
					$count++;
				}
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
							$this->artists[] = $artist['name'];
					if (isset($json_decoded['album']['genres']))
						foreach ($json_decoded['album']['genres'] as $genre)
							$this->genres[] = $genre['name'];
					$this->releaseDate = $json_decoded['album']['originalReleaseDate'];
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