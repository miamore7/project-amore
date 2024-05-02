<?php
require('video.php');

// Membuat objek dari kelas Video
$videoObj = new Video();

// Memeriksa apakah parameter video_id telah diterima dari URL
if (isset($_GET['video_id'])) {
    $videoId = $_GET['video_id'];

    // Mengambil data video berdasarkan urutan yang diberikan
    $videos = $videoObj->getVideoData();

    // Memeriksa apakah urutan video sesuai dengan parameter video_id
    if (isset($videos[$videoId])) {
        $embedLink = $videos[$videoId]['embed_link'];
    } else {
        // Jika urutan video tidak valid, tampilkan pesan error
        echo "Invalid video ID!";
        exit();
    }
} else {
    // Jika parameter video_id tidak diterima, tampilkan pesan error
    echo "Video ID not provided!";
    exit();
}
?>
<?php include('sidebar.php'); ?>
<link rel="stylesheet" href="preview.css">
<div class="video-player">
    <iframe width="720" height="480" src="<?php echo $embedLink; ?>" frameborder="0" allowfullscreen></iframe>
</div>