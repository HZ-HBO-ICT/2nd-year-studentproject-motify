<?php

namespace App\Http\Helpers;

class ColorConversion
{
    /**
     * Converts RGB values to XY values
     *
     * @param int $red Red value
     * @param int $green Green value
     * @param int $blue Blue value
     *
     * @return array x, y, bri key/value
     */
    public static function convertRGBToXY(int $red, int $green, int $blue)
    {
        // Normalize the values to 1
        $normalizedToOne['red'] = $red / 255;
        $normalizedToOne['green'] = $green / 255;
        $normalizedToOne['blue'] = $blue / 255;

        // Make colors more vivid
        foreach($normalizedToOne as $key => $normalized) {
            if ($normalized > 0.04045)
                $color[$key] = pow(($normalized + 0.055) / (1.0 + 0.055), 2.4);
            else
                $color[$key] = $normalized / 12.92;
        }

        // Convert to XYZ using the Wide RGB D65 formula
        $xyz['x'] = $color['red'] * 0.664511 + $color['green'] * 0.154324 + $color['blue'] * 0.162028;
        $xyz['y'] = $color['red'] * 0.283881 + $color['green'] * 0.668433 + $color['blue'] * 0.047685;
        $xyz['z'] = $color['red'] * 0.000000 + $color['green'] * 0.072310 + $color['blue'] * 0.986039;

        // Calculate the x/y values
        if (array_sum($xyz) == 0) {
            $x = 0;
            $y = 0;
        } else {
            $x = $xyz['x'] / array_sum($xyz);
            $y = $xyz['y'] / array_sum($xyz);
        }

        return array(
            'x' => $x,
            'y' => $y,
            'bri' => round($xyz['y'] * 255)
        );
    }

    /**
     * Converts XY (and brightness) values to RGB
     *
     * @param float $x   X value
     * @param float $y   Y value
     * @param int   $bri Brightness value
     *
     * @return array
     */
    public static function convertXYToRGB(float $x, float $y, $bri = 255)
    {
        // Calculate XYZ
        $z = 1.0 - $x - $y;
        $Y = $bri / 255;
        $X = ($Y / $y) * $x;
        $Z = ($Y / $y) * $z;

        // Convert to RGB using Wide RGB D65 conversion
        $red1 = $X * 1.656492 - $Y * 0.354851 - $Z * 0.255038;
        $green1 = -$X * 0.707196 + $Y * 1.655397 + $Z * 0.036152;
        $blue1 = $X * 0.051713 - $Y * 0.121364 + $Z * 1.011530;
        $red2 = ($red1 <= 0.0031308 ?12.92 * $red1 : (1.0 + 0.055) * pow($red1, (1.0 / 2.4)) - 0.055);
        $green2 = ($green1 <= 0.0031308 ?12.92 * $green1 : (1.0 + 0.055) * pow($green1, (1.0 / 2.4)) - 0.055);
        $blue2 = ($blue1 <= 0.0031308 ?12.92 * $blue1 : (1.0 + 0.055) * pow($blue1, (1.0 / 2.4)) - 0.055);
        $correction = max($red2, $blue2, $green2);

        $red = floor(max($red2 / $correction, 0) * 255);
        $green = floor(max($green2 / $correction, 0) * 255);
        $blue = floor(max($blue2 / $correction, 0) * 255);

        return [(int)$red, (int)$green, (int)$blue];
    }
}
