<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        $users = User::latest()->get();
        return view('users.index', compact('users'));
    }

    public function updateRole(Request $request, User $user)
    {
        $request->validate([
            'role' => 'required|string|in:admin,user',
        ]);

        // Zabezpieczenie: Administrator nie może samemu sobie odebrać praw (by nie zablokować systemu)
        if ($user->id === Auth::id() && $request->role === 'user') {
            return redirect()->back()->withErrors('Nie możesz sam sobie odebrać uprawnień administratora.');
        }

        $user->update(['role' => $request->role]);
        return redirect()->back()->with('success', 'Rola użytkownika ' . $user->name . ' została zaktualizowana.');
    }

    public function destroy(User $user)
    {
        if ($user->id === Auth::id()) {
            return redirect()->back()->withErrors('Nie możesz usunąć własnego konta z poziomu panelu zarządzania.');
        }

        $user->delete();
        return redirect()->back()->with('success', 'Konto użytkownika zostało trwale usunięte.');
    }
}
