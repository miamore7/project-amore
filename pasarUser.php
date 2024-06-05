<?php
// session_start(); // Memulai sesi di awal skrip

// Memeriksa apakah pengguna sudah login
if (isset($_SESSION['email'])) {
  // Jika pengguna belum login, arahkan ke halaman login
  header("Location: login.php");
  exit(); // Menghentikan eksekusi skrip lebih lanjut
}

include('sidebar.php');
?>
<link rel="stylesheet" href="css/dashboardM.css">
<div class="top-courses">
  <div class="course-grid">
    <div class="course-item">
      <img src="img/ui.jpeg" alt="Learn Figma: UI/UX Design Essential Training">
      <h3>Learn Figma: UI/UX Design Essential Training</h3>
      <a href="barangUser.php?jenis_course=Learn+Figma%3A+UI%2FUX+Design+Essential+Training"><button>Lihat Pasar</button></a>
      <a href="userJual.php?jenis_course=Learn+Figma%3A+UI%2FUX+Design+Essential+Training"><button> Jual</button></a>
      <!-- <a href="tambah_barang.php?jenis_course=Learn+Figma%3A+UI%2FUX+Design+Essential+Training"><button>Tambah Barang</button></a> -->
    </div>
    <div class="course-item">
      <img src="img/Code.jpeg" alt="Python For Beginners - Learn Programming">
      <h3>Python For Beginners - Learn Programming</h3>
      <a href="barangUser.php?jenis_course=Python+For+Beginners+-+Learn+Programming"><button>Lihat Pasar</button></a>
      <a href="userJual.php?jenis_course=Python+For+Beginners+-+Learn+Programming"><button>Jual</button></a>
      <!-- <a href="tambah_barang.php?jenis_course=Python+For+Beginners+-+Learn+Programming"><button>Tambah Barang</button></a> -->
    </div>
    <div class="course-item">
      <img src="img/Gitar.jpeg" alt="Acoustic Guitar And Electric Guitar Started">
      <h3>Acoustic Guitar And Electric Guitar Started</h3>
      <a href="barangUser.php?jenis_course=Acoustic+Guitar+And+Electric+Guitar+Started"><button>Lihat Pasar</button></a>
      <a href="userJual.php?jenis_course=Acoustic+Guitar+And+Electric+Guitar+Started"><button>Jual</button></a>
      <!-- <a href="tambah_barang.php?jenis_course=Acoustic+Guitar+And+Electric+Guitar+Started"><button>Tambah Barang</button></a> -->
    </div>
  </div>
  <a href="viewStatusBarang.php"><button>View Status Barang</button></a>
    <style>
      /* CSS untuk tautan */
/* CSS untuk tombol */
button {
  background-color: #4CAF50; /* Warna latar belakang */
  color: white; /* Warna teks */
  padding: 10px 20px; /* Padding */
  border: none; /* Menghilangkan border */
  border-radius: 5px; /* Border radius */
  cursor: pointer; /* Pointer saat dihover */
  text-decoration: none; /* Menghilangkan underline */
  font-size: 16px; /* Ukuran font */
}

/* CSS untuk link */
a {
  text-decoration: none; /* Menghilangkan underline */
}

/* CSS untuk hover */
button:hover {
  background-color: #45a049; /* Warna latar belakang saat dihover */
}

    </style>
</a>

</div>
