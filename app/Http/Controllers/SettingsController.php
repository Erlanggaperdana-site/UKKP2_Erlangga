<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdatePasswordRequest;
use App\Http\Requests\UpdateProfileRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class SettingsController extends Controller
{
    public function index()
    {
        return view('settings.index');
    }

    public function updateProfile(UpdateProfileRequest $request)
    {
        $request->user()->update($request->validated());

        return redirect()->route('settings.index')->with('success', 'Profil berhasil diperbarui.');
    }

    public function updatePassword(UpdatePasswordRequest $request)
    {
        $request->user()->update(['password' => Hash::make($request->password)]);

        return redirect()->route('settings.index')->with('success', 'Password berhasil diperbarui.');
    }

    public function updateAvatar(Request $request)
    {
        $request->validate([
            'avatar' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        $user = $request->user();

        if ($user->avatar) {
            Storage::disk('public')->delete('avatars/' . $user->avatar);
        }

        $file = $request->file('avatar');
        $filename = 'avatar_' . $user->id . '_' . time() . '.' . $file->getClientOriginalExtension();
        $file->storeAs('avatars', $filename, 'public');

        $user->update(['avatar' => $filename]);

        return redirect()->route('settings.index')->with('success', 'Foto profil berhasil diperbarui.');
    }

    public function removeAvatar(Request $request)
    {
        $user = $request->user();

        if ($user->avatar) {
            Storage::disk('public')->delete('avatars/' . $user->avatar);
            $user->update(['avatar' => null]);
        }

        return redirect()->route('settings.index')->with('success', 'Foto profil berhasil dihapus.');
    }

    public function updateAppearance(Request $request)
    {
        $request->validate([
            'theme_color' => 'required|string|in:slate,blue,green,purple,rose,orange',
            'sidebar_mode' => 'required|string|in:dark,light',
        ]);

        $user = $request->user();
        $settings = array_merge(User::defaultSettings(), $user->settings ?? []);
        $settings['theme_color'] = $request->theme_color;
        $settings['sidebar_mode'] = $request->sidebar_mode;
        $user->update(['settings' => $settings]);

        return redirect()->route('settings.index')->with('success', 'Tampilan berhasil diperbarui.');
    }
}
