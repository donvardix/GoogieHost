<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Main</title>
  </head>
  <body>
    <?php
    require_once 'MyFuncs.php';
    //echo htmlspecialchars( MyFuncs::get_content('https://steamcommunity.com/market/search?q=Bracers+of+the+Cavern+Luminar'));
    //echo MyFuncs::get_content('https://www.google.ru/');

    //echo MyFuncs::parser('http://php.donvardix.pp.ua/test.php', '.qwer');
    //echo MyFuncs::parser('https://steamcommunity.com/market/search?q=Bracers+of+the+Cavern+Luminar', '#searchResultsRows .market_recent_listing_row');
    MyFuncs::parser_f('https://steamcommunity.com/market/search?q=Bracers+of+the+Cavern+Luminar', '#searchResultsRows .market_recent_listing_row');
    //MyFuncs::parser_f('https://www.kolesa.ru/news', '.articles-container .post-excerpt');

    ?>
  </body>
</html>
