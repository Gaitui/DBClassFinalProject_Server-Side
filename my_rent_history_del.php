<?php
  $login = $_COOKIE["login"];
  if ($login!="TRUE")
  {
    header("location:login.html");
    exit();
  }
  require_once("dbtools.inc.php");
  $link = create_connection();
  $rent_no=$_COOKIE["rent_no"];
  $sql = "SELECT * FROM 租借紀錄 where rent_no = '$rent_no'";
  $result = execute_sql($link, "nuk_rent_3", $sql);
  $row = mysqli_fetch_assoc($result);
  if($row{"accept"}=="1")
  {
	$rdate=$row{"date"};
	if($row{"BBQ_time"}!=0)
	{
		$rBBQt=$row{"BBQ_time"};
		$sql="SELECT * FROM 烤肉台 WHERE date='$rdate' AND time='$rBBQt'";
		$result=execute_sql($link,"nuk_rent_3",$sql);
		$rrow=mysqli_fetch_assoc($result);
		$rBBQn=$rrow{"BBQ_num"}+$row{"BBQ_num"};
		$sql="UPDATE 烤肉台 set BBQ_num='$rBBQn' WHERE date='$rdate' AND time='$rBBQt'";
		$result=execute_sql($link,"nuk_rent_3",$sql);
	}
	if($row{"camp_num"}!=0)
	{
		$sql="SELECT * FROM 營位 WHERE date='$rdate'";
		$result=execute_sql($link,"nuk_rent_3",$sql);
		$rrow=mysqli_fetch_assoc($result);
		$rcampn=$row{"camp_num"}+$rrow{"camp_num"};
		$sql="UPDATE 營位 set camp_num='$rcampn' WHERE date='$rdate'";
		$result=execute_sql($link,"nuk_rent_3",$sql);
	}
	if($row{"stage_time"}!=0)
	{
		$rst=$row{"stage_time"};
		$sql="DELETE FROM 表演台 WHERE date='$rdate' AND time='$rst'";
		$result=execute_sql($link,"nuk_rent_3",$sql);
	}
  }
  $sql="DELETE FROM 租借紀錄 WHERE rent_no='$rent_no'";
  $result = execute_sql($link, "nuk_rent_3" , $sql);
  $sql="DELETE FROM 租借人 WHERE rent_no='$rent_no'";
  $result = execute_sql($link, "nuk_rent_3" , $sql);
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
	已刪除申請單</br></br>
	</font></b></div>
	<div style="text-align:center;">
	<div class="box">
		<a href="my_rent_history.php" class="button"> 返回  </a>
	</div>
</div>
</body>
</html>