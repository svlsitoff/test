<?php 

if(!empty($_POST['go']) && !empty($_FILES['file']))
	{
	$type = file_get_contents($_FILES['file']['tmp_name']);
	$type = json_decode($type,true);
	if(is_array($type))
		{
		move_uploaded_file($_FILES['file']['tmp_name'], 'downloads/'.$_FILES['file']
		['name']);
		echo "файл загружен<br>";
		}else
		{
		echo "Невалидный тип файла";
		exit;
		}
	}

if (!empty($_POST['del']) && !empty($_POST['del_test']))
{
	$del_test = nl2br($_POST['del_test']);
	$tests = scandir('downloads');
	for ($i=0; $i<count($tests) ; $i++)
	{
		if ($del_test.".json"===$tests[$i])
			{
				unlink("downloads/".$del_test.".json");
				echo "файл удален";
			}
	}
	
}
if (!empty($_POST['list'])) 
{
	$tests = scandir('downloads');
	for ($i=2; $i<count($tests); $i++) 
		{ 
		  $tests[$i] = str_replace(".json", "", $tests[$i]);	
		  echo $tests[$i]."<br>";
		}	
}
?>


<form action="admin.php" method="post" enctype="multipart/form-data">
<input type="file" name="file" value="файл для загрузки"><br><br>
<input type="submit" name="go" value="Загрузить"><br><br>
<label for="del_test" >Имя удаляемого файла :</label>
<input type="text" name="del_test" id="del_test"><br><br>
<input type="submit" name="del" value="удалить" ><br><br>
<input type="submit" name="list" value="Список тестов"><br>
</form>
<a href="test.php">тест</a>
</body>
</html>
