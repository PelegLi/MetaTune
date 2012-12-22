<?php 

	include_once "../dostuff.php";
	require_once "Search.php";
	 
//	$connection = connectToDB();
	
?>

<!DOCTYPE html>
<html>

	<head>
		
		<meta charset="utf-8">
		<link rel="shortcut icon" href="../tigerrabbit.png" />
		<link rel="Stylesheet" href="../portfolio.css"/>
		<script src="scripts/AllMusicAPI.js"></script>
		<title>AllMusic.com API</title>
				
	</head>
	
	<body>
	
	<div id="main">
	
		<form method="get">
			
			<p>Search for: 
				<select id="searchItems" name="searchItems">
					<script>getSearchItems();</script>
				</select>
			
			<input type="text" name="search_value"/>
			<input type="submit" value="Search"/></p>					
		
		</form>
	
		<?php 
		
			if (isset($_GET["search_value"]) && ($_GET["search_value"]) != "")
			{
				$search = new Search($_GET["search_value"]);				
				$search->searchItem->displayItemData();
			}

		?>
		
	</div>
	
	</body>
	
</html>
