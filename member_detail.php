<?php
  $login = $_COOKIE["login"];
  if ($login!="TRUE")
  {
    header("location:login.html");
    exit();
  }
  if(empty($_POST["check"]))
  {
			echo "<script type='text/javascript'>";
			echo "alert('請選擇會員');";
			echo "history.back()";
			echo "</script>";
			exit();
  }
  require_once("dbtools.inc.php");
  $link = create_connection();
  $m_id=$_POST["check"];
  setcookie("m_id",$m_id);
  $sql="SELECT * FROM 會員 WHERE id='$m_id'";
  $result=execute_sql($link,"nuk_rent_3",$sql);
  $row=mysqli_fetch_assoc($result);
  $m_email=$row{"email"};
  $m_name=$row{"name"};
  $m_level=$row{"level"};
  setcookie("m_name",$m_name);
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
					$id=$_COOKIE["id"];
					$email=$_COOKIE["email"];
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
	會員資料</br></br>
	<center>
	<table width="400" border="1">
		<tr><td>帳號</td><td><?php echo"$m_email";?></td></tr>
		<tr><td>ID</td><td><?php echo"$m_id";?></td></tr>
		<tr><td>名字</td><td><?php echo"$m_name";?></td></tr>
		<tr><td>權限</td><td><?php
					if($m_level==2)
					{echo "系統管理員";}
					else if($m_level==1)
					{echo "授權人";}
					else
					{echo "一般會員";}
					
				?></td></tr>
	</table>
	</center>
	</font></b></div>
	<div style="text-align:center;">
	<div class="box">
	<?if($level!=$m_level)
	{?>
		<a href="level.php" class="button"> 修改權限  </a>
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	<?}?>
		<a onclick="history.back()" class="button"> 返回 </a>
	</div>
</div>
</body>
</html>
<?php
    //釋放資源及關閉資料連接
	//mysqli_free_result($result);
	mysqli_close($link);
?>