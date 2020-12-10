<?php
    require_once("dbtools.inc.php");
    $link = create_connection();
	if(empty($_POST["email"]))
	{
		echo "<script type='text/javascript'>";
		echo "alert('email不可為空白');";
		echo "history.back()";
		echo "</script>";
		exit();
	}
	if(empty($_POST["name"]))
	{
		echo "<script type='text/javascript'>";
		echo "alert('姓名不可為空白');";
		echo "history.back()";
		echo "</script>";
		exit();
	}
	$c_email=$_POST["email"];
	$c_name=$_POST["name"];
	$sql="SELECT * FROM 會員 WHERE email='$c_email' AND name='$c_name'";
	$result=execute_sql($link,"nuk_rent_3",$sql);
	$num=mysqli_num_rows($result);
	if($num==0)
	{
		echo "<script type='text/javascript'>";
		echo "alert('無匹配資料,請重新輸入');";
		echo "history.back()";
		echo "</script>";
		exit();
	}
	else
	{
		$row=mysqli_fetch_assoc($result);
		$pwd=$row{"pwd"};
	}
	//關閉資料連接
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
			<h1><a href="login.html">高雄大學BBQ系統</a></h1>
		</div>
	</div>
</div>
<div id="portfolio" class="container">
	
	<div style="text-align:center;"><b><font size="5" color="white">
	忘記密碼</br></br>
	<center>
	<table width="200" border="1">
		<tr><td>密碼</td><td><?php echo"$pwd";?></td></tr>
	</table>
	</center>
	</br>請不要再忘了!</br>
	</font></b></div>
	<div style="text-align:center;">
	<div class="box">
		<a href="login.html" class="button"> 返回登入畫面  </a>
	</div>
</div>
</body>
</html>