<html>
  <!-- [START csslink] -->
  <head>
    <link type="text/css" rel="stylesheet" href="/stylesheets/main.css" />
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Auto Complete</title>
    <style>
        .ui-autocomplete-loading {
            background: white url("images/ui-anim_basic_16x16.gif") right center no-repeat;
        }
    </style>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="/resources/demos/style.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <link rel="stylesheet" type="text/css" href="jquery-ui.css">
    <?php
    // include your composer dependencies
require_once 'vendor/autoload.php';

$client = new Google_Client();
$client->setApplicationName("autocomplete");
$client->setDeveloperKey("AIzaSyDNyjmUVd_nrmYwpiphtZkHSD1Ashhzdgk");

$service = new Google_Service_Books($client);
$optParams = array('filter' => 'free-ebooks');
$results = $service->volumes->listVolumes('Henry David Thoreau', $optParams);

$term = array();
$j=0;
foreach ($results as $i => $item) {
  echo $item['volumeInfo']['title'], "<br /> \n";
  $term[$j++] = $item['volumeInfo']['title'];
}
?>

    <script>
    $(function() {
        var availableTags = <?php echo json_encode($term); ?>;
        $("#tags").autocomplete({
            source: availableTags
        });
    });
    </script>
  </head>
  <!-- [END csslink] -->
  <body>

<div class="ui-widget">
    <label for="tags">Tags: </label>
    <input id="tags">
</div>
</body>

</html>
