<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     *
     * @param  \App\Http\Requests\Auth\LoginRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(LoginRequest $request)
    {
        $user = User::where('email', $request->email)->first();
        $attr = $request->validate([
            'email' => 'required|string|email|',
            'password' => 'required|string|min:3'
        ]);

    if (!Auth::attempt($attr)) {
        return response()->json('credentials incorrect', 403);
    }
    if($user->hasRole('ADMIN')){
        $token = $user->createToken('api-token',['admin_privilege'])->plainTextToken;
    }else if($user->hasRole('directeur')){
        $token = $user->createToken('api-token',['direct_privilege'])->plainTextToken;
    }else{
        $token = $user->createToken('api-token')->plainTextToken;
    }
    $data = [
        "user"=>$user,
        "token=>$token"
    ];
    return response()->json($data, 200);
    }

    /**
     * Destroy an authenticated session.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
       
       $request->user()->tokens()->delete();


      

        

        return response()->json(null,204);
    }

    /**
     * Destroy an authenticated session.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function addUser(Request $request)
    {
        $user = $request->user();
        if($user->tokenCan('admin_privilege'))
        {
        
       
        // $u = new User;
        // $u->setEmail($request->data['email']);
        // {
        //     $user = User::create($u);
        //     $roles = UserRole::create($requet()->data['roles']);
       
            
            $user = User::create($request->all());
            if($request->role=='admin'){
                $role=1;
            }else if ($request->role=='directeur'){
                $role = 3;
            }else{
                $role = 2;
            }
            DB::table('user_roles')->insert([
                'user_id'=> $user->id,
                'role_id'=>$role
            ]);
           return response()->json($user, 201);
        }
    }
}
