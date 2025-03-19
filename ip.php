<?php
// ip.php
$ip = $_SERVER['REMOTE_ADDR'];
$api_url = "http://ip-api.com/json/{$ip}";

$ch = curl_init($api_url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_TIMEOUT, 5);
$response = curl_exec($ch);
$curlError = curl_error($ch);
curl_close($ch);

if ($response === false) {
    error_log("Failed to fetch IP details for: $ip. cURL error: $curlError");
    $data = [];
} else {
    $data = json_decode($response, true);
}

$lat = $data['lat'] ?? 'Unknown';
$lon = $data['lon'] ?? 'Unknown';
$city = $data['city'] ?? 'Unknown';
$country = $data['country'] ?? 'Unknown';
$status = $data['status'] ?? 'fail';

error_log("IP Lookup: IP={$ip}, Status={$status}, City={$city}, Country={$country}, Lat={$lat}, Lon={$lon}");

if ($status !== 'success') {
    $lat = $lon = $city = $country = 'N/A';
}

header('Content-Type: application/json');
echo json_encode([
    'ip'      => $ip,
    'lat'     => $lat,
    'lon'     => $lon,
    'city'    => $city,
    'country' => $country
]);
?>
