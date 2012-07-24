<?php
/**
 * Valorin\Console
 *
 * A simple PHP Console helper
 *
 * @link        https://github.com/valorin/console
 * @copyright   Copyright (c) 2012 Stephen Rees-Carter <stephen@rees-carter.net>
 * @licence     New BSD Licence
 * @package     Valorin\Console
 */

namespace Valorin\Console;

/**
 * \Valorin\Console\Simple
 *
 * A collection of simple static functions to help with console tools
 */
class Simple
{
    /**
     * @var Boolean Only outputs if the console is enabled
     */
    static protected $enabled = false;

    /**
     * @var Integer
     */
    static protected $dots = 0;


    /**
     * Enable the Console
     *
     */
    static public function enable()
    {
        self::$enabled = true;
    }


    /**
     * Disable the Console
     *
     */
    static public function disable()
    {
        self::$enabled = false;
    }


    /**
     * Get CLI Arguments
     *
     * @return  Array
     */
    static public function getArguments()
    {
        /**
         * Retrieve Arguments from _SERVER
         */
        $args = $_SERVER['argv'];


        /**
         * Check for Arguments
         */
        if (!isset($args)) {
            return Array();
        }


        /**
         * Check for Script in position '0'
         */
        if ($args[0] == $_SERVER['PHP_SELF']) {
            array_shift($args);
        }


        /**
         * Return Arguments
         */
        return $args;
    }


    /**
     * Format the Script title nicely
     *
     * @param   String  $title Script Title
     */
    static public function title($title, $colour = "light_purple")
    {
        /**
         * Calculate script length
         */
        $len = strlen($title) + 4;


        /**
         * Output
         */
        self::output(
            Array(
                str_pad("", $len, "="),
                "= ".self::colour($title, $colour)." =",
                str_pad("", $len, "="),
                ""
            )
        );
    }


    /**
     * Output text to the console
     *
     * @param   String  $text      Text to output
     * @param   String  $colour     Colour to use
     * @return  String              Currently saved output
     */
    static public function output($text = "", $colour = null)
    {
        /**
         * Ignore if not enabled
         */
        if (!self::$enabled) {
            return;
        }


        /**
         * Check for an array of text
         */
        if (is_array($text)) {
            foreach ($text as $line) {
                self::output($line, $colour);
            }
            return;
        }


        /**
         * Check colour
         */
        if ($colour) {
            $text = self::colour($text, $colour);
        }


        /**
         * Check for preceeding dot and add a \n
         */
        if (self::$dots > 0) {
            echo "\n";
        }
        self::$dots = 0;


        /**
         * Echo and return
         */
        echo $text."\n";
    }


    /**
     * Colourizes text
     *
     * @param   String  $text      Text to colourize
     * @param   String  $colour    Colour to use
     * @return  String
     */
    static public function colour($text, $colour)
    {
        /**
         * Define useful colours
         */
        $colours = Array(
            'black'        => "0;30",
            'dark_gray'    => "1;30",
            'red'          => "0;31",
            'light_red'    => "1;31",
            'green'        => "0;32",
            'light_green'  => "1;32",
            'brown'        => "0;33",
            'yellow'       => "1;33",
            'blue'         => "0;34",
            'light_blue'   => "1;34",
            'purple'       => "0;35",
            'light_purple' => "1;35",
            'cyan'         => "0;36",
            'light_cyan'   => "1;36",
            'light_gray'   => "0;37",
            'white'        => "1;37",
        );


        /**
         * Replace if found
         */
        if (isset($colours[$colour])) {
            $colour = $colours[$colour];
        }


        /**
         * Colourize
         */
        return "\033[{$colour}m{$text}\033[m";
    }


    /**
     * Output a simple dot into the console, as an activity indicator
     *
     * @param   String  $char   Character to echo
     */
    static public function dot($char = ".")
    {
        if (!self::$enabled) {
            return;
        }


        /**
         * Increment dots counter
         */
        self::$dots++;


        /**
         * Add newline if > 80
         */
        if (self::$dots > 80) {
            echo "\n";
        }


        /**
         * Echo char
         */
        echo $char;
    }
}
