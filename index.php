<?php

declare(strict_types=1);
error_reporting(0);
ini_set('display_errors', '0');
session_start();

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
  ->addIntColumn('id', null, true)
  ->addTextColumn('name')
  ->addIntColumn('age', null, true)
  ->addTextColumn('company')
  ->addCurrencyColumn('balance', 'USD')
  ->addTextColumn('phone')
  ->addTextColumn('email');

echo $dataGrid->withConfig($config)->render($rows, $state);

function getRows($file, $method = "GET")
{
  $opts = [
    'http' => [
      'method' => $method,
      'header' =>
      "Accept-language: en\r\n" .
        "Cookie: foo=bar\r\n"
    ]
  ];
  $context = stream_context_create($opts);
  try {
    $rows = json_decode(file_get_contents($file, false, $context), true);
    if (
      is_array($rows) == false
      || empty($rows)
      ) {
      throw new Exception;
    }
    if (is_array($rows)) {
      unset($_SESSION['error']);
      return $rows;
    }
  } catch (Exception $e) {
    header("Location: views/base");
    return $_SESSION["error"] = "Critical Error! Render unvaible!";
  }
}
