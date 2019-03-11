<?php

return [
	
	// flags that can be linked to addresses
	'flags' => array('primary', 'billing', 'shipping'),

	// two letter code for the default country you want
	'default_country_id'=>'1',

	// two letter code for the default country you want
	'default_country'=>'DK',
	
	// full name of the default country
	'default_country_name'=>'Danmark',
	
	// if this is true, two things happen ..
	// 1. latitude and longitude will be saved into the address table
	// 2. saves run a bit slower because we have to hit google servers
	'geocode'=>false,
];
