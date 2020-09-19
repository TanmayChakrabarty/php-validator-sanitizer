<?php
namespace tanmay\ValidatorSanitizer;

trait is_number_in_range{
    public function rule_number_in_range(array $fields, int $minLength, int $maxLength)
    {
        $param = new \stdClass();
        $param->min = $minLength;
        $param->max = $maxLength;

        $this->register_configuration('is_number_in_range', $fields, $param);

        return $this;
    }
    private function is_number_in_range(string $fName, object $param): void
    {
        $default = new \stdClass();
        $default->min = 0;
        $default->max = 1;

        $default = (object) array_replace_recursive((array) $default, (array) $param);

        $data = $this->sourceData[$fName];
        $fNameAlias = $this->fieldAliases[$fName];

        $ret = self::_is_number_in_range($data, $default->min, $default->max);

        if (!$ret) $this->register_errors(sprintf($this->lang['is_number_in_range'], $fNameAlias, $default->min, $default->max));
    }
    public static function _is_number_in_range(string $data, int $min, int $max): bool
    {
        if ($data >= $min && $data <= $max) return true;
        else return false;
    }
}