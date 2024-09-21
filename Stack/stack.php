<?php


class Stack
{
    private array $stack = [];

    private int $size = 0;

    private int $top = -1;

    public function __construct(int $size)
    {
        $this->setSize($size);
    }

    public function push($element)
    {
        if ($this->isFull()) {
            return "Stack is Full." . PHP_EOL;
        }

        $this->stack[++$this->top] = $element;
    }

    public function pop(): mixed
    {
        if ($this->isEmpty()) {
            return "Stack is Empty." . PHP_EOL;
        }

        $returnValue = $this->stack[$this->top];
        unset($this->stack[$this->top--]);

        return $returnValue;
    }

    public function isEmpty(): bool
    {
        return $this->top < 0;
    }

    public function isFull(): bool
    {
        return $this->top == $this->size - 1;
    }

    public function peek(): mixed
    {
        if ($this->isEmpty()) {
            return "Stack is Empty." . PHP_EOL;
        }

        return $this->stack[$this->top];
    }

    public function __toString(): string
    {
        if ($this->isEmpty()) {
            return "Stack is Empty." . PHP_EOL;
        }

        return implode(',', $this->stack) . PHP_EOL;
    }

    private function setSize(int $size)
    {
        if ($size > 0) {
            $this->size = $size;
            return;
        }

        echo "Size can not be less than 1." . PHP_EOL;
    }
}

function Menue(Stack $stack)
{
    $message = "\nOperations: \n";
    $operations = [];
    if (!$stack->isFull())
        $operations[] = 'push';

    if (!$stack->isEmpty()) {
        $operations[] = 'pop';
        $operations[] = 'peek';
    }

    $operations[] = 'print';

    foreach ($operations as $index => $operation) {
        $lable = $index + 1;
        $message .= "$lable- $operation\n";
    }

    return [$message, $operations];
}

function takeAction(string $operation, array $operations, Stack $stack)
{
    if (in_array($operation, $operations)) {
        if ($operation == 'push') {
            echo "\033[35mWhat do you want to push: ";
            $element = readline();
            $stack->push($element);
            echo "\033[35m### '$element' pushed to stack." . PHP_EOL;
        } elseif ($operation == 'pop') {
            echo "\033[35m### " . $stack->pop() . " poped from stack"  . PHP_EOL;
        } elseif ($operation == 'peek') {
            echo "\033[35m### " . $stack->peek() . " peeked from stack" . PHP_EOL;
        } elseif ($operation == 'print') {
            echo "\033[35mstack: " . $stack . PHP_EOL;
        }
    } else {
        echo "\033[31m### invalid operation, select from " . implode(',', $operations) . PHP_EOL;
    }
}
