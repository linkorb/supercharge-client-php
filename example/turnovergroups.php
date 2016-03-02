<?php

require_once 'common.php';

use Supercharge\Client\Turnovergroup;
use Supercharge\Client\Supercharge;

Supercharge::setApiBase($url);
Supercharge::setPassword($password);
Supercharge::setUsername($username);

try{
    // get all turnovergroups
    $turnovergroups = Turnovergroup::all(); // array of Turnovergroup objects

    if (count($turnovergroups))
    {
        // retrieve one by code
        $turnovergroup = Turnovergroup::retrieve($turnovergroups[0]->getCode()); // single Turnovergroup
    }
    // let try to get non-existing turnovergroup
    $turnovergroup = Turnovergroup::retrieve('non-existing');
}
catch(\Exception $e)
{
    echo $e->getCode() . ' ' .$e->getMessage() . "\n";
}


echo '<pre>';
print_r($turnovergroups);
echo '</pre>';

