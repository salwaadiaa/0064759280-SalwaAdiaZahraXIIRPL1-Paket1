<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\RequestStoreOrUpdateUser;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::orderBy('created_at', 'asc')->paginate(10);

        return view('dashboard.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
{
    // Generate user ID based on role
    $rolePrefix = '';
    $roles = ['petugas', 'user']; // List of roles
    $selectedRole = ''; // Default selected role, you can set it to a default value if needed

    // Jika role telah dipilih sebelumnya, gunakan role tersebut, jika tidak, gunakan role pertama dalam daftar roles
    if (old('role')) {
        $selectedRole = old('role');
    } else {
        $selectedRole = $roles[0]; // Default role
    }

    switch ($selectedRole) {
        case 'petugas':
            $rolePrefix = 'P-';
            break;
        case 'user':
            $rolePrefix = 'US-';
            break;
        // Add more cases if you have additional roles
    }

    // Generate user ID
    $user_id = $rolePrefix . uniqid();

    return view('dashboard.users.create', compact('user_id', 'roles', 'selectedRole'));
}


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RequestStoreOrUpdateUser $request)
    {
        // Form request akan menangani validasi, dan jika gagal, akan secara otomatis dialihkan kembali dengan kesalahan.
    
        // Handle file upload if an avatar is provided
        $avatarPath = null;
    
        if ($request->hasFile('avatar')) {
            $fileName = time() . '.' . $request->avatar->extension();
            $avatarPath = $fileName;
        
            // move file
            $request->avatar->move(public_path('uploads/images'), $fileName);
        } else {
            // Set default avatar filename if no file is uploaded
            $avatarPath = 'avatar.png';
        }
    
        // Generate user ID based on role
        $rolePrefix = '';
        switch ($request->role) {
            case 'petugas':
                $rolePrefix = 'P-';
                break;
            case 'user':
                $rolePrefix = 'US-';
                break;
            // Add more cases if you have additional roles
        }
        
        // Get the latest user ID for the selected role
        $latestUserId = User::where('role', $request->role)->orderBy('created_at', 'desc')->first();
        
        // If there are no users for the selected role, start with '0001'
        if (!$latestUserId) {
            $user_id = $rolePrefix . '0001';
        } else {
            // Extract the numeric part of the user ID, increment it, and pad it with zeros
            preg_match('/\d+$/', $latestUserId->user_id, $matches);
            $numericPart = (int)$matches[0];
            $nextNumericPart = $numericPart + 1;
            $paddedNextNumericPart = str_pad($nextNumericPart, 4, '0', STR_PAD_LEFT);
            
            $user_id = $rolePrefix . $paddedNextNumericPart;
        }
    
        // Create a new user
        $user = User::create([
            'user_id' => $user_id,
            'username' => $request->username,
            'name' => $request->name,
            'alamat' => $request->alamat,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'avatar' => $avatarPath,
        ]);
        
    
        // Redirect back with a success message
        return redirect()->route('users.index')->with('success', 'Pengguna berhasil ditambahkan.');
    }
    

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($user_id)
    {
        return User::findOrFail($user_id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($user_id)
    {
        $user = User::findOrFail($user_id);

        return view('dashboard.users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(RequestStoreOrUpdateUser $request, $user_id)
    {
        $user = User::findOrFail($user_id);

        // Handle file upload if a new avatar is provided
        $avatarPath = $user->avatar;
    
        if ($request->hasFile('avatar')) {
            $fileName = time() . '.' . $request->avatar->extension();
            $avatarPath = $fileName;
    
            // Move file
            $request->avatar->move(public_path('uploads/images'), $fileName);
    
            // Delete the old avatar file if it's not the default one
            if ($user->avatar !== 'avatar.png') {
                $oldAvatarPath = public_path('uploads/images/') . $user->avatar;
                if (file_exists($oldAvatarPath)) {
                    unlink($oldAvatarPath);
                }
            }
        }
    
        // Update the user data
        $user->update([
            'user_id' => $request->user_id,
            'username' => $request->username,
            'name' => $request->name,
            'alamat' => $request->alamat,
            'email' => $request->email,
            'role' => $request->role,
            'avatar' => $avatarPath,
        ]);
    
        // Redirect back with a success message
        return redirect()->route('users.index')->with('success', 'Pengguna berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($user_id)
    {
        $user = User::findOrFail($user_id);
        // delete old file
        $oldPath = public_path('/uploads/images/'.$user->avatar);
        if(file_exists($oldPath) && $user->avatar != 'avatar.png'){
            unlink($oldPath);
        }
        $user->delete();

        return redirect(route('users.index'))->with('success', 'User berhasil dihapus.');
    }
}
