<?php

require_once 'Controllers/Parser.php';
require_once 'Controllers/Db.php';

$arr = Parser::get_data('https://steamcommunity.com/market/search?q=Bracers+of+the+Cavern+Luminar', '#searchResultsRows .market_recent_listing_row');
Db::send($arr);

?>
