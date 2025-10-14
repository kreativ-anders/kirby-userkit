# Kirby Userkit Plugin

This is the plugin directory for Kirby Userkit. For complete documentation, installation instructions, and customization options, please see the main [README.md](../../../README.md) in the repository root.

## Plugin Structure

```
userkit/
├── index.php                      # Plugin registration and routes
├── controllers/                   # Page controllers
│   ├── login.php                  # Login controller
│   ├── register.php               # Registration controller
│   └── user.php                   # User settings controller
├── templates/                     # Page templates
│   ├── login.php                  # Login template
│   ├── register.php               # Registration template
│   ├── user.php                   # User settings template
│   ├── user.json.php              # JSON export template
│   ├── user.csv.php               # CSV export template
│   └── emails/                    # Email templates
│       ├── account-activation.html.php
│       └── account-activation.text.php
├── blueprints/                    # Panel blueprints
│   ├── pages/
│   │   ├── login.yml
│   │   └── register.yml
│   └── users/
│       └── user.yml
└── snippets/                      # Reusable snippets
    └── notification.php           # Notification display snippet
```

## Quick Start

After installation, create the following pages in your Kirby site:
- Login page (slug: `login`, template: `login`)
- Register page (slug: `register`, template: `register`)
- User page (slug: `user`, template: `user`)

Configure the plugin options in your `site/config/config.php`:

```php
return [
  'kreativ-anders.userkit.user.email.activation' => false,
  'kreativ-anders.userkit.user.email.activation.sender' => 'noreply@example.com',
  'kreativ-anders.userkit.user.email.activation.subject' => 'Account Activation Link',
];
```

For full documentation, see the [main README](../../../README.md).
