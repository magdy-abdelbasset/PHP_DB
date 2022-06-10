<?php

function ERR_HANDLER($errno, $errstr, $errfile, $errline){
    $msg = "<b>Something bad happened.</b> [$errno] $errstr <br><br>
    <b>File:</b> $errfile <br>
    <b>Line:</b> $errline <br>
    <pre>".json_encode(debug_backtrace(), JSON_PRETTY_PRINT)."</pre> <br>";
    echo $msg;
    return false;
}

function EXC_HANDLER($exception){
    ERR_HANDLER(0, $exception->getMessage(), $exception->getFile(), $exception->getLine());
}

function shutDownFunction() {
    $error = error_get_last();
    if ($error["type"] == 1) {
        ERR_HANDLER($error["type"], $error["message"], $error["file"], $error["line"]);
    }
}
