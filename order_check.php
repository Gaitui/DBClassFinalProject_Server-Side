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
  if(empty($_POST["name"]))
  {
	echo "<script type='text/javascript'>";
	echo "alert('申請人(單位)不可為空白');";
	echo "history.back()";
	echo "</script>";
	exit();
  }
  if(empty($_POST["email"]))
  {
	echo "<script type='text/javascript'>";
	echo "alert('email不可為空白');";
	echo "history.back()";
	echo "</script>";
	exit();
  }
  if(empty($_POST["phone"]))
  {
	echo "<script type='text/javascript'>";
	echo "alert('聯絡電話不可為空白');";
	echo "history.back()";
	echo "</script>";
	exit();
  }
  $date=$_POST["date"];
  $id=$_COOKIE["id"];
  $sql="SELECT * FROM 租借紀錄 WHERE mem_id='$id' AND date='$date'";
  $result = execute_sql($link,"nuk_rent_3" , $sql);
  if(mysqli_num_rows($result)!=0)
  {
	echo "<script type='text/javascript'>";
	echo "alert('一個帳號一個日期只能送出1筆申請單\\n若有特殊需求，請洽事務組 孫先生07-5919094');";
	echo "history.back()";
	echo "</script>";
	exit();
  }
  if(empty($_POST["rent"]))
  {
	echo "<script type='text/javascript'>";
	echo "alert('請擇一時段勾選，若有特殊需求，請洽事務組 孫先生07-5919094');";
	echo "history.back()";
	echo "</script>";
	exit();
  }
  else
  {
	  setcookie("BBQt","");
	  setcookie("BBQn","");
	  setcookie("stage","");
	  setcookie("camp","");
	  $BBQ=0;
	  $cam=0;
	  $sta=0;
	  $rent=$_POST["rent"];
	  for($i=0;$i<count($rent);$i++)
	  {
		  //echo "$rent[$i]";
		  if(preg_match("/\bstage\b/i",$rent[$i]))
		  {
			  if($_POST["stagetime"]=="0")
			  {
				  echo "<script type='text/javascript'>";
				  echo "alert('請選擇舞台使用時段');";
				  echo "history.back()";
				  echo "</script>";
				  exit();
			  }
			  else
			  {
				  $sta=1;
				  setcookie("stage",$_POST["stagetime"]);
			  }
		  }
		  else if(preg_match("/\bcamp\b/i",$rent[$i]))
		  {
			  if($_POST["camp"]=="0")
			  {
				  echo "<script type='text/javascript'>";
				  echo "alert('請填入營位使用個數');";
				  echo "history.back()";
				  echo "</script>";
				  exit();
			  }
			  else
			  {
				  $cam=$_POST["camp"];
				  setcookie("camp",$_POST["camp"]);
			  }
			  
		  }
		  else if(preg_match("/\bBBQ\b/i",$rent[$i]))
		  {
			  if($_POST["BBQ"]=="0")
			  {
				  echo "<script type='text/javascript'>";
				  echo "alert('請填入烤肉台使用個數');";
				  echo "history.back()";
				  echo "</script>";
				  exit();
			  }
			  else if($_POST["BBQtime"]=="0")
			  {
				  echo "<script type='text/javascript'>";
				  echo "alert('請填入烤肉台使用時間');";
				  echo "history.back()";
				  echo "</script>";
				  exit();
			  }
			  else
			  {
				  setcookie("BBQt",$_POST["BBQtime"]);
				  setcookie("BBQn",$_POST["BBQ"]);
				  $BBQ=$_POST["BBQ"];
			  }
		  }
	  }
  }
  setcookie("n_name",$_POST["name"]);
  setcookie("n_email",$_POST["email"]);
  setcookie("n_phone",$_POST["phone"]);
  if(empty($_POST["student_id"]))
  {
	  $std=0;
	  setcookie("n_std_id","");
  }
  else
  {
	  $std=1;
	  setcookie("n_std_id",$_POST["student_id"]);
  }

  if(empty($_POST["recept"]))
  {setcookie("n_recept","");}
  else
  {setcookie("n_recept",$_POST["recept"]);}

  if(empty($_POST["people_num"]))
  {setcookie("n_people_num","");}
  else
  {setcookie("n_people_num",$_POST["people_num"]);}

  if(empty($_POST["uni_no"]))
  {setcookie("n_uni_no","");}
  else
  {setcookie("n_uni_no",$_POST["uni_no"]);}

  if(empty($_POST["tax_id"]))
  {setcookie("n_tax_id","");}
  else
  {setcookie("n_tax_id",$_POST["tax_id"]);}

  if(empty($_POST["address"]))
  {setcookie("n_address","");}
  else
  {setcookie("n_address",$_POST["address"]);}

  setcookie("n_date",$_POST["date"]);
  
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
	租借金額</br></br>
	<center> 
	<table width="850" border="1">
	<?php 
		$sql= "Select * FROM 場地 where catacory='BBQ'";
	    $result= execute_sql($link,"nuk_rent_3",$sql);
		$oBBQ=mysqli_fetch_assoc($result);
		$sql= "Select * FROM 場地 where catacory='camp'";
	    $result= execute_sql($link,"nuk_rent_3",$sql);
		$ocamp=mysqli_fetch_assoc($result);
		$sql= "Select * FROM 場地 where catacory='stage'";
	    $result= execute_sql($link,"nuk_rent_3",$sql);
		$ostage=mysqli_fetch_assoc($result);
	
	?>
		<tr><td>場地名稱</td><td>收費標準</td><td>借用數量</td><td>金額</td></tr>
		<tr><td>烤肉台(共<?php echo $oBBQ["num"];?>台)</td><td><?php echo $oBBQ["stdprice"];?>元(職員生)/1台，<?php echo $oBBQ["price"];?>元(校外人士)/1台</td><td><?php echo"$BBQ";?></td><td><?php if($std==1)$BBQp=$BBQ*$oBBQ["stdprice"]; else $BBQp=$BBQ*$oBBQ["price"]; echo"$BBQp"?></td></tr>
		<tr><td>營位(共<?php echo $ocamp["num"];?>區)</td><td><?php echo $ocamp["stdprice"];?>元(職員生)/1區，<?php echo $ocamp["price"];?>元(校外人士)/1區</td><td><?php echo"$cam";?></td><td><?php if($std==1)$campp=$cam*$ocamp["stdprice"]; else $campp=$cam*$ocamp["price"]; echo"$campp"?></td></tr>
		<tr><td>露天表演場</td><td><?php echo $ostage["stdprice"];?>元(職員生)/1時段，<?php echo $ostage["price"];?>元(校外人士)/1時段</td><td><?php echo"$sta";?></td><td><?php if($std==1)$stap=$sta*$ostage["stdprice"]; else $stap=$sta*$ostage["price"]; echo"$stap"?></td></tr>
		<tr><td>總計</td><td></td><td></td><td><?php $sum=$BBQp+$campp+$stap; echo"$sum"; setcookie("price",$sum);?></td></tr>
	</table>
	</center>
	</font></b></div>
	<div style="text-align:center;">
	<div class="box">
		<a href="order_check_ok.php" class="button"> 確認  </a>
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<a onclick="history.back()" class="button"> 返回  </a>
	</div>
</div>
</body>
</html>
<?php
	mysqli_free_result($result);
	mysqli_close($link);
?>