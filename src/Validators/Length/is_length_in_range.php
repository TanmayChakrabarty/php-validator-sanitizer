<?php
namespace tanmay\ValidatorSanitizer\Validators\Length;

trait is_length_in_range{
    public function rule_length_in_range(array $fields, int $minLength, int $maxLength)
    {
        $param = new \stdClass();
        $param->min = $minLength;
        $param->max = $maxLength;

        $this->register_configuration('is_length_in_range', $fields, $param);

        return $this;
    }
    private function is_length_in_range(string $fName, object $param): void
    {
        $default = new \stdClass();
        $default->min = 0;
        $default->max = 1;

        $default = (object) array_replace_recursive((array) $default, (array) $param);

        $data = $this->sourceData[$fName];
        $fNameAlias = $this->fieldAliases[$fName];

        $ret = self::_is_length_in_range($data, $default->min, $default->max);

        if (!$ret) $this->register_errors(sprintf($this->lang['is_length_in_range'], $fNameAlias, $default->min, $default->max));
    }
    public static function _is_length_in_range(string $data, int $min, int $max): bool
    {
        $dataLength = mb_strlen($data);
        if ($dataLength >= $min && $dataLength <= $max) return true;
        else return false;
    }
}