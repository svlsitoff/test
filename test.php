<?php 
 function getdata(){
		$list = file_get_contents("listing.txt");
		$list = explode("***", $list);
		$list = array_diff($list, array(""));
		$list = array_combine(array_merge(array_slice(array_keys($list), 1), array(count($list))), array_values($list));
		
	return $list;

} 

	echo " выберите вариант теста<br><br>";
	$varcount = scandir('downloads');
	foreach ($varcount as $file)
	{
		if($file !='.' && $file != '..')
		{
			$file = str_replace(".json", "", $file);
			echo "<h4><a href='test.php"."?var=$file'>$file</a></h4>";
			echo "<br>";
		}
	}
$list = getdata();

@$var = (int)$_GET['var'];

@$test = $list[$var];

$test = json_decode($test, true);
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
<input type="text" name="test_var" value="<?=$var?>" hidden><br>
<input type="submit" name="go" value="проверить"><br>
</form>
<a href="admin.php">админка</a>
</body>
</html>
<?php 

  
if(!empty($_POST['go'])&&!empty($_POST['res'])){
	$res = nl2br($_POST['res']);
	$var = $_POST['test_var'];
	$list = getdata();
	$test = $list[$var];
	$test = json_decode($test, true);
	if($res==$test['result'])
	{
		echo "<br><h3>Правильно</h3><br>";
	}else
	{
		echo "<br><h3>Неверно</h3><br>";
	}
}
?>