<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $q = $request->q;

        $users = User::where('role', 'user')
            ->when($q, function ($qr) use ($q) {
                $qr->where('nama', 'like', "%$q%")
                   ->orWhere('email', 'like', "%$q%")
                   ->orWhere('no_hp', 'like', "%$q%");
            })
            ->orderBy('id_user', 'asc')
            ->paginate(10);

        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        return view('admin.users.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'nama'   => 'required|string|max:255',
            'email'  => 'required|email|unique:users,email',
            'no_hp'  => 'required|string|max:20',
            'alamat' => 'required|string',
        ]);

        User::create([
            'nama'     => $request->nama,
            'email'    => $request->email,
            'no_hp'    => $request->no_hp,
            'alamat'   => $request->alamat,
            'role'     => 'user',
            'password' => Hash::make('pelanggan'),
        ]);

        return redirect()->route('admin.users.index')
                         ->with('success', 'Pelanggan berhasil ditambahkan');
    }

    public function edit($id)
    {
        $user = User::where('id_user', $id)
                    ->where('role', 'user')
                    ->firstOrFail();

        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = User::where('id_user', $id)
                    ->where('role', 'user')
                    ->firstOrFail();

        $request->validate([
            'nama'   => 'required|string|max:255',
            'email'  => [
                'required',
                'email',
                Rule::unique('users', 'email')->ignore($user->id_user, 'id_user')
            ],
            'alamat' => 'required|string',
            'no_hp'  => 'required|string|max:20',
            'password' => 'nullable|min:5',
        ]);

        $data = [
            'nama'   => $request->nama,
            'email'  => $request->email,
            'alamat' => $request->alamat,
            'no_hp'  => $request->no_hp,
        ];

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return redirect()->route('admin.users.index')
                         ->with('success', 'Data pelanggan berhasil diperbarui');
    }
        public function destroy($id)
    {
        $user = User::where('id_user', $id)
                    ->where('role', 'user')
                    ->firstOrFail();

        $user->delete();

        return redirect()->route('admin.users.index')
                         ->with('success', 'Data pelanggan berhasil dihapus');
    }
}
