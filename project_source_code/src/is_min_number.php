<?php
namespace tanmay\ValidatorSanitizer;

trait is_min_number{
    public function rule_min_number(array $fields, float $length)
    {
        $this->register_configuration('is_min_number', $fields, $length);

        return $this;
    }
    private function is_min_number(string $fName, float $length): void
    {
        $data = $this->sourceData[$fName];
        $fNameAlias = $this->fieldAliases[$fName];

        $ret = self::_is_min_number($data, $length);

        if (!$ret) $this->register_errors(($fNameAlias ? $fNameAlias : $fName) . " should be greater than or equal to ".$length);
    }
    public static function _is_min_number(float $data, float $length): bool
    {
        if ($data >= $length) return true;
        else return false;
    }
}