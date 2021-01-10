<?php

declare(strict_types=1);

require __DIR__.'/../../vendor/autoload.php';

use Superrosko\ExamplePhpFFI\WindowsApi\MessageBoxA;

$uType = MessageBoxA::MB_ICONINFORMATION | MessageBoxA::MB_OKCANCEL;

echo 'uType = '.$uType.PHP_EOL;

$msgboxID = (new MessageBoxA(null, 'Hello World!!!', 'MessageBox from PHP!', $uType))->call();

echo 'Return code = '.$msgboxID.PHP_EOL;
switch ($msgboxID) {
    case MessageBoxA::IDOK:
        echo 'The OK button was selected.';
        break;
    case MessageBoxA::IDCANCEL:
        echo 'The Cancel button was selected.';
        break;
}
