<?php

declare(strict_types=1);

class MyCustomHandler implements \SessionHandlerInterface
{

    public function close()
    {
        // TODO: Implement close() method.
    }

    public function destroy($id)
    {
        // TODO: Implement destroy() method.
    }

    public function gc($max_lifetime)
    {
        // TODO: Implement gc() method.
    }

    public function open($path, $name)
    {
        // TODO: Implement open() method.
    }

    public function read($id)
    {
        // TODO: Implement read() method.
    }

    public function write($id, $data)
    {
        // TODO: Implement write() method.
    }
}