<?php

namespace app\core;

class Request
{
    public function getPath(): string
    {
        $path = $_SERVER["REQUEST_URI"] ?? '/';
        $parameterPosition = strpos($path, '?');

        if ($parameterPosition) {
            return substr($path, 0, $parameterPosition);
        }

        return $path;
    }


    public function getMethod(): string
    {
        return mb_strtolower($_SERVER["REQUEST_METHOD"]);
    }


    public function getBody(): array
    {
        $body = [];
        $requestData = ($this->getMethod() === 'get') ? $_GET : $_POST;
        $inputeType = ($this->getMethod() === 'get') ? INPUT_GET : INPUT_POST;



        foreach ($requestData as $key => $value) {
            $body[$key] = filter_input($inputeType, $key, FILTER_SANITIZE_SPECIAL_CHARS);
        }

        echo '<pre>';
        // var_dump($body);
        print(json_encode($body));
        echo '</pre>'; exit;

        
        return $body;
    }

}