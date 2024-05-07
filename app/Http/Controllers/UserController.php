<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (request()->ajax()) {
            $query = User::query();

            return DataTables::of($query)
                ->addIndexColumn()
                ->addColumn('action', function ($data) {
                    return '<a href="#" class="btn btn-sm btn-success editUser" data-id="' . $data->id . ' "><i class="ri-pencil-line"></i></a>
                    <button type="submit" class="btn btn-sm btn-danger deleteUser" data-id="' . $data->id . ' "><i class="ri-delete-bin-6-line"></i></button>';
                })
                ->addColumn('photo', function ($data) {
                    return '<img src="' . asset($data->profile_photo_path) . '" width="30">';
                })
                ->editColumn('created_at', function ($data) {
                    return $data->created_at ? $data->created_at->format("d M Y") : '-';
                })
                ->editColumn('email_verified_at', function ($data) {
                    return $data->email_verified_at ? $data->email_verified_at->format("d M Y") : '-';
                })
                ->editColumn('role', function ($data) {
                    return '<span class="badge badge-' .
                        ($data->role === 'admin' ? 'primary' : ($data->role === 'writer' ? 'info' : 'secondary'))
                        . '">' . $data->role . '</span>';
                })
                ->rawColumns(['role', 'photo', 'action'])
                ->removeColumn(['profile_photo_path', 'updated_at'])
                ->make(true);
        }

        $data = [
            'title' => 'List User',
        ];

        return view('pages.back.users.index', compact('data'));
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
        $validated = $request->validate([
            'name' => 'required|max:255',
            'username' => 'required|min:4|max:25|unique:users,username',
            'role' => 'required|in:admin,writer,user',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
        ]);
        $user = User::create($validated);
        $data = User::where('id', $user->id)->first();
        $data['created_at'] = $data->created_at->format('d M Y');

        return response()->json(['user' => $data]);
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return response()->json($user);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'username' => 'required|min:4|max:25|unique:users,username,' . $user?->id,
            'role' => 'required|in:admin,writer,user',
            'email' => 'required|email|unique:users,email,' . $user?->id,
            'password' => 'nullable|min:6',
        ]);
        if (empty($validated['password'])) {
            unset($validated['password']);
        } else {
            $validated['password'] = bcrypt($validated['password']);
        }
        $user->update($validated);
        $user = User::where('id', $user->id)->first();

        return response()->json(['user' => $user]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        // dd($user->id);
        User::where('id', $user->id)->delete();
    }
}
