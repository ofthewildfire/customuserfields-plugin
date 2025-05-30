<?php namespace ofthewildfire\academyusers;

use Backend;
use System\Classes\PluginBase;
use RainLab\User\Models\User as UserModel;
use RainLab\User\Controllers\Users as UsersController;

class Plugin extends PluginBase
{
    public $require = ['RainLab.User'];

    public function pluginDetails()
    {
        return [
            'name'        => 'Academy Users',
            'description' => 'Extends the Users plugin with additional fields for academy members',
            'author'      => 'ofthewildfire',
            'icon'        => 'icon-user-plus',
            'homepage'    => 'https://github.com/ofthewildfire/academyusers'
        ];
    }

    public function boot()
    {
        // Extend the User model
        UserModel::extend(function($model) {
            $model->addFillable([
                'organization',
                'city_state',
                'reason_for_joining'
            ]);
        });

        // Extend the Users controller
        UsersController::extendFormFields(function($form, $model, $context) {
            if (!$model instanceof UserModel) {
                return;
            }

            $form->addFields([
                'organization' => [
                    'label' => 'Organization',
                    'type' => 'text',
                    'tab' => 'User'
                ],
                'city_state' => [
                    'label' => 'City/State',
                    'type' => 'text',
                    'tab' => 'User'
                ],
                'reason_for_joining' => [
                    'label' => 'Reason for Joining',
                    'type' => 'textarea',
                    'tab' => 'User'
                ]
            ]);
        });

        // Add columns to the Users list
        UsersController::extendListColumns(function($list, $model) {
            if (!$model instanceof UserModel) {
                return;
            }

            $list->addColumns([
                'organization' => [
                    'label' => 'Organization',
                    'type' => 'text',
                    'searchable' => true,
                    'sortable' => true
                ],
                'city_state' => [
                    'label' => 'City/State',
                    'type' => 'text',
                    'searchable' => true,
                    'sortable' => true
                ],
                'reason_for_joining' => [
                    'label' => 'Reason for Joining',
                    'type' => 'text',
                    'searchable' => true,
                    'sortable' => true
                ]
            ]);
        });
    }

    public function registerComponents()
    {
        return [
            'ofthewildfire\academyusers\Components\ProfileForm' => 'profileForm',
            'ofthewildfire\academyusers\Components\RegisterForm' => 'registerForm'
        ];
    }
} 