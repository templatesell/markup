=== Markup ===

Contributors: templatesell
Tags: custom-background, custom-header, one-column, two-columns, three-columns, custom-logo, custom-menu, featured-images, threaded-comments, translation-ready, blog, news
Requires at least: 6.0
Requires PHP: 7.4
Tested up to: 7.1
Stable tag: 1.0.6
License: GNU General Public License v2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

A perfect theme for blog and magazine site. With masonry layout and multiple blog page layout, this theme is the awesome and minimal theme. This theme has search option, off-canvas sidebar, multiple sidebar options, footer options, featured slider, promo boxed, footer widgets and many more. Besides that, this theme comes with added custom widgets for author information, featured posts, social icons, etc. It comes with primary color option to change the whole site color with a single click. It is advertisement ready theme. More Details: https://www.templatesell.com/item/markup-masonry-wordpress-blog-theme/

== Description ==

A perfect theme for blog and magazine site. With masonry layout and multiple blog page layout, this theme is the awesome and minimal theme.
== Installation ==

1. In your admin panel, go to Appearance > Themes and click the Add New button.
2. Click Upload Theme and Choose File, then select the theme's .zip file. Click Install Now.
3. Click Activate to use your new theme right away.

== Frequently Asked Questions ==

= Does this theme support any plugins? =

Markup includes support for Infinite Scroll in Jetpack.

== Notes ==
* Custom pagination for numeric is made.

== Changelog ==
= 1.0.6 - August 20 2026 =
* Fixed - Fatal error on pages with non-ASCII permalinks. Percent-encoded characters in a URL were read as sprintf() format specifiers, which threw an uncaught ArgumentCountError on PHP 8 and returned a 500 for the whole page.
* Fixed - PHP warnings in the feed, from a theme options global that was only populated in header.php.
* Fixed - The editor requested a Google Fonts URL with an HTML fragment pasted inside it, which left a malformed display parameter on the request. Google tolerated it and still served the font, so nothing visibly broke, but the URL was wrong and it is moot now that the fonts are bundled.
* Fixed - Post tags rendered outside their own styling wrapper, because the span was closed before the tag list rather than around it.
* Fixed - Block pattern styles were enqueued behind is_admin(), so patterns were styled in the editor but not on the published page. The function was also named after a different theme, copied from prefer-blog.
* Fixed - Block patterns were registered at file scope, before init, so the strings in their titles forced an early text domain load. WordPress 6.7 and later reported that as doing_it_wrong on every request.
* Fixed - The ajax pagination check called paginate_links() with no arguments purely to test truthiness, building the whole pagination markup and discarding it. The numeric pagination also left an empty div when there was only one page.
* Fixed - Pagination arrows were wrapped in translation functions but contained only an icon element, so a translator saw markup and no words.
* Fixed - A stray echo inside a pre_get_posts filter, which risked sending output before the headers.
* Fixed - Requires PHP said 4.7, which has never been a PHP version, Stable tag said 1.0.0 against a 1.0.5 theme, and the readme tag list had drifted from style.css.
* Fixed - custom-background was advertised in the theme tags but never registered.
* Security - Added nonce and capability checks to the Upgrade To Pro notice dismissal, which previously wrote user meta straight from a GET parameter.
* Security - Escaped all remaining theme output, including the search form, the Customizer category control and the social sharing links.
* Changed - Fonts are now bundled with the theme. They were served through a loader that still had to reach fonts.googleapis.com on first use and cache into the uploads directory, so it needed both outbound network access and a writable uploads folder.
* Changed - Typography. Body copy and headings shared a line-height of 1.5, which was tight for body text and loose for a 29px heading. Body copy is now 16px at 1.75 and headings 1.25, headings gained a little negative tracking, and the top of the size scale was opened up so h1 reads clearly larger than h3.
* Accessibility - Darkened the muted grey used for post categories and post navigation from #989ea6 to #70757b, raising it from 2.7:1 to 4.65:1 against white.
* Accessibility - Search field placeholders were #bbbbbb at 1.92:1, which is unreadable for many people. They are now #70757b at 4.65:1.
* Accessibility - The primary colour #ec407a measured 3.76:1, which passes for large text but not for the menu and pagination labels it was used on. The default is now #e5175c at 4.56:1, the lightest colour on the same hue that meets WCAG AA. The old value can be restored in Customizer > Colors.
* Added - The Share label is now translatable; it was hard coded English.
* Added - Recommended plugins notice for the free Template Sell plugins. Nothing is bundled or installed automatically.
* Added - languages/markup.pot so the theme can be translated.
* Changed - Every enqueued asset now carries the theme version, and render-blocking scripts were moved to the footer.
* Changed - Requires PHP raised to 7.4 and Requires at least set to 6.0.
* Tested with WP 7.1

= 1.0.5 - June 22 2022 =
* Load Google fonts locally
* Tested with WordPress 6.0

= 1.0.4 - February 21 2022 =
* Fixed image size issues in search page
* Tested with WordPress 5.9

= 1.0.3 - August 31 2021 =
* Fixed some minor CSS issues

= 1.0.2 - August 04 2021 =
* Added upgrade to pro
* Added theme about page
* Added pro discount notice

= 1.0.1 - August 02 2021 =
* Fixed theme review action issues

= 1.0.0 - August 01 2021 =
* Initial release

== Credits ==

Markup is free WordPress theme by, Template Sell.
Markup is distributed under the terms of the GNU GPL v2 or later.


* Based on Underscores https://underscores.me/, (C) 2012-2017 Automattic, Inc., [GPLv2 or later](https://www.gnu.org/licenses/gpl-2.0.html)
* normalize.css https://necolas.github.io/normalize.css/, (C) 2012-2016 Nicolas Gallagher and Jonathan Neal, [MIT](https://opensource.org/licenses/MIT)
* BreadcrumbTrail, Copyright (c) 2008 - 2015, Justin Tadlock http://themehybrid.com/plugins/breadcrumb-trail
* Theia Sticky Sidebar https://github.com/WeCodePixels/theia-sticky-sidebar [MIT license]
* Slick Slider https://github.com/kenwheeler/slick/blob/master/LICENSE [The MIT License (MIT)]
* Font-Awesome https://github.com/FortAwesome/Font-Awesome FontAwesome 4.6.3 Copyright 2012 Dave Gandy Font License: SIL OFL 1.1 Code License: MIT License http://fontawesome.io/license/
* imagesLoaded MIT License https://imagesloaded.desandro.com/#mit-license
* Webfont loader  https://github.com/WPTT/webfont-loader https://github.com/WPTT/webfont-loader/blob/master/LICENSE



== Block Patters & Screenshot Images [CCO License] ==
Image for theme screenshot, Copyright Authentic Stock 
License: CC0 1.0 Universal (CC0 1.0)
Source: https://stocksnap.io/photo/wellness-cosmetics-TQ6B6IW8VJ

* Sidbear icons for the customizer are self created and license under GPL.