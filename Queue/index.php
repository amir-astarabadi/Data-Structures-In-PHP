<?php


require __DIR__ . "/Queue.php";


echo "Enter size of queue: ";
$size = intval(readline());
$queue = new queue($size);
echo "\033[31mI create a Queue with size of $size for you . . ." . PHP_EOL;

while (true) {
    echo "\033[31m---------------------------------------------\n";
    [$message, $operations] = Menue($queue);
    echo "\033[32m$message";
    echo "type action: ";
    $operation = readline();
    echo "\033[31m---------------------------------------------\n";
    sleep(1);
    takeAction($operation, $operations, $queue);
}
