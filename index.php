<?php

require_once 'fbConfig.php';
require_once 'User.php';
   if (isset($_SESSION['userData']) && !empty($_SESSION['userData']))
   {
     Include 'dashboard.php';
   }
   else {
     include 'home.html';
   }
 ?>
