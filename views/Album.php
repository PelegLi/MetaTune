<div id="title">
	<strong> <?php echo $this->title ?>	</strong>
</div>

<div id="artists">
	<span class="artistsLabel"><strong>By: </strong></span> <?php $this->displayArtists(); ?>
</div>

<div id="genres">
	<span class="genresLabel"><strong>Genres: </strong></span> <?php $this->printArrayValues($this->genres); ?>
</div>

<div id="date">
	<span class="releaseDateLabel"><strong>Release date: </strong> <?php echo $this->releaseDate; ?> </span>
</div>

<div id="discography">
	<span class="discographyLabel"><strong>Discography:</strong></span>
	<div class="discographyList">
		<?php $this->displayTracks(); ?>
	</div>
</div>
