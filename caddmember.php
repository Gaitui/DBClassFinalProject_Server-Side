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
	if(empty($_POST["password"]))
	{
		echo "<script type='text/javascript'>";
		echo "alert('密碼不可為空白');";
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
	$n_email=$_POST["email"];
	$sql="SELECT * FROM 會員 WHERE email='$n_email'";
	$result=execute_sql($link,"nuk_rent_3",$sql);
	if(mysqli_num_rows($result)!=0)
	{
		echo "<script type='text/javascript'>";
		echo "alert('此email已被註冊');";
		echo "history.back()";
		echo "</script>";
		exit();
	}	
	$n_email=$_POST["email"];
	$n_password=$_POST["password"];
	$n_name=$_POST["name"];
	$sql = "INSERT INTO 會員 (email, name, pwd)
			VALUES ('$n_email', '$n_name', '$n_password')";
	$result = execute_sql($link, "nuk_rent_3" , $sql);
?>
<?
	$sql="SELECT * FROM 會員 WHERE email='$n_email'";
	$result=execute_sql($link,"nuk_rent_3",$sql);
	$row=mysqli_fetch_assoc($result);
	$id=$row{"id"};
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
	歡迎加入&nbsp;<?echo"$n_name";?></br></br>
	<center>
	<table width="200" border="1">
		<tr><td>會員編號</td><td><?php echo"$id";?></td></tr>
	</table>
	</center>
	</font></b></div>
	<div style="text-align:center;">
	<div class="box">
		<a href="login.html" class="button"> 返回登入畫面  </a>
	</div>
</div>
</body>
</html>