<?php


class Queue
{
    public array $queue = [];

    public int $size = 0;

    public int $rear = -1;

    public int $front = -1;

    public int $count = 0;

    public function __construct(int $size)
    {
        $this->setSize($size);
    }

    public function enqueue($element)
    {
        if ($this->isFull()) {
            return "Queue is Full." . PHP_EOL;
        }

        if ($this->isEmpty()) {
            $this->front += 1;
        }

        $this->rear =  ($this->rear + 1) % $this->size;

        $this->queue[$this->rear] = $element;

        $this->count += 1;
    }

    public function dequeue(): mixed
    {
        if ($this->isEmpty()) {
            return "Queue is Empty." . PHP_EOL;
        }

        $returnValue = $this->queue[$this->front];

        $this->front = ($this->front + 1) % $this->size;

        $this->count -= 1;

        if ($this->isEmpty()) {
            $this->front = -1;
            $this->rear = -1;
        }

        return $returnValue;
    }

    public function isEmpty(): bool
    {
        return $this->count <= 0;
    }

    public function isFull(): bool
    {
        return  $this->count >= $this->size;
    }

    public function peek(): mixed
    {
        if ($this->isEmpty()) {
            return "Queue is Empty." . PHP_EOL;
        }

        return $this->queue[$this->front];
    }

    public function __toString(): string
    {
        if ($this->isEmpty()) {
            return "Queue is Empty." . PHP_EOL;
        }

        $front = $this->front;
        $rear = $this->rear;
        $queue = $this->queue[$front] ?? "";

        while ($front < $rear) {
            $front = ($front + 1) % $this->size;
            $queue .= (", " . $this->queue[$front]);
        }

        return $queue . PHP_EOL;
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

function menue(Queue $queue)
{
    $message = "\nOperations: \n";
    $operations = [];
    if (!$queue->isFull())
        $operations[] = 'enqueue';

    if (!$queue->isEmpty()) {
        $operations[] = 'dequeue';
        $operations[] = 'peek';
    }

    $operations[] = 'print';

    foreach ($operations as $index => $operation) {
        $lable = $index + 1;
        $message .= "$lable- $operation\n";
    }

    return [$message, $operations];
}

function takeAction(string $operation, array $operations, $queue)
{
    if (in_array($operation, $operations)) {
        if ($operation == 'enqueue') {
            echo "\033[35mWhat do you want to enqueu: ";
            $element = readline();
            $queue->enqueue($element);
            echo "\033[35m### '$element' enqueued to Queue." . PHP_EOL;
        } elseif ($operation == 'dequeue') {
            echo "\033[35m### " . $queue->dequeue() . " dequeued from Queue"  . PHP_EOL;
        } elseif ($operation == 'peek') {
            echo "\033[35m### " . $queue->peek() . " peeked from Queue" . PHP_EOL;
        } elseif ($operation == 'print') {
            echo "\033[35mqueue: " . $queue . PHP_EOL;
        }
    } else {
        echo "\033[31m### invalid operation, select from " . implode(',', $operations) . PHP_EOL;
    }
}
