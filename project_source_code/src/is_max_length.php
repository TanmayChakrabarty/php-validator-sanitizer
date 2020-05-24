<?php
namespace tanmay\ValidatorSanitizer;

trait is_max_length{
    public function rule_max_length(array $fields, int $length)
    {
        $this->register_configuration('is_max_length', $fields, $length);

        return $this;
    }
    private function is_max_length(string $fName, float $length): void
    {
        $data = $this->sourceData[$fName];
        $fNameAlias = $this->fieldAliases[$fName];

        $ret = self::_is_max_length($data, $length);

        if (!$ret) $this->register_errors(($fNameAlias ? $fNameAlias : $fName) . " should contain maximum ".$length." characters");
    }
    public static function _is_max_length(string $data, float $length): bool
    {
        if ($data <= $length) return true;
        else return false;
    }
}