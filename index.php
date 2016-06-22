<?php
define('_DS_',DIRECTORY_SEPARATOR);
// Include namespace
require(__DIR__._DS_.'core.processor'._DS_.'namespaces'._DS_.'nText.php');
// Any old random string
$str	=	'OS X is the operating system that powers everything you do on a Mac.'.PHP_EOL.'With OS X El Capitan, it\'s simple to do amazing things and delightful to do all the everyday things. And it works seamlessly with your apps and iOS devices.';

try {
	// Create instance
	$spellCheck	=	new \Nubersoft\nText('en');
	// This will make a new personal library to store learned words
	$spellCheck	->savePersonalFile(__DIR__._DS_.'test_folder','mine')
				// This should now use that library
				->usePersonal(array('pws'=>__DIR__._DS_.'test_folder'._DS_.'mine.pws'));
	// Add new words to the learned library
	$spellCheck	->learnWords(array('El','Capitan'));
	// Find a misspelled word
	$find	=	$spellCheck->suggest('capitin');
	// Sort results
	asort($find);
	// Show all results
	print_r($find);
	// This will use PHP to add to the filtering
	echo $spellCheck	->addWords(array('el','Capitan'),true)
						// This will spell check a block of text and output html
						// with span wrappers around misspelled words
						->spellCheckBlock($str);
}
catch (\Exception $e) {
	die($e->getMessage());
}
