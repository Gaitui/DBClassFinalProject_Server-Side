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
	<?php
		if(empty($_POST["check"]))
		{
			echo "<script type='text/javascript'>";
			echo "alert('請選擇申請單');";
			echo "history.back()";
			echo "</script>";
			exit();
		}
		else
		{
			$check=$_POST["check"];
			$sql = "SELECT * FROM 租借紀錄 where rent_no = '$check'";
			$result = execute_sql($link, "nuk_rent_3", $sql);
			$row = mysqli_fetch_assoc($result);
			setcookie("rent_no",$check);
			$sql = "SELECT * FROM 租借人 where rent_no = '$check'";
			$result = execute_sql($link, "nuk_rent_3", $sql);
			$rown = mysqli_fetch_assoc($result);
		}
	?>
	<form method="POST" action="manage_fee.php">
		<div style="text-align:center;"><b><font size="5" color="white">
			</br>申請單資料</br></br>
	<center> 
	<table width="700" border="1">
		<tr><td>申請人(單位)</td><td><?php echo $row{"name"};?></td></tr>
		<tr><td>學號/職員編號</td><td><?php echo $rown{"student_id"};?></td></tr>
		<tr><td>e-mail</td><td><?php echo $rown{"email"};?></td></tr>
		<tr><td>聯絡電話</td><td><?php echo $rown{"tele"};?></td></tr>
		<tr><td>收據繳款(人)(公司)名稱</td><td><?php echo $rown{"receipt"};?></td></tr>
		<tr><td>總人數</td><td><?php echo $row{"people_num"};?></td></tr>
		<tr><td>統一編號</td><td><?php echo $rown{"uni_no"};?></td></tr>
		<tr><td>稅籍編號</td><td><?php echo $rown{"tax_id"};?></td></tr>
		<tr><td>地址</td><td><?php echo $rown{"address"};?></td></tr>
		<tr><td>借用時間</td><td><?php echo $row{"date"};?></td></tr>
		<tr><td>時段及場地</td><td><?php if($row{"BBQ_time"}!="0")
										 {
											echo"烤肉台".$row{"BBQ_num"}."台,時段:";
											if($row{"BBQ_time"}=="1")
												echo"08：00~11：00</br>";
											else if($row{"BBQ_time"}=="2")
												echo"11：00~14：00</br>";
											else if($row{"BBQ_time"}=="3")
												echo"18：00~21：00</br>";
											else
												echo"錯誤</br>";
										 }
										 if($row{"camp_num"}!="0")
										 {
											 echo"營位".$row{"camp_num"}."區:12：30~翌日11：30</br>";
										 }
										 if($row{"stage_time"}!="0")
										{
											echo"露天表演場";
											if($row{"stage_time"}=="1")
												echo"08：00~11：00</br>";
											else if($row{"stage_time"}=="2")
												echo"11：00~14：00</br>";
											else if($row{"stage_time"}=="3")
												echo"18：00~21：00</br>";
											else
												echo"錯誤";
										}
										?></td></tr>
			<tr><td>費用</td><td><?echo $row{"fee"};?></td></tr>
			<tr><td>繳費狀態</td><td><?if($row{"deposit"}=="0")
									{?></br>
									<select style="width:150px;height:26px;font-size:18px;" name="deposit" size="1"><font size="5">
										<option value="0">未繳</option>
										<option value="1">已繳</option></font>
									</select></br></br>
									<?}
									else echo"已繳費"?></td></tr>
	</table>
	</center></b></font>
				<?if($row{"deposit"}=="0"){?>
				<input type="submit" class="button" value="確認修改">
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<?}?>
				<a onclick="history.back()" class="button"> 返回  </a>
			</div>
	</form>
	</br></br>
</body>
</html>
<?php
	mysqli_free_result($result);
	mysqli_close($link);
?>

