<?php 

	require_once "models/SearchItem.php";
	
	class Album extends SearchItem
	{
		public $title;
		public $releaseDate;
		public $views;
		public $headlineReview;
		public $type;
		public $status;
		public $flags = array();
		public $artists = array();		
		public $tracks = array();
		public $dataClusters = array("info", "tracks");
		
		public function __construct($id = null, $title = null, $releaseDate = null, $type = null, $flags = null)
		{
				$this->id = $id;
				$this->title = $title;
				$this->releaseDate = parent::rectifyDate($releaseDate, "Album");
				$this->type = $type;
				$this->flags = $flags;
				$this->defineAlbumStatus();
		}
		
		public function defineAlbumStatus()
		{			
			if ($this->type == "Album" && (!isset($this->flags) || 
				(((in_array("Digitally Remastered", $this->flags)) || (in_array("Gold", $this->flags)) || (in_array("Soundtrack", $this->flags)) || (in_array("Limited Edition", $this->flags))) && 
				!((in_array("Compilation", $this->flags)) || (in_array("Video", $this->flags))))))
					$this->status = "main";
				else
					$this->status = "notmain";
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
					$this->releaseDate = $this->rectifyDate($json_decoded['album']['originalReleaseDate'], "Album");
					$this->headlineReview = $json_decoded['album']['headlineReview']['text'];
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