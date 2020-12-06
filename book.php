<!DOCTYPE HTML>  
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="輪轉.css"/>
	<title>大同大飯店-預訂房間</title>
</head>

<style>
input{
	padding:5px 15px;
	-webkit-border-radius: 5px;
	border-radius: 5px;	
}
fieldset {
	width:600px;
	border-style: none;
	align: center center;
	margin: 0px auto;
}
ul {
  list-style-type: none;
  margin: 0;
  padding: 0;
  overflow: hidden;
  background-color: #333;
}

li {float: left;}
li a, .dropbtn {
  display: inline-block;
  color: white;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none; 
}
li a:hover, .dropdown:hover .dropbtn {background-color: red;}
li.dropdown {display: inline-block;}

.dropdown-content {
  display: none;
  position: absolute;
  background-color: #f9f9f9;
  min-width: 160px;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  z-index: 1;
}
.dropdown-content a {
  color: black;
  padding: 12px 16px;
  text-decoration: none;
  display: block;
  text-align: left;
}
.dropdown-content a:hover {background-color: #f1f1f1}
.dropdown:hover .dropdown-content {display: block;}

.demo{
  padding: 25px;
  background-color:#000000;
  background-color:rgba(255,255,255,0.65);
  border-radius: 8px;
}
.demo p{color: #000000;}

select {
  width: 30%;
  padding: 8px 20px;
  border: 5;
  border-radius: 4px;
  background-color: #f1f1f1;
}

</style>

<body style="background-image: url('1.jpg');background-size:cover;background-attachment:fixed ;">    

<ul>
  <li><a href="#home" onclick="location.href='index.php'">首頁</a></li>
  <li><a href="#introduction" onclick="location.href='introduction.php'">關於大同</a></li>
  <li><a href="#room" onclick="location.href='room.php'">精緻客房</a></li>
  <li><a href="#viewpoint" onclick="location.href='viewpoint.php'">周邊景點</a></li>
  <li><a href="#traffic" onclick="location.href='traffic.php'">交通資訊</a></li>
  <li class="dropdown">
    <a href="javascript:void(0)" class="dropbtn">客房預定</a>
    <div class="dropdown-content">
      <a href="#book" onclick="location.href='book.php'">預訂房間</a>
      <a href="#inquire" onclick="location.href='inquire.php'">查詢訂單</a>
    </div>
  </li>
  <li style="float:right"><a href="#login" onclick="location.href='login.php'">會員登入</a></li>
</ul>

<?php
$nameErr = $passwordErr = $accountErr = "";
$account = $passwords = $name =  "";
?> 
<fieldset>
<div style="text-align:center;valign:center">
<div class="demo">

<h1>預訂房間</h1>
<form method="post" action="book.php" name="send" onsubmit="return chk();">

  會員編號: <input type="text" name="會員編號">
  <br><br>
  入住房型:
  <select class="form-control form-control-sm" name=room>
	<option value = "豪華客房(2人價格45000)">豪華客房(2人價格45000)</option>
	<option value = "商務型(2人價格15000)">商務型(2人價格15000)</option>
	<option value = "精緻型(2人價格10000)">精緻型(2人價格10000)</option>
	<option value = "家庭房(4人價格6000)">家庭房(4人價格6000)</option>
	<option value = "精緻四人房(4人價格5000)">精緻四人房(4人價格5000)</option>
  </select>
  房間數量:
  <select class="form-control form-control-sm"  name=qua>
	<option value = "1間">1間</option>
	<option value = "2間">2間</option>
	<option value = "3間">3間</option>
	<option value = "4間">4間</option>
	<option value = "5間">5間</option>
  </select>
  <br><br>
  入住時間 :
  <input type="date" value="<?= isset($_POST['get_date']) ? $_POST['get_date'] : ''; ?>" name="get_date1" min="<?= date('Y-m-d'); ?>" max="<?=date('Y-m-d', strtotime("+30 day", time()))?>" >
  到
  <input type="date" value="<?= isset($_POST['get_date']) ? $_POST['get_date'] : ''; ?>" name="get_date2" min="<?= date('Y-m-d'); ?>"  max="<?=date('Y-m-d', strtotime("+30 day", time()))?>" >
  <br><br>
  
  <input type="submit" name="submit" value="提交"> 
  <input type ="button" onclick="location.href='login.php'" value="登入查看會員編號"></input>
  <br><br>
  <a href="##" style="color:red;font-size:17px;" onclick="location.href='register.php'">還不是會員嗎?趕快免費註冊!</a>

</form>

</div>
</div>
</fieldset>

<script type="text/javascript">
  function chk(){

    if(document.send.get_date1.value>document.send.get_date2.value){
      alert('退房日期不可小於入住日期');

      return false;
    }
	else if(document.send.會員編號.value==""){
		alert('會員編號不可空白(註冊取得會員編號)');
		return false;
	}
	else if(document.send.get_date1.value==""){
		alert('請填寫入住日期');
		return false;
	}
	else if(document.send.get_date2.value==""){
		alert('請填寫退房日期');
		return false;
	}
	else
		return true;
  }
</script>

<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "hotel booking system";
$conn =  mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
	
     die("Connection failed: " . mysqli_connect_error());
} 
if ($_SERVER["REQUEST_METHOD"] == "POST"){
	mysqli_query($conn,"SET NAMES utf8");
			$sql = "INSERT INTO `訂單`(`會員編號`, `員工編號`, `入住日期`, `退房日期`, `訂單狀態`) VALUES ('$_POST[會員編號]','1','$_POST[get_date1]','$_POST[get_date2]','準備中')";
			if($conn->query($sql)==true){
				$today = strtotime($_POST['get_date1']);
				$thisday = strtotime($_POST['get_date2']);
				$days=round(($thisday-$today)/3600/24) ;
				if($days<0)
				{
					echo "退房日期不可小於入住日期";
				}
				else{
				$sql = "INSERT INTO `訂房明細`( `訂單編號`, `會員編號`, `房間` , `間數` , `天數`, `日期`) VALUES ('1','$_POST[會員編號]','$_POST[room]','$_POST[qua]','$days','$_POST[get_date1]')";
				if($conn->query($sql)==true)
				echo 
					'<span class="w3-text-orange" style="text-shadow:1px 1px 0 #444">
					 <font size="10">
					 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					 &nbsp;&nbsp;&nbsp;
					 訂房成功!
					 </font>
					 </span>
					';
				else 
					echo " ";
				}
			}
			else
				echo " ";
			
		$conn->close();
}
?>

</body>
</html>