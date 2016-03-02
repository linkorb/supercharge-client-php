<?php

require_once 'common.php';

use Supercharge\Client\Vat;
use Supercharge\Client\Supercharge;

Supercharge::setApiBase($url);
Supercharge::setPassword($password);
Supercharge::setUsername($username);

try{
    // get all vats
    $vats = Vat::all(); // array of Vat objects

    if (count($vats))
    {
        // retrieve one by code
        $vat = Vat::retrieve($vats[0]->getCode()); // single Vat
    }
    // let try to get non-existing vat
    $vat = Vat::retrieve('non-existing');
}
catch(\Exception $e)
{
    echo $e->getCode() . ' ' .$e->getMessage() . "\n";
}


echo '<pre>';
print_r($vats);
echo '</pre>';

