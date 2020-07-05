<?php 

declare(strict_types = 1);

namespace App\Helper;

define('ROOT', dirname(__DIR__));

class View 
{
    private $data = [];
    private $render = FALSE;
    

    public function __construct($template)
    {
        $file = ROOT . '/views/' . strtolower($template) . '.php';
            if (file_exists($file)) {
                $this->render = $file;
            } else {
                echo "<h1>Template not found</h1>";
            }
    }

    public function assign($variable, $value)
    {
        $this->data[$variable] = $value;
    }

    public function __destruct()
    {
        extract($this->data);
        include($this->render);
    }
}