<?php
// Array berisi informasi tentang gambar dan judul video
$videosData = array(
    array("image" => "img/ui.jpeg", "title" => "Learn Figma: UI/UX Design Essential Training"),
    array("image" => "img/Code.jpeg", "title" => "Python For Beginners - Learn Programming"),
    array("image" => "img/Gitar.jpeg", "title" => "Acoustic Guitar And Electric Guitar Started")
);
?>

<?php include('sidebar.php'); ?>
<link rel="stylesheet" href="course.css">
<div class="top-courses">
  <h2>TOP COURSES</h2>
  <div class="course-grid">
    <?php foreach($videosData as $key => $video): ?>
    <div class="course-item">
      <img src="<?php echo $video['image']; ?>" alt="<?php echo $video['title']; ?>">
      <h3><?php echo $video['title']; ?></h3>
      <button>Start Course</button>
      <a href="preview.php?video_id=<?php echo $key; ?>"><button>Preview</button></a>
    </div>
    <?php endforeach; ?>
  </div>
</div>
