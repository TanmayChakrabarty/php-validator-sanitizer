<?php

require_once __DIR__.'/vendor/autoload.php';

use tanmay\ValidatorSanitizer\validator;

$sampleDataArray = [
    'username' => '',
    'current_time' => '4g-49-0'
];

$sampleAliasArray = [
    'username' => 'Username'
];

$v = new validator($sampleDataArray, $sampleAliasArray, 'en');

$v->rule_required(['username']);
$v->rule_valid_time(['current_time'], 'sih', '-', true, true);

$v->validate();

var_dump($v->get_errors());