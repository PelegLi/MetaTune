<div id="title">
	<strong> <?php echo $this->title ?>	</strong>
</div>

<div id="genres">
	<span class="genresLabel"><strong>Genres: </strong></span> <?php $this->printArrayValues($this->genres); ?>
</div>

<?php $this->removeDuplicateAlbums($this->albums); ?>

<div id="discography">
	<span class="discographyLabel"><strong>Appears in <?php echo $this->views ?> album<?php if ($this->views > 1) echo "s"; ?>:</strong></span>
	<div class="discographyList">
		<?php $this->displayAlbums(); ?>
	</div>
</div>

