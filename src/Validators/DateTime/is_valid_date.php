<?php
namespace tanmay\ValidatorSanitizer\Validators\DateTime;

trait is_valid_date{
    /**
     * @param array $fields
     * @param string $format only use y,m & d to indicate positions of year, month and date respectively. do not use separator here
     * @param string $separator Indicate the separator here
     * @return is_valid_date
     */
    public function rule_valid_date(array $fields, string $format = 'ymd', string $separator = '-')
    {
        $args = [
            'format' => $format,
            'separator' => $separator
        ];

        $this->register_configuration('is_valid_date', $fields, $args);

        return $this;
    }
    private function is_valid_date(string $fName, object $param): void
    {
        $data_date = $this->sourceData[$fName];
        $fNameAlias = $this->fieldAliases[$fName];

        $ret = self::_is_valid_date($data_date, $param['format'], $param['separator']);

        if (!$ret) $this->register_errors(sprintf($this->lang['is_valid_date'], $fNameAlias));
    }
    public static function _is_valid_date(string $date, string $format = 'ymd', string $separator = '-'): bool
    {
        if(!strlen($date)) return true;

        $allowedDateFormats = array('dmy', 'dym', 'mdy', 'myd', 'ymd', 'ydm');

        if (!self::_is_in_array($format, $allowedDateFormats)) return false;

        $y = null;
        $m = null;
        $d = null;

        $dateParts = explode($separator, $date);

        if (count($dateParts) != 3) return false;

        $formatParts = str_split($format);

        $indexOfY = array_search('y', $formatParts);
        $indexOfM = array_search('m', $formatParts);
        $indexOfD = array_search('d', $formatParts);

        $y = $dateParts[$indexOfY];
        $m = $dateParts[$indexOfM];
        $d = $dateParts[$indexOfD];

        return checkdate($m, $d, $y);
    }
}