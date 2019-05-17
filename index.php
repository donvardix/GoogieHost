<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Main</title>
  </head>
  <body>
    <?php
    require_once 'MyFuncs.php';

    $res = MyFuncs::parser_steam('https://steamcommunity.com/market/search?q=Bracers+of+the+Cavern+Luminar', '#searchResultsRows .market_recent_listing_row');
    print_r($res);

    ?>
  </body>
</html>
