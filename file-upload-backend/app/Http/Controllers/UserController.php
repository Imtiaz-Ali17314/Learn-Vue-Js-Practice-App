<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::get();
        // return $users;
        return view('file-upload', compact('users'));

    }

    // For API
public function getAll()
{
    $users = User::all();
    return response()->json($users);
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
    $request->validate([
        'files' => 'required',
        'files.*' => 'image|max:5120',
    ]);

    $paths = [];

    foreach ($request->file('files') as $file) {
        $path = $file->store('images', 'public');
        $paths[] = $path;

        User::create(['file_name' => $path]);
    }

    return response()->json([
        'message' => 'Files uploaded successfully!',
        'paths' => $paths
    ]);
}

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::find($id);

        return view('file-update', compact('user'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::find($id);



        if($request->hasFile('photo')){

            $image_path = public_path('storage/'). $user->file_name;

            if(file_exists($image_path)){
                @unlink($image_path);
            };

            $path = $request->photo->store('image' , 'public');

            $user->file_name = $path;
            $user->save();

             return redirect()->route('user.index')->with('status','User Image Updated Successfully!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
public function destroy(string $id)
{
    $user = User::find($id);
    if (!$user) {
        return response()->json(['error' => 'User not found'], 404);
    }

    $image_path = storage_path('app/public/' . $user->file_name);

    $user->delete();

    if (file_exists($image_path)) {
        @unlink($image_path);
    }

    return response()->json(['message' => 'User Image Deleted Successfully!']);
}
}
