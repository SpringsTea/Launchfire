<?

$color = $_REQUEST['c'];

try{
	if( is_null($color) || strlen(utf8_decode($color)) < 1 ){
		throw new Exception( "Empty string: '{$color}'");
	}

	if( is_numeric($color) ){
		throw new Exception( "Numeric String: '{$color}'");
		
	}

} catch (Exception $e){
	echo json_encode(array(
		'success' => false,
		'error' => array(
			'msg' => $e->getMessage()
		)
	));
	die();
}

include_once('../connection.php');

$stmt = $db->prepare( "SELECT ENT_Color AS color FROM entries
						ORDER BY ENT_DateTime DESC LIMIT 1" );

$stmt->execute();
$recentEntry = $stmt->fetch(PDO::FETCH_ASSOC);//The most recently entered record color

$stmt = $db->prepare( "INSERT INTO entries (ENT_Color) VALUES (:color)" );
$stmt->bindParam(':color', $color);

$stmt->execute();//Create new record with $color

$isDuplicate = false;
if( $recentEntry['color'] == $color ){
	$isDuplicate = true;
}

echo json_encode(array(
	'success' => $isDuplicate,
	'value' => $color
));


?>