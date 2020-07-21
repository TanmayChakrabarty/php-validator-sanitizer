<?php


namespace tanmay\ValidatorSanitizerTests\unit;

use tanmay\ValidatorSanitizer\validator;
use PHPUnit\Framework\TestCase;

class IsLengthTest extends TestCase
{
    /**
     * @dataProvider dataGenerator
     * @param string $data
     * @param int $len
     * @param bool $expected
     */
    public function testIsLengthWithData(string $data, int $len, bool $expected){
        $validator = new validator(['username' => $data]);
        $validator->rule_length(['username'], $len);

        self::assertSame($expected, $validator->validate());
    }

    public function dataGenerator(){
        return [
            ['tan', 4, false],
            ['tanm', 4, true],
            ['tanmay', 4, false],
        ];
    }
}