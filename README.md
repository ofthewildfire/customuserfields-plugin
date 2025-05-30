# Academy Users Plugin for OctoberCMS

Extends the OctoberCMS Users plugin with additional fields for academy members.

## Features

- Adds custom fields for academy members:
  - Organization
  - City/State
  - Reason for Joining
- Provides a user-friendly profile form component
- Enhances backend Users list view with new columns

## Installation

1. Install the plugin via Composer:
```bash
composer require ofthewildfire/academyusers
```

2. **Important**: After installation, run the database migration:
```bash
php artisan october:migrate
```
> Note: If you get a SQL error about missing columns, this step was missed! The migration is required to add the necessary database columns.

## Usage

The plugin automatically extends the user profile with additional fields. To display the profile form on your frontend, use the included component:

```twig
{% component 'profileForm' %}
```


# customuserfields-plugin
