<?php

declare(strict_types=1);

namespace App\Model;

class Cart implements \ArrayAccess
{
    public function __construct(private array $lines)
    {
    }

    /**
     * Checks the existence of the an element in the given offset.
     *
     * @param mixed $offset
     *
     * @return bool
     */
    public function offsetExists($offset): bool
    {
        return true === isset($this->lines[$offset]);
    }

    /**
     * Get the CartLine by offset.
     *
     * @param mixed $offset
     *
     * @return mixed the order line
     */
    public function offsetGet($offset): mixed
    {
        if ($this->offsetExists($offset) === true) {
            return $this->lines[$offset];
        }

        return null;
    }

    /**
     * Sets the new value in the given offset.
     *
     * @param mixed $offset
     * @param mixed $value
     */
    public function offsetSet($offset, $value): void
    {
        $this->lines[$offset] = $value;
    }

    /**
     * Unsets the given offset.
     *
     * @param mixed $offset
     */
    public function offsetUnset($offset): void
    {
        if (true === $this->offsetExists($offset)) {
            unset($this->lines[$offset]);
        }
    }
}