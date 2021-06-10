<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Services\MediaService;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    protected $roles = [
        'User',
        'Admin',
        'RetailSales'
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::with(['media'])->paginate(20);

        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = $this->roles;

        return view('admin.users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'max:100'],
            'email' => ['required', 'email', 'max:100', 'unique:users,email'],
            'password' => ['required', 'min:6', 'max:100', 'confirmed'],
            'role' => ['required', Rule::in($this->roles)],
            'image' => ['nullable', 'image', 'mimes:png,jpeg,gif'],
        ]);

        if ($request->has('image') && !empty($request->file('image'))) {
            $media_id = MediaService::upload($request->file('image'), "users");
        }

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => $request->role,
            'media_id' => $media_id ?? null,
        ]);

        return redirect()->route('admin.users.index')
            ->with('success', 'New User Created Successfully!');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('admin.users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $roles = $this->roles;

        return view('admin.users.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,User $user)
    {
        $request->validate([
            'name' => ['required', 'max:100'],
            'email' => ['required', 'email', 'max:100', 'unique:users,email,'. $user->id],
            'password' => ['nullable', 'min:6', 'max:100', 'confirmed'],
            'role' => ['required', Rule::in($this->roles)],
            'image' => ['nullable', 'image', 'mimes:png,jpeg,gif'],
        ]);

        if ($request->has('image') && !empty($request->file('image'))) {
            if ($user->media_id)
                Storage::delete("public/" . $user->media->path);
            $media_id = MediaService::upload($request->file('image'), "users");
        }


        $user->name = $request->name;
        $user->email = $request->email;
        if (!empty($request->password))
            $user->password = bcrypt($request->password);

        $user->role = $request->role;
        $user->media_id = $media_id ?? $user->media_id;
        $user->save();


        return redirect()->route('admin.users.index')
            ->with('success', 'User Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        return redirect()->route('admin.users.index')
            ->with('error', 'You cannot delete an user!');
    }
}
