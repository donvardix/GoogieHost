<?php

require_once 'MyFuncs.php';

$arr = Parser::get_data('https://steamcommunity.com/market/search?q=Bracers+of+the+Cavern+Luminar', '#searchResultsRows .market_recent_listing_row');
DB::send($arr);

?>
