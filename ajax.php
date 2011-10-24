<?php

mysql_connect('localhost', 'username', 'password') or die(mysql_error());
mysql_select_db('dbname') or die(mysql_error());


//User's latitude and longitude.
$latitude = $_GET['latitude']; //clean me
$longitude = $_GET['longitude']; //clean me

/*
 What can you do with this information?
 Well... if you have a database full of businesses with their latitudes and longitudes, you can
 return to the user a list of businesses close to them, letting the user know his/her distance
 from the business.
*/

/*
$maxdistance = 10; //10 miles
$query = "SELECT *,((ACOS(SIN($latitude * PI() / 180) * SIN(latitude * PI() / 180) + COS($latitude * PI() / 180) * COS(latitude * PI() / 180) * COS(($longitude - longitude) * PI() / 180)) * 180 / PI()) * 60 * 1.1515) AS `distance` FROM businesses HAVING distance<$maxdistance";
*/
$query = "SELECT *,((ACOS(SIN($latitude * PI() / 180) * SIN(latitude * PI() / 180) + COS($latitude * PI() / 180) * COS(latitude * PI() / 180) * COS(($longitude - longitude) * PI() / 180)) * 180 / PI()) * 60 * 1.1515) AS `distance` FROM businesses";

$us = mysql_query($query) or die(mysql_error());
if(mysql_num_rows($us) == 0)
{
	die('No businesses found within '.$distance.' miles of you');
}
while($ur = mysql_fetch_assoc($us))
{
        print '
        Business: '.$ur['name'].'<br />
        Distance: '.number_format($ur['distance'],1).'<br />
        ';
}


?>