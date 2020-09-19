<?php
namespace tanmay\ValidatorSanitizer;

trait is_max_number{
    public function rule_max_number(array $fields, float $length)
    {
        $this->register_configuration('is_max_number', $fields, $length);
        return $this;
    }
    private function is_max_number(string $fName, $data, string $fNameAlias, $length): void
    {
        $ret = self::_is_max_number($data, $length);

        if (!$ret) $this->register_errors(sprintf($this->lang['is_max_number'], $fNameAlias, $length));
    }
    public static function _is_max_number(float $data, float $length): bool
    {
        if ($data <= $length) return true;
        else return false;
    }
}
