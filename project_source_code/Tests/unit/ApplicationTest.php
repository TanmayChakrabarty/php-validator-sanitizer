<?php


namespace tanmay\ValidatorSanitizerTests\unit;

use PHPUnit\Framework\TestCase;
use tanmay\ValidatorSanitizer\validator;

class ApplicationTest extends TestCase
{
    public function testAppCanBeInitialized()
    {
        self::assertInstanceOf(validator::class, new validator([],[]));
    }
}