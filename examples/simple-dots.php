#!/usr/bin/php
<?php
/**
 * Simple Console Dot Example
 *
 * Example usage of the ::dot() function
 */

include __DIR__ ."/../src/Valorin/Console/Simple.php";


/**
 * Enable Simple Console
 */
\Valorin\Console\Simple::enable();


/**
 * Loop 1000 times and output dots
 */
for ($i = 0; $i < 1000; $i++) {
    \Valorin\Console\Simple::dot();
}


/**
 * Newline at the end
 */
\Valorin\Console\Simple::output();
