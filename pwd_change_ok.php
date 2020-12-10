<?php
  $login = $_COOKIE["login"];
  if ($login!="TRUE")
  {
    header("location:login.html");
    exit();
  }
  require_once("dbtools.inc.php");
  $link = create_connection();
  $id=$_COOKIE["id"];
  $sql="SELECT * FROM 會員 WHERE id='$id'";
  $result=execute_sql($link,"nuk_rent_3",$sql);
  $row=mysqli_fetch_assoc($result);
  if($row{"pwd"}!=$_POST["opassword"])
  {
	echo "<script type='text/javascript'>";
	echo "alert('原密碼輸入錯誤');";
	echo "history.back()";
	echo "</script>";
	exit();
  }
  if(empty($_POST["npassword"]))
  {
	echo "<script type='text/javascript'>";
	echo "alert('新密碼不可為空白');";
	echo "history.back()";
	echo "</script>";
	exit();
  }
  $npwd=$_POST["npassword"];
  $sql="UPDATE 會員 SET pwd='$npwd' WHERE id='$id'";
  $result=execute_sql($link,"nuk_rent_3",$sql);
  mysqli_close($link);
 ?>
<!DOCTYPE html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>高雄大學BBQ系統</title>
<meta name="keywords" content="" />
<meta name="description" content="" />
<link href="http://fonts.googleapis.com/css?family=Source+Sans+Pro:200,300,400,600,700,900" rel="stylesheet" />
<link href="default.css" rel="stylesheet" type="text/css" media="all" />
<link href="fonts.css" rel="stylesheet" type="text/css" media="all" />
</head>
<body>
<div id="header-wrapper">
	<div id="header" class="container">
		<div id="logo">
			<h1><a href="default.php">高雄大學BBQ系統</a></h1>
		</div>
		<div id="menu">
			<ul>
				<li><h2>Hi,
				<?php 
					$name = $_COOKIE["name"];
					$level = $_COOKIE["level"];
					echo "$name";
				?>
				&nbsp;
				<?php
					$level = $_COOKIE["level"];
					if($level==2)
					{echo "系統管理員";}
					else if($level==1)
					{echo "授權人";}
					else
					{echo "會員";}
					
				?>
				&nbsp;&nbsp;
				</h2></li>
				<li class="current_page_item"><a href="default.php">首頁</a></li>
				<li class="current_page_item"><a href="logout.php">登出</a></li>
			</ul>
		</div>
	</div>
</div>
<div id="portfolio" class="container">
	
	<div style="text-align:center;"><b><font size="5" color="white">
	已更新密碼</br></br>
	</font></b></div>
	<div style="text-align:center;">
	<div class="box">
		<a href="default.php" class="button"> 返回  </a>
	</div>
</div>
</body>
</html>