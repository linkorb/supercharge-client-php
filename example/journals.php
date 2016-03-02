<?php

require_once 'common.php';

use Supercharge\Client\Journal;
use Supercharge\Client\Supercharge;

Supercharge::setApiBase($url);
Supercharge::setPassword($password);
Supercharge::setUsername($username);

try{
    // get all journals
    $journals = Journal::all(); // array of Journal objects

    if (count($journals))
    {
        // retrieve one by code
        $journal = Journal::retrieve($journals[0]->getCode()); // single Journal
    }
    // let try to get non-existing journal
    $journal = Journal::retrieve('non-existing');
}
catch(\Exception $e)
{
    echo $e->getCode() . ' ' .$e->getMessage() . "\n";
}


echo '<pre>';
print_r($journals);
echo '</pre>';

