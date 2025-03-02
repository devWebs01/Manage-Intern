<?php namespace Config;

use CodeIgniter\Config\BaseConfig;
use Myth\Auth\Config\Auth as AuthConfig;

class Auth extends AuthConfig
{

    /**
     * --------------------------------------------------------------------
     * Require Confirmation Registration via Email
     * --------------------------------------------------------------------
     *
     * When enabled, every registered user will receive an email message
     * with an activation link to confirm the account.
     *
     * @var string|null Name of the ActivatorInterface class
     */
    public $requireActivation = null;


    public $views = [
        'login'           => 'App\Views\Auth\login',
        'register'        => 'App\Views\Auth\register',
        'forgot'          => 'App\Views\Auth\forgot',
        'reset'           => 'App\Views\Auth\reset',
        'emailForgot'     => 'App\Views\Auth\emails\forgot',
        'emailActivation' => 'App\Views\Auth\emails\activation',
    ];

    /**
     * --------------------------------------------------------------------
     * Layout for the views to extend
     * --------------------------------------------------------------------
     *
     * @var string
     */
    public $viewLayout = 'App\Views\Auth\layout';
}