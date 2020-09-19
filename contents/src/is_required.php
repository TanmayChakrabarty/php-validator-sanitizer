<?php

namespace tanmay\ValidatorSanitizer;

trait is_required
{
    public function rule_required(array $fields)
    {
        $this->register_configuration('is_required', $fields, true);

        return $this;
    }

    private function is_required(string $fName, $data, string $fNameAlias, $param): void
    {
        $ret = self::_is_required($data);

        if (!$ret) $this->register_errors(sprintf($this->lang['is_required'], $fNameAlias));
    }

    public static function _is_required(string $data): bool
    {
        if (mb_strlen($data)) return true;
        else return false;
    }
}