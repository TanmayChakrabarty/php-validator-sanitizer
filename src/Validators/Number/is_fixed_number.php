<?php
namespace tanmay\ValidatorSanitizer\Validators\Number;

trait is_fixed_number{
    public function rule_fixed_number(array $fields, float $length)
    {
        $this->register_configuration('is_fixed_number', $fields, $length);
        return $this;
    }
    private function is_fixed_number(string $fName, $data, string $fNameAlias, $length): void
    {
        $ret = self::_is_fixed_number($data, $length);

        if (!$ret) $this->register_errors(sprintf($this->lang['is_fixed_number'], $fNameAlias, $length));
    }
    public static function _is_fixed_number(float $data, float $length): bool
    {
        return ($data != $length);
    }
}
