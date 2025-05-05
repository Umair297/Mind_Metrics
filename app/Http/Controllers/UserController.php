<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
 
        $users = User::orderBy('created_at', 'DESC')->get();
        return view('users.list', compact('users'));
    }

   public function create()
   {
       return view('users.create');
   }


   public function store(Request $request)
   {
       $messages = [
        'email.unique' => '',
    ];
    
       $rules = [
           'name' => 'required',
           'email' => 'required',
           'password' => 'required',
           'role' => 'required',
       ];
   
       $validator = Validator::make($request->all(), $rules, $messages);
       if ($validator->fails()) {
           return redirect()->route('users.create')->withInput()->withErrors($validator);
       }
   
       $user= new User();
       $user->name = $request->name;
       $user->email = $request->email;
       $user->password = bcrypt($request->password);
       $user->role = $request->role;
       $user->save();
   
return redirect()->route('users.index')->with('success', 'User created successfully!');
   }
   public function edit($id)
   {
       $user= User::findOrFail($id);
       return view('users.list', [
           'employe' => $user
       ]);
   }
   
  public function update(Request $request, User $user)
{
    $request->validate([
        'name' => 'required',
        'email' => 'required',
        'role' => 'required',
        'password' => 'nullable', 
    ]);

    $user->name = $request->name;
    $user->email = $request->email;
    if ($request->filled('password')) {
        $user->password = Hash::make($request->password);
    }
    $user->role = $request->role;
    $user->save();
    return redirect()->route('users.index')->with('success', 'User updated successfully.');
}
   public function destroy($id)
   {
       $user = User::findOrFail($id);
       $user->delete();
   
       return redirect()->route('users.index')->with('success', 'User deleted successfully!');
   }
}
