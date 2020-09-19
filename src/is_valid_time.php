<?php
namespace tanmay\ValidatorSanitizer;

trait is_valid_time{
    /**
     * @param array $fields
     * @param string $format only use y,m & d to indicate positions of year, month and date respectively. do not use separator here
     * @param string $separator Indicate the separator here
     * @param bool $allowSingleDigit
     * @return is_valid_time
     */
    public function rule_valid_time(array $fields, string $format = 'his', string $separator = ':', bool $_24Hours = true, bool $allowSingleDigit = false)
    {
        $param = new \stdClass();
        $param->format = $format;
        $param->separator = $separator;
        $param->_24Hours = $_24Hours;
        $param->allowSingleDigit = $allowSingleDigit;

        $this->register_configuration('is_valid_time', $fields, $param);

        return $this;
    }
    private function is_valid_time(string $fName, object $param): void
    {
        $data_time = $this->sourceData[$fName];
        $fNameAlias = isset($this->fieldAliases[$fName]) ? $this->fieldAliases[$fName] : null;

        $ret = self::_is_valid_time($data_time, $param->format, $param->separator, $param->_24Hours, $param->allowSingleDigit);

        if (!$ret) $this->register_errors(sprintf($this->lang['is_valid_time'], $fNameAlias));
    }
    public static function _is_valid_time(string $time, string $format = 'his', string $separator = ':', bool $_24Hours = true, bool $allowSingleDigit = false): bool
    {
        $allowedTimeFormats = ['his', 'hsi', 'ihs', 'ish', 'shi', 'sih'];

        if (!self::_is_in_array($format, $allowedTimeFormats)) return false;

        $h = null;
        $i = null;
        $s = null;

        $timeParts = explode($separator, $time);

        if (count($timeParts) != 3) return false;

        $formatParts = str_split($format);

        $indexOfH = array_search('h', $formatParts);
        $indexOfI = array_search('i', $formatParts);
        $indexOfS = array_search('s', $formatParts);

        if(!$allowSingleDigit){
            $regexParts = [
                $indexOfH => ($_24Hours ? "((0\d)|(1[0-2])|(1\d)|(2[1-4]))" : "((0\d)|(1[0-2]))"),
                $indexOfI => "[0-5]\d",
                $indexOfS => "[0-5]\d",
            ];
        } else {
            $regexParts = [
                $indexOfH => ($_24Hours ? "((0*\d)|(1[0-2])|(1\d)|(2[1-4]))" : "((0*\d)|(1[0-2]))"),
                $indexOfI => "[0-5]*\d",
                $indexOfS => "[0-5]*\d",
            ];
        }

        ksort($regexParts);

        $pattern = '/^'.implode($separator, $regexParts).'*$/';

        return preg_match($pattern, $time);
    }
}