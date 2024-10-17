<?php

require __DIR__ . "/Node.php";

class DoublyLinkedList
{
    private ?Node $head = null;

    private ?Node $tail = null;

    private int $length = 0;

    public function __construct()
    {
        $this->head = new Node(null);
        $this->tail = new Node(null);

        $this->head->next = $this->tail;
        $this->tail->prev = $this->head;
    }

    public function insert($value, int $index = 0)
    {
        if ($index > $this->length) {
            throw new Exception('your selected index is bigger than list length.');
        }

        $temp = $this->head;
        for ($i = 0; $i < $index; $i++) {
            $temp = $temp->next;
        }

        $newNode  = new Node($value, $temp, $temp->next);
        $temp->next = $newNode;
        $newNode->next->prev = $newNode;

        $this->length++;
    }

    public function delete($value)
    {
        if ($this->length === 0) {
            return false;
        }

        $temp = $this->head;
        while ($temp->next !== $this->tail) {
            if ($temp->next->value === $value) {
                $temp->next = $temp->next->next;
                $temp->next->prev = $temp;
                $this->length--;
                return true;
            }

            $temp = $temp->next;
        }

        return false;
    }

    public function search($value): bool
    {
        if ($this->length === 0) {
            return false;
        }

        $temp = $this->head;
        while ($temp->next !== $this->tail) {
            if ($temp->next->value === $value) {
                return true;
            }

            $temp = $temp->next;
        }

        return false;
    }


    public function __toString(): string
    {
        $output = "\n";
        if ($this->length === 0) {
            return $output . "Empty";
        }

        $temp = $this->head;
        while ($temp->next !== $this->tail) {
            $value = $temp->next->value;
            $temp = $temp->next;
            $output .= " $value ";
            if ($temp->next !== $this->tail) {
                $output .=  "<-->";
            }
        }

        return $output;
    }
}

function Menue(DoublyLinkedList $list)
{
    $message = "\nOperations: \n";
    $operations = [];
    $operations = ['insert', 'delete', 'search', 'print'];


    foreach ($operations as $index => $operation) {
        $lable = $index + 1;
        $message .= "$lable- $operation\n";
    }

    return [$message, $operations];
}

function takeAction(string $operation, array $operations, DoublyLinkedList $list)
{
    if (in_array($operation, $operations)) {
        if ($operation == 'insert') {
            echo "\033[35mWhat do you want to insert: ";
            $element = readline();
            echo "\033[35mAt what index : ";
            $index = readline();
            $list->insert($element, $index);
            echo "\033[35m### '$element' inserted at position $index." . PHP_EOL;
        } elseif ($operation == 'delete') {
            echo "\033[35mWhat do you want to delete: ";
            $element = readline();
            $list->delete($element);
            echo "\033[35m### " . $element . " deleted."  . PHP_EOL;
        } elseif ($operation == 'search') {
            echo "\033[35mWhat are you looking for: ";
            $element = readline();
            echo "\033[35m### " . $element . ($list->search($element) ? " Found.\n" : " Not Found\n");
        } elseif ($operation == 'print') {
            echo "\033[35mlist: " . $list . PHP_EOL;
        }
    } else {
        echo "\033[31m### invalid operation, select from " . implode(',', $operations) . PHP_EOL;
    }
}
