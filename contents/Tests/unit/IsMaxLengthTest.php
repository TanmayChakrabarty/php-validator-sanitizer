<?php


namespace tanmay\ValidatorSanitizerTests\unit;

use tanmay\ValidatorSanitizer\validator;
use PHPUnit\Framework\TestCase;

class IsMaxLengthTest extends TestCase
{
    /**
     * @dataProvider dataGenerator
     * @param string $data
     * @param int $maxLen
     * @param bool $expected
     */
    public function testIsMaxLengthWithData(string $data, int $maxLen, bool $expected){
        $validator = new validator(['username' => $data]);
        $validator->rule_max_length(['username'], $maxLen);

        self::assertSame($expected, $validator->validate());
    }

    public function dataGenerator(){
        return [
            ['tan', 4, true],
            ['tanm', 4, true],
            ['tanmay', 4, false],
        ];
    }
}