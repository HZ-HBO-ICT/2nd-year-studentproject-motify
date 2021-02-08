<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Notifications\BuddyInvite;
use App\Notifications\BuddyInviteAccepted;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

/**
 * @Class   BuddyController
 *
 * @Package App\Http\Controllers\Api
 * @author  Levi Deurloo <ldeurloo1@hz.nl>
 */
class BuddyController extends Controller
{

    /**
     * @var array
     */
    protected $buddies;

    /**
     * BuddyController constructor.
     */
    public function __construct()
    {
        $this->buddies = User::all()->where('is_buddy', 1);
    }

    /**
     * Return listing of the resource.
     *
     * @return JsonResponse
     */
    public function index()
    {

        return response()->json($this->buddies, 200);
    }

    /**
     * Notify a buddy when he needs to help
     *
     * @param int $id
     * @return JsonResponse
     */
    public function notify(int $id)
    {
        //validate
        if (!isset($id))
            return response()->json(['message' => 'Please fill the buddy id'], 422);

        $item = User::findOrFail($id);
        if (!$item->isBuddy())
            return response()->json(['message' => 'This user is not a buddy'], 422);

        //get logged in user
        $user = auth()->user();

        //create buddy invite
        $buddyInvite = \App\Models\BuddyInvite::create([
            'requested_by_user_id' => $user->id,
            'requested_user_id' => $item->id
        ]);

        //send notification
        Notification::send($item, new BuddyInvite($buddyInvite, $user->getFullName()));

        return response()->json(['buddy_invite_id' => $buddyInvite->id]);
    }

    /**
     * Return the specified resource.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function show(int $id)
    {
        $item = $this->buddies->where('id', $id)->first();

        return response()->json($item);
    }

    /**
     * Create a Buddy
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request)
    {
        $item = $request;
        $item->is_buddy = true;

        $item->validate([
            'name' => 'required|string',
            'email' => 'required|string',
            'password' => 'required|string'
        ]);

        $item = User::create($item);

        return response()->json($item);
    }

    /**
     * Update a Buddy
     *
     * @param Request $request
     * @param int $id
     *
     * @return JsonResponse
     */
    public function update(Request $request, int $id)
    {
        $item = $this->buddies->where('id', $id);
        $item = $item->update($request['is_buddy']);

        return response()->json($item);
    }

    /**
     * Remove a Buddy (And user account)
     *
     * @param int $id
     * @return JsonResponse
     */
    public function delete(int $id)
    {
        $item = $this->buddies->where('id', $id);

        return response()->json($item->delete());
    }

    /**
     *  Accept/decline the buddy the invite
     *
     * @param \App\Models\BuddyInvite $buddyInvite
     * @param Request $request
     * @return JsonResponse
     */
    public function acceptInvite(\App\Models\BuddyInvite $buddyInvite)
    {
        //accept invite
        $buddyInvite->is_accepted = true;
        $buddyInvite->save();

        //send notification to user
        Notification::send($buddyInvite->requestedByUser, new BuddyInviteAccepted($buddyInvite));
    }

    /**
     * Callback which returns the status of the callback
     *
     * @param \App\Models\BuddyInvite $buddyInvite
     * @return JsonResponse
     */
    public function inviteStatus(\App\Models\BuddyInvite $buddyInvite)
    {
        return response()->json(['is_accepted' => $buddyInvite->is_accepted]);
    }

}
