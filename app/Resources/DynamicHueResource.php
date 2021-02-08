<?php

namespace App\Resources;

use App\Http\Helpers\ColorConversion;

/**
 * @Class   DynamicHueResource
 *
 * @Package App\Resources
 * @Author  Levi Deurloo <ldeurloo1@hz.nl>
 */
class DynamicHueResource
{
    /**
     * @var array
     */
    public $lightsRGB;

    /**
     * @var object
     */
    protected $attributes;

    /**
     * @var string
     */
    protected $color;

    /**
     * @var string
     */
    protected $category;

    /**
     * DynamicHueResource constructor.
     *
     * @param string $category
     * @param null   $data
     */
    public function __construct(string $category, $data = null)
    {
        $this->attributes = $data;
        foreach ($data as $key => $val) {
            $this->$key = $val;
        }
        $this->category = $category;
    }

    public function convertColor()
    {
        if ($this->category === 'groups') {
            if (isset($this->attributes->action->colormode) && $this->attributes->action->colormode === 'xy') {
                $arr = $this->attributes->action->xy;
                $values = array_values($arr);

                $x = $values[0];
                $y = $values[1];
                $bri = $this->attributes->action->bri;
                return $this->color = (new ColorConversion())->convertXYToRGB($x, $y, $bri);
            }
        } else  if ($this->category === 'lights')
            if (isset($data->state->colormode) && $data->state->colormode === 'xy') {
                $arr = $data->state->xy;
                $values = array_values($arr);

                $x = $values[0];
                $y = $values[1];
                $bri = $data->state->bri;
                return $this->lightsRGB = (new ColorConversion())->convertXYToRGB($x, $y, $bri);
            } else return $this->attributes;
    }
}
