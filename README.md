# Kirby Userkit Plugin

* [What do you get?](#what-do-you-get)
* [Installation](#installation)
* [Configuration](#configuration)
* [Customization](#customization)
* [Notes](#notes)
    * [Kirby CMS Licence](#kirby-cms-licence)
* [Support](#support)  
* [Contribute](#contribute)


## What do you get?
A functional, lean, and unstyled Kirby User Management Plugin for Kirby CMS.

**Functionality** | **Comment**
--------------------------- | --------------------------- 
Register / Login            | Yes
Activation by Email         | Yes (Disabled by dafault)
Logout                      | Virtual    
Change Email                | Yep
Change Password             | Sure
Export Data                 | CSV & JSON
Dedicated Role              | Of course
CSS                         | Nope
Data Validation             | Yes
Success Messages            | Partly (Best is to do it manually to adapt to **YOUR** way of working.)
Messages                    | Mix of hardcoded and page content

## Why not use login with Google/Facebook/etc.?
Short answer: **Simplicity and Privacy**. An individual solution like this keeps it simple and create a stronger bond between you and your visitors. No dependency on third parties like Firebase, Okta, OAuth2, etc.

## Installation

> **Note:** If you're upgrading from the add-on version, please see the [CHANGELOG.md](CHANGELOG.md) for migration instructions.

### Option 1: Git Submodule (Recommended)
```bash
cd /path/to/your/kirby-project
git submodule add https://github.com/kreativ-anders/kirby-userkit.git site/plugins/userkit
```

### Option 2: Composer
```bash
composer require kreativ-anders/kirby-userkit
```

### Option 3: Manual Installation
1. Download the repository
2. Unzip the files
3. Copy the `site/plugins/userkit` folder to your Kirby installation's `site/plugins/` directory

### Setting up pages
After installation, you need to create the following pages in your Kirby Panel or content folder:

- **Login** page (slug: `login`, template: `login`)
- **Register** page (slug: `register`, template: `register`)  
- **User** page (slug: `user`, template: `user`)

The plugin automatically handles the logout route at `/logout`.

## Configuration

Add these options to your `site/config/config.php`:

```php
return [
  // Email configuration (required for activation emails)
  'email' => [
    'transport' => [
      'type' => 'smtp',
      'host' => 'smtp.example.com',
      'port' => 587,
      'security' => 'tls',
      'auth' => true,
      'username' => 'your-email@example.com',
      'password' => 'your-password'
    ]
  ],
  
  // Userkit plugin options
  'kreativ-anders.userkit.user.email.activation' => false, // Enable/disable email activation
  'kreativ-anders.userkit.user.email.activation.sender' => 'noreply@example.com', // Sender email
  'kreativ-anders.userkit.user.email.activation.subject' => 'Account Activation Link', // Email subject
];
```

### Configuration Options

Option | Type | Default | Description
--- | --- | --- | ---
`kreativ-anders.userkit.user.email.activation` | `bool` | `false` | Enable or disable email activation for new users
`kreativ-anders.userkit.user.email.activation.sender` | `string` | `null` | Email address used as sender for activation emails (required when activation is enabled)
`kreativ-anders.userkit.user.email.activation.subject` | `string` | `'Account Activation Link'` | Subject line for activation emails

## Customization

### Overriding Templates

To customize the appearance of the user management pages, you can override the plugin templates in your site:

1. Create the following directory structure in your site:
   ```
   site/templates/
   ├── login.php
   ├── register.php
   └── user.php
   ```

2. Copy the template files from `site/plugins/userkit/templates/` and customize them to match your design.

### Overriding Styles

The plugin comes without any CSS styling by default. Add your custom styles in your site's CSS file:

```css
/* Example custom styles for user forms */
form fieldset {
  border: 1px solid #ccc;
  padding: 20px;
  border-radius: 5px;
}

form input[type="email"],
form input[type="password"] {
  width: 100%;
  padding: 10px;
  margin: 5px 0;
}

form input[type="submit"] {
  background: #007bff;
  color: white;
  padding: 10px 20px;
  border: none;
  cursor: pointer;
}
```

### Overriding Email Templates

To customize activation email templates:

1. Create directory: `site/templates/emails/`
2. Copy `account-activation.html.php` and `account-activation.text.php` from plugin
3. Customize the email content to your needs

### Overriding Controllers

To customize the controller logic, you can override the page controllers in your site:

1. Create `site/controllers/` directory if it doesn't exist
2. Copy the controller you want to customize from `site/plugins/userkit/controllers/`
3. Modify the logic as needed

For example, to change the activation token length in the register controller:

```php
// site/controllers/register.php
<?php

return function ($kirby) {
  // Change token length from default 16 to 32
  $token = Str::random(32);
  
  // ... rest of the controller logic
};
```

### Extending Functionality

You can check the user's activation status in your templates or controllers:

```php
if ($kirby->user() && $kirby->user()->emailActivation() == true) {
  // User account is activated
} else {
  // Account is not activated, show activation notice
}
```

### Custom Redirect Pages

In the plugin's route for activation (`site/plugins/userkit/index.php`), you can customize redirect destinations:

```php
// Successful activation redirect
go('welcome'); // Instead of go();

// Failed activation redirect  
go('activation-error'); // Instead of return false;
```

## Notes:
This Plugin is built for Kirby CMS based on **Kirby´s Starterkit Version 4.0.2**. 

Ensure you add the pages/links for the following pages somewhere in your snippets or templates:

- Register (`/register`)
- Login (`/login`)
- Logout (`/logout`) - automatically routed by the plugin
- User (`/user`)

> :warning: The user will be logged in even if the account is not activated by email yet! You can check `$kirby->user()->emailActivation()` for disabling certain features, pages, etc.

To customize email templates, see the [Customization](#customization) section above.

In case the user changes the email address, the activation status is set to `false` and another activation email will be sent.

### Kirby CMS Licence 
**Kirby CMS requires a dedicated licence:**

*Go to https://getkirby.com/buy*

## Disclaimer
The source code is provided "as is" with no guarantee. Use it at your own risk and always test it yourself before using it in a production environment. If you find any issues, please create a new issue.

## Support

If this plugin saved you some time and energy, consider supporting kreativ-anders by donating via [PayPal](https://paypal.me/kreativanders) or becoming a **GitHub Sponsor**.

## Contribute

Feel free to fork the repository and participate.
