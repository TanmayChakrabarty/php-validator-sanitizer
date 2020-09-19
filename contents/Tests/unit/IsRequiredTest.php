<?php


namespace tanmay\ValidatorSanitizerTests\unit;

use tanmay\ValidatorSanitizer\validator;
use PHPUnit\Framework\TestCase;

class IsRequiredTest extends TestCase
{
    /**
     * @dataProvider dataGenerator
     * @param string $data
     * @param bool $expected
     */
    public function testIsRequiredWithData(string $data, bool $expected){
        $validator = new validator(['username' => $data]);
        $validator->rule_required(['username']);

        self::assertSame($expected, $validator->validate());
    }

    public function dataGenerator(){
        return [
            ['', false],
            ['tanmay', true],
        ];
    }
}