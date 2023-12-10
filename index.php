<?php
require 'vendor/autoload.php';
require 'src/Render.php';
require 'src/Search.php';
require 'src/Database.php';
use vBulletin\Search\Search;
use vBulletin\Search\Render;

$db = Database::connect();

$render = new Render();
$search = new Search($db, $render);

$search->doSearch($_REQUEST);
