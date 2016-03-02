<?php

require_once 'common.php';

use Supercharge\Client\Paymentmethod;
use Supercharge\Client\Supercharge;

Supercharge::setApiBase($url);
Supercharge::setPassword($password);
Supercharge::setUsername($username);

try{
    // get all paymentmethods
    $paymentmethods = Paymentmethod::all(); // array of Paymentmethod objects

    if (count($paymentmethods))
    {
        // retrieve one by code
        $paymentmethod = Paymentmethod::retrieve($paymentmethods[0]->getCode()); // single Paymentmethod
    }
    // let try to get non-existing paymentmethod
    $paymentmethod = Paymentmethod::retrieve('non-existing');
}
catch(\Exception $e)
{
    echo $e->getCode() . ' ' .$e->getMessage() . "\n";
}


echo '<pre>';
print_r($paymentmethods);
echo '</pre>';

