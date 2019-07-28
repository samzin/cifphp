<?php
/** Search city based on country
* @author : Prem Tiwair <www.freewebmentor.com>
*/

#include database configuration file
require_once('php/php/functions.php');
$Solvent_id = $_GET['Solventrate_id'];
$regions_data=mysqli_query($db,"SELECT * FROM solvent where solid=$Solvent_id");
$regions = array();
while($region = mysqli_fetch_assoc($regions_data)){
	array_push($regions, $region);
}
print_r(json_encode($regions));

?>