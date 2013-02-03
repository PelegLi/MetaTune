<div id="title">
	<img src="images/album.png">
	<strong> <?php echo $this->title ?>	</strong>
</div>

<div id="artists">
	<div class="discographyList">
		<ul>
			<?php  $urlPreFix = "allmusicapi.php?searchItems=Name&idSearch=id&search_value=";
				foreach ($this->artists as $artist)
					if (isset($artist->id) && isset($artist->name)): ?>
						<li>
							<img src="images/name.png">
							<a href=<?php echo $urlPreFix . $artist->id; ?>><?php echo $artist->name; ?></a>
						</li>
			  		<?php endif; ?>
		</ul>
	</div>
</div>
		
<div id="date">
	<span class="label"><strong>Release date: </strong> <?php echo $this->releaseDate; ?> </span>
</div>

<div id="genres">
	<span class="label"><strong>Genres: </strong></span> <?php $this->printArrayValues($this->genres); ?>
</div>

<?php if ($this->headlineReview != "") :?>
	<div id="headlineReview">
		<span class="label"><strong>In a sentence: </strong> <?php echo $this->headlineReview; ?> </span>
	</div>
<?php endif;?>

<div id="discography">
	<span class="label"><strong>Track list: </strong></span>
	<div class="discographyList">
		<ol>
			<?php  $urlPreFix = "allmusicapi.php?searchItems=Track&idSearch=id&search_value=";
				foreach ($this->tracks as $track)
					if (isset($track->id) && isset($track->title)): ?>
						<li>
							<img src="images/track.png">
							<a href=<?php echo $urlPreFix . $track->id; ?>><?php echo $track->title; ?></a>
						</li>
			  		<?php endif; ?>
		</ol>
	</div>
</div>
