<?php
namespace tanmay\ValidatorSanitizer;

trait is_min_length{
    public function rule_min_length(array $fields, int $length)
    {
        $this->register_configuration('is_min_length', $fields, $length);

        return $this;
    }
    private function is_min_length(string $fName, $data, string $fNameAlias, $length): void
    {
        $ret = self::_is_min_length($data, $length);

        if (!$ret) $this->register_errors(sprintf($this->lang['is_min_length'], $fNameAlias, $length));
    }
    public static function _is_min_length(string $data, float $length): bool
    {
        if (mb_strlen($data) >= $length) return true;
        else return false;
    }
}