Release Log:

= V1.7.2 - 28 December, 2019 =
* Update: Theme .POT file
* Fixed: An issue where conditional-based candidate contact details were not being shown without any notice

= V1.7.1 - 21 December, 2019 =
* Added: Ability to insert shortcode in job/resume description
* Added: Ability to change order of resume experience and education modules
* Added: Output of missing meta fields in the job preview page
* Added: Ability to have same-name company profiles for different users
* Fixed: An issue with facetWP integration where maps API was being called twice
* Fixed: An issue with facetWP integration where it was showing expired listings even when not-allowed
* Fixed: An issue where auto-selection of pricing package was not working as expected
* Fixed: Private Message plugin method not being disabled for resumes
* Fixed: Issue where purchased packages were re-appearing even after being disabled
* Fixed: Admin panel showing no more than 10 job listings
* Fixed: An issue where newly created jobs were showing "expired" notification when no expiry was set
* Fixed: Issue where dashboard icons were not importing correctly
* Removed: Email notification to employer/candidate on job/resume approval
* Removed: Email notification to candidate on resume expiry
* Changed: Single blog post, job listing, resume title from <h3> and <h2> to <h1> for SEO purposes

= V1.7.0 - 26 August, 2019 =
* Added: FacetWP plugin integration (allows you to create custom filters)
* Added: Job listing expiry notification banner
* Added: Option to disable page title on regular pages
* Added: Ability to replace hero search module with custom form shortcode
* Added: Ability to provide text template for job/resume description field
* Added: Private Message plugn support for resume manager
* Improved: Listing Spotlight module
* Improved: Split Google API keys into server-side & client-side keys

= V1.6.3 - 01 July, 2019 =
* Improved: Handling for horizontal company logo
* Added: Taxonomies Grid module for beaver builder
* Added: Google location autocomplete option
* Added: Email notification to employer/candidate on job/resume approval
* Added: Email notification to candidate on resume expiry
* Added: Print single job/resume link
* Added: Map zoom handler in customizer

= V1.6.2 - 18 June, 2019 =
* Fixed: BeaverBuilder full-width row issue
* Fixed: Application deadline now respects WordPress global date format
* Added: Ability to show pricing even with custom description

= V1.6.1 - 05 June, 2019 =
* Added: Ability to disable repurchase of submission packages
* Added: Ability to display custom term description (job + resume)
* Added: Ability to automatically create and assign new company term on job submission
* Added: Indeed and ZipRecruiter integration add-ons
* Improved: Simplified WP Job Manager native application method (URL + email)

= V1.6.0 - 10 May, 2019 =
* Added: Moved from "Meta Based" classification to "Taxonomy Based" classification for Companies
* Added: Ability to assign companies to users (user-specific companies)
* Added: Dashboard "Quick Links" feature
* Added: Dashboard "Account Navigation" menu
* Added: HTML5 Geolocation Method for "Location" field
* Added: Support for predefined "Job Regions" plugin (with "regions" taxonomy)
* Added: "Location" field mask settings in customizer
* Added: Ability to customize search module (job + resume)
* Added: "Login" indicator to the "Account Menu" icon
* Added: Select2.js dropdown field styling (introduced in-place of chosen.js)
* Added: Extendable "More Actions" links module in listing detail pages (job + resume)
* Added: Output locations for "Field Editor" plugin in listing preview pages (job + resume)
* Added: Additional output locations for "Field Editor" plugin in listing detail pages (job + resume)
* Added: Auto job excerpt feature for master job listings
* Fixed: long string styling issue in some places
* Fixed: Some IE 11 related styling issues
* Fixed: Some menu issues when moving from mobile to desktop view and vice versa
* Fixed: Intermidiary page flash issue when package is selected from "Pricing" page
* Fixed: Mobile CTA URL was different from Desktop CTA URL.
* Fixed: Issue where "resume" file download link was not displaying correctly
* Fixed: Issue where "Field Editor" plugin was displaying duplicate fields
* Fixed: Related job/resume widget showing current single listing
* Improved: Header CTA now points to "Resume Submission" if "Candidate" logged in
* Improved: Now "Employer" and "Candidate" roles are not hardcoded in the core
* Improved: Styling for some elements of application form
* Improved: Styling for some elements of "Field Editor" plugin form
* Improved: Logout link styling in dashboard
* Improved: Updated bundled plugins
* Improved: Login attempt from bookmark/application popups, job/resume submission forms now redirects back
* Improved: Styling for WP Editor "Insert Link" popup

= V1.5.2 - 07 March, 2019 =
* Fixed: "Location" field echoing wrong location in some instances
* Fixed: bookmark link for single resumes
* Fixed: page builder "Jobs" module showing only non-featured listings

= V1.5.1 - 04 March, 2019 =
* Fixed: an issue which was causing 500 internal server error in some scenarios triggered by theme activation
* Fixed: an issue introduced by WP Job Manager 1.32.2 which was causing issues with job submission
* Fixed: styling of pricing panels when sale price is activated

= V1.5 - 27 February, 2019 =
* Added: support for "WP Job Manager Field Editor" plugin, allows you to add/edit/delete new/existing fields and show them on relevant page
* Added: support for "WP Job Manager Visibility" plugin, allows you to define visibility criteria for any given custom field
* Added: support for "WP Job Manager Packages" plugin, allows you to offer packages to limit number of listing views and ability to apply or contact listing owner
* Added: customizer option to configure header CTA button
* Added: 6 additional sidebars to easily manage widgets in job, resume and companies master and detail pages
* Improved: design for custom fields module in detail job/resume/company listing page
* Fixed a few bugs

= V1.4.1 - 22 January, 2019 =
* Fixed: a few issues which were causing issues when some features are disabled
* Fixed: map scrolling on mobile devices
* Modified: some performance tweaks

= V1.4 - 21 January, 2019 =

* Added: "Companies" listing and profile pages
* Added: "Private Messages" plugin integration
* Added: "Explore" menu item to browse taxonomies directly from the menu
* Added: "Mapbox" map to jobs and resume archive pages
* Added: option to change header stickiness behaviour
* Added: option to change social profiles order
* Added: an additional menu location to access dashboard pages from main site header
* Added: two menu locations to "Dashboard Template"
* Added: ability to setup role-specific custom "Dashboard Welcome Messages"
* Added: ability to resize primary and dashboard logo from customizer
* Added: ability to adjust height of site header from customizer
* Added: ability to change default preloader icon
* Added: a few "action hooks"
* Improved: re-designed mobile menu for better user-experience
* Modified: Dashboard page types are marked in "Customizer" now, instead of "Meta Panel"
* Modified: Compact page types are marked in "Customizer" now, instead of "Meta Panel"
* Fixed: Added some missing translation strings
* Fixed: a few bugs

= V1.3.1 - 28 December, 2018 =

* Fixed "Header Already Sent" error

= V1.3 - 27 December, 2018 =

* Added following fields to job submission form
-- Salary Field (use `capstone_job_salary_options` to change options)
-- Career Level Field (use `capstone_job_career_level_options` to change options)
-- Experience Field (use `capstone_job_experience_options` to change options)
-- Qualification Field (use `capstone_job_qualification_options` to change options)
-- Job Excerpt Field (to display a short summary about the job)
-- Company Size (use `capstone_company_size_options` to change options)
-- Company Location
-- Company Description
* Added newly added job-specific meta fields to single job listing page
* Added ability to change order + visibility of different elements in job archive page sidebar
* Added ability to change order + visibility of different elements in single job listing page
* Job tags now support Icons
* Extended site footer with extra elements
* Improved form styling for "Restrict Content Pro"
* Added various hooks to master job listing page and detail job listing page
* In dashboard template, switched "logout" link and "go back to site" positions for better UX

= V1.2.1 - 21 December, 2018 =

* Added some hooks to various pages
* Fixed an issue which was causing installation of an older plugin version
* Fixed a deprecated warning for PHP 7.2

= V1.2 - 18 December, 2018 =

* Improved styling of forms
* Added Customizer options to control accent colors (for modern browsers)
* Added Customizer options to control background images (for modern browsers)

= V1.1.1 - 10 December, 2018 =

* Styling Improvements for various small elements

= V1.1 - 5 December, 2018 =

* Integrated MerlinWP (a better theme on-boarding experience)

= V1.0 - 5 December, 2018 =

* Initial realease of the theme