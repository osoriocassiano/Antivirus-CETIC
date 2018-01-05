<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

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
    protected $redirectTo = '/usuario_sistema';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|min:3|alpha|max:255',
            'email' => 'required|email|max:255|unique:tbl_usuario_sistema',
            'password' => 'required|min:6|confirmed',
            'us_apelido' => 'required|min:3|alpha|max:255',
            'us_cargo' => 'required|max:255',
            'us_tipo' => 'required|max:255',
            'username' => 'required|max:255',
        ],
            [   'name.required' => 'O Nome é obrigatório!',
                'name.alpha' => 'Caracteres alfabéticos permitidos!',
                'name.min' => 'Permitidos pelo menos três caracteres!',
                'us_apelido.required' => 'O Apelido é obrigatório!',
                'us_apelido.alpha' => 'Caracteres alfabéticos permitidos!',
                'us_apelido.min' => 'Permitidos pelo menos três caracteres!',
                'us_cargo.required' => 'O Cargo é obrigatório!',
                'us_tipo.required' => 'O Tipo de Usuario é obrigatório!',
                'email.required' => 'O Email é obrigatório!',
                'email.email' => 'Introduza um nome válido!',
                'email.unique' => 'Email já existente na base de dados.',
                'password.required' => 'A Senha é obrigatória!',
                'password.min' => 'A Senha deve ser de pelo menos 6 caracteres!',
                'password.confirmed' => 'As senhas não são compatíveis!',
            ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'us_apelido' => $data['us_apelido'],
            'us_cargo' => $data['us_cargo'],
            'us_tipo' => $data['us_tipo'],
            'username' => $data['username'],
        ]);
    }
}
