<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use GuzzleHttp\Client;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;
    protected $base_uri = 'http://wishlist.test/';
    protected $client;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
        $this->client = new Client([
            'base_uri' => $this->base_uri,
        ]);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }


    public function createUser(Request $request)
    {


        $response = $this->client->post('api/storeUser', [
            'headers' => [
                'Accept' => 'application/json',
            ],
            'form_params' => [
                'name' => $request['name'],
                'email' => $request['email'],
                'password' => $request['password'],
                'password_confirmation' => $request['password_confirmation']
            ],
        ]);
        Session::flash('success', 'User was created successfully.');
        return redirect()->route('login');
    }

    public function deactivateAccount()
    {
        $result = $this->client->post('oauth/token');
        $access_token = json_decode((string) $result->getBody(), true)['access_token'];

        $response = $this->client->get('api/deactivateAccount', [
            'headers' => [
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
                'Authorization' => "Bearer $access_token",
            ]
        ]);

        return redirect()->route('register')->with('success', 'Your account has been deactivated.');
    }
}
