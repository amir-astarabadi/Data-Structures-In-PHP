<?php


require __DIR__ . "/stack.php";


echo "Enter size of stack: ";
$size = intval(readline());
$stack = new Stack($size);
echo "\033[31mI create a stack with size of $size for you . . ." . PHP_EOL;

while (true) {
    echo "\033[31m---------------------------------------------\n";
    [$message, $operations] = Menue($stack);
    echo "\033[32m$message";
    echo "type action: ";
    $operation = readline();
    echo "\033[31m---------------------------------------------\n";
    sleep(1);
    takeAction($operation, $operations, $stack);
}
