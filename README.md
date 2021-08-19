# Kirby Userkit Add-On (Pre-Release)

* [What do you get?](#what-do-you-get)
* [Why an Add-On?](#why-an-add-on)
* [Installation](#installation)
* [Notes](#notes)
    * [Kirby CMS Licence](#kirby-cms-licence)
* [Support](#support)  


## What do you get?
A functional, lean, and unstyled Kirby User Management Add-On (Pre-Release) for Kirby CMS.

**Functionality** | **Comment**
---- | ----
Register / Login| Yes
Activation by Email | Yes (Not by dafault)
Logout | Virtual
Change Email | Yep
Change Password | Sure
Export Data | CSV & JSON
Dedicated Role | Of course
CSS | Nope
Data Validation | Yes
Success Messages | Partly (Best is to do it manually to adapt to **YOUR** way of working.)
Messages | Mix of hardcoded and page content

## Why not use login with Google/Facebook/etc.?
Short answer: Privacy! An individual solution like this keeps it simple and create a stronger bond between you and your visitors.

## Why an Add-On?
IMHO a Plug-in does not make sense due to interoperability. 
Also this kind of Add-On adapts way more easy to **YOUR** project.

## Installation:
1. Unzip the files.
1. Paste (overwrite) the folder *content* and *site* on top of the root folder of your Kirby installation.
1. Done!

### Configuration
- Set `email` config (see [Kirby email options](https://getkirby.com/docs/reference/system/options/email))
- Set `user.email.activation` config to true (default false).
- Set `user.email.activation.sender` config email sender (mandatory when email activation is enabled).
- Set `user.email.activation.subject` config email subject (mandatory when email activation is enabled).
- Change activation token length in `register.php` controller (default 12).

## Notes:
This Add-On is built for Kirby CMS based on **Kirby´s Starterkit Version 3.5.7.1**. 

In case you are using Kirby´s Plainkit ensure to add the pages/links for the following pages somewhere in your snippets or templates!

- Register 
- Login
- Logout
- User 

> Last Login have been removed since hooks make life more difficult.

The user will be logged in even the account is not activated by email yet! 
You can check `$kirby->user()->emailActivation()` for disabling certain features, pages etc.

To change the email template go to `templates\email\account-activation.*.php`.

In case the user changes the email adress teh activation status is set to `false`and another email will be sent.

### Kirby CMS Licence 
**Kirby CMS requires a dedicated licence:**

*Go to https://getkirby.com/buy*

## Disclaimer
The source code is provided "as is" with no guarantee. Use it at your own risk and always test it yourself before using it in a production environment. If you find any issues, please create a new issue.

## Support

In case this Add-On saved you some time and energy consider supporting kreativ-anders by donating via [PayPal](https://paypal.me/kreativanders) or becoming a **GitHub Sponsor**.
