<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Color;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * @Class   ColorController
 *
 * @Package App\Http\Controllers\Api
 * @author  Levi Deurloo <ldeurloo1@hz.nl>
 */
class ColorController extends Controller
{
    /**
     * Return listing of the resource.
     *
     * @return JsonResponse
     */
    public function index()
    {
        return response()->json(Color::all());
    }

    /**
     * Return the specified resource.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function show(int $id)
    {
        return response()->json(Color::findOrFail($id));
    }

    /**
     * Create a color
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request)
    {
        $item = $request->validate([
            'title' => 'required|string',
            'code' => 'required|string',
            'active' => 'required|boolean'
        ]);
        $item = Color::create($item);

        return response()->json($item);
    }

    /**
     * Update a color
     *
     * @param Request $request
     * @param int     $id
     *
     * @return JsonResponse
     */
    public function update(Request $request, int $id)
    {
        $item = Color::findOrFail($id);

        $item = $item->update($request->all())->validate([
            'title' => 'required|string',
            'code' => 'required|string',
            'active' => 'required|boolean'
        ]);

        return response()->json($item);
    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function delete(int $id)
    {
        $item = Color::findOrFail($id);

        return response()->json($item->delete());
    }
}
