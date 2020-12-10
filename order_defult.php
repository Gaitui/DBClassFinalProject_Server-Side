<?php
  $login = $_COOKIE["login"];
  if ($login!="TRUE")
  {
    header("location:login.html");
    exit();
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
	<form method="POST" action="restaurant_back_order.php">
		<div style="text-align:center;"><b><font size="10" color="white">
			</br>國立高雄大學露營烤肉區使用規範</br></br></b></font>
		</div>
	</form>
	<div style="text-align:center;">
		<div style="overflow:scroll;height:300px;"><font size="5" color="white"> <p align="left">
		一、本露營烤肉區係採使用者付費；使用前，請依規定申請核准後，方可使用；申請單格式詳如附件。</br>
		二、申請程序：請於使用日前三日向本校總務處事務組提出申請作業，完成審核並向出納組完成繳款後，始完成租借手續。</br>
		三、收費標準請參閱本校「場地提供使用收費標準」，因須向國稅局繳納營業稅，故繳費開立收據時，請繳款人注意收據之名稱，詳填公司名稱或統一及稅籍編號。</br>
		四、借用時段及提供設備區分：</br>
		(一)烤肉區:</br>
		1.早上時段：08:00至11:00時；提供水電、洗手間。</br>
		2.中午時段：11:00至14:00時；提供水電、洗手間。</br>
		3.晚上時段：18:00至21:00時；提供水電、洗手間及夜間照明。</br>
		(二)露營區：12:30至翌日11:30時；提供水電、洗手間及沐浴熱水。</br>
		五、使用露營烤肉區有關配合事項如下：</br>
		(一)如需炊事生火，請於高架炊具爐台上炊事，嚴禁直接於草地上野炊。</br>
		(二)嚴禁攜帶與燃放炮竹、煙火等危險物品。</br>
		(三)夜間時段PM10:00～AM08:00為靜聲時段，禁止大聲喧嘩或製造噪音。</br>
		(四)請將產生之垃圾，集中並置於男(女)廁所淋浴間內，以防野狗覓食，事後會有清潔人員清除；另對湯汁、厨餘、液體類請包妥，以免污染地板，增加清潔人員清洗困難。</br>
		(五)可回收之物品，例：紙箱(袋)、塑膠瓶(罐)、烤肉用鐵架、玻璃瓶,....等，請儘量歸類集中。</br>
		(六)請節約水、電，不使用時，請隨手關閉；若有故障時，上班期間電話請撥：07-5919094或向本校駐警隊電話：07-5919005反映，通報本校相關單位(人)處理。</br>
		(七)健康步道內之鵝卵石，請勿當球玩耍丟棄草皮，以免整理場地割草時，高速運轉傷及葉片或彈跳傷人。</br>
		(八)另提醒在紥營釘時，在洗手台一線，因埋設塑膠水管管路接近表土，請避開埋管處下釘，以免釘破水管。</br>
		(九)為維護校園觀瞻，盥洗請於盥洗室內為之；晾曬衣物，請懸掛室內曬衣間，勿於室外空間曝曬。</br>
		六、本校為無菸校園[全面禁菸]，依菸害防制法之規定：於禁菸區吸菸者，罰行為人2千-1萬元，請勿於校園內吸菸，以維自身及他人健康。</br>
		七、使用本校田徑場請遵守下列事項：</br>
		(一)嚴禁攜帶牲畜或危險物品進入，禁止使用釘鞋及從事標槍、鐵餅、鉛球、鏈球、棒球、壘球、高爾夫球、溜冰、直排輪或操作遙控汽車、飛機等危險性活動。</br>
		(二)各種交通工具不得進入運動場區，並請勿穿著高跟鞋等尖銳物進入跑道。</br>
		八、請愛惜公物，如有損毀本露營場或校置之設備，須照價賠償。</br>
		九、使用營區應在指定範圍內活動，並遵守本使用規範，如有違反經制止不聽者，得取消其場區使用資格。</br>
		十、其他未規定事項依本校「場地提供使用作業辦法」辦理。</br>
		十一、相關資訊及申請書，請參閱本校網頁－行政單位－總務處－事務組－各式表單－空間借用業務－露營烤肉場地租借申請書或
		<a href="http://ga.nuk.edu.tw/files/15-1012-2898,c427-1.php?Lang=zh-tw">http://ga.nuk.edu.tw/files/15-1012-2898,c427-1.php?Lang=zh-tw</a></br>
		</p></font></div>
		</br>
		<div class="box">
		<a href="order.php" class="button"> 同意  </a>
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<a href="default.php" class="button"> 返回  </a>
		</br></br>
		</div>
	</div>
	</form>
</div>
</body>
</html>