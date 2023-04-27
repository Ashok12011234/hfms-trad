<?php

class MyIterator extends Iterator
{
    private int $position;
    private array $array;  

    public function __construct(array $array) {
        $this->position = 0;
        $this->array = $array;
    }

    public function rewind() {
        $this->position = 0;
    }

    public function current() {
        return $this->array[$this->position];
    }

    public function key() {
        return $this->position;
    }

    public function next() {
        ++$this->position;
    }

    public function valid() {
        return isset($this->array[$this->position]);
    }
}

?>