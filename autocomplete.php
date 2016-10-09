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
  <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="https://jqueryui.com/resources/demos/style.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <?php
    // include your composer dependencies
require_once 'vendor/autoload.php';

$client = new Google_Client();
$client->setApplicationName("autocomplete");
$client->setDeveloperKey("AIzaSyDNyjmUVd_nrmYwpiphtZkHSD1Ashhzdgk");

$service = new Google_Service_Books($client);
//$optParams = array('filter' => 'full');

$results = $service->volumes->listVolumes('*');


$term = array();
$j=0;
foreach ($results as $i => $item) {
  echo $item['volumeInfo']['title'], "<br /> \n";
  $term[$j++] = $item['volumeInfo']['title'];
}
//$memcache = new Memcache;
//return $memcache->set($key, $term);

//$termcache = array();
// Simple HTTP GET and PUT operators.
//$termcache->get('/memcache/{key}', function ($key) {
    # [START memcache_get]
//    $memcache = new Memcache;
//    return $memcache->get($key);
    # [END memcache_get]
//});
$page = file_get_contents("https://www.googleapis.com/books/v1/volumes?q=isbn:9789381141977");

$data = json_decode($page, true);

$booktitle = "Title = " . $data['items'][0]['volumeInfo']['title'];
$bookAuthor =  "Authors = " . @implode(",", $data['items'][0]['volumeInfo']['authors']);
$bookcount = "Pagecount = " . $data['items'][0]['volumeInfo']['pageCount'];
?>

    <script>
    $(function() {
      function log( message ) {
      $( "<div>" ).text( message ).prependTo('#log');
      $( "#log" ).scrollTop( 0 );
    }
        var availableTags = <?php echo json_encode($term); ?>;
        $("#tags").autocomplete({
            minLength: 0,
            source: availableTags,
               select: function( event, ui ) {
                 $("#log").text("Selected: " + ui.item.label + "<br />" + <?php echo json_encode($bookAuthor); ?>);
                  return false;
                }
            });
  });
    </script>
  </head>
  <!-- [END csslink] -->
  <body>

<div class="ui-widget">
    <label for="tags">Product Search </label>
    <input id="tags">
    <div class="ui-widget" style="margin-top:2em; font-family:Arial">
        Result:
        <div id="log" style="height: 50px; width: 300px; overflow: auto;" class="ui-widget-content"></div>
          </div>
</div>
</body>

</html>
