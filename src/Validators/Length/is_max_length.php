<?php
namespace tanmay\ValidatorSanitizer\Validators\Length;

trait is_max_length{
    public function rule_max_length(array $fields, int $length)
    {
        $this->register_configuration('is_max_length', $fields, $length);

        return $this;
    }
    private function is_max_length(string $fName, $data, string $fNameAlias, $length): void
    {
        $ret = self::_is_max_length($data, $length);

        if (!$ret) $this->register_errors(sprintf($this->lang['is_max_length'], $fNameAlias, $length));
    }
    public static function _is_max_length(string $data, float $length): bool
    {
        if (mb_strlen($data) <= $length) return true;
        else return false;
    }
}