<?php
  $login = $_COOKIE["login"];
  if ($login!="TRUE")
  {
    header("location:login.html");
    exit();
  }
  require_once("dbtools.inc.php");
  $link = create_connection();
  
  $n_id=$_COOKIE["id"];
  
  $n_name=$_COOKIE["n_name"];
  setcookie("n_name","");
  
  $n_email=$_COOKIE["n_email"];
  setcookie("n_email","");
  
  $n_phone=$_COOKIE["n_phone"];
  setcookie("n_phone","");
  
  if(empty($_COOKIE["n_std_id"]))
  {$n_std_id="";}
  else{$n_std_id=$_COOKIE["n_std_id"];}
  setcookie("n_std_id","");
  
  if(empty($_COOKIE["n_recept"]))
  {$n_recept="";}
  else{$n_recept=$_COOKIE["n_recept"];}
  setcookie("n_recept","");
  
  if(empty($_COOKIE["n_people_num"]))
  {$n_people_num=0;}
  else{$n_people_num=$_COOKIE["n_people_num"];}
  setcookie("n_people_num","");

  if(empty($_COOKIE["n_uni_no"]))
  {$n_uni_no="";}
  else{$n_uni_no=$_COOKIE["n_uni_no"];}
  setcookie("n_uni_no","");
  
  if(empty($_COOKIE["n_tax_id"]))
  {$n_tax_id="";}
  else{$n_tax_id=$_COOKIE["n_tax_id"];}
  setcookie("n_tax_id","");
  
  if(empty($_COOKIE["n_address"]))
  {$n_address="";}
  else{$n_address=$_COOKIE["n_address"];}
  setcookie("n_address","");
  
  if(empty($_COOKIE["n_date"]))
  {$n_date_num="";}
  else{$n_date=$_COOKIE["n_date"];}
  setcookie("n_date","");
  
  if(empty($_COOKIE["BBQt"]))
  {$BBQt=0;}
  else{$BBQt=$_COOKIE["BBQt"];}
  setcookie("BBQt","");
  
  if(empty($_COOKIE["BBQn"]))
  {$BBQn=0;}
  else{$BBQn=$_COOKIE["BBQn"];}
  setcookie("BBQn","");
  
  if(empty($_COOKIE["stage"]))
  {$stage=0;}
  else{$stage=$_COOKIE["stage"];}
  setcookie("stage","");
  
  if(empty($_COOKIE["camp"]))
  {$camp=0;}
  else{$camp=$_COOKIE["camp"];}
  setcookie("camp","");
  
  $sum=$_COOKIE["price"];
  setcookie("price","");
  $deposit=0;
  $take_id="";
  $accept=0;
  $sql="INSERT INTO 租借紀錄 (mem_id,take_id,name,date,deposit,fee,people_num,
                              camp_num,BBQ_time,BBQ_num,stage_time,accept)
  VALUES('$n_id','$take_id','$n_name','$n_date','$deposit','$sum','$n_people_num',
                               '$camp','$BBQt','$BBQn','$stage','$accept')";
  $result = execute_sql($link, "nuk_rent_3" , $sql);
  ?>
  
  <?php

  $sql="SELECT * FROM 租借紀錄 WHERE mem_id='$n_id' AND date='$n_date'";
  $result1= execute_sql($link,"nuk_rent_3", $sql);
  $row = mysqli_fetch_object($result1);
  $rent_no= $row -> rent_no;
  $sql="INSERT INTO 租借人(rent_no,id,name,email,address,uni_no,tele,student_id,receipt,tax_id)
  VALUES('$rent_no','$n_id','$n_name','$n_email','$n_address','$n_uni_no','$n_phone','$n_std_id','$n_recept','$n_tax_id')";
  $result=execute_sql($link,"nuk_rent_3",$sql);
  
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
	已送出申請單</br></br>
	<center>
	<table width="200" border="1">
		<tr><td>申請編號</td><td><?php echo"$rent_no";?></td></tr>
	</table>
	</center>
	</font></b></div>
	<div style="text-align:center;">
	<div class="box">
		<a href="default.php" class="button"> 返回  </a>
	</div>
</div>
</body>
</html>