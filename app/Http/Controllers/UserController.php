<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class UserController extends Controller
{
    /**
     * Display a listing of the registered users.
     */
    public function index(): View
    {
        $users = User::orderBy('created_at', 'desc')->paginate(10);

        return view('users.index', compact('users'));
    }

    /**
     * Show the form for editing the specified user.
     */
    public function edit($id): View
    {
        $user = User::findOrFail($id);

        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified user in storage.
     */
    public function update(Request $request, $id): RedirectResponse
    {
        $user = User::findOrFail($id);

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'address' => ['nullable', 'string', 'max:1000'],
        ], [
            'name.required' => 'Nama lengkap wajib diisi.',
            'name.string' => 'Nama lengkap harus berupa teks.',
            'name.max' => 'Nama lengkap maksimal :max karakter.',
            'address.string' => 'Alamat harus berupa teks.',
            'address.max' => 'Alamat maksimal :max karakter.',
        ]);

        $user->update([
            'name' => $validated['name'],
            'address' => $validated['address'],
        ]);

        return redirect()->route('users.index')
            ->with('success', 'Data user ' . $user->name . ' berhasil diperbarui.');
    }

    /**
     * Remove the specified user from storage.
     */
    public function delete($id): RedirectResponse
    {
        // Prevent self deletion
        if ($id == Auth::id()) {
            return redirect()->route('users.index')
                ->with('error', 'Anda tidak diperbolehkan menghapus akun Anda sendiri.');
        }

        $user = User::find($id);
        if (!$user) {
            return redirect()->route('users.index')
                ->with('error', 'User tidak ditemukan atau sudah dihapus.');
        }

        try {
            $user->delete();
            return redirect()->route('users.index')
                ->with('success', 'User ' . $user->name . ' berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->route('users.index')
                ->with('error', 'Gagal menghapus user: ' . $e->getMessage());
        }
    }
}
