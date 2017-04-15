<?php 
error_reporting(-1);
if (!isset($_GET['var']) || !isset($_POST['var']))
	{
		echo " выберите вариант теста : <br><br>";
		$var = '';
	}
$tests = scandir('downloads');
for($i=2; $i<count($tests); $i++)
{
	$tests[$i] = str_replace(".json", "", $tests[$i]);
	echo "<h4><a href='test.php"."?var=$tests[$i]'>$tests[$i]</a></h4>";
	echo "<br>";
}
if (!empty($_GET['var'])) 
	{
		$var = (int)$_GET['var'];		
	}
if(!empty($_POST['var']))	
	{
		$var = $_POST['test_var'];
	}

function  gettest($var)
	{
		if($var)
		{
		 	$tests =  scandir('downloads');
		 	for ($i=2; $i<=count($tests) ; $i++) 
		 	{ 
		 		if ($var) 
		 		{
		 			$test = file_get_contents('downloads/'.$var.".json");
		 			$test = json_decode($test,true);
		 		}
		 	} 
		 	return $test;
		 }
	 	
	}
$test = gettest($var);
?>
<!DOCTYPE html>
<html>
<head>
	<title>вариант теста</title>
</head>
<body>
<form action="test.php" method="post" >
<label for="res" ><?=$test['label']?></label><br>
<input  type="text" name="res"  id = "res" ><br>
<input type="text" name="test_var" value="<?=$var?>" hidden ><br>
<input type="submit" name="go" value="проверить"><br>
</form>
<a href="admin.php">админка</a>
</body>
</html>
<?php 

if(!empty($_POST['go'])&&!empty($_POST['res']))
	{
		$res = nl2br($_POST['res']);
		$variant = (int)$_POST['test_var'];
		$test = gettest($variant);
			if($res==$test['result'])
			{
				echo "<br><h3>Правильно</h3><br>";
			}
			else
			{
				echo "<br><h3>Неверно</h3><br>";
			}
	}
?>