<?php
namespace tanmay\ValidatorSanitizer;

trait is_min_length{
    public function rule_min_length(array $fields, int $length)
    {
        $this->register_configuration('is_min_length', $fields, $length);

        return $this;
    }
    private function is_min_length(string $fName, float $length): void
    {
        $data = $this->sourceData[$fName];
        $fNameAlias = $this->fieldAliases[$fName];

        $ret = self::_is_min_length($data, $length);

        if (!$ret) $this->register_errors(($fNameAlias ? $fNameAlias : $fName) . " should contain minimum ".$length." characters");
    }
    public static function _is_min_length(string $data, float $length): bool
    {
        if ($data >= $length) return true;
        else return false;
    }
}