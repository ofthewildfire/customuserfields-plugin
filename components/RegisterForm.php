<?php namespace ofthewildfire\customuserfields\Components;

use Cms\Classes\ComponentBase;
use RainLab\User\Components\Account as AccountComponent;
use RainLab\User\Models\User as UserModel;
use Lang;
use Flash;
use Redirect;
use ValidationException;
use ApplicationException;

class RegisterForm extends AccountComponent
{
    public function componentDetails()
    {
        return [
            'name'        => 'Extended Registration Form',
            'description' => 'Registration form with additional academy fields'
        ];
    }

    public function defineProperties()
    {
        return [
            'redirect' => [
                'title'       => 'Redirect to',
                'description' => 'Page name to redirect to after registration',
                'type'        => 'dropdown',
                'default'     => ''
            ]
        ];
    }

    public function onRun()
    {
        parent::onRun();
    }

    public function onRegister()
    {
        try {
            if (!post('email') || !post('password')) {
                throw new ValidationException(['error' => Lang::get('rainlab.user::lang.account.invalid_user')]);
            }

            // Get the base registration data
            $data = [
                'email'                 => post('email'),
                'password'              => post('password'),
                'first_name'           => post('first_name'),
                'last_name'            => post('last_name'),
                'organization'         => post('organization'),
                'city_state'          => post('city_state'),
                'reason_for_joining'  => post('reason_for_joining')
            ];

            // Register the user
            $user = $this->register($data);

            // Log them in
            \Auth::login($user);

            // Redirect
            if ($redirect = $this->property('redirect')) {
                return Redirect::to($redirect);
            }
        }
        catch (ValidationException $ex) {
            throw $ex;
        }
        catch (ApplicationException $ex) {
            throw $ex;
        }
    }

    protected function register($data)
    {
        $user = new UserModel;
        $user->fill($data);
        $user->save();

        return $user;
    }
} 