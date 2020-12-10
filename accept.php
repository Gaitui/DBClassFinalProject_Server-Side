<?php
  $login = $_COOKIE["login"];
  if ($login!="TRUE")
  {
    header("location:login.html");
    exit();
  }
  require_once("dbtools.inc.php");
  $link = create_connection();
  $accept=$_POST["accept"];
  if($accept=="2")
  {
	  if(empty($_POST["reason"]))
	  {
		  echo "<script type='text/javascript'>";
			echo "alert('拒絕申請需填原因');";
			echo "history.back()";
			echo "</script>";
			exit();
	  }
	  else
		  $reason=$_POST["reason"];
  }
  else
  $reason="";
  $rent_no=$_COOKIE["rent_no"];
  $id=$_COOKIE["id"];
  $sql="UPDATE 租借紀錄 SET accept='$accept',take_id='$id',reason='$reason' WHERE rent_no='$rent_no'";
  $result=execute_sql($link,"nuk_rent_3",$sql);
  if($accept=="1")
  {
	  $date=$_COOKIE["r_date"];
	  if(!empty($_COOKIE["rbt"]))
	  {
		  $rbt=$_COOKIE["rbt"];
		  $rbn=$_COOKIE["rbn"];
		  $sql="SELECT *FROM 烤肉台 WHERE date='$date' AND time='$rbt'";
		  $result=execute_sql($link,"nuk_rent_3",$sql);
		  $num=mysqli_num_rows($result);
		  if($num!="0")
		  {
			  $sql="UPDATE 烤肉台 SET BBQ_num='$rbn' WHERE date='$date' AND time='$rbt'";
			  $result=execute_sql($link,"nuk_rent_3",$sql);
		  }
		  else
		  {
			  $sql="INSERT INTO 烤肉台 (date,time,BBQ_num) VALUES ('$date','$rbt','$rbn')";
			  $result=execute_sql($link,"nuk_rent_3",$sql);
		  }
	  }
	  if(!empty($_COOKIE["rc"]))
	  {
		  $rc=$_COOKIE["rc"];
		  $sql="SELECT *FROM 營位 WHERE date='$date'";
		  $result=execute_sql($link,"nuk_rent_3",$sql);
		  $num=mysqli_num_rows($result);
		  if($num!="0")
		  {
			  $sql="UPDATE 營位 SET camp_num='$rc' WHERE date='$date'";
			  $result=execute_sql($link,"nuk_rent_3",$sql);
		  }
		  else
		  {
			  $sql="INSERT INTO 營位 (date,camp_num) VALUES ('$date','$rc')";
			  $result=execute_sql($link,"nuk_rent_3",$sql);
		  }
	  }
	  if(!empty($_COOKIE["rc"]))
	  {
		  $rc=$_COOKIE["rc"];
		  $sql="SELECT *FROM 營位 WHERE date='$date'";
		  $result=execute_sql($link,"nuk_rent_3",$sql);
		  $num=mysqli_num_rows($result);
		  if($num!="0")
		  {
			  $sql="UPDATE 營位 SET camp_num='$rc' WHERE date='$date'";
			  $result=execute_sql($link,"nuk_rent_3",$sql);
		  }
		  else
		  {
			  $sql="INSERT INTO 營位 (date,camp_num) VALUES ('$date','$rc')";
			  $result=execute_sql($link,"nuk_rent_3",$sql);
		  }
	  }
	  if(!empty($_COOKIE["rs"]))
	  {
		  $rs=$_COOKIE["rs"];
		  $sql="INSERT INTO 表演台 (date,time) VALUES ('$date','$rs')";
		  $result=execute_sql($link,"nuk_rent_3",$sql);
	  }
  }
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
	已完成審核</br></br>
	</font></b></div>
	<div style="text-align:center;">
	<div class="box">
		<a href="manage.php" class="button"> 返回  </a>
	</div>
</div>
</body>
</html>