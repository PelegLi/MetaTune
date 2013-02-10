	<?php 

	require_once "Search.php";
	require_once "HelpFunctions.php";
	
?>

<!DOCTYPE html>
<html>

	<head>
		
		<meta charset="utf-8">
		<link rel="shortcut icon" href="images/album.png" />
		<link rel="Stylesheet" href="style/MetaTune.css"/>
		<script src="scripts/MetaTune.js"></script>
		<script src="http://code.jquery.com/jquery-latest.js"></script>
		<title>MetaTune<?php setPageTitle(); ?></title>
				
	</head>
	
	<body>
			
		<div id="container">
			
			<div id="banner">
			
				<div>
					
					<a href="MetaTune.php"><img id="bannerLogo" src="images/metatune.png" alt="metatune"/></a>
			
				</div>
				
				<div id="searchSection">
		
					<form method="get">
						
						<fieldset id="searchItems">						
							<input type="radio" name="searchItems" value="Name" id="Name" title="Name" checked />
							<label for="Name"><img id="NameImage" alt="Name" src="images/name.png" onclick=chooseSearchItem(this.id);></label>
							<input type="radio" name="searchItems" value="Track" id="Track" title="Track" <?php if (isChecked("Track")) echo "checked"; ?> />
							<label for="Track"><img id="TrackImage" alt="Track" src="images/track.png" onclick=chooseSearchItem(this.id);></label>
							<input type="radio" name="searchItems" value="Album" id="Album" title="Album" <?php if (isChecked("Album")) echo "checked"; ?> />
							<label for="Album"><img id="AlbumImage" alt="Album" src="images/album.png" onclick=chooseSearchItem(this.id);></label>
						</fieldset>
					
						<div id="searchBox" >
							<input id="search" type="text" name="search_value"/>
							<input id="submit" type="submit" value="Search"/>				
						</div>					
				
					</form>
				
				</div>
				
			</div>
				
			<div id="content">
			
				<?php 
				
					if (isset($_GET["search_value"]) && ($_GET["search_value"]) != "")
					{
						$idSearch = isset($_GET["idSearch"]) ? "id" : "";
						$search = new Search($_GET["search_value"], $idSearch);	
						$search->searchItem->loadView($search->response);
					}	

					else					
						require "views/Welcome.php";
					
					/* TODO:
					 * 
					 * Sanitize user search input.
					 * Organize front end by headers.
					 * Add track numbers to tracks.
					 * Add anchors for each view.
					 * Remove broken links from biography.
					 * Add music styles to artists' biography.
					 *
					 */
	
				?>
				
			</div>
			
			<div id="footer">
			
				<span id="footerContent"><a href="MetaTune.php">Meta Tune &nbsp&nbsp&nbsp 2013</a></span>
				
			</div>
			
		</div>
		
	</body>
	
</html>
