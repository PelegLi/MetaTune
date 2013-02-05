<div id="title">
	<img src="images/track.png">
	<strong> <?php echo $this->title ?>	</strong>
</div>

<div id="genres">
	<span class="label"><strong>Genres: </strong></span> <?php $this->printArrayValues($this->genres); ?>
</div>

<?php $this->removeDuplicateAlbums($this->albums); ?>

<div id="discography">
	<span class="label"><strong>Appears in <?php echo $this->views ?> album<?php if ($this->views > 1) echo "s"; ?>:</strong></span>
	<div class="discographyList">
		<ol>
			<?php  $urlPreFix = "MetaTune.php?searchItems=Album&idSearch=id&search_value=";
				foreach ($this->albums as $album)
					if (isset($album->id) && isset($album->title)): ?>
							<li>
								<img src="images/album.png">
								<a href=<?php echo $urlPreFix . $album->id; ?>><?php echo $album->title; ?></a> - <?php echo $album->releaseDate; ?>
							</li>
				  	<?php endif; ?>
		</ol>
	</div>
</div>

