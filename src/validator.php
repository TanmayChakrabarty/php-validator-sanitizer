<?php
declare(strict_types=1);

namespace tanmay\ValidatorSanitizer;

class validator
{
    use is_required
        , Validators\Length\is_min_length
        , Validators\Length\is_max_length
        , Validators\Number\is_min_number
        , Validators\Number\is_max_number
        , Validators\DateTime\is_valid_date
        , is_in_array
        , Validators\Length\is_length_in_range
        , Validators\Number\is_number_in_range
        , Validators\DateTime\is_valid_time
        , Validators\Length\is_fixed_length
        , Validators\Number\is_fixed_number
        ;

    private array $sourceData = [];
    private array $fieldAliases = [];
    private array $configuration = [];
    private string $current_language = '';
    private array $lang = [];
    private array $errors = [];

    /**
     * validator constructor.
     * @param array $data
     * @param array $aliases
     * @param string $language
     */
    public function __construct(array $data, array $aliases = [], string $language = 'en')
    {
        $this->sourceData = $data;
        $this->fieldAliases = $aliases ? $aliases : [];
        $this->errors = [];
        $this->configuration = [];
        $this->current_language = $language;

        //including language file
        if(file_exists(__DIR__."/languages/$this->current_language.php")){
            $this->lang = include __DIR__."/languages/$this->current_language.php";
        }

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
                    $data = $this->sourceData[$fName];
                    $fNameAlias = isset($this->fieldAliases[$fName]) ? $this->fieldAliases[$fName] : $fName;
                    $this->$validatorName($fName, $data, $fNameAlias, $param);
                }
            }
        }

        if ($this->errors) return false;
        else return true;
    }
}
