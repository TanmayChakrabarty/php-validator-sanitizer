<?php
namespace tanmay\ValidatorSanitizer;

trait is_length{
    public function rule_length(array $fields, int $length)
    {
        $this->register_configuration('is_length', $fields, $length);

        return $this;
    }
    private function is_length(string $fName, $data, string $fNameAlias, $length): void
    {
        $ret = self::_is_length($data, $length);

        if (!$ret) $this->register_errors($fNameAlias . " should contain only ".$length." characters");
    }
    public static function _is_length(string $data, float $length): bool
    {
        if (mb_strlen($data) == $length) return true;
        else return false;
    }
}