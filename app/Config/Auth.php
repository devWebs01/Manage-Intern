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
        'login'           => 'App\Views\auth\login',
        'register'        => 'App\Views\auth\register',
        'forgot'          => 'App\Views\auth\forgot',
        'reset'           => 'App\Views\auth\reset',
        'emailForgot'     => 'App\Views\auth\emails\forgot',
        'emailActivation' => 'App\Views\auth\emails\activation',
    ];

    /**
     * --------------------------------------------------------------------
     * Layout for the views to extend
     * --------------------------------------------------------------------
     *
     * @var string
     */
    public $viewLayout = 'App\Views\auth\layout';
}