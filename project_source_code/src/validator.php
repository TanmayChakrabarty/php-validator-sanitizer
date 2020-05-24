<?php
declare(strict_types=1);

namespace tanmay\ValidatorSanitizer;

class validator
{
    use is_required
        , is_min_length
        , is_max_length
        , is_min_number
        , is_max_number
        , is_valid_date
        , is_in_list;

    private $sourceData;
    private $fieldAliases;
    private $configuration;

    private $errors;

    /**
     * validator constructor.
     * @param array $data
     * @param array $aliases
     * @return validator
     */
    public function __construct(array $data, array $aliases = [])
    {
        $this->sourceData = $data;
        $this->fieldAliases = $aliases ? $aliases : [];
        $this->errors = [];
        $this->configuration = [];

        return $this;
    }

    private function register_errors(string $e): void
    {
        $this->errors[] = $e;
    }

    private function register_configuration(string $validator, array $fields, $param):void{
        if (!isset($this->configuration[$validator])) $this->configuration[$validator] = array();
        foreach ($fields as $f) {
            $this->configuration[$validator][$f] = $param;
        }
    }

    public function get_errors():array{
        return $this->errors;
    }

    /**
     * @return bool
     */
    public function validate(): bool
    {
        $this->errors = [];
        foreach ($this->configuration as $validatorName => $fields) {
            if ($fields) {
                foreach ($fields as $fName => $param) {
                    $this->$validatorName($fName, $param);
                }
            }
        }

        if ($this->errors) return false;
        else return true;
    }
}
