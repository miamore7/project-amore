<?php
include('sidebar.php');
?>
<link rel="stylesheet" href="preview.css">
<div class="video-player">
  <video width="640" height="360" controls>
    <source src="video/Deadpool & Wolverine _ Trailer.mp4" type="video/mp4">
    <source src="movie.ogg" type="video/ogg">
    Your browser does not support the video tag.
  </video>
  <div class="controls">
    <button class="volume-up">Volume Naik</button>
    <input type="range" class="volume-slider" min="0" max="1" step="0.01" value="0.5">
    <button class="volume-down">Volume Turun</button>
  </div>
</div>
