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
  $rent_no=$_COOKIE["rent_no"];
  $sql="SELECT * FROM 租借紀錄 WHERE rent_no='$rent_no'";
  $result=execute_sql($link,"nuk_rent_3",$sql);
  $row=mysqli_fetch_assoc($result);
  
  $sql="SELECT * FROM 租借人 WHERE rent_no='$rent_no'";
  $result=execute_sql($link,"nuk_rent_3",$sql);
  $rown=mysqli_fetch_assoc($result);
  if(empty($rown{"std_id"}))
	  setcookie("std",0);
  else
	  setcookie("std",1);
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
	修改申請單</br></br>
	注意事項</br>
	<font size="3" color="white">
	1.如需修改"借用時間及時段"視同重新申請,需重新核准,請重新填入日期,時段以及所需個數</br>
	2.其他部分毋需填寫"借用時間及時段",否則將需重新核准
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</br></br>
	</font>
	<form method="POST" action="my_rent_change_ok.php">
		<center> 
	<table width="880" border="1">
		<tr><td>申請人(單位)*</td><td><?echo $rown{"name"};?></td></tr>
		<tr><td>學號/職員編號</td><td><?echo $rown{"student_id"}?></td></tr>
		<tr><td>e-mail*</td><td><?php echo $rown{"email"};?></td></tr>
		<tr><td>聯絡電話*</td><td><?echo $rown{"tele"}?></td></tr>
		<tr><td>收據繳款(人)(公司)名稱</br><font size="1">(如為公司，請詳填全名，開立收據後不可更改收據台頭)</font></td><td><input type="text" name = "receipt" size="20" value="<?echo $rown{"receipt"};?>"></td></tr>
		<tr><td>總人數</td><td><input type="int" name = "people_num" size="20" value="<?php echo $row{"people_num"};?>"></td></tr>
		<tr><td>統一編號</td><td><input type="text" name = "uni_no" size="20" value="<?php echo $rown{"uni_no"};?>"></td></tr>
		<tr><td>稅籍編號</td><td><input type="text" name = "tax_id" size="20" value="<?php echo $rown{"tax_id"};?>"></td></tr>
		<tr><td>地址</td><td><input type="text" name = "address" size="20" value="<?php echo $rown{"address"};?>"></td></tr>
		<tr><td>借用時間及時段</td><td>	<input type="date" name="date" min="<?php echo date('Y-m-d', strtotime("+3 day", time()))?>" max="<?php echo date('Y-m-d', strtotime("+1 year", time()))?>" value="<?php echo $row{"date"}?>"><font size="3"><strong>*請於使用前三天辦理完成</strong></br>
										<input type="checkbox" name="rent[]" value="BBQ">烤肉台<input type="number" name = "BBQ" size="1" value="0" min="0" max="12">台<font size="1">(一台限十人內使用)</font>
											<select name="BBQtime" size="1">
												<option value="0">-</option>
												<option value="1">08：00~11：00(提供水電、洗手間)</option>
												<option value="2">11：00~14：00(提供水電、洗手間)</option>
												<option value="3">18：00~21：00(提供水電、洗手間及夜間照明)</option>
											</select></br>
										<input type="checkbox" name="rent[]" value="camp">營位<input type="number" name = "camp" size="1" value="0" min="0" max="12">區:<font size="4">12：30~</font>翌日<font size="4">11：30</font>(提供水電、洗手間、夜間照明及沐浴熱水)</br>
										<input type="checkbox" name="rent[]" value="stage">露天表演場
											<select name="stagetime" size="1">
												<option value="0">-</option>
												<option value="1">08：00~11：00</option>
												<option value="2">11：00~14：00</option>
												<option value="3">18：00~21：00</option>
											</select>(提供水電、洗手間及夜間照明)</br>
										以上請擇一時段勾選，若有特殊需求，請洽事務組 孫先生07-5919094</br>
								</font></td></tr>
	</table>
	</center>
	</font></b></div>
	<div style="text-align:center;">
	<div class="box">
		<input type="submit" class="button" value="確定" >
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<a onclick="history.back()" class="button"> 返回 </a>
	</div>
	</form>
</div>
</body>
</html>
<?php
	mysqli_free_result($result);
	mysqli_close($link);
?>