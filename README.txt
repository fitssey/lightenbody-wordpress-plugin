=== Plugin Name ===
Contributors: lightenbody
URL: http://lightenbody.com
Tags: schedule, lightenbody
Requires at least: 3.0.1
Tested up to: 5.9.3
PHP version: 5.4.0 or greater
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

== Description ==

This plugin connects with lightenbody's api and enables you to display the schedule.

lightenbody is a web-application that helps you manage your fitness studio by enabling online schedule, online payments, bookings,
personal account for each of your customers and many more features.

== Installation ==

Upload the plugin to your plugins' directory, activate it and get the api credentials from your lightenbody's account.

== Short code ==

Basic example:
Add [lightenbody-schedule] shortcode to your WordPress page

Filter by Class Service example and start date:
Add [lightenbody-schedule start-date="2022-01-01" filter-class-services="guid1,guid2"] to your WordPress page

For more examples see Help tab in plugin settings.

== Changelog ==

= 2.3.1 =
* Fixed showing No classes today message when all classes are hidden in that day.
* Minor plugin improvements.

= 2.3.0 =
* Fixed translations.
* Fixed disabling book button when class is not available yet due to booking ahead setting.

= 2.2.9 =
* Implemented new shortcode attributes to filter schedule events

= 2.2.8 =
* Bump API version from 2 to 4
* Implemented new option to delegate booking to either popup or new window
* Minor improvements in schedule views

= 2.2.7 =
* Fixed follow redirects in Curl connections.
* Changed API base url from studio.lightenbody.com to app.fitssey.com

= 2.2.6 =
* Implemented an option to show teacher's nickname on the schedule.

= 2.2.5 =
* Implemented highlights for Calendar view.
* Minor Calendar view style improvements.

= 2.2.2 =
* Implemented a few more options in the settings.
* Implemented toggling between Agenda and Calendar views.
* Implemented overriding default translations.
* Minor code improvements.

= 2.0.0 =
* Support of lightenbody api v2.

= 1.0.0 =
* First release.
