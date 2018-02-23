<?php
include "koneksi.php";
if(isset($_GET['id'])):
     if(isset($_POST['submit'])):
          $stmt = $mysqli->prepare("UPDATE konversi()");
          $stmt->bind_param('sssss', $nm, $tl, $ct, $st, $id);
 
          $nm = $_POST['nm'];
          $tl = $_POST['tl'];
          $ct = $_POST['ct'];
          $st = $_POST['st'];
          $id = $_POST['id'];
?>