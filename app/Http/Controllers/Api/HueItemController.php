<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\HueItem;
use App\Resources\DynamicHueResource;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * @Class   HueItemController
 *
 * @Package App\Http\Controllers\Api
 * @author  Levi Deurloo <ldeurloo1@hz.nl>
 */
class HueItemController extends Controller
{
    /**
     * Initialize HueClient
     *
     * @var HueItem
     */
    protected $hueItem;

    /**
     * @var string
     */
    protected $category;

    /**
     * Create a new controller instance.
     *
     * @param    $category
     */
    public function __construct($category)
    {
        if ($category === 'bridge')
            $this->category = 'config';
        else
            $this->category = $category;

        $this->hueItem = new HueItem($this->category);
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request     $request
     * @param string|null $filter
     *
     * @return JsonResponse
     * @throws GuzzleException
     */
    public function index(Request $request, string $filter = null)
    {
        $items = $this->hueItem->all([], $filter);
        if ($this->category === 'groups')
            return $this->getLightsByRoom($items);

        return response()->json($items);
    }

    /**
     * Get the lights by each rooms array
     *
     * @param array $items
     *
     * @return JsonResponse
     * @throws GuzzleException
     */
    public function getLightsByRoom(array $items)
    {
        $hueItem2 = new HueItem('lights');
        $updatedItems = array();

        foreach($items as $item) {
            if (!$item->lights)
                array_push($updatedItems, $item);
            else {
                $objects = array();
                foreach($item->lights as $light) {
                    $rgbLight = $hueItem2->byID((int)$light);

                    if ($rgbLight->state->on && isset($rgbLight->lightsRGB) && $rgbLight->state->reachable)
                        array_push($objects, $rgbLight->lightsRGB);
                }
                if (!isset($rgbLight->lightsRGB))
                    $objects = null;

                $item->lightsRGB = $objects;
                array_push($updatedItems, $item);
            }
        }
        return response()->json($updatedItems);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     *
     * @return JsonResponse
     * @throws GuzzleException
     */
    public function store(Request $request)
    {
        $item = $this->hueItem->save($request->toArray());

        return response()->json($item);
    }

    /**
     * Display the specified resource.
     *
     * @param int|string $id
     *
     * @return JsonResponse|DynamicHueResource
     * @throws GuzzleException
     */
    public function show($id)
    {
        $item = $this->hueItem->byID($id);

        return response()->json($item);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request     $request
     * @param int         $id
     * @param string|null $custom
     *
     * @return JsonResponse
     * @throws GuzzleException
     */
    public function update(Request $request, int $id, string $custom = null)
    {
        $item = $this->hueItem->update($request, $id, $custom);

        return response()->json($item);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return JsonResponse
     * @throws GuzzleException
     */
    public function destroy(int $id)
    {
        $item = $this->hueItem->delete($id);

        return response()->json($item);
    }
}
