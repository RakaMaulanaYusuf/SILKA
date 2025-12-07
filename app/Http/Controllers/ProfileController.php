<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    public function show()
    {
        return view('editprofile', [
            'user' => Auth::user()
        ]);
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:255',
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('users')->ignore($user->user_id, 'user_id')
            ],
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->with('error', 'Gagal menyimpan perubahan!');
        }

        $user->update([
            'nama' => $request->nama,
            'email' => $request->email,
        ]);

        return back()->with('success', 'Profil berhasil diperbarui!');
    }

    public function updatePhoto(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'profile_photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->with('error', 'Gagal mengupload foto profil!');
        }

        $user = Auth::user();

        if ($user->profile_photo && Storage::disk('public')->exists($user->profile_photo)) {
            Storage::disk('public')->delete($user->profile_photo);
        }

        $photoPath = $request->file('profile_photo')->store('profile-photos', 'public');
        $user->profile_photo = $photoPath;
        $user->save();

        return back()->with('success', 'Foto profil berhasil diperbarui!');
    }

    public function updatePassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'current_password' => 'required',
            'password' => 'required|string|min:8|confirmed'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->with('error', 'Gagal memperbarui password!');
        }

        $user = Auth::user();

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->with('error', 'Password saat ini tidak sesuai.');
        }

        $user->update([
            'password' => Hash::make($request->password)
        ]);

        return back()->with('success', 'Password berhasil diperbarui!');
    }

    public function deletePhoto()
    {
        $user = Auth::user();

        if ($user->profile_photo && Storage::disk('public')->exists($user->profile_photo)) {
            Storage::disk('public')->delete($user->profile_photo);
        }

        $user->profile_photo = null;
        $user->save();

        return back()->with('success', 'Photo profile berhasil dihapus!');
    }
}