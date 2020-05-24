<?php
namespace tanmay\ValidatorSanitizer;

trait is_in_list{
    public function rule_in_list(array $fields, array $list, bool $showListInErrorMsg = false)
    {
        $this->register_configuration('is_in_list', $fields, ['list' => $list, 'showListInErrorMsg' => $showListInErrorMsg]);
        return $this;
    }
    private function is_in_list(string $fName, array $param): void
    {
        $data = $this->sourceData[$fName];
        $fNameAlias = $this->fieldAliases[$fName];

        $list = $param['list'];
        $showListInErrorMsg = $param['showListInErrorMsg'];

        $ret = self::_is_in_list($data, $list);

        if (!$ret) {
            if ($showListInErrorMsg) $eMsg = ($fNameAlias ? $fNameAlias : $fName) . " has to be one among " . implode(', ', $list);
            else $eMsg = ($fNameAlias ? $fNameAlias : $fName) . " is not a valid";

            $this->register_errors($eMsg);
        };
    }
    public static function _is_in_list(string $data, array $list): bool
    {
        if (in_array($data, $list) !== false) return true;
        else return false;
    }
}