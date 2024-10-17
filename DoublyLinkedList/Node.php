<?php

class Node
{
    public function __construct(public $value, public ?Node $prev = null, public ?Node $next = null) {}
}
