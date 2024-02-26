<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\RequestStoreOrUpdateUser;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::orderBy('created_at', 'asc')->paginate(10);

        return view('dashboard.users.index', compact('users'));
    }

    public function create()
    {
        $rolePrefix = '';
        $roles = ['petugas', 'user'];
        $selectedRole = ''; 

        if (old('role')) {
            $selectedRole = old('role');
        } else {
            $selectedRole = $roles[0]; 
        }

        switch ($selectedRole) {
            case 'petugas':
                $rolePrefix = 'P-';
                break;
            case 'user':
                $rolePrefix = 'US-';
                break;
        }

        $user_id = $rolePrefix . uniqid();

        return view('dashboard.users.create', compact('user_id', 'roles', 'selectedRole'));
    }

    public function store(RequestStoreOrUpdateUser $request)
    {
        $avatarPath = null;
    
        if ($request->hasFile('avatar')) {
            $fileName = time() . '.' . $request->avatar->extension();
            $avatarPath = $fileName;
        
            $request->avatar->move(public_path('uploads/images'), $fileName);
        } else {
            $avatarPath = 'avatar.png';
        }
    
        $rolePrefix = '';
        switch ($request->role) {
            case 'petugas':
                $rolePrefix = 'P-';
                break;
            case 'user':
                $rolePrefix = 'US-';
                break;
        }
        
        $latestUserId = User::where('role', $request->role)->orderBy('created_at', 'desc')->first();
        
        if (!$latestUserId) {
            $user_id = $rolePrefix . '0001';
        } else {
            preg_match('/\d+$/', $latestUserId->user_id, $matches);
            $numericPart = (int)$matches[0];
            $nextNumericPart = $numericPart + 1;
            $paddedNextNumericPart = str_pad($nextNumericPart, 4, '0', STR_PAD_LEFT);
            
            $user_id = $rolePrefix . $paddedNextNumericPart;
        }
    
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
        
        return redirect()->route('users.index')->with('success', 'Pengguna berhasil ditambahkan.');
    }
    
    public function show($user_id)
    {
        return User::findOrFail($user_id);
    }

    public function edit($user_id)
    {
        $user = User::findOrFail($user_id);

        return view('dashboard.users.edit', compact('user'));
    }

    public function update(RequestStoreOrUpdateUser $request, $user_id)
    {
        $user = User::findOrFail($user_id);

        $avatarPath = $user->avatar;

        if ($request->hasFile('avatar')) {
            $fileName = time() . '.' . $request->avatar->extension();
            $avatarPath = $fileName;

            $request->avatar->move(public_path('uploads/images'), $fileName);

            if ($user->avatar !== 'avatar.png') {
                $oldAvatarPath = public_path('uploads/images/') . $user->avatar;
                if (file_exists($oldAvatarPath)) {
                    unlink($oldAvatarPath);
                }
            }
        }

        $user->update([
            'username' => $request->username,
            'name' => $request->name,
            'alamat' => $request->alamat,
            'email' => $request->email,
            'role' => $request->role,
            'avatar' => $avatarPath,
        ]);

        return redirect()->route('users.index')->with('success', 'Pengguna berhasil diperbarui.');
    }

    public function destroy($user_id)
    {
        $user = User::findOrFail($user_id);
        $oldPath = public_path('/uploads/images/'.$user->avatar);
        if(file_exists($oldPath) && $user->avatar != 'avatar.png'){
            unlink($oldPath);
        }
        $user->delete();

        return redirect(route('users.index'))->with('success', 'User berhasil dihapus.');
    }
}
