<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    public function admin()
    {
        $data = [
            'title' => 'Akun Admin',
            'role' => 'Admin'
        ];
        return view('user.admin', $data);
    }
    public function operator()
    {
        $data = [
            'title' => 'Akun Operator Puskesmas',
            'role' => 'Operator'
        ];
        return view('user.operator', $data);
    }
    public function pj()
    {
        $data = [
            'title' => 'Akun Penanggung Jawab Puskesmas',
            'role' => 'PJ-KB'
        ];
        return view('user.pj', $data);
    }
    public function getUserDataTable($role)
    {
        $user = User::orderByDesc('id')->where('role', $role);

        return DataTables::of($user)
            ->addColumn('action', function ($user) {
                return view('user.components.actions', compact('user'));
            })
            ->rawColumns(['action'])
            ->make(true);
    }
    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users,email',
        ];


        if (!$request->filled('id')) {
            $rules['password'] = 'required|string|min:8';
            $request->validate($rules);
        }
        if ($request->input('role') != 'Admin') {
            $rules['id_puskesmas'] = 'required|string';
            $request->validate($rules);
        }

        $userData = [
            'name' => $request->input('name'),
            'last_name' => $request->input('last_name'),
            'email' => $request->input('email'),
            'role' => $request->input('role'),
            'id_puskesmas' => $request->input('id_puskesmas'),
        ];
        if (!$request->filled('last_name')) {
            $userData['last_name'] = '';
        }

        if ($request->filled('password')) {
            $userData['password'] = $request->input('password');
        }

        if ($request->filled('id')) {
            $user = User::find($request->input('id'));
            if (!$user) {
                return response()->json(['message' => 'User not found'], 404);
            }

            $user->update($userData);
            $message = 'User updated successfully';
        } else {
            User::create($userData);
            $message = 'User created successfully';
        }

        return response()->json(['message' => $message]);
    }

    public function destroy($id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json(['message' => 'user not found'], 404);
        }

        $user->delete();

        return response()->json(['message' => 'user deleted successfully']);
    }
    public function edit($id)
    {
        $customer = User::find($id);

        if (!$customer) {
            return response()->json(['message' => 'user not found'], 404);
        }

        return response()->json($customer);
    }
}
