<div id="title">
	<img src="images/name.png">
	<strong> <?php echo $this->name ?>	</strong>
</div>

<div id="date">
	<span class="label"> <?php if ($this->country != "") echo $this->country . ", "; echo $this->birth . " - " . $this->death; ?> </span>
</div>

<div id="genres">
	<p><span class="label"><strong>Genres: </strong></span> <?php $this->printArrayValues($this->genres); ?></p>
</div>

<?php if ($this->headline_bio != "") :?>
	<div id="headlineBio">
		<p><span class="label"><strong>In a sentence: </strong></span> <?php echo $this->headline_bio; ?></p> 
	</div>
<?php endif;?>

<div id="themes">
	<p><span class="label"><strong>Feels like: </strong></span> <?php $this->printArrayValues($this->themes); ?></p>
</div>

<div id="musicBio">
	<span class="label"><strong>Biography: </strong></span>
	<div class="biography">
		<p>
			<?php echo $this->musicBio; ?>
		</p>
	</div>
	<div id="collapsibleLabel" onclick="showHiddenBiography()">more &raquo</div>
	<div id="collapsibleText"></div>
</div>

<div id="discography">
	<p>
		<span class="label"><strong>Discography: </strong></span>
		<div class="discographyList">
			<ol>
				<?php  $urlPreFix = "MetaTune.php?searchItems=Album&idSearch=id&search_value=";
					foreach ($this->albums as $album)
						if (isset($album->id) && isset($album->title) && $album->status == "main"): ?>
								<li>
									<img src="images/album.png" alt="album">
									<a href=<?php echo $urlPreFix . $album->id; ?>><?php echo $album->title; ?></a> - <?php echo $album->releaseDate; ?>
								</li>
						<?php endif; ?>
			</ol>
		</div>
	</p>
</div>