<?
 error_reporting(0);
/**
 * Возвращает преформатированный массив
 *
 * @param {array} массив
 * @return {array} преформатированный массив
 */
function pre($v){
	echo '<pre>'; print_r($v); echo '</pre>';
}

/*Соединение с базой*/
$db_host = 'localhost';
$db_name = 'pbit';
$db_user = 'root';
$db_password = '';

$db_connect = mysqli_connect($db_host, $db_user, $db_password, $db_name);
if (!$db_connect) {
    echo "Ошибка: Невозможно установить соединение с MySQL." . PHP_EOL; 
    echo '<br>';
    echo "Код ошибки errno: " . mysqli_connect_errno() . PHP_EOL;
    echo '<br>';
    echo "Текст ошибки error: " . mysqli_connect_error() . PHP_EOL;
    exit;
}
/*/Соединение с базой*/
/*Удаляем эелемент из базы */
if(!empty($_POST['btnDelete']))
{
	$arr_package= explode( ',', $_POST['btnDelete'] );
	
	pre($arr_package);

	foreach ($arr_package as $k => $v) {
		$qdelete =  'DELETE FROM catalog WHERE  id ='. $v;
		$query = mysqli_query($db_connect, $qdelete);

		if($result_delete = mysqli_query($db_connect, $qdelete))
		{
			echo 'удалилось';

		}else{
			echo 'не удалилось';
		}
	}
}
/*/Удаляем эелемент из базы*/

/*Добавляем элемент в базу*/
if(!empty($_POST['btnAdd'])){

	$parent_id = $_POST['selectSection'];
	$name = $_POST['nameSection'];

	if($parent_id=='no')
	{
		$parent_id= 0;
	} 
	$qcreate = "INSERT INTO catalog (parent_id, name) VALUES ('$parent_id', '$name')";
	$query = mysqli_query($db_connect, $qcreate);
}
/*/Добавляем запись в базу*/

/*Получаем все элементы из базы*/
if($result_read = mysqli_query($db_connect, "SELECT * FROM catalog"))
{
	$main_arr = mysqli_fetch_all($result_read,  MYSQLI_ASSOC); 


		/*Наполняем дерево элементами*/
		function generateElemTree(&$treeElem,$parents_arr) {
			 foreach($treeElem as $key=>$item) {
			 if(!isset($item['children'])) {
			 $treeElem[$key]['children'] = array();
			 }
			 if(array_key_exists($key,$parents_arr)) {
			 $treeElem[$key]['children'] = $parents_arr[$key];
			 generateElemTree($treeElem[$key]['children'],$parents_arr);
			 }
			 }
		}
		/*/Наполняем дерево элементами*/
		/*Создаем древовидную структуру*/
		function createTree($arr) {
		 $parents_arr = array();
		 foreach($arr as $key=>$item) {
		 $parents_arr[$item['parent_id']][$item['id']] = $item;
		 }
		 $treeElem = $parents_arr[0];
		 generateElemTree($treeElem,$parents_arr);

		 
		 return $treeElem;
		} 
		/*/Создаем древовидную структуру*/

		$main_arr = createTree($main_arr);
		/*Выводим каталог*/
		function renderTemplate($path,$arr) {
		 $output = '';
		 if(file_exists($path)) {
		 extract($arr);
		 ob_start();
		 include $path;
		 $output = ob_get_clean();
		 }
		 return $output;
		} 
		/*/Выводим каталог*/

}else{
	echo 'Запрос $result_read к базе вернул false';
}
/*/Получаем все элементы из базы*/





require_once('index.inc.php');

?>