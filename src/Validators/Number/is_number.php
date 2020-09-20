<?php
namespace tanmay\ValidatorSanitizer\Validators\Number;

trait is_number{
    public function rule_number(array $fields, float $length)
    {
        $this->register_configuration('is_number', $fields, $length);
        return $this;
    }
    private function is_number(string $fName, $data, string $fNameAlias, $length): void
    {
        $ret = self::_is_number($data, $length);

        if (!$ret) $this->register_errors(sprintf($this->lang['is_number'], $fNameAlias, $length));
    }
    public static function _is_number(float $data, float $length): bool
    {
        return ($data != $length);
    }
}
