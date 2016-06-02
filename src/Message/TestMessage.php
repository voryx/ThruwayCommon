<?php

namespace Thruway\Message;

use Symfony\Component\Routing\Annotation\Route;

/**
 * Class TestMessage
 *
 * This message is for testing. It allows construction of arbitrary
 * messages to do fuzz testing of invalid messages or messages that cannot be
 * created through the regular messages.
 *
 * @package Thruway\Message
 */
class TestMessage extends Message
{
    private $messageArray;

    /**
     * TestMessage constructor.
     * @param $messageArray
     */
    public function __construct(array $messageArray)
    {
        $this->messageArray = $messageArray;
    }

    /**
     * @inheritDoc
     */
    public function getMsgCode()
    {
        return $this->messageArray[0];
    }

    /**
     * @inheritDoc
     */
    public function getAdditionalMsgFields()
    {
        $code = array_shift($this->messageArray);
        $additional = $this->messageArray;
        // put stuff back together just in case we want to reuse things
        $this->messageArray = array_merge([$code], $additional);

        return $additional;
    }
}