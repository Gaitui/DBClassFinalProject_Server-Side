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
  if(empty($_POST["receipt"]))
	$c_receipt="";
  else
	$c_receipt=$_POST["receipt"];

  if(empty($_POST["people_num"]))
	$c_people_num=0;
  else
	$c_people_num=$_POST["people_num"];

  if(empty($_POST["uni_no"]))
	$c_uni_no="";
  else
	$c_uni_no=$_POST["uni_no"];

  if(empty($_POST["tax_id"]))
	$c_tax_id="";
  else
	$c_tax_id=$_POST["tax_id"];

  if(empty($_POST["address"]))
	$c_address="";
  else
	$c_address=$_POST["address"];
  $f=0;
  if(empty($_POST["rent"]))
  {
	$sql="UPDATE 租借紀錄 set people_num='$c_people_num' WHERE rent_no='$rent_no'";
	$result=execute_sql($link,"nuk_rent_3",$sql);
	$sql="UPDATE 租借人 set receipt='$c_receipt',uni_no='$c_uni_no',tax_id='$c_tax_id',address='$c_address'WHERE rent_no='$rent_no'";
	$result=execute_sql($link,"nuk_rent_3",$sql);
  }
  else
  {
	$cdate=$_POST["date"];
	$sql="SELECT * FROM 租借紀錄 WHERE rent_no='$rent_no'";
	$result=execute_sql($link,"nuk_rent_3",$sql);
	$row=mysqli_fetch_assoc($result);
	if($row{"date"}!=$cdate)
	{
		$id=$_COOKIE["id"];
		$sql="SELECT * FROM 租借紀錄 WHERE mem_id='$id' AND date='$cdate'";
		$result = execute_sql($link,"nuk_rent_3" , $sql);
		if(mysqli_num_rows($result)!=0)
		{
			echo "<script type='text/javascript'>";
			echo "alert('此帳號在該日期已有申請單');";
			echo "history.back()";
			echo "</script>";
			exit();
		}	
	}
	$f=1;
	$BBQ=0;
	$cam=0;
	$sta=0;
	$c_stage=0;
	$c_BBQt=0;
	$rent=$_POST["rent"];
	for($i=0;$i<count($rent);$i++)
	{
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
				$c_stage=$_POST["stagetime"];
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
				$c_BBQt=$_POST["BBQtime"];
				$BBQ=$_POST["BBQ"];
			}
		}
	}
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
			$rcampn=$rrow{"camp_num"}+$row{"camp_num"};
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
	
	$sql= "Select * FROM 場地 where catacory='BBQ'";
	$result= execute_sql($link,"nuk_rent_3",$sql);
	$oBBQ=mysqli_fetch_assoc($result);
	$sql= "Select * FROM 場地 where catacory='camp'";
	$result= execute_sql($link,"nuk_rent_3",$sql);
	$ocamp=mysqli_fetch_assoc($result);
	$sql= "Select * FROM 場地 where catacory='stage'";
	$result= execute_sql($link,"nuk_rent_3",$sql);
	$ostage=mysqli_fetch_assoc($result);
	$std=$_COOKIE["std"];
	
	if($std==1)
	{
		$BBQp=$BBQ*$oBBQ["stdprice"];
		$campp=$cam*$ocamp["stdprice"];
		$stap=$sta*$ostage["stdprice"];
	}
	else
	{
		$BBQp=$BBQ*$oBBQ["price"]; 
		$campp=$cam*$ocamp["price"];
		$stap=$sta*$ostage["price"];
	}		
		
	
	$sum=$BBQp+$campp+$stap;
	$c_take_id="";
	$c_accept=3;
	$sql="UPDATE 租借紀錄 set people_num='$c_people_num',date='$cdate',fee='$sum',camp_num='$cam',BBQ_time='$c_BBQt',BBQ_num='$BBQ',
	stage_time='$c_stage',accept='$c_accept',take_id='$c_take_id' WHERE rent_no='$rent_no'";
	$result=execute_sql($link,"nuk_rent_3",$sql);
	$sql="UPDATE 租借人 set receipt='$c_receipt',uni_no='$c_uni_no',tax_id='$c_tax_id',address='$c_address'WHERE rent_no='$rent_no'";
	$result=execute_sql($link,"nuk_rent_3",$sql);
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
<div id="portfolio" class="container">
	<div style="text-align:center;"><b><font size="5" color="white">
	已更新申請單</br></br>
	<?if($f==1)
	{?>更新金額</br></br>
	<center> 
	<table width="850" border="1">
		<tr><td>場地名稱</td><td>收費標準</td><td>借用數量</td><td>金額</td></tr>
		<tr><td>烤肉台(共<?php echo $oBBQ["num"];?>台)</td><td><?php echo $oBBQ["stdprice"];?>元(職員生)/1台，<?php echo $oBBQ["price"];?>元(校外人士)/1台</td><td><?php echo"$BBQ";?></td><td><?php echo"$BBQp"?></td></tr>
		<tr><td>營位(共<?php echo $ocamp["num"];?>區)</td><td><?php echo $ocamp["stdprice"];?>元(職員生)/1區，<?php echo $ocamp["price"];?>元(校外人士)/1區</td><td><?php echo"$cam";?></td><td><?php echo"$campp"?></td></tr>
		<tr><td>露天表演場</td><td><?php echo $ostage["stdprice"];?>元(職員生)/1時段，<?php echo $ostage["price"];?>元(校外人士)/1時段</td><td><?php echo"$sta";?></td><td><?php echo"$stap"?></td></tr>
		<tr><td>總計</td><td></td><td></td><td><?php echo"$sum";?></td></tr>
	</table>
	</center>
	<?}?>
	</font></b></div>
	<div style="text-align:center;">
	<div class="box">
		<a href="my_rent.php" class="button"> 返回  </a>
	</div>
</div>
</body>
</html>
<?php
	mysqli_close($link);
?>