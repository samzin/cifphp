<?php
/** Search city based on country
* @author : Prem Tiwair <www.freewebmentor.com>
*/

#include database configuration file
require_once('php/php/functions.php');

$country_id = $_GET['country_id'];
$regions_data=mysqli_query($db,"SELECT * FROM sub_analysis where Aid = $country_id ");
$regions = array();
while($region = mysqli_fetch_assoc($regions_data)){
	array_push($regions, $region);
}
print_r(json_encode($regions));

?>