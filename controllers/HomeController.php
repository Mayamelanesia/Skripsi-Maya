<?php
class HomeController
{
     public function index()
     {
          require_once 'views/home/index.php';
     }

     public function profil()
     {
          require_once 'views/home/profil.php';
     }

     public function panduan()
     {
          require_once 'views/home/panduan.php';
     }

     public function kontak()
     {
          require_once 'views/home/kontak.php';
     }
}