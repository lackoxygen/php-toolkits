<?php

namespace Lackoxygen\Toolkits;

class Sys
{
    /**
     * Returns the number of digits in the system.
     *
     * @return string
     */
    public static function arch(): string
    {
        return php_uname('m');
    }

    /**
     * Return to operating system.
     *
     * @return string
     */
    public static function os(): string
    {
        return php_uname('s');
    }

    /**
     * Return Host name, eg localhost.example.com.
     *
     * @return string
     */
    public static function hostname(): string
    {
        return php_uname('n');
    }
}