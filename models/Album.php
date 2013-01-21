<?php 

	require_once "models/SearchItem.php";
	
	class Album extends SearchItem
	{
		public $title;
		public $releaseDate;
		public $views;
		public $artists = array();		
		public $tracks = array();
		public $dataClusters = array("info", "tracks");
		
		public function __construct($id = null, $title = null, $releaseDate = null)
		{
				$this->id = $id;
				$this->title = $title;
				$this->releaseDate = parent::rectifyDate($releaseDate, "Album");
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