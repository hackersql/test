<?php

	/* ------------------------------------------
	 * @VERSION
	 * ------------------------------------------*/
	$C_VERSION = "2.0.9";
	$C_VERSION_STRING = "Version: " . $C_VERSION;
	
	/* ------------------------------------------
	 * @CONSTANTS
	 * ------------------------------------------*/
	$C_MAX_HINT_LEVEL = 2;


	/* Defined our constants to use to tokenize allowed HTML characters.
	 * Why use GUIDs? GUIDs are unique, they are very unlikely to be typed in 
	 * by users, and they are alpha numeric. It is important that there be
	 * a mathematically slim chance that the user would input the token
	 * as part of normal input. For example, the character "X" would work
	 * fine as a token for the bold tag, but it is likely the user would
	 * want to use the letter "X" as the letter "X" and not to 
	 * represent a bold tag. GUIDs solve this issue. Equally important
	 * the GUID is alphanumeric so when we encode our output, the GUID
	 * will not be modified. When alpha-numeric characters are encoded,
	 * they come out the same as before encoding. */
	define('BOLD_STARTING_TAG','9880e8bc4fcb4794a875e8ca8d493e65');
	define('BOLD_ENDING_TAG','9880e8bc4fcb4794a875e8ca8d493e66');
	define('ITALIC_STARTING_TAG','7dc0116a0d514496adbb456fd60b00ac');
	define('ITALIC_ENDING_TAG','7dc0116a0d514496adbb456fd60b00ad');
	define('UNDERLINE_STARTING_TAG','7dc0116a0d514496adbb456fd60b001d');
	define('UNDERLINE_ENDING_TAG','7dc0116a0d514496adbb456fd60b002d');
?>