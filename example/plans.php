<?php

require_once 'common.php';

use Supercharge\Client\Plan;
use Supercharge\Client\Supercharge;

Supercharge::setApiBase($url);
Supercharge::setPassword($password);
Supercharge::setUsername($username);

// get all plans
$plans = Plan::all(); // array of Plan objects

if (count($plans))
{
    // retrieve one by code
    $plan = Plan::retrieve($plans[0]->getCode()); // single Plan
}

// let try to get non-existing plan
try{
    $plan = Plan::retrieve('non-existing');
}
catch(\Exception $e)
{
    echo $e->getCode() . ' ' .$e->getMessage() . "\n";
}


echo '<pre>';
print_r($plans);
echo '</pre>';

