<?php


namespace tanmay\ValidatorSanitizerTests\unit;

use tanmay\ValidatorSanitizer\validator;
use PHPUnit\Framework\TestCase;

class IsMinLengthTest extends TestCase
{
    /**
     * @dataProvider dataGenerator
     * @param string $data
     * @param int $minLength
     * @param bool $expected
     */
    public function testIsMinLengthWithData(string $data, int $minLength, bool $expected){
        $validator = new validator(['username' => $data]);
        $validator->rule_min_length(['username'], $minLength);

        self::assertSame($expected, $validator->validate());
    }

    public function dataGenerator(){
        return [
            ['tan', 4, false],
            ['tanm', 4, true],
            ['tanmay', 4, true],
        ];
    }
}