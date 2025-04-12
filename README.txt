=== User Mass Messaging ===
Contributors: Mohammad Imran
Tags: messaging, bulk messaging, messages, friends, user profile, BuddyBoss
Requires at least: 5.0
Tested up to: 6.0
Requires PHP: 7.2
Stable tag: 1.0.0
License: GPL-2.0+
License URI: http://www.gnu.org/licenses/gpl-2.0.txt

== Description ==

User Mass Messaging is a WordPress plugin that allows users to send bulk messages to their friends directly from their profile connection tab. This plugin is perfect for BuddyBoss users who need to send a message to all their connections at once. It adds a "Send Message" button to the user profile, allowing users to compose a message and send it to all their connections at once.

Features:
- Send bulk messages to all friends from the profile connection tab.
- Easy-to-use interface integrated with BuddyBoss.
- Ensures security through nonce verification to prevent unauthorized access.
- Customizable message and connection selection.

== Installation ==

1. Download the plugin zip file.
2. Go to the WordPress Admin dashboard.
3. Navigate to Plugins > Add New.
4. Click on "Upload Plugin" and choose the plugin zip file.
5. Click "Install Now" and then "Activate" the plugin.

Alternatively, you can install the plugin manually:
1. Upload the `user-mass-messaging` folder to your `/wp-content/plugins/` directory.
2. Activate the plugin from the Plugins menu in WordPress.

== Usage ==

Once the plugin is activated:
1. Go to the "Connections" tab in your BuddyBoss profile.
2. You will see a "Send Message" button.
3. Click the button to open the message compose window.
4. The plugin will automatically pre-select all of your connections, so you can send a message to all your friends at once.
5. Compose your message and hit "Send" to notify your connections.

== Frequently Asked Questions ==

= Can I customize the message composition window? =
Yes, you can customize the message composition window and the way messages are sent by modifying the plugin code or extending it via hooks and filters.

= Does this plugin work without BuddyBoss? =
No, this plugin relies on BuddyBoss for the user connections and profile tabs. It will not work without BuddyBoss being active on your WordPress site.

= How can I report a bug or request a feature? =
You can report bugs or request new features by visiting the plugin's GitHub repository: https://github.com/wbimran/user-mass-messaging.

== Changelog ==

= 1.0.0 =
* Initial release of the plugin.
* Allows users to send mass messages to all their friends via the "Send Message" button in the user profile connection tab.
* Nonce verification added for security.

== Upgrade Notice ==

= 1.0.0 =
First version. No previous version to upgrade from.

== Additional Information ==

* Author: Mohammad Imran
* Author URI: https://github.com/wbimran
* Plugin URI: https://github.com/wbimran/user-mass-messaging
* Text Domain: user-mass-messaging
* Domain Path: /languages

== License ==

This plugin is licensed under the GPL-2.0+ License. You can redistribute it and/or modify it under the terms of the GPL License.

