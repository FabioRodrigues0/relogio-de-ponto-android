<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProfileResource;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserApiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $allUsers = DB::table('users')
            ->join('users_type', 'users.users_type_id', '=', 'users_type.id')
            ->select('users.*', 'users_type.type')
            ->orderBy('users.id')
            ->get();

        return UserResource::collection($allUsers);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function checkInRequest($id, $type)
    {
        DB::table('presence_record')->insert([
            'date' => now()->format('Y-m-d'),
            'entry_time' => now()->format('H:i:s'),
            'attendance_mode_id' => $type,
            'user_id' => $id,
            'created_at' => now(),
        ]);
    }

    public function checkOutRequest($id)
    {
        DB::table('presence_record')
            ->where('user_id', $id)
            ->whereDate('date', now()->format('Y-m-d'))
            ->whereNull('exit_time')
            ->update([
                'exit_time' => now()->format('H:i:s'),
                'updated_at' => now()
            ]);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $user = User::with(['userType', 'presenceRecords.attendanceMode'])
            ->findOrFail($id);

        return new ProfileResource($user);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
