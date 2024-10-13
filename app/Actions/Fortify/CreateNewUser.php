<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;
use Illuminate\Http\Request;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array<string, string>  $input
     */
    public function create(array $input): User
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => $this->passwordRules(),
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
        ])->validate();

        $roles = 'Vartotojas';  // Default role
        $userCount = User::all()->count();  // Get the count of all users

        if ($userCount == 0) {
            $roles = 'Administratorius';  // If no users exist, set role to 'admin'
        } elseif ($userCount == 1) {
        $roles = 'Darbuotojas';  // If one user exists, set role to 'worker'
        }

        return User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'roles'=> $roles,
            'password' => Hash::make($input['password']),
        ]);
    }

    public function index(){
        $users = User::all();
        return view('all_users', compact('users'));
    }

    public function editForm($id){
        $users = User::where('id', $id)->firstOrFail();

        return view('edit_users',compact("users"));
    }

    public function edit(Request $request, $id){

        $validated = $request -> validate([
           'name' => 'required|max:225|',
           'email' => 'required|max:225|',
           'roles' => 'required|max:225|',
   
        ]);

       $users = User::where('id', $id)->firstOrFail();

       $users->name = request('name');
       $users->email = request('email');
       $users->roles = request('roles');
       $users->save();

       return redirect('/all_users')->with('message_user_edit', 'Sėkmingai redagavote!');
   }

   public function removeForm($id){
    $users = User::where('id', $id)->firstOrFail(); 

    return view('remove_users]',compact("users"));
    }
    public function remove($id){
        $users = User::where('id', $id)->firstOrFail();
        $users->delete();

        return redirect('/all_users')->with('message_user_delete', 'Sėkmingai ištrynėte!');
    }
}
