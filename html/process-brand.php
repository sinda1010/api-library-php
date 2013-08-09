<?
if (isset($_POST['param']) && trim($_POST['param']) != ''){
	parse_str(trim($_POST['param']), $newData);
	$newData['id'] = trim($newData['id']);
	$newData['id'] .= '';
	if ($newData['id'] == '')
		$data = array('result' => 'fail');
	else{
		require_once ('../nutritionix.v1.1.php');
		$nutritionix = new Nutritionix($newData['apiID'], $newData['apiKey']);
		$data = $nutritionix -> getBrand($newData['id'], (bool)$newData['return_result_as_json'], (bool)$newData['return_request_url']);
	}
}else
	$data = array('result' => 'fail');

if ( (bool)$newData['return_result_as_json'] ){
	header('Cache-Control: no-cache, must-revalidate');
	header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
	header('Content-Type: application/json');
	echo json_encode($data);
}else
	print_r($data);
exit;
?>