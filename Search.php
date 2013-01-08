<?php 

	require_once("SigGen.php");
	require_once("FactorySearchItem.php");

	class Search
	{
		public $id;
		public $json_decoded;
		public $searchItem;
		public $response;
		
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
				
				try
				{
					if (!$json_request = @file_get_contents($requestString))
						throw new Exception($search_value);
					else 
					{
						$this->response = "200";
						$this->json_decoded = json_decode($json_request, true);
						$this->searchItem->parseJSON($this->json_decoded, $dataCluster);
					}
				}
				catch (Exception $ex)
				{
					echo 'Could not find results for: "' . $ex->getMessage() . '".';
					$this->response = "404";
					break;
				}
			}
		}
		
		function setSearchId($sig)
		{
			$this->id = $sig;
		}
	}
			
?>		