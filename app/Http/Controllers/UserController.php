<?php

namespace App\Http\Controllers;

use App\Http\Requests\ValidateUser;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            if ($request->ajax()) {
                return DataTables::of(User::query())
                    ->addIndexColumn()
                    ->make(true);
            }
            $users = User::all();
            return view('admin.users.index', compact('users'));
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
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
    public function show(User $user)
    {
        try {
            $this->authorize('view', $user);
            return view('admin.users.profile', compact('user'));
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
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
    public function update(ValidateUser $request, User $user)
    {
        try {
            $inputs = $request->all();
            if (request()->hasFile('profile_pic')) {
                $inputs['profile_pic'] = request()->file('profile_pic')->store('images');
            }
            $user->update($inputs);
            return back()->with(['update_profile_msg' => 'Profile updated successfully']);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
