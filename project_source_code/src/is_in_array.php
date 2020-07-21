<?php
namespace tanmay\ValidatorSanitizer;

trait is_in_array{
    public function rule_in_array(array $fields, array $list, bool $showListInErrorMsg = false)
    {
        $this->register_configuration('is_in_array', $fields, ['list' => $list, 'showListInErrorMsg' => $showListInErrorMsg]);
        return $this;
    }
    private function is_in_array(string $fName, $data, string $fNameAlias, array $param): void
    {
        $list = $param['list'];
        $showListInErrorMsg = $param['showListInErrorMsg'];

        $ret = self::_is_in_array($data, $list);

        if (!$ret) {
            if ($showListInErrorMsg) $eMsg = sprintf($this->lang['is_in_array_with_list'], $fNameAlias, implode(', ', $list));
            else $eMsg = sprintf($this->lang['is_in_array'], $fNameAlias);

            $this->register_errors($eMsg);
        };
    }
    public static function _is_in_array(string $data, array $list): bool
    {
        if (in_array($data, $list) !== false) return true;
        else return false;
    }
}