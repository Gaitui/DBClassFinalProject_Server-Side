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
	<form method="POST" action="member.php">
		<div style="text-align:center;"><b><font size="5" color="white">
			</br>會員管理</br></b></font>
				<select style="width:150px;height:26px;font-size:18px;" name="type" size="1"><font size="5">
					<option value="ALL">請選擇搜尋類型</option>
					<option value="id">會員ID</option>
					<option value="name">姓名</option>
					<option value="level">權限</option></font>
				</select>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<input type="text" style="font-size:18px" name="keyword" size="10" placeholder="請輸入搜尋內容">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<input type="submit" class="button" value="查詢" />
			</div>
	</form>
	<div style="text-align:center;"><b><font size="5" color="white"></br>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;會員ID
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;權限
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;姓名
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</font></b></div>
	<form method="POST" action="member_detail.php">
			<div style="text-align:center;">
				<select style="width:400px;height:300px;font-size:18px;" name="check" size="20"><font size="5">
				<?php
					$accept=1;
					$rkeyword=$_POST["keyword"];
					if($_POST["type"]=="id" && $rkeyword!=NULL)
					{
						$sql = "SELECT * FROM 會員 where id='$rkeyword' ORDER BY ID";
						$result = execute_sql($link, "nuk_rent_3", $sql);
						$row = mysqli_fetch_assoc($result);
						$num = mysqli_num_rows($result);
						for($i=0;$i<$num;$i++)
						{
							$y=$row{"id"};
							echo"<option value='$y'>"."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".str_replace(" ","&nbsp;",str_pad($row{"id"} , 20-strlen($row{"id"})));
							if($row{"level"}=="2")
							{
								echo str_replace(" ","&nbsp;",str_pad( "系統管理員" , 31));
							}
							else if($row{"level"}=="1")
							{
								echo str_replace(" ","&nbsp;",str_pad( "授權人" , 32));
							}
							else
							{
								echo str_replace(" ","&nbsp;",str_pad( "一般會員" , 32));
							}
							echo $row{"name"};
							echo"</option>";
							$result++;
							$row = mysqli_fetch_assoc($result);
						}
					}
					else if($_POST["type"]=="name" && $rkeyword!=NULL)
					{
						$sql = "SELECT * FROM 會員 where name LIKE '%$rkeyword%' ORDER BY ID";
						$result = execute_sql($link, "nuk_rent_3", $sql);
						$row = mysqli_fetch_assoc($result);
						$num = mysqli_num_rows($result);
						for($i=0;$i<$num;$i++)
						{
							$y=$row{"id"};
							echo"<option value='$y'>"."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".str_replace(" ","&nbsp;",str_pad($row{"id"} , 20-strlen($row{"id"})));
							if($row{"level"}=="2")
							{
								echo str_replace(" ","&nbsp;",str_pad( "系統管理員" , 31));
							}
							else if($row{"level"}=="1")
							{
								echo str_replace(" ","&nbsp;",str_pad( "授權人" , 32));
							}
							else
							{
								echo str_replace(" ","&nbsp;",str_pad( "一般會員" , 32));
							}
							echo $row{"name"};
							echo"</option>";
							$result++;
							$row = mysqli_fetch_assoc($result);
						}
					}
					else if($_POST["type"]=="level" && $rkeyword!=NULL)
					{
						if($rkeyword=="系統管理員")
							$sql = "SELECT * FROM 會員 where level='2' ORDER BY ID";
						else if($rkeyword=="授權人")
							$sql = "SELECT * FROM 會員 where level='1' ORDER BY ID";
						else
							$sql = "SELECT * FROM 會員 where level='0' ORDER BY ID";
						$result = execute_sql($link, "nuk_rent_3", $sql);
						$row = mysqli_fetch_assoc($result);
						$num = mysqli_num_rows($result);
						for($i=0;$i<$num;$i++)
						{
							$y=$row{"id"};
							echo"<option value='$y'>"."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".str_replace(" ","&nbsp;",str_pad($row{"id"} , 20-strlen($row{"id"})));
							if($row{"level"}=="2")
							{
								echo str_replace(" ","&nbsp;",str_pad( "系統管理員" , 31));
							}
							else if($row{"level"}=="1")
							{
								echo str_replace(" ","&nbsp;",str_pad( "授權人" , 32));
							}
							else
							{
								echo str_replace(" ","&nbsp;",str_pad( "一般會員" , 32));
							}
							echo $row{"name"};
							echo"</option>";
							$result++;
							$row = mysqli_fetch_assoc($result);
						}
					}					
					else
					{
						$sql = "SELECT * FROM 會員 ORDER BY ID";
						$result = execute_sql($link, "nuk_rent_3", $sql);
						$row = mysqli_fetch_assoc($result);
						$num = mysqli_num_rows($result);
						for($i=0;$i<$num;$i++)
						{
							$y=$row{"id"};
							echo"<option value='$y'>"."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".str_replace(" ","&nbsp;",str_pad($row{"id"} , 20-strlen($row{"id"})));
							if($row{"level"}=="2")
							{
								echo str_replace(" ","&nbsp;",str_pad( "系統管理員" , 31));
							}
							else if($row{"level"}=="1")
							{
								echo str_replace(" ","&nbsp;",str_pad( "授權人" , 32));
							}
							else
							{
								echo str_replace(" ","&nbsp;",str_pad( "一般會員" , 32));
							}
							echo $row{"name"};
							echo"</option>";
							$result++;
							$row = mysqli_fetch_assoc($result);
						}
					} 
				?>
				</font>
				</select>
				</br>
				<div class="box">
				<input type="submit" class="button" value="詳細資料" >
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<a href="default.php" class="button">  反回  </a>
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