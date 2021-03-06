=== Nightingale 2.0 ===
Contributors: tblacker
Requires at least: 5.0
Tested up to: 5.2
Requires PHP: 5.6
License: GPL v3 or later
License URI: https://www.gnu.org/licenses/gpl-3.0.en.html
Theme URI: https://digital.leadershipacademy.nhs.uk/digital-capabilities/websites/nightingale-theme-user-guide/
Version: 2.0.7
Stable tag: 2.0.7


== Description ==

A responsive and accessible theme for NHS organisations based on the NHSUK Frontend Library.

== Frequently Asked Questions ==

= Can I use this on any NHS website? =
Yes, the only restriction being that you need to have WordPress running first :)

= Can I use it on a non NHS website =
Yes, it is open source code and can be used anywhere. However, you may not use the NHS logo or pass your site off as an NHS organisation if you are not.

= Do you offer support? =
Yes, either through the themes support pages on WordPress, or via our GitHub project https://github.com/NHSLeadership/nightingale

= Can I get involved? =
Yes - please do! Whether you work in the NHS or would just like to contribute, we are happy to involve the wider
community in this work and will consider any pull requests or code snippets you are happy to contribute.

= How do I customise my 404 page? =
All content on the 404 error page is widgetised. Navigate to admin > appearance > widgets and add your chosen widgets and content to the `404 page` widget.

== Changelog
= 2.0.7 =
 * Updated bundled resources license documentation
 * Made TGM Plugin Activation notices dismissable
 * Renamed functions in inc/custom_colours.php to have nightingale_ prefix
 * 404 page layout revised and text added to make the page more useful.
 * Sidebar lists (including Subpages widget) made more obvious what is intended.
 * Sidebar calendar styling adjusted to fit into region.
 * Native sidebar navigation widget restrictions removed.
 * Logic for titles on archive and latest posts page reworked.
 * Floats clears after content added and more consistent.
 * "Leave a comment" styled to match other footer links below posts.
 * Added readmore to posts list pages to ensure link is included even on posts without a title
 * Featured image width reset to actual size with a max instead of a forced 100% width.
 * Pingbacks and trackbacks added in to comments display
 * Print output cleaned up significantly, all edit and action links removed. Fonts cleaned up.
 * Header customiser cleaned up
 * Logo modified so NHS logo is optional
 * Site name and tagline used instead of custom variables
 * Removed:
    * Retina images functionality
    * GA functionality (Added recommended plugin instead)
    * Emergency Alert header addin - this was removed from upstream NHSUK Frontend library so legacy code
    * Feedback Alert footer addin - functional rather than presentational. Plugin territory.
    * unused jquery.min.js
    * .pot translation file
    * empty node_modules folder (auto generates if user locally installs node)
    * wp-html-email folder and contents
    * performance optimisations to admin pages. Apparently admin is outside theme scope. Even when editing content.
    * assets/js/editor.js - content moved into nhsblocks plugin
    * NHSBlocks styling - reduces conflicts and allows plugin to have full control on display

= 2.0.6 =
 * Optimised critical path css to remove load flicker. Amended Screenshot to follow WP best practices. Updated readme.md instructions for github repo.

= 2.0.5 =
 * Updated nhsuk-frontend upstream library. Added compatability to WP 5.3. Refactored breadcrumb and header areas to allow for organisational and transactional header styles.

= 2.0.4 =
 * Added in full LearnDash compatability. Added basic email template for plugin WP_HTML_Email.

= 2.0.3 =
 * Reworked 404 page. All content for 404 output can now be determined via widgetised area (404 widget).

= 2.0.2 =
 * Header region reworked. There are now Customiser options for disabling search box and site title as well as inversion

= 2.0.1 =
 * Add in nhsblocks plugin to TGM plugin install routine

= 2.0.0 =
 * Initial work on theme, standardised and tested for accessibility and optimised for performance.

== Upgrade Notice ==

= 2.0.7 =
 * Please upgrade to 2.0.7 for reasons

 == Copyright ==

 Nightingale theme, copyright NHS Leadership Academy 2019 - 2020. Nightingale is distributed under the terms of the GNU
 GPL v3

 Nightingale bundles the following third party resources:

 *  nhsuk frontend library. Copyright NHS Digital 2019. License: MIT Source: https://nhsuk.github.io/nhsuk-frontend/

 * instantpage.js - Copyright 2019 Alexandre Dieulot. License: https://instant.page/license Source: https://instant.page

 * LoadCSS - Copyright 2017 Filament Group, Inc. License: MIT License. Source: https://github.com/filamentgroup/loadCSS

 * Underscores - Copyright 2012-2017 Automattic Inc. License: GNU GPL v2. Source: https://github.com/Automattic/_s

 * SubPages Widget - Copyright 2018 Bill Erickson. License GNU GPL v2. Source: http://www.billerickson.net

 * TGM Plugin Activation - Copyright 2011 Thomas Griffin. License GNU GPL v2. Source: http://tgmpluginactivation.com/

== Resources ==

 * Screenshot - Copyright 2019 NHS Leadership Academy. License GNU GPL v3.

 * assets/cross.svg, assets/pixel_trans.svg, assets/pixel_trans_mini.png, assets/tick.svg - Copyright 2019 NHS Digital.
 License MIT




