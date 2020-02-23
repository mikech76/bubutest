<?php

function d($var, $depth = 5)
{
    if (YII_DEBUG) {
        echo '<p style="background-color: #f9f2f4; margin:1px;font-size: 15px;">';

        $tmp_var = debug_backtrace(1);
        $caller  = array_shift($tmp_var);

        echo '<i><code>File: ' . $caller['file'] . ' / Line: ' . $caller['line'] . '</code></i><br>';
        yii\helpers\VarDumper::dump($var, $depth, true);
        echo '</p>';
    }
}

function dd($var, $depth = 5)
{
    if (YII_DEBUG) {
        echo '<p style="background-color: #f9f2f4; margin:1px;font-size: 15px;">';
        yii\helpers\VarDumper::dump($var, $depth, true);
        echo '</p>';
        die();
    }
}


