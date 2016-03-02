<?php

require_once 'common.php';

use Supercharge\Client\Ledgeraccount;
use Supercharge\Client\Supercharge;

Supercharge::setApiBase($url);
Supercharge::setPassword($password);
Supercharge::setUsername($username);

try{
    // get all ledgeraccounts
    $ledgeraccounts = Ledgeraccount::all(); // array of Ledgeraccount objects

    if (count($ledgeraccounts))
    {
        // retrieve one by code
        $ledgeraccount = Ledgeraccount::retrieve($ledgeraccounts[0]->getCode()); // single Ledgeraccount
    }
    // let try to get non-existing ledgeraccount
    $ledgeraccount = Ledgeraccount::retrieve('non-existing');
}
catch(\Exception $e)
{
    echo $e->getCode() . ' ' .$e->getMessage() . "\n";
}


echo '<pre>';
print_r($ledgeraccounts);
echo '</pre>';

