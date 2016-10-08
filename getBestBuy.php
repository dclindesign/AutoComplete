<!DOCTYPE html>
<html>
<body>

<?php
$requestUrl="http://api.bestbuy.com/v1/products(name=*)?format=json&show=name&apiKey=tbfysysru7tnt8cs2ja2zec7";
$data=file_get_contents($requestUrl);
$json = json_decode($data, true);

foreach($json['products'] as $products) {
  echo $products['name'] . '<br />';
}
?>

</body>
</html>
