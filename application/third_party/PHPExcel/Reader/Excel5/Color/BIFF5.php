<?php

/**
     * Map color array from BIFF5 built-in color index
     *
     * @param int $color
     * @return array
     */
    public static function lookup($color)
    {
        if (isset(self::$map[$color])) {
            return array('rgb' => self::$map[$color]);
        }
        return array('rgb' => '000000');
    }
}