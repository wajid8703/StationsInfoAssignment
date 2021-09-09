<?php

$url = "https://gbfs.urbansharing.com/oslobysykkel.no/station_information.json";

$stations_data = array();
$headers = array(
   "Client-Identifier: IDENTIFIER",
   "Content-Type: application/json",
);

$curl = curl_init($url);
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);


$resp = curl_exec($curl);
curl_close($curl);
$response = json_decode($resp);

foreach ($response->data->stations as $key => $value) {
	$station_id = $value->station_id;
	$station_name = $value->name;
	$capacity = $value->capacity;

	$url2 = "https://gbfs.urbansharing.com/oslobysykkel.no/station_status.json";
	$curl2 = curl_init($url2);
	curl_setopt($curl2, CURLOPT_URL, $url2);
	curl_setopt($curl2, CURLOPT_HTTPHEADER, $headers);
	curl_setopt($curl2, CURLOPT_RETURNTRANSFER, true);


	$resp2 = curl_exec($curl2);
	curl_close($curl2);
	$response2 = json_decode($resp2);
	foreach ($response2->data->stations as $key => $value) {
		if($value->station_id == $station_id){
			$stations_data[$key]['id'] = $station_id;
			$stations_data[$key]['name'] = $station_name;
			$stations_data[$key]['capacity'] = $capacity;
			$stations_data[$key]['num_bikes_available'] = $value->num_bikes_available;
		}
		
	}
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Stations Information</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
  <h2>Stations Information</h2>         
  <table class="table table-bordered">
    <thead>
      <tr>
        <th>Station ID</th>
        <th>Station Name</th>
        <th>Station Capacity</th>
        <th>Number of Bikes Available</th>
      </tr>
    </thead>
    <tbody>
    	<?php
    		$html = "";
    		foreach ($stations_data as $key => $value) {
    			$html .='<tr>';
			        $html .='<td>'.$value['id'].'</td>';
			        $html .='<td>'.$value['name'].'</td>';
			        $html .='<td>'.$value['capacity'].'</td>';
			        $html .='<td>'.$value['num_bikes_available'].'</td>';
			    $html .='</tr>';
    		}
    		echo $html;
    	?>
      
    </tbody>
  </table>
</div>

</body>
</html>
