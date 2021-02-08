<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Color;
use App\Models\Mood;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * @Class   ColorController
 *
 * @Package App\Http\Controllers\Api
 * @author  Levi Deurloo <ldeurloo1@hz.nl>
 */
class MoodController extends Controller
{
    /**
     * Return listing of the resource.
     *
     * @return JsonResponse
     */
    public function index()
    {
        return response()->json(Mood::all());
    }

    /**
     * Return the specified resource.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function show(int $id)
    {
        return response()->json(Mood::findOrFail($id));
    }

    /**
     * Create a mood
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request)
    {
        $item = $request->validate([
            'user_id' => 'required|integer',
            'points' => 'required|integer',
            'tracking_date' => 'required|datetime'
        ]);
        $item = Mood::create($item);

        return response()->json($item);
    }

    /**
     * Update  a mood
     *
     * @param Request $request
     * @param int     $id
     *
     * @return JsonResponse
     */
    public function update(Request $request, int $id)
    {
        $item = Mood::findOrFail($id);

        $item = $item->update($request->all())->validate([
            'user_id' => 'required|integer',
            'points' => 'required|integer',
            'tracking_date' => 'required|datetime'
        ]);

        return response()->json($item);
    }

    /**
     * Delete this mood item
     *
     * @param int $id
     * @return JsonResponse
     */
    public function delete(int $id)
    {
        $item = Mood::findOrFail($id);

        return response()->json($item->delete());
    }
}
