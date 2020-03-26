<?php

$fmt = numfmt_create('en_EN', NumberFormatter::CURRENCY);

return [
    'fmt' => $fmt,
    'startingBalance' => 2000.00,
    'defaultOverdraft' => 250.00,
];
