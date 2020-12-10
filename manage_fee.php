<?php
  $login = $_COOKIE["login"];
  if ($login!="TRUE")
  {
    header("location:login.html");
    exit();
  }
  else
  {
    require_once("dbtools.inc.php");
    $link = create_connection();
	$deposit=$_POST["deposit"];
	$rent_no=$_COOKIE["rent_no"];
	$sql = "UPDATE 租借紀錄 SET deposit = '$deposit' WHERE rent_no = '$rent_no'";
	$result = execute_sql($link, "nuk_rent_3" , $sql);
?>
<?
	if($deposit==1)
	{
		$sql = "SELECT * FROM 租借紀錄 WHERE rent_no = '$rent_no'";
		$result = execute_sql($link, "nuk_rent_3" , $sql);
		$row=mysqli_fetch_assoc($result);
		$date=$row{"date"};
		if($row{"BBQ_time"}!=0)
		{
			$BBQt=$row{"BBQ_time"};
			$BBQn=$row{"BBQ_num"};
			$sql = "SELECT * FROM 烤肉台 WHERE date = '$date' AND time='$BBQt'";
			$result = execute_sql($link, "nuk_rent_3" , $sql);
			$rowB=mysqli_fetch_assoc($result);
			$BBQ_no=$rowB{"BBQ_no"};
			$rBBQ_no=substr($BBQ_no,0,$BBQn);
			$nBBQ_no=substr($BBQ_no,$BBQn,strlen($BBQ_no)-1);
			$sql = "UPDATE 租借紀錄 SET BBQ_no = '$rBBQ_no' WHERE rent_no = '$rent_no'";
			$result = execute_sql($link, "nuk_rent_3" , $sql);
			$sql = "UPDATE 烤肉台 set BBQ_no='$nBBQ_no' WHERE date = '$date' AND time='$BBQt'";
			$result = execute_sql($link, "nuk_rent_3" , $sql);
		}
		if($row{"camp_num"}!=0)
		{
			$campn=$row{"camp_num"};
			$sql = "SELECT * FROM 營位 WHERE date = '$date'";
			$result = execute_sql($link, "nuk_rent_3" , $sql);
			$rowC=mysqli_fetch_assoc($result);
			$camp_no=$rowC{"camp_no"};
			$rcamp_no=substr($camp_no,0,$campn);
			$ncamp_no=substr($camp_no,$campn,strlen($camp_no)-1);
			$sql = "UPDATE 租借紀錄 SET camp_no = '$rcamp_no' WHERE rent_no = '$rent_no'";
			$result = execute_sql($link, "nuk_rent_3" , $sql);
			$sql = "UPDATE 營位 set camp_no='$ncamp_no' WHERE date = '$date'";
			$result = execute_sql($link, "nuk_rent_3" , $sql);
		}
	}
	mysqli_close($link);
  }
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
	已更新資料
	</font></b></div>
	<div style="text-align:center;">
	<div class="box">
		<a href="manage_default.php" class="button"> 返回  </a>
	</div>
</div>
</body>
</html>