<?php


namespace tanmay\ValidatorSanitizerTests\unit;

use tanmay\ValidatorSanitizer\validator;
use PHPUnit\Framework\TestCase;

class IsMaxNumberTest extends TestCase
{
    //todo: create test for no data given
    //todo: create test for index not found
    //todo: create test for float numbers

    /**
     * @dataProvider dataGenerator
     * @param string $data
     * @param float $maxNumber
     * @param bool $expected
     */

    public function testIsMaxNumberWithData(string $data, float $maxNumber, bool $expected){
        $validator = new validator(['salary' => $data]);
        $validator->rule_max_number(['salary'], $maxNumber);

        self::assertSame($expected, $validator->validate());
    }

    public function dataGenerator(){
        return [
            ['25000', 30000, true],
            ['30000', 30000, true],
            ['35000', 30000, false],
        ];
    }
}