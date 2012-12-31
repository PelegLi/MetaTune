<?php 

	/*	  ** xml code **
	 
	$feedURL = 'http://api.rovicorp.com/data/v1.1/name/info?name=led+zeppelin&duration=10080&inprogress=0&country=US&language=en&format=xml&apikey=f52a3zyhzt6ur5zwrz87xfp3&sig=ea5673b6e6c4497bb2675cc8c1ec62ae';	
	$sxml = simplexml_load_file($feedURL);
	echo $sxml->name;
	*/
	require_once("SigGen.php");
	require_once("FactorySearchItem.php");

	class Search
	{
		public $json_decoded;
		public $searchItem;
		public $id;
		
		function __construct($search_value, $idSearch)
		{
			$this->json_decoded = $this->getJSONSearchResults($search_value, $idSearch);			
		}
		
		function getJSONSearchResults($search_value, $idSearch)
		{
			$sig = SigGen::createMD5Hash();
			$search_value = str_replace(' ', '+', $_GET["search_value"]);
			$this->setSearchId($sig);
			$this->searchItem = FactorySearchItem::createSearchItem($_GET["searchItems"]);

			foreach ($this->searchItem->dataClusters as $dataCluster)
			{
				$requestString = $this->searchItem->getRequestString($search_value, $sig, $dataCluster, $idSearch);
				$json_request = file_get_contents($requestString);
				$this->json_decoded = json_decode($json_request, true);
				$this->searchItem->parseJSON($this->json_decoded, $dataCluster);
			}
		}
		
		function setSearchId($sig)
		{
			$this->id = $sig;
		}
	}
			
?>		