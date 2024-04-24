<?php
require('video.php');

// Membuat objek dari kelas Video
$videoObj = new Video();

// Mengambil data video dari database
$videos = $videoObj->getVideoData();
?>

<?php include('sidebar.php'); ?>
<link rel="stylesheet" href="course.css">
<div class="top-courses">
  <h2>TOP COURSES</h2>
  <div class="course-grid">
    <?php foreach($videos as $key => $video): ?>
    <div class="course-item">
      <img src="img/<?php echo $video['image']; ?>" alt="<?php echo $video['title']; ?>">
      <h3><?php echo $video['title']; ?></h3>
      <button>Start Course</button>
      <a href="preview.php?video_id=<?php echo $key; ?>"><button>Preview</button></a>
    </div>
    <?php endforeach; ?>
  </div>
</div>
