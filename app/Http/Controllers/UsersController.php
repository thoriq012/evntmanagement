<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

/**
 * User Controller Terhubung Kedalam Model User
 * 
 * 
 */

class UsersController extends Controller
{
    // Tampilkan semua pengguna
    public function index()
    {
        $user = User::all();
        return view('admin.user', compact('user'));
    }

    // Form untuk membuat pengguna baru
    public function create()
    {
        return view('auth.register');
        // return view('home.create');
    }

    // Simpan pengguna baru
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|confirmed|min:8',
        ]);

        // Buat pengguna baru
        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'email_verification_expired_at' => now()->addMinutes(30),
            'password' => bcrypt($validatedData['password']),
        ]);

        // Trigger event untuk mengirim email verifikasi
        event(new Registered($user));

        // Redirect ke halaman verifikasi
        return redirect()->route('verification.notice');

        // return redirect()->route('home.index')->with('success', 'User created successfully.');
    }

    // Tampilkan detail pengguna
    public function show(User $user)
    {
        return response()->json($user);
    }

    // Form untuk mengedit pengguna
    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    public function updateProfilePicture(Request $request, User $user)
    {
        $request->validate([
            'profile_pict' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        if ($user->profile_pict) {
            Storage::disk('public')->delete('profile_pictures/' . $user->profile_pict);
        }

        $image = $request->file('profile_pict');
        $filename = time() . '_' . $image->getClientOriginalName();
        $image->storeAs('profile_pictures', $filename, 'public');

        $user->update(['profile_pict' => $filename]);

        return redirect()->back()->with('success', 'Profile picture updated successfully.');
    }
    // 
    public function updatePersonalData(Request $request, User $user)
    {
        if ($request['dial_phone'] == '+62') {
            $request->validate([
                'no_hp' => 'required',
                'provinsi' => 'required',
                'kabupaten' => 'required',
                'kecamatan' => 'required',
                'desa' => 'required',
            ]);
            $request['no_telp'] = $request['dial_phone'] . $request['no_hp'];
            $request['alamat'] = $request['provinsi'] . ', ' . $request['kabupaten'] . ', ' . $request['kecamatan'] . ', ' . $request['desa'] . ', ' .  $request['additional'];
        } else {
            $request->validate([
                'no_hp' => 'required',
                'address' => 'required',
            ]);
            $request['alamat'] = $request['address'];
        }
        $request['no_telp'] = $request['dial_phone'] . $request['no_hp'];
        
        $data = [
            'no_telp' => $request->no_telp,
            'alamat' => $request->alamat,
        ];
        $user->update($data);
        return redirect()->route('profile');
    }

    // Perbarui data pengguna
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password ? Hash::make($request->password) : $user->password,
            'role' => isset($user['name']) ? $request->role : 'user',
        ];

        // Handle profile picture upload
        // if ($request->hasFile('profile_pict')) {
        //     // Delete old profile picture if exists
        //     if ($user->profile_pict) {
        //         Storage::disk('public')->delete('profile_pictures/' . $user->profile_pict);
        //     }

        //     // Store the new image
        //     $image = $request->file('profile_pict');
        //     $filename = time() . '_' . $image->getClientOriginalName();
        //     $image->storeAs('profile_pictures', $filename, 'public');

        //     $data['profile_pict'] = $filename;
        // }

        if (isset($user['name'])) {
            $user->update($data);
        } else {
            User::where('id', Auth::user()->id)->update($data);
        }

        return redirect()->route('user.index')->with('success', 'User updated successfully.');
    }

    // Add this method to handle profile picture deletion if needed
    public function deleteProfilePicture(User $user)
    {
        if ($user->profile_pict) {
            Storage::disk('public')->delete('profile_pictures/' . $user->profile_pict);
            $user->update(['profile_pict' => null]);
        }

        return redirect()->back()->with('success', 'Profile picture removed successfully.');
    }

    public function destroy(User $user)
    {
        // Delete profile picture if exists
        if ($user->profile_pict) {
            Storage::disk('public')->delete('profile_pictures/' . $user->profile_pict);
        }

        $user->delete();
        return redirect()->route('home.index')->with('danger', 'User deleted successfully.');
    }

    // Untuk Memverify Email
    public function verifyEmail()
    {
        return view('auth.verify');
    }
}
