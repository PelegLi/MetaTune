<?php 

	require_once "models/SearchItem.php";
	
	class Name extends SearchItem
	{
		public $name;
		public $headline_bio;
		public $birth;
		public $death;
		public $albums = array();
		public $dataClusters = array("info", "discography");
		
		public function __construct($id = null, $name = null)
		{
			$this->id = $id;
			$this->name = $name;
		}
		
		public function parseJSON($json_decoded, $dataCluster)
		{
			switch ($dataCluster)
			{
				case "info":
					$this->id = $json_decoded['name']['ids']['nameId'];
					$this->name = $json_decoded['name']['name'];
					$this->headline_bio = $json_decoded['name']['headlineBio'];
					$this->genres = array();
					if (isset($json_decoded['name']['musicGenres']))
						foreach ($json_decoded['name']['musicGenres'] as $genre)
							$this->genres[] = $genre['name'];
					$this->birth = parent::rectifyDate($json_decoded['name']['birth']['date'], "Name");
					$this->death = parent::rectifyDate($json_decoded['name']['death']['date'], "Name");
					break;
					
				case "discography":
					if (isset($json_decoded['discography']))
						foreach ($json_decoded['discography'] as $album)
						{
							$newAlbum = new Album($album['ids']['albumId'], $album['title'], $album['year']);
							$this->albums[] = $newAlbum;
						}
					break;
			}
		}
	}
	
?>