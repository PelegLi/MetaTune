<div id="title">
	<strong> <?php echo $this->title ?>	</strong>
</div>

<div id="artists">
	<span class="label"><strong>By: </strong></span> <?php $this->displayArtists(); ?>
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
	<span class="label"><strong>Discography: </strong></span>
	<div class="discographyList">
		<ul>
			<?php  $urlPreFix = "allmusicapi.php?searchItems=Track&idSearch=id&search_value=";
				foreach ($this->tracks as $track)
					if (isset($track->id) && isset($track->title)): ?>
						<li><a href=<?php echo $urlPreFix . $track->id; ?>><?php echo $track->title; ?></a></li>
			  		<?php endif; ?>
		</ul>
	</div>
</div>
