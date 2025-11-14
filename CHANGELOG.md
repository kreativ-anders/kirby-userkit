# Changelog

All notable changes to Kirby Userkit will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [1.0.0] - 2025-10-14

### Changed
- **BREAKING**: Converted from add-on to Kirby plugin architecture
- **BREAKING**: Configuration options now use plugin namespace: `kreativ-anders.userkit.*`
  - `user.email.activation` → `kreativ-anders.userkit.user.email.activation`
  - `user.email.activation.sender` → `kreativ-anders.userkit.user.email.activation.sender`
  - `user.email.activation.subject` → `kreativ-anders.userkit.user.email.activation.subject`
- Moved all controllers, templates, and blueprints to `site/plugins/userkit/`
- Updated snippet reference from `notification` to `userkit/notification`
- Installation now via Composer, Git submodule, or manual plugin installation

### Added
- Plugin structure in `site/plugins/userkit/`
- `composer.json` for Composer/Packagist support
- `package.json` for npm support
- Plugin-specific README at `site/plugins/userkit/README.md`
- Comprehensive customization documentation in main README
- Examples for overriding templates, styles, controllers, and email templates

### Removed
- Add-on installation method (copy/paste folders)
- Old controller, template, and blueprint files from `site/` directories
- Routes configuration from `site/config/config.php` (now handled by plugin)

### Migration Guide

If you're upgrading from the add-on version:

1. **Backup your installation**

2. **Update configuration in `site/config/config.php`:**
   ```php
   // OLD
   'user.email.activation' => false,
   'user.email.activation.sender' => '...',
   'user.email.activation.subject' => 'Account Activation Link',
   
   // NEW
   'kreativ-anders.userkit.user.email.activation' => false,
   'kreativ-anders.userkit.user.email.activation.sender' => '...',
   'kreativ-anders.userkit.user.email.activation.subject' => 'Account Activation Link',
   ```

3. **Remove routes from `site/config/config.php`** - the plugin now handles them

4. **Install the plugin:**
   - Git submodule: `git submodule add https://github.com/kreativ-anders/kirby-userkit.git site/plugins/userkit`
   - Or copy the `site/plugins/userkit` folder to your installation

5. **If you customized templates:**
   - Keep your customized templates in `site/templates/`
   - They will override the plugin's templates automatically

6. **If you customized controllers:**
   - Keep your customized controllers in `site/controllers/`
   - They will override the plugin's controllers automatically

## [0.x.x] - Previous versions

Previous versions were distributed as an add-on, not a plugin.
