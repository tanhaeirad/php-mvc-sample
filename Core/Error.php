<?php namespace Core;

use Exception;

class Error
{

    public static function errorHandler($level , $message , $file , $line)
    {
        if(error_reporting() !== 0) {
            throw new \ErrorException($message , 0 , $level , $file , $line);
        }
    }

    public static function exceptionHandler(Exception $exception) {
        $code = $exception->getCode();
        if($code != 404) {
            $code = 500;
        }

        http_response_code($code);

        if(_env('APP_DEBUG', false)) {
            echo "<h1>Fatal error</h1>";
            echo "<p>Uncaught exception: '" . get_class($exception) . "'</p>";
            echo "<p>Message : '" . $exception->getMessage() . "'</p>";
            echo "<p>Stack trace: <pre>" . $exception->getTraceAsString() . "</pre></p>";
            echo "<p>Thrown in '" . $exception->getFile() . "' on line " . $exception->getLine() . "</p>";
        } else {

            $log = dirname(__DIR__) . '/storage/logs/' . date('Y-m-d') . '.txt';
            $message = "Fatal error\n";
            $message .= "Uncaught exception: '" . get_class($exception) . "'\n";
            $message .= "Message : '" . $exception->getMessage() . "'\n";
            $message .= "Stack trace: " . $exception->getTraceAsString() . "\n";
            $message .= "Thrown in '" . $exception->getFile() . "' on line " . $exception->getLine() . "\n";
            $message .= "**********************************************";
            $message .= "\n\n\n\n\n";

            file_put_contents($log,$message,FILE_APPEND);

            echo Views::renderWithBlade("errors.{$code}");

        }


    }

}