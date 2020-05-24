<?php

require_once __DIR__.'/vendor/autoload.php';

use tanmay\ValidatorSanitizer\validator;

$sampleDataArray = [
    'username' => '32'
];

$sampleAliasArray = [
    'username' => 'Username'
];

$v = new validator($sampleDataArray, $sampleAliasArray);

$v->rule_required(['username']);

$v->validate();

var_dump($v->get_errors());