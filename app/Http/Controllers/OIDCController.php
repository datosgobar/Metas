<?php

namespace App\Http\Controllers;
use App\User;
use App\Role;
use Illuminate\Http\Request;
use App\Http\Resources\User as UserResource;
use Jumbojett\OpenIDConnectClient;
use Illuminate\Support\Facades\Hash;

class OIDCController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function __construct()
    {
      //
    }

    public function loginMiArgentina(Request $request)
    {
       // OIDC config
       $oicd_url = config('oidc.url');
       $oicd_client_id = config('oidc.client_id');
       $oicd_client_secret = config('oidc.client_secret');
       
       // Create the client
       $client = new OpenIDConnectClient($oicd_url, $oicd_client_id, $oicd_client_secret);
 
       // Add scopes
       $client->addScope('profile');
       $client->addScope('email');
 
       // Set the redirect URL
       $redirect_url = route('auth.miargentina');
       $client->setRedirectURL($redirect_url);
       
      // get the absolute route for route name "auth.miargentina"

       if(!$client->authenticate()){
         return redirect()->route('login')->with('message', 'Hubo un error al autenticar con MiArgentina');
       }
 
       // Retrieve the user's information using the access token
       $userInfo = $client->requestUserInfo();
 
       // Check if the user exists
       $user = User::where('oidc_id', $userInfo->sub)->first();
  
       
       if (!$user) {
         // check the name, surname and email are not empty
         if (empty($userInfo->given_name) || empty($userInfo->family_name) || empty($userInfo->email)) {
           return redirect()->route('login')->with('message', 'Hubo un error al autenticar con MiArgentina (Código 10: Nombre, apellido o email no pueden estar vacíos)');
         }
         
         // Check the user's email
         $aux = User::where('email', $userInfo->email)->first();
         if ($aux) {
           return redirect()->route('login')->with('message', 'El email ya se encuentra en uso');
         }
 
         // make a random string with 28 random alphanumeric characters
         $password = substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil(28/strlen($x)) )),1,28);
 
         // Create the user
         $user = User::create([
           'oidc_id' => $userInfo->sub,
           'email' => $userInfo->email,
           'name' => $userInfo->given_name,
           'surname' => $userInfo->family_name,
           'password' => Hash::make($password),
         ]);
 
         // force mail verify 
         $user->email_verified_at = now();
         $user->save();
 
         $user->roles()->attach(Role::where('name', 'user')->first());
 
       } else {
         // Update the user
         $user->email = $userInfo->email;
         $user->name = $userInfo->given_name;
         $user->surname = $userInfo->family_name;
         $user->save();
       }
 
      // Log the user in
      auth()->login($user, true);

      return redirect()->route('home');

    }
}