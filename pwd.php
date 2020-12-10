<?php
	require_once("dbtools.inc.php");
	header("Content-type: text/html; charset=utf-8");
		
	$lemail = $_POST["email"]; 	
	$lpassword = $_POST["password"];

	$link = create_connection();
						
	$sql = "SELECT * FROM 會員 Where email = '$lemail' AND pwd = '$lpassword'";
	$result = execute_sql($link, "nuk_rent_3" , $sql);
	if (mysqli_num_rows($result) == 0)
	{
		mysqli_free_result($result);
		mysqli_close($link);
			
		echo "<script type='text/javascript'>";
		echo "alert('帳號密碼錯誤，請查明後再登入');";
		echo "history.back()";
		echo "</script>";
	}
		
	else
	{
		$temp = mysqli_fetch_object($result);
		mysqli_free_result($result);
			
		mysqli_close($link);
		setcookie("id", $temp -> id);
		setcookie("email", $temp -> email);
		setcookie("name", $temp -> name);
		setcookie("level", $temp -> level);
		setcookie("login", "TRUE");		
		header("location:default.php");		
  }
?>