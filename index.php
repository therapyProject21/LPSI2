<?php
session_start();

// Periksa apakah pengguna sudah login
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php'); // Redirect ke halaman login jika belum login
    exit;
}

require 'transfer.php'; // Pastikan file koneksi.php sudah ada

// Ambil data peserta dari database
$user_id = $_SESSION['user_id'];
$stmt = $pdo->prepare("SELECT Nama, ID, alamat FROM pengguna WHERE ID = ?");
$stmt->execute([$user_id]);
$peserta = $stmt->fetch();

// Tampilkan informasi peserta
$nama_peserta = $peserta['Nama'];
$id_peserta = $peserta['ID'];
$alamat_peserta = $peserta['alamat'];

?>

<html lang="en">
 <head>
  <meta charset="utf-8"/>
  <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
  <title>
   LPSI - Beranda
  </title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
  <style>
   .sidebar {
            transition: transform 0.3s ease-in-out;
        }
        .sidebar-closed {
            transform: translateX(-100%);
        }
        .sidebar-open {
            transform: translateX(0);
        }
        /* Custom scrollbar styles */
        ::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }
        ::-webkit-scrollbar-thumb {
            background-color: rgba(107, 114, 128, 0.5); /* Tailwind's gray-600 with transparency */
            border-radius: 4px;
        }
        ::-webkit-scrollbar-track {
            background: transparent;
        }
  </style>
 </head>
 <body class="bg-gray-100">
  <!-- Splash Screen -->
  <div id="splash-screen" class="fixed inset-0 bg-white flex items-center justify-center z-50">
   <img alt="Company logo with a 16:9 aspect ratio" class="h-12 w-auto" height="50" src="https://storage.googleapis.com/a1aa/image/teWVpuWI9kVTW6dOzHie2QXZYrOze7lz9pSukGFAlfM9E4DQB.jpg" width="100"/>
  </div>
  <header class="bg-white shadow-md w-full z-50 fixed top-0 hidden" id="main-header">
   <div class="container mx-auto px-4 py-2 flex justify-between items-center">
    <!-- Sidebar Menu Icon -->
    <div class="flex items-center">
     <button class="text-gray-600 focus:outline-none focus:text-gray-900" id="menu-button">
      <i class="fas fa-bars fa-2x"></i>
     </button>
    </div>
    <!-- Logo -->
    <div class="flex items-center">
     <img alt="Company logo with a 16:9 aspect ratio" class="h-12 w-auto" height="50" src="https://storage.googleapis.com/a1aa/image/teWVpuWI9kVTW6dOzHie2QXZYrOze7lz9pSukGFAlfM9E4DQB.jpg" width="100"/>
    </div>
   </div>
  </header>
  <!-- Sidebar -->
  <div class="fixed inset-0 bg-gray-800 bg-opacity-50 z-40 hidden" id="overlay"></div>
  <div class="fixed inset-y-0 left-0 w-64 bg-white shadow-md z-50 sidebar sidebar-closed" id="sidebar">
   <div class="p-4 flex flex-col justify-between h-full">
    <div class="border-b-2 border-black pb-2 mb-4">
     <h2 class="text-xl font-semibold text-gray-800">Menu</h2>
    </div>
    <ul>
     <li class="mb-4">
      <a class="text-gray-700 hover:text-gray-900" href="#" onclick="navigateTo('index')">Beranda</a>
     </li>
     <li class="mb-4">
      <a class="text-gray-700 hover:text-gray-900" href="#" onclick="navigateTo('informasi-pelatihan')">Informasi Pelatihan</a>
     </li>
     <li class="mb-4">
      <a class="text-gray-700 hover:text-gray-900" href="#" onclick="navigateTo('edukasi-terbaru')"> Edukasi Terbaru</a>
     </li>
     <li class="mb-4">
      <a class="text-gray-700 hover:text-gray-900" href="#" onclick="navigateTo('tentang-lpsi')">Tentang LPSI</a>
     </li>
    </ul>
    <div class="flex items-center justify-between mt-4">
     <span class="text-gray-700">Nama User</span>
     <button class="text-gray-600 focus:outline-none focus:text-gray-900">
      <i class="fas fa-sign-out-alt fa-2x"></i>
     </button>
    </div>
   </div>
  </div>
  <!-- Main Content -->
  <div class="container mx-auto px-1 py-2 mt-20 hidden" id="content">
   <!-- Default Content (Index) -->
   <div id="index" class="content-page">
    <div class="bg-white shadow-md rounded-lg mx-auto p-4 flex items-center" style="max-width: 600px;">
     <!-- Image Box -->
     <div class="flex-shrink-0">
      <img alt="Participant's profile picture with a 1:1 aspect ratio" class="h-36 w-36 rounded" height="150" src="https://storage.googleapis.com/a1aa/image/wJLjkZxQ5e0rbSMNOkFoCyyGnTuTycdV5Nd7dYTXtP6lAfAUA.jpg" width="150"/>
     </div>
     <!-- informasi peserta -->
     <div class="ml-2">
      <h2 class="text-xl font-semibold text-gray-800" id="nama-peserta"><?php echo $nama_peserta; ?></h2>
      <p class="text-gray-600" id="id-peserta">ID Peserta: <?php echo $id_peserta; ?></p>
      <p class="text-gray-600" id="alamat-peserta">Alamat Peserta: <?php echo $alamat_peserta; ?></p>
     </div>
    </div>
    <!-- Recommendations Section -->
    <div class="mt-4">
     <h3 class="text-lg font-semibold text-gray-800">Rekomendasi</h3>
     <div class="flex overflow-x-scroll space-x-4 mt-2">
      <!-- Recommendation Item 1 -->
      <a class="flex-shrink-0 w-40 bg-white shadow-md rounded-lg p-2 relative" href="#">
       <img alt="Recommendation image 1" class="h-24 w-full rounded" height="150" src="https://storage.googleapis.com/a1aa/image/76FKIOfazt07OqolBfv60ocps3yjplrr0Hr1SUPguS9UBeBoA.jpg" width="150"/>
       <p class="text-gray-700 mt-2">Informasi 1</p>
      </a>
      <!-- Recommendation Item 2 -->
      <a class="flex-shrink-0 w-40 bg-white shadow-md rounded-lg p-2 relative" href="#">
       <img alt="Recommendation image 2" class="h-24 w-full rounded" height="150" src="https://storage.googleapis.com/a1aa/image/NXj2zfeFqRhiEUfLlKVxVyEzOO0RycAg2Nr4anCZPX2OC8BoA.jpg" width="150"/>
       <p class="text-gray-700 mt-2">Informasi 2</p>
      </a>
      <!-- Recommendation Item 3 -->
      <a class="flex-shrink-0 w-40 bg-white shadow-md rounded-lg p-2 relative" href="#">
       <img alt="Recommendation image 3" class="h-24 w-full rounded" height="150" src="https://storage.googleapis.com/a1aa/image/EwVsmpcT8mbmFxMc2nEC5Gx7ZzvfOu0Z5t4DZH0NVPlmAfAUA.jpg" width="150"/>
       <p class="text-gray-700 mt-2">Informasi 3</p>
      </a>
      <!-- Recommendation Item 4 -->
      <a class="flex-shrink-0 w-40 bg-white shadow-md rounded-lg p-2 relative" href="#">
       <img alt="Recommendation image 4" class="h-24 w-full rounded" height="150" src="https://storage.googleapis.com/a1aa/image/xeR2qMF6Aej0W0M0yPIo7UzligqiaUF8TWm1UXfTfL0AF4DQB.jpg" width="150
       <p class="text-gray-700 mt-2">Informasi 4</p>
      </a>
      <!-- Recommendation Item 5 -->
      <a class="flex-shrink-0 w-40 bg-white shadow-md rounded-lg p-2 relative" href="#">
       <img alt="Recommendation image 5" class="h-24 w-full rounded" height="150" src="https://storage.googleapis.com/a1aa/image/dL1hhY7OOi7mH5kh79OaUD40qG1GVmkkRBB1FWlRfATpAfAUA.jpg" width="150"/>
       <p class="text-gray-700 mt-2">Informasi 5</p>
      </a>
      <!-- Recommendation Item 6 -->
      <a class="flex-shrink-0 w-40 bg-white shadow-md rounded-lg p-2 relative" href="#">
       <img alt="Recommendation image 6" class="h-24 w-full rounded" height="150" src="https://storage.googleapis.com/a1aa/image/0iwhqvfUbfvLIkuCh8E3KL4g0geUJqg9gBekuntwYQzlE4DQB.jpg" width="150"/>
       <p class="text-gray-700 mt-2">Informasi 6</p>
      </a>
     </div>
    </div>
    <!-- Documentation Section -->
    <div class="mt-4">
     <h3 class="text-lg font-semibold text-gray-800">Dokumentasi</h3>
     <div class="grid grid-cols-2 gap-4 mt-2">
      <!-- Documentation Item 1 -->
      <div class="bg-white shadow-md rounded-lg p-2">
       <img alt="Documentation image 1" class="h-24 w-full rounded" height="150" src="https://storage.googleapis.com/a1aa/image/1.jpg" width="150"/>
       <p class="text-gray-700 mt-2">Dokumentasi 1</p>
      </div>
      <!-- Documentation Item 2 -->
      <div class="bg-white shadow-md rounded-lg p-2">
       <img alt="Documentation image 2" class="h-24 w-full rounded" height="150" src="https://storage.googleapis.com/a1aa/image/2.jpg" width="150"/>
       <p class="text-gray-700 mt-2">Dokumentasi 2</p>
      </div>
      <!-- Documentation Item 3 -->
      <div class="bg-white shadow-md rounded-lg p-2">
       <img alt="Documentation image 3" class="h-24 w-full rounded" height="150" src="https://storage.googleapis.com/a1aa/image/3.jpg" width="150"/>
       <p class="text-gray-700 mt-2">Dokumentasi 3</p>
      </div>
      <!-- Documentation Item 4 -->
      <div class="bg-white shadow-md rounded-lg p-2">
       <img alt="Documentation image 4" class="h-24 w-full rounded" height="150" src="https://storage.googleapis.com/a1aa/image/4.jpg" width="150"/>
       <p class="text-gray-700 mt-2">Dokumentasi 4</p>
      </div>
      <!-- Documentation Item 5 -->
      <div class="bg-white shadow-md rounded-lg p-2">
       <img alt="Documentation image 5" class="h-24 w-full rounded" height="150" src="https://storage.googleapis.com/a1aa/image/5.jpg" width="150"/>
       <p class="text-gray-700 mt-2">Dokumentasi 5</p>
      </div>
      <!-- Documentation Item 6 -->
      <div class="bg-white shadow-md rounded-lg p-2">
       <img alt="Documentation image 6" class="h-24 w-full rounded" height="150" src="https://storage.googleapis.com/a1aa/image/6.jpg" width="150"/>
       <p class="text-gray-700 mt-2">Dokumentasi 6</p>
      </div>
     </div>
    </div>
   </div>
   <!-- Informasi Pelatihan Page -->
   <div id="informasi-pelatihan" class="content-page hidden">
    <h2 class="text-2xl font-semibold text-gray-800">Informasi Pelatihan</h2>
    <p class="text-gray-600 mt-4">Ini adalah halaman Informasi Pelatihan.</p>
   </div>
   <!-- Edukasi Terbaru Page -->
   <div id="edukasi-terbaru" class
   class="content-page hidden">
    <h2 class="text-2xl font-semibold text-gray-800">Edukasi Terbaru</h2>
    <p class="text-gray-600 mt-4">Ini adalah halaman Edukasi Terbaru.</p>
   </div>
   <!-- Tentang LPSI Page -->
   <div id="tentang-lpsi" class="content-page hidden">
    <h2 class="text-2xl font-semibold text-gray-800">Tentang LPSI</h2>
    <p class="text-gray-600 mt-4">Ini adalah halaman Tentang LPSI.</p>
   </div>
  </div>
  <!-- Footer -->
  <footer class="bg-white shadow-md mt-4 py-4 hidden" id="main-footer">
   <div class="container mx-auto text-center">
    <p class="text-gray-700">Lembaga Pengembangan Sujok Indonesia</p>
    <p class="text-gray-500 text-sm">copyright: Tim GMI</p>
   </div>
  </footer>
  <script>
   const menuButton = document.getElementById('menu-button');
   const sidebar = document.getElementById('sidebar');
   const overlay = document.getElementById('overlay');
   const splashScreen = document.getElementById('splash-screen');
   const mainHeader = document.getElementById('main-header');
   const mainContent = document.getElementById('content');
   const mainFooter = document.getElementById('main-footer');

   menuButton.addEventListener('click', () => {
       sidebar.classList.toggle('sidebar-open');
       sidebar.classList.toggle('sidebar-closed');
       overlay.classList.toggle('hidden');
   });

   overlay.addEventListener('click', () => {
       sidebar.classList.add('sidebar-closed');
       sidebar.classList.remove('sidebar-open');
       overlay.classList.add('hidden');
   });

   function navigateTo(pageId) {
       const pages = document.querySelectorAll('.content-page');
       pages.forEach(page => {
           page.classList.add('hidden');
       });
       document.getElementById(pageId).classList.remove('hidden');
       sidebar.classList.add('sidebar-closed');
       sidebar.classList.remove('sidebar-open');
       overlay.classList.add('hidden');
   }

   // menampilkan splashscreen 5 detik
   setTimeout(() => {
       splashScreen.classList.add('hidden');
       mainHeader.classList.remove('hidden');
       mainContent.classList.remove('hidden');
       mainFooter.classList.remove('hidden');
   }, 5000);
   
   //menampilkan informasi peserta
   document.addEventListener('DOMContentLoaded', function() {
       fetch('transfe.php')
           .then(response => response.json())
           .then(data => {
               if (data.error) {
                   console.error(data.error);
               } else {
                   document.getElementById('nama-peserta').textContent = data.nama;
                   document.getElementById('id-peserta').textContent = `ID Peserta: ${data.id_peserta}`;
                   document.getElementById('alamat-peserta').textContent = `Alamat Peserta: ${data.alamat}`;
               }
           })
           .catch(error => console.error('Error fetching peserta info:', error));
   });
  </script>
 </body>
</html>