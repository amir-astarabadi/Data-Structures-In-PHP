<?php


require __DIR__ . "/DoublyLinkedList.php";


echo "Initializing Linked List... \n";
$list = new DoublyLinkedList();

while (true) {
    echo "\033[31m---------------------------------------------\n";
    [$message, $operations] = Menue($list);
    echo "\033[32m$message";
    echo "type action: ";
    $operation = readline();
    echo "\033[31m---------------------------------------------\n";
    sleep(1);
    takeAction($operation, $operations, $list);
}
