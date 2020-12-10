<?php
  //清除 cookie 內容
  setcookie("email","");
  setcookie("name", "");
  setcookie("login", "FALSE");	
	
  //將使用者導回主網頁
  header("location:login.html");
  exit();
?>