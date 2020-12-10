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
<div class="container">
	<div style="text-align:center;"><b><font size="5" color="white"></br>核准租借</br></br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;申請編號&nbsp;&nbsp;
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;租借日期&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;申請狀態
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</font></b></div>
	<form method="POST" action="accept_detail.php">
			<div style="text-align:center;">
				<select style="width:400px;height:300px;font-size:18px;" name="check" size="20"><font size="5">
				<?php
					$sql = "SELECT * FROM 租借紀錄 where accept='0' OR accept='3' ORDER BY DATE";
					$result = execute_sql($link, "nuk_rent_3", $sql);
					$row = mysqli_fetch_assoc($result);
					$num = mysqli_num_rows($result);
					for($i=0;$i<$num;$i++)
					{
						$y=$row{"rent_no"};
						$accept=$row{"accept"};
						echo"<option value='$y'>"."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".str_replace(" ","&nbsp;",str_pad($row{"rent_no"} , 20-strlen($row{"rent_no"}))).
						str_replace(" ","&nbsp;",str_pad( $row{"date"} , 33-strlen($row{"date"})));
						if($row{"accept"}==0)
							echo"&nbsp;新申請";
						else
							echo"申請修改";
						echo"</option>";
						$result++;
						$row = mysqli_fetch_assoc($result);
					} 
				?>
				</font>
				</select>
				</br>
				<div class="box">
				<input type="submit" class="button" value="詳細資料" >
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<a href="manage.php" class="button">  反回  </a>
				</br></br>
				</div>
			</div>
	</form>
</div>
</body>
</html>
<?php
    //釋放資源及關閉資料連接
	//mysqli_free_result($result);
	mysqli_close($link);
?>