<?php
namespace tanmay\ValidatorSanitizer;

trait is_required{
    public function rule_required(array $fields)
    {
        $this->register_configuration('is_required', $fields, true);

        return $this;
    }
    private function is_required(string $fName): void
    {
        $data = $this->sourceData[$fName];
        $fNameAlias = $this->fieldAliases[$fName];

        $ret = self::_is_required($data);

        if (!$ret) $this->register_errors(($fNameAlias ? $fNameAlias : $fName) . " is required, please provide");
    }
    public static function _is_required(string $data): bool
    {
        if (mb_strlen($data)) return true;
        else return false;
    }
}