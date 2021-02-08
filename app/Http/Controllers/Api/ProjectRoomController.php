<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ProjectRoom;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class ProjectRoomController extends Controller
{
    /**
     * Return listing of the resource.
     *
     * @return Collection
     */
    public function index()
    {
        return ProjectRoom::all();
    }

    /**
     * Return the specified resource.
     *
     * @param ProjectRoom $projectRoom
     *
     * @return ProjectRoom
     */
    public function show(ProjectRoom $projectRoom)
    {
        return $projectRoom;
    }

    /**
     * Connected with the specified room
     *
     * @param Request $request
     *
     * @return ProjectRoom
     */
    public function connect(Request $request)
    {
        //validate
        $data = $request->validate([
            'code' => 'required|string'
        ]);

        return ProjectRoom::where('code', $data['code'])->firstOrFail();
    }

}
