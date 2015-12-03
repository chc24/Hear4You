<?php
/*
SOURCES, ATTRIBUTIONS, WHO DID WHAT:
Dennis: Created script
*/

use Firebase\Token\TokenException;
use Firebase\Token\TokenGenerator;

try {
    $generator = new TokenGenerator('
B36VLkZQtmcqVbsVbwYaXPhAArcbwUNV1qnALY9I');
    // Using setOptions()
	$token = $generator
	    ->setOptions(array(
	        'admin' => true,
	        'debug' => true
	    ))
	    ->setData(array('uid' => 'exampleID'))
	    ->create();
} catch (TokenException $e) {
    echo "Error: ".$e->getMessage();
}

echo $token;

?>
