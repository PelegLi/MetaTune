<div id="title">
	<strong> <?php echo $this->name ?>	</strong>
</div>

<div id="genres">
	<span class="genresLabel"><strong>Genres: </strong></span> <?php $this->printArrayValues($this->genres); ?>
</div>

<div id="date">
	<span> <?php echo $this->birth . " - " . $this->death; ?> </span>
</div>

<?php if ($this->headline_bio != "") :?>
	<div id="headlineBio">
		<span class="headlineBioLabel"><strong>In a sentence: </strong></span> <?php echo $this->headline_bio; ?> 
	</div>
<?php endif;?>

<div id="discography">
	<span class="discographyLabel"><strong>Discography:</strong></span>
	<div class="discographyList">
		<?php $this->displayAlbums(); ?>
	</div>
</div>


