<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Zone;
use App\Models\Branch;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $data['users'] = User::all();
        $data['branches'] = Branch::all();
        $data['zones'] = Zone::all();
        return view('system.auth.login', $data);
    }


    public function login_store(Request $request)
    {

        $request->validate([
            'branch' => 'required|exists:branches,id',
            'zone' => 'required|exists:zones,id',
            'name' => 'required|string|exists:users,name',
            'password' => 'required|string',
        ]);


        $user = User::where('branch_id', $request->branch)
            ->where('zone_id', $request->zone)
            ->where('name', $request->name)
            ->first();

        if ($user && Hash::check($request->password, $user->password)) {

            Auth::login($user);

            return redirect('/');
        }
        return back()->withErrors([
            'password' => 'The provided credentials do not match our records.',
        ]);
    }

    public function waterpower_logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login')->with('success', 'You have been logged out.');
    }




    public function users()
    {
        $users = User::latest()->get();
        return view('system.components.user.index', compact('users'));
    }

    public function users_create(Request $request)
    {
        $data['branches'] = Branch::all();
        $data['zones'] = Zone::all();
        $data['roles'] = Role::orderBy('name', 'ASC')->get();
        return view('system.components.user.create', $data);
    }

    public function users_store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:3|confirmed',
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->mobile = $request->mobile;
        $user->password = Hash::make($request->password);
        $user->username = $request->username;
        $user->status = $request->status;
        $user->branch_id = (int) $request->branch_id;
        $user->zone_id = (int) $request->zone_id;
        $user->syncRoles($request->role);

        if ($request->hasFile('photo')) {
            $image = $request->file('photo');
            $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $imagePath = public_path('uploads/users/photos');

            if (!File::exists($imagePath)) {
                File::makeDirectory($imagePath, 0755, true);
            }

            $image->move($imagePath, $imageName);
            $user->photo = 'uploads/users/photos/' . $imageName;
        }

        $user->save();

        return redirect()->back()->with('success', 'User created successfully!');
    }


    public function users_edit($id)
    {
        $user = User::find($id);
        $roles = Role::orderBy('name', 'ASC')->get();
        $hasRoles = $user->roles->pluck('id');
        $branches = Branch::all();
        $zones = Zone::all();
        return view('system.components.user.edit', [
            'user' => $user,
            'roles' => $roles,
            'hasRoles' => $hasRoles,
            'branches' => $branches,
            'zones' => $zones
        ]);
    }

    public function users_update(Request $request, $id){
        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->mobile = $request->mobile;
        $user->password = Hash::make($request->password);
        $user->username = $request->username;
        $user->status = $request->status;
        $user->branch_id = (int) $request->branch_id;
        $user->zone_id = (int) $request->zone_id;
        $user->syncRoles($request->role);

        if ($request->hasFile('photo')) {
            $image = $request->file('photo');
            $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $imagePath = public_path('uploads/users/photos');

            if ($user->photo && File::exists(public_path($user->photo))) {
                File::delete(public_path($user->photo));
            }

            if (!File::exists($imagePath)) {
                File::makeDirectory($imagePath, 0755, true);
            }

            $image->move($imagePath, $imageName);
            $user->photo = 'uploads/users/photos/' . $imageName;
        }

        $user->save();

        return redirect()->back()->with('success', 'User Updated successfully!');
    }

    public function users_delete($id){
        $user = User::find($id);
        if ($user->photo && File::exists(public_path($user->photo))) {
            File::delete(public_path($user->photo));
        }
        $user->delete();
        return redirect()->back()->with('success', 'User Deleted successfully!');
    }
}



