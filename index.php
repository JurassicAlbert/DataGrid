<?php

declare(strict_types=1);

require_once realpath("vendor/autoload.php");

use App\Service\{
  HttpState,
  HtmlDataGrid,
  DefaultConfig
};

$rows = getRows("./data.json", "GET");

$state = HttpState::create(); // instanceof State
$dataGrid = new HtmlDataGrid(); // instanceof DataGrid
$config = (new DefaultConfig) // instanceof Config
    ->addIntColumn('id', true)
    ->addTextColumn('name')
    ->addIntColumn('age', true)
    ->addTextColumn('company')
    ->addCurrencyColumn('balance', 'USD')
    ->addTextColumn('phone')
    ->addTextColumn('email');

echo $dataGrid->withConfig($config)->render($rows, $state);

function getRows($file, $method="GET")
{
  $opts = [
    'http'=> [
      'method'=>$method,
      'header'=>
        "Accept-language: en\r\n" .
        "Cookie: foo=bar\r\n"
    ]
  ];
  $context = stream_context_create($opts);
  $rows = json_decode(file_get_contents($file, false, $context), true);
  return $rows;
}