<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="loading" data-textdirection="ltr">
<!-- BEGIN: Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description"
        content="Materialize is a Material Design Admin Template,It's modern, responsive and based on Material Design by Google.">
    <meta name="keywords"
        content="materialize, admin template, dashboard template, flat admin template, responsive admin template, eCommerce dashboard, analytic dashboard">
    <meta name="author" content="ThemeSelect">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    @push('style')

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <script src="https://code.jquery.com/jquery-3.6.4.js" integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E="
            crossorigin="anonymous"></script>
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />
        @livewireStyles

        <link href="{{ asset('sky/icon.css?family=Material+Icons') }}" rel="stylesheet">
        <!-- BEGIN: VENDOR CSS-->
        <link rel="stylesheet" type="text/css" href="{{ asset('sky/assets/app-assets/vendors/vendors.min.css') }}">
        <!-- END: VENDOR CSS-->
        <!-- BEGIN: Page Level CSS-->
        <link rel="stylesheet" type="text/css"
            href="{{ asset('sky/assets/app-assets/css/themes/vertical-dark-menu-template/materialize.min.css') }}">
        <link rel="stylesheet" type="text/css"
            href="{{ asset('sky/assets/app-assets/css/themes/vertical-dark-menu-template/style.min.css') }}">
        <!-- END: Page Level CSS-->
        <!-- BEGIN: Custom CSS-->
        <link rel="stylesheet" type="text/css" href="{{ asset('sky/assets/app-assets/css/custom/custom.css') }}">
        <!-- END: Custom CSS-->
    </head>
    <!-- END: Head-->

    <body
        class="vertical-layout page-header-light vertical-menu-collapsible vertical-dark-menu preload-transitions 2-columns menu-collapse"
        data-open="click" data-menu="vertical-dark-menu" data-col="2-columns">

        <!-- BEGIN: Header-->
        <header class="page-topbar" id="header">
            <div class="navbar navbar-fixed">
                <nav class="navbar-main navbar-color nav-collapsible sideNav-lock navbar-light">
                    <div class="nav-wrapper">

                        <ul class="navbar-list right">
                            {{-- <li class="dropdown-language"><a class="waves-effect waves-block waves-light translation-button"
                                href="#" data-target="translation-dropdown"><span
                                    class="flag-icon flag-icon-gb"></span></a></li>
                        <li class="hide-on-med-and-down"><a
                                class="waves-effect waves-block waves-light toggle-fullscreen"
                                href="javascript:void(0);"><i class="material-icons">settings_overscan</i></a></li>
                        <li class="hide-on-large-only search-input-wrapper"><a
                                class="waves-effect waves-block waves-light search-button" href="javascript:void(0);"><i
                                    class="material-icons">search</i></a></li>
                        <li><a class="waves-effect waves-block waves-light notification-button"
                                href="javascript:void(0);" data-target="notifications-dropdown"><i
                                    class="material-icons">notifications_none<small
                                        class="notification-badge">5</small></i></a></li>
                        <li><a class="waves-effect waves-block waves-light profile-button" href="javascript:void(0);"
                                data-target="profile-dropdown"><span class="avatar-status avatar-online"><img
                                        src="../../../app-assets/images/avatar/avatar-7.png"
                                        alt="avatar"><i></i></span></a></li>
                        <li><a class="waves-effect waves-block waves-light sidenav-trigger" href="#"
                                data-target="slide-out-right"><i class="material-icons">format_indent_increase</i></a>
                        </li> --}}
                        </ul>
                        <!-- translation-button-->
                        <ul class="dropdown-content" id="translation-dropdown">

                        </ul>
                        <!-- notifications-dropdown-->
                        <ul class="dropdown-content" id="notifications-dropdown">

                        </ul>
                        <!-- profile-dropdown-->
                        <ul class="dropdown-content" id="profile-dropdown">

                        </ul>
                    </div>
                    <nav class="display-none search-sm">
                        <div class="nav-wrapper">
                            <form id="navbarForm">
                                <div class="input-field search-input-sm">
                                    <input class="mb-0 search-box-sm" type="search" required="" id="search"
                                        placeholder="Explore Materialize" data-search="template-list">
                                    <label class="label-icon" for="search"><i
                                            class="material-icons search-sm-icon">search</i></label><i
                                        class="material-icons search-sm-close">close</i>
                                    <ul class="search-list collection search-list-sm display-none"></ul>
                                </div>
                            </form>
                        </div>
                    </nav>
                </nav>
            </div>
        </header>
        <!-- END: Header-->
        <ul class="display-none" id="default-search-main">
            <li class="auto-suggestion-title"><a class="collection-item" href="#">
                    <h6 class="search-title">FILES</h6>
                </a></li>
            <li class="auto-suggestion"><a class="collection-item" href="#">
                    <div class="display-flex">
                        <div class="display-flex align-item-center flex-grow-1">
                            <div class="avatar"><img src="../../../app-assets/images/icon/pdf-image.png" width="24"
                                    height="30" alt="sample image"></div>
                            <div class="member-info display-flex flex-column"><span class="black-text">Two new item
                                    submitted</span><small class="grey-text">Marketing Manager</small></div>
                        </div>
                        <div class="status"><small class="grey-text">17kb</small></div>
                    </div>
                </a></li>
            <li class="auto-suggestion"><a class="collection-item" href="#">
                    <div class="display-flex">
                        <div class="display-flex align-item-center flex-grow-1">
                            <div class="avatar"><img src="../../../app-assets/images/icon/doc-image.png" width="24"
                                    height="30" alt="sample image"></div>
                            <div class="member-info display-flex flex-column"><span class="black-text">52 Doc file
                                    Generator</span><small class="grey-text">FontEnd Developer</small></div>
                        </div>
                        <div class="status"><small class="grey-text">550kb</small></div>
                    </div>
                </a></li>
            <li class="auto-suggestion"><a class="collection-item" href="#">
                    <div class="display-flex">
                        <div class="display-flex align-item-center flex-grow-1">
                            <div class="avatar"><img src="../../../app-assets/images/icon/xls-image.png" width="24"
                                    height="30" alt="sample image"></div>
                            <div class="member-info display-flex flex-column"><span class="black-text">25 Xls File
                                    Uploaded</span><small class="grey-text">Digital Marketing Manager</small></div>
                        </div>
                        <div class="status"><small class="grey-text">20kb</small></div>
                    </div>
                </a></li>
            <li class="auto-suggestion"><a class="collection-item" href="#">
                    <div class="display-flex">
                        <div class="display-flex align-item-center flex-grow-1">
                            <div class="avatar"><img src="../../../app-assets/images/icon/jpg-image.png" width="24"
                                    height="30" alt="sample image"></div>
                            <div class="member-info display-flex flex-column"><span class="black-text">Anna
                                    Strong</span><small class="grey-text">Web Designer</small></div>
                        </div>
                        <div class="status"><small class="grey-text">37kb</small></div>
                    </div>
                </a></li>
            <li class="auto-suggestion-title"><a class="collection-item" href="#">
                    <h6 class="search-title">MEMBERS</h6>
                </a></li>
            <li class="auto-suggestion"><a class="collection-item" href="#">
                    <div class="display-flex">
                        <div class="display-flex align-item-center flex-grow-1">
                            <div class="avatar"><img class="circle" src="../../../app-assets/images/avatar/avatar-7.png"
                                    width="30" alt="sample image"></div>
                            <div class="member-info display-flex flex-column"><span class="black-text">John
                                    Doe</span><small class="grey-text">UI designer</small></div>
                        </div>
                    </div>
                </a></li>
            <li class="auto-suggestion"><a class="collection-item" href="#">
                    <div class="display-flex">
                        <div class="display-flex align-item-center flex-grow-1">
                            <div class="avatar"><img class="circle" src="../../../app-assets/images/avatar/avatar-8.png"
                                    width="30" alt="sample image"></div>
                            <div class="member-info display-flex flex-column"><span class="black-text">Michal
                                    Clark</span><small class="grey-text">FontEnd Developer</small></div>
                        </div>
                    </div>
                </a></li>
            <li class="auto-suggestion"><a class="collection-item" href="#">
                    <div class="display-flex">
                        <div class="display-flex align-item-center flex-grow-1">
                            <div class="avatar"><img class="circle" src="../../../app-assets/images/avatar/avatar-10.png"
                                    width="30" alt="sample image"></div>
                            <div class="member-info display-flex flex-column"><span class="black-text">Milena
                                    Gibson</span><small class="grey-text">Digital Marketing</small></div>
                        </div>
                    </div>
                </a></li>
            <li class="auto-suggestion"><a class="collection-item" href="#">
                    <div class="display-flex">
                        <div class="display-flex align-item-center flex-grow-1">
                            <div class="avatar"><img class="circle" src="../../../app-assets/images/avatar/avatar-12.png"
                                    width="30" alt="sample image"></div>
                            <div class="member-info display-flex flex-column"><span class="black-text">Anna
                                    Strong</span><small class="grey-text">Web Designer</small></div>
                        </div>
                    </div>
                </a></li>
        </ul>
        <ul class="display-none" id="page-search-title">
            <li class="auto-suggestion-title"><a class="collection-item" href="#">
                    <h6 class="search-title">PAGES</h6>
                </a></li>
        </ul>
        <ul class="display-none" id="search-not-found">
            <li class="auto-suggestion"><a class="collection-item display-flex align-items-center" href="#"><span
                        class="material-icons">error_outline</span><span class="member-info">No results found.</span></a>
            </li>
        </ul>



        <!-- BEGIN: SideNav-->
        <aside class="sidenav-main nav-expanded nav-lock nav-collapsible sidenav-dark sidenav-active-rounded">
            <div class="brand-sidebar">
                <h1 class="logo-wrapper"><a class="brand-logo darken-1" href="index.html"><img
                            class="hide-on-med-and-down "
                            src="{{ asset('sky/assets/app-assets/images/logo/materialize-logo.png') }}"
                            alt="materialize logo"><img class="show-on-medium-and-down hide-on-med-and-up"
                            src="{{ asset('sky/assets/app-assets/images/logo/materialize-logo-color.png') }}"
                            alt="materialize logo"><span class="logo-text hide-on-med-and-down">Materialize</span></a>
            </div>
            <ul class="sidenav sidenav-collapsible leftside-navigation collapsible sidenav-fixed menu-shadow"
                id="slide-out" data-menu="menu-navigation" data-collapsible="accordion">
                <li class="bold"><a class="collapsible-header waves-effect waves-cyan " href="JavaScript:void(0)"><i
                            class="material-icons">settings_input_svideo</i><span class="menu-title"
                            data-i18n="Dashboard">Dashboard</span><span
                            class="float-right mr-10 badge pill orange">3</span></a>
                    <div class="collapsible-body">
                        <ul class="collapsible collapsible-sub" data-collapsible="accordion">
                            <li><a href="dashboard-modern.html"><i class="material-icons">radio_button_unchecked</i><span
                                        data-i18n="Modern">Modern</span></a>
                            </li>
                            <li><a href="dashboard-ecommerce.html"><i
                                        class="material-icons">radio_button_unchecked</i><span
                                        data-i18n="eCommerce">eCommerce</span></a>
                            </li>
                            <li><a href="dashboard-analytics.html"><i
                                        class="material-icons">radio_button_unchecked</i><span
                                        data-i18n="Analytics">Analytics</span></a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="bold"><a class="collapsible-header waves-effect waves-cyan " href="JavaScript:void(0)"><i
                            class="material-icons">dvr</i><span class="menu-title"
                            data-i18n="Templates">Templates</span></a>
                    <div class="collapsible-body">
                        <ul class="collapsible collapsible-sub" data-collapsible="accordion">
                            <li><a class="collapsible-header waves-effect waves-cyan" href="JavaScript:void(0)"><i
                                        class="material-icons">radio_button_unchecked</i><span
                                        data-i18n="Vertical">Vertical</span></a>
                                <div class="collapsible-body">
                                    <ul class="collapsible" data-collapsible="accordion">
                                        <li><a href="../vertical-modern-menu-template/"><i
                                                    class="material-icons">radio_button_unchecked</i><span
                                                    data-i18n="Modern Menu">Modern Menu</span></a>
                                        </li>
                                        <li><a href="../vertical-menu-nav-dark-template/"><i
                                                    class="material-icons">radio_button_unchecked</i><span
                                                    data-i18n="Navbar Dark">Navbar Dark</span></a>
                                        </li>
                                        <li><a href="../vertical-gradient-menu-template/"><i
                                                    class="material-icons">radio_button_unchecked</i><span
                                                    data-i18n="Gradient Menu">Gradient Menu</span></a>
                                        </li>
                                        <li><a href="index.htm"><i class="material-icons">radio_button_unchecked</i><span
                                                    data-i18n="Dark Menu">Dark Menu</span></a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li><a class="collapsible-header waves-effect waves-cyan" href="JavaScript:void(0)"><i
                                        class="material-icons">radio_button_unchecked</i><span
                                        data-i18n="Horizontal">Horizontal</span></a>
                                <div class="collapsible-body">
                                    <ul class="collapsible" data-collapsible="accordion">
                                        <li><a href="../horizontal-menu-template/"><i
                                                    class="material-icons">radio_button_unchecked</i><span
                                                    data-i18n="Horizontal Menu">Horizontal Menu</span></a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="navigation-header"><a class="navigation-header-text">Applications</a><i
                        class="navigation-header-icon material-icons">more_horiz</i>
                </li>
                <li class="bold"><a class="waves-effect waves-cyan " href="app-contacts.html"><i
                            class="material-icons">import_contacts</i><span class="menu-title"
                            data-i18n="Contacts">Contacts</span></a>
                </li>
                <li class="bold"><a class="waves-effect waves-cyan " href="app-email.html"><i
                            class="material-icons">mail_outline</i><span class="menu-title"
                            data-i18n="Mail">Mail</span><span
                            class="float-right mr-2 badge new pill pink accent-2">5</span></a>
                </li>
                <li class="bold"><a class="waves-effect waves-cyan " href="app-chat.html"><i
                            class="material-icons">chat_bubble_outline</i><span class="menu-title"
                            data-i18n="Chat">Chat</span></a>
                </li>
                <li class="bold"><a class="waves-effect waves-cyan " href="app-todo.html"><i
                            class="material-icons">check</i><span class="menu-title" data-i18n="ToDo">ToDo</span></a>
                </li>
                <li class="bold"><a class="waves-effect waves-cyan " href="app-kanban.html"><i
                            class="material-icons">format_list_bulleted</i><span class="menu-title"
                            data-i18n="Kanban">Kanban</span></a>
                </li>
                <li class="bold"><a class="waves-effect waves-cyan " href="app-file-manager.html"><i
                            class="material-icons">content_paste</i><span class="menu-title"
                            data-i18n="File Manager">File manager</span></a>
                </li>
                <li class="bold"><a class="waves-effect waves-cyan " href="app-contacts.html"><i
                            class="material-icons">import_contacts</i><span class="menu-title"
                            data-i18n="Contacts">Contacts</span></a>
                </li>
                <li class="bold"><a class="waves-effect waves-cyan " href="app-calendar.html"><i
                            class="material-icons">today</i><span class="menu-title"
                            data-i18n="Calendar">Calendar</span></a>
                </li>
                <li class="bold"><a class="collapsible-header waves-effect waves-cyan " href="JavaScript:void(0)"><i
                            class="material-icons">receipt</i><span class="menu-title"
                            data-i18n="Invoice">Invoice</span></a>
                    <div class="collapsible-body">
                        <ul class="collapsible collapsible-sub" data-collapsible="accordion">
                            <li><a href="app-invoice-list.html"><i class="material-icons">radio_button_unchecked</i><span
                                        data-i18n="Invoice List">Invoice List</span></a>
                            </li>
                            <li><a href="app-invoice-view.html"><i class="material-icons">radio_button_unchecked</i><span
                                        data-i18n="Invoice View">Invoice View</span></a>
                            </li>
                            <li><a href="app-invoice-edit.html"><i class="material-icons">radio_button_unchecked</i><span
                                        data-i18n="Invoice Edit">Invoice Edit</span></a>
                            </li>
                            <li><a href="app-invoice-add.html"><i class="material-icons">radio_button_unchecked</i><span
                                        data-i18n="Invoice Add">Invoice Add</span></a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="bold"><a class="collapsible-header waves-effect waves-cyan " href="JavaScript:void(0)"><i
                            class="material-icons">add_shopping_cart</i><span class="menu-title"
                            data-i18n="eCommerce">eCommerce</span></a>
                    <div class="collapsible-body">
                        <ul class="collapsible collapsible-sub" data-collapsible="accordion">
                            <li><a href="eCommerce-products-page.html"><i
                                        class="material-icons">radio_button_unchecked</i><span
                                        data-i18n="Products Page">Products Page</span></a>
                            </li>
                            <li><a href="eCommerce-pricing.html"><i class="material-icons">radio_button_unchecked</i><span
                                        data-i18n="Pricing">Pricing</span></a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="navigation-header"><a class="navigation-header-text">Pages </a><i
                        class="navigation-header-icon material-icons">more_horiz</i>
                </li>
                <li class="bold"><a class="waves-effect waves-cyan " href="user-profile-page.html"><i
                            class="material-icons">person_outline</i><span class="menu-title"
                            data-i18n="User Profile">User Profile</span></a>
                </li>
                <li class="active bold"><a class="collapsible-header waves-effect waves-cyan "
                        href="JavaScript:void(0)"><i class="material-icons">content_paste</i><span class="menu-title"
                            data-i18n="Pages">Pages</span></a>
                    <div class="collapsible-body">
                        <ul class="collapsible collapsible-sub" data-collapsible="accordion">
                            <li><a href="page-contact.html"><i class="material-icons">radio_button_unchecked</i><span
                                        data-i18n="Contact">Contact</span></a>
                            </li>
                            <li><a href="page-blog-list.html"><i class="material-icons">radio_button_unchecked</i><span
                                        data-i18n="Blog">Blog</span></a>
                            </li>
                            <li><a href="page-search.html"><i class="material-icons">radio_button_unchecked</i><span
                                        data-i18n="Search">Search</span></a>
                            </li>
                            <li><a href="page-knowledge.html"><i class="material-icons">radio_button_unchecked</i><span
                                        data-i18n="Knowledge">Knowledge</span></a>
                            </li>
                            <li><a href="page-timeline.html"><i class="material-icons">radio_button_unchecked</i><span
                                        data-i18n="Timeline">Timeline</span></a>
                            </li>
                            <li><a href="page-faq.html"><i class="material-icons">radio_button_unchecked</i><span
                                        data-i18n="FAQs">FAQs</span></a>
                            </li>
                            <li><a href="page-account-settings.html"><i
                                        class="material-icons">radio_button_unchecked</i><span
                                        data-i18n="Account Settings">Account Settings</span></a>
                            </li>
                            <li><a href="page-blank.html"><i class="material-icons">radio_button_unchecked</i><span
                                        data-i18n="Page Blank">Page Blank</span></a>
                            </li>
                            <li class="active"><a class="active" href="page-collapse.html"><i
                                        class="material-icons">radio_button_unchecked</i><span
                                        data-i18n="Page Collapse">Page Collapse</span></a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="bold"><a class="collapsible-header waves-effect waves-cyan " href="JavaScript:void(0)"><i
                            class="material-icons">crop_original</i><span class="menu-title"
                            data-i18n="Medias">Medias</span></a>
                    <div class="collapsible-body">
                        <ul class="collapsible collapsible-sub" data-collapsible="accordion">
                            <li><a href="media-gallery-page.html"><i
                                        class="material-icons">radio_button_unchecked</i><span
                                        data-i18n="Gallery Page">Gallery Page</span></a>
                            </li>
                            <li><a href="media-hover-effects.html"><i
                                        class="material-icons">radio_button_unchecked</i><span
                                        data-i18n="Media Hover Effects">Media Hover Effects</span></a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="bold"><a class="collapsible-header waves-effect waves-cyan " href="JavaScript:void(0)"><i
                            class="material-icons">face</i><span class="menu-title" data-i18n="User">User</span><span
                            class="float-right mr-10 badge pill purple">3</span></a>
                    <div class="collapsible-body">
                        <ul class="collapsible collapsible-sub" data-collapsible="accordion">
                            <li><a href="page-users-list.html"><i class="material-icons">radio_button_unchecked</i><span
                                        data-i18n="List">List</span></a>
                            </li>
                            <li><a href="page-users-view.html"><i class="material-icons">radio_button_unchecked</i><span
                                        data-i18n="View">View</span></a>
                            </li>
                            <li><a href="page-users-edit.html"><i class="material-icons">radio_button_unchecked</i><span
                                        data-i18n="Edit">Edit</span></a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="bold"><a class="collapsible-header waves-effect waves-cyan " href="JavaScript:void(0)"><i
                            class="material-icons">lock_open</i><span class="menu-title"
                            data-i18n="Authentication">Authentication</span><span
                            class="float-right mr-10 badge pill purple">10</span></a>
                    <div class="collapsible-body">
                        <ul class="collapsible collapsible-sub" data-collapsible="accordion">
                            <li><a href="user-login.html" target="_blank"><i
                                        class="material-icons">radio_button_unchecked</i><span
                                        data-i18n="Login">Login</span></a>
                            </li>
                            <li><a href="user-register.html" target="_blank"><i
                                        class="material-icons">radio_button_unchecked</i><span
                                        data-i18n="Register">Register</span></a>
                            </li>
                            <li><a href="user-forgot-password.html" target="_blank"><i
                                        class="material-icons">radio_button_unchecked</i><span
                                        data-i18n="Forgot Password">Forgot Password</span></a>
                            </li>
                            <li><a href="user-lock-screen.html" target="_blank"><i
                                        class="material-icons">radio_button_unchecked</i><span
                                        data-i18n="Lock Screen">Lock Screen</span></a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="bold"><a class="collapsible-header waves-effect waves-cyan " href="JavaScript:void(0)"><i
                            class="material-icons">filter_tilt_shift</i><span class="menu-title"
                            data-i18n="Misc">Misc</span></a>
                    <div class="collapsible-body">
                        <ul class="collapsible collapsible-sub" data-collapsible="accordion">
                            <li><a href="page-404.html" target="_blank"><i
                                        class="material-icons">radio_button_unchecked</i><span
                                        data-i18n="404">404</span></a>
                            </li>
                            <li><a href="page-maintenance.html" target="_blank"><i
                                        class="material-icons">radio_button_unchecked</i><span
                                        data-i18n="Page Maintenanace">Page Maintenanace</span></a>
                            </li>
                            <li><a href="page-500.html" target="_blank"><i
                                        class="material-icons">radio_button_unchecked</i><span
                                        data-i18n="500">500</span></a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="navigation-header"><a class="navigation-header-text">User Interface </a><i
                        class="navigation-header-icon material-icons">more_horiz</i>
                </li>
                <li class="bold"><a class="collapsible-header waves-effect waves-cyan " href="JavaScript:void(0)"><i
                            class="material-icons">cast</i><span class="menu-title" data-i18n="Cards">Cards</span></a>
                    <div class="collapsible-body">
                        <ul class="collapsible collapsible-sub" data-collapsible="accordion">
                            <li><a href="cards-basic.html"><i class="material-icons">radio_button_unchecked</i><span
                                        data-i18n="Cards">Cards</span></a>
                            </li>
                            <li><a href="cards-advance.html"><i class="material-icons">radio_button_unchecked</i><span
                                        data-i18n="Cards Advance">Cards Advance</span></a>
                            </li>
                            <li><a href="cards-extended.html"><i class="material-icons">radio_button_unchecked</i><span
                                        data-i18n="Cards Extended">Cards Extended</span></a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="bold"><a class="collapsible-header waves-effect waves-cyan " href="JavaScript:void(0)"><i
                            class="material-icons">invert_colors</i><span class="menu-title"
                            data-i18n="CSS">CSS</span></a>
                    <div class="collapsible-body">
                        <ul class="collapsible collapsible-sub" data-collapsible="accordion">
                            <li><a href="css-typography.html"><i class="material-icons">radio_button_unchecked</i><span
                                        data-i18n="Typograpy">Typograpy</span></a>
                            </li>
                            <li><a href="css-color.html"><i class="material-icons">radio_button_unchecked</i><span
                                        data-i18n="Color">Color</span></a>
                            </li>
                            <li><a href="css-grid.html"><i class="material-icons">radio_button_unchecked</i><span
                                        data-i18n="Grid">Grid</span></a>
                            </li>
                            <li><a href="css-helpers.html"><i class="material-icons">radio_button_unchecked</i><span
                                        data-i18n="Helpers">Helpers</span></a>
                            </li>
                            <li><a href="css-media.html"><i class="material-icons">radio_button_unchecked</i><span
                                        data-i18n="Media">Media</span></a>
                            </li>
                            <li><a href="css-pulse.html"><i class="material-icons">radio_button_unchecked</i><span
                                        data-i18n="Pulse">Pulse</span></a>
                            </li>
                            <li><a href="css-sass.html"><i class="material-icons">radio_button_unchecked</i><span
                                        data-i18n="Sass">Sass</span></a>
                            </li>
                            <li><a href="css-shadow.html"><i class="material-icons">radio_button_unchecked</i><span
                                        data-i18n="Shadow">Shadow</span></a>
                            </li>
                            <li><a href="css-animations.html"><i class="material-icons">radio_button_unchecked</i><span
                                        data-i18n="Animations">Animations</span></a>
                            </li>
                            <li><a href="css-transitions.html"><i class="material-icons">radio_button_unchecked</i><span
                                        data-i18n="Transitions">Transitions</span></a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="bold"><a class="collapsible-header waves-effect waves-cyan " href="JavaScript:void(0)"><i
                            class="material-icons">photo_filter</i><span class="menu-title" data-i18n="Basic UI">Basic
                            UI</span></a>
                    <div class="collapsible-body">
                        <ul class="collapsible collapsible-sub" data-collapsible="accordion">
                            <li><a class="collapsible-header waves-effect waves-cyan" href="JavaScript:void(0)"><i
                                        class="material-icons">radio_button_unchecked</i><span
                                        data-i18n="Buttons">Buttons</span></a>
                                <div class="collapsible-body">
                                    <ul class="collapsible" data-collapsible="accordion">
                                        <li><a href="ui-basic-buttons.html"><i
                                                    class="material-icons">radio_button_unchecked</i><span
                                                    data-i18n="Basic">Basic</span></a>
                                        </li>
                                        <li><a href="ui-extended-buttons.html"><i
                                                    class="material-icons">radio_button_unchecked</i><span
                                                    data-i18n="Extended">Extended</span></a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li><a href="ui-icons.html"><i class="material-icons">radio_button_unchecked</i><span
                                        data-i18n="Icons">Icons</span></a>
                            </li>
                            <li><a href="ui-alerts.html"><i class="material-icons">radio_button_unchecked</i><span
                                        data-i18n="Alerts">Alerts</span></a>
                            </li>
                            <li><a href="ui-badges.html"><i class="material-icons">radio_button_unchecked</i><span
                                        data-i18n="Badges">Badges</span></a>
                            </li>
                            <li><a href="ui-breadcrumbs.html"><i class="material-icons">radio_button_unchecked</i><span
                                        data-i18n="Breadcrumbs">Breadcrumbs</span></a>
                            </li>
                            <li><a href="ui-chips.html"><i class="material-icons">radio_button_unchecked</i><span
                                        data-i18n="Chips">Chips</span></a>
                            </li>
                            <li><a href="ui-collections.html"><i class="material-icons">radio_button_unchecked</i><span
                                        data-i18n="Collections">Collections</span></a>
                            </li>
                            <li><a href="ui-navbar.html"><i class="material-icons">radio_button_unchecked</i><span
                                        data-i18n="Navbar">Navbar</span></a>
                            </li>
                            <li><a href="ui-pagination.html"><i class="material-icons">radio_button_unchecked</i><span
                                        data-i18n="Pagination">Pagination</span></a>
                            </li>
                            <li><a href="ui-preloader.html"><i class="material-icons">radio_button_unchecked</i><span
                                        data-i18n="Preloader">Preloader</span></a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="bold"><a class="collapsible-header waves-effect waves-cyan " href="JavaScript:void(0)"><i
                            class="material-icons">settings_brightness</i><span class="menu-title"
                            data-i18n="Advanced UI">Advanced UI</span></a>
                    <div class="collapsible-body">
                        <ul class="collapsible collapsible-sub" data-collapsible="accordion">
                            <li><a href="advance-ui-carousel.html"><i
                                        class="material-icons">radio_button_unchecked</i><span
                                        data-i18n="Carousel">Carousel</span></a>
                            </li>
                            <li><a href="advance-ui-collapsibles.html"><i
                                        class="material-icons">radio_button_unchecked</i><span
                                        data-i18n="Collapsibles">Collapsibles</span></a>
                            </li>
                            <li><a href="advance-ui-toasts.html"><i class="material-icons">radio_button_unchecked</i><span
                                        data-i18n="Toasts">Toasts</span></a>
                            </li>
                            <li><a href="advance-ui-tooltip.html"><i
                                        class="material-icons">radio_button_unchecked</i><span
                                        data-i18n="Tooltip">Tooltip</span></a>
                            </li>
                            <li><a href="advance-ui-dropdown.html"><i
                                        class="material-icons">radio_button_unchecked</i><span
                                        data-i18n="Dropdown">Dropdown</span></a>
                            </li>
                            <li><a href="advance-ui-feature-discovery.html"><i
                                        class="material-icons">radio_button_unchecked</i><span
                                        data-i18n="Discovery">Discovery</span></a>
                            </li>
                            <li><a href="advance-ui-media.html"><i class="material-icons">radio_button_unchecked</i><span
                                        data-i18n="Media">Media</span></a>
                            </li>
                            <li><a href="advance-ui-modals.html"><i class="material-icons">radio_button_unchecked</i><span
                                        data-i18n="Modals">Modals</span></a>
                            </li>
                            <li><a href="advance-ui-scrollspy.html"><i
                                        class="material-icons">radio_button_unchecked</i><span
                                        data-i18n="Scrollspy">Scrollspy</span></a>
                            </li>
                            <li><a href="advance-ui-tabs.html"><i class="material-icons">radio_button_unchecked</i><span
                                        data-i18n="Tabs">Tabs</span></a>
                            </li>
                            <li><a href="advance-ui-waves.html"><i class="material-icons">radio_button_unchecked</i><span
                                        data-i18n="Waves">Waves</span></a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="bold"><a class="collapsible-header waves-effect waves-cyan " href="JavaScript:void(0)"><i
                            class="material-icons">add_to_queue</i><span class="menu-title"
                            data-i18n="Extra Components">Extra Components</span></a>
                    <div class="collapsible-body">
                        <ul class="collapsible collapsible-sub" data-collapsible="accordion">
                            <li><a href="extra-components-range-slider.html"><i
                                        class="material-icons">radio_button_unchecked</i><span
                                        data-i18n="Range Slider">Range Slider</span></a>
                            </li>
                            <li><a href="extra-components-sweetalert.html"><i
                                        class="material-icons">radio_button_unchecked</i><span
                                        data-i18n="Sweetalert">Sweetalert</span></a>
                            </li>
                            <li><a href="extra-components-nestable.html"><i
                                        class="material-icons">radio_button_unchecked</i><span
                                        data-i18n="Nestable">Nestable</span></a>
                            </li>
                            <li><a href="extra-components-treeview.html"><i
                                        class="material-icons">radio_button_unchecked</i><span
                                        data-i18n="Treeview">Treeview</span></a>
                            </li>
                            <li><a href="extra-components-ratings.html"><i
                                        class="material-icons">radio_button_unchecked</i><span
                                        data-i18n="Ratings">Ratings</span></a>
                            </li>
                            <li><a href="extra-components-tour.html"><i
                                        class="material-icons">radio_button_unchecked</i><span
                                        data-i18n="Tour">Tour</span></a>
                            </li>
                            <li><a href="extra-components-i18n.html"><i
                                        class="material-icons">radio_button_unchecked</i><span
                                        data-i18n="i18n">i18n</span></a>
                            </li>
                            <li><a href="extra-components-highlight.html"><i
                                        class="material-icons">radio_button_unchecked</i><span
                                        data-i18n="Highlight">Highlight</span></a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="navigation-header"><a class="navigation-header-text">Tables &amp; Forms </a><i
                        class="navigation-header-icon material-icons">more_horiz</i>
                </li>
                <li class="bold"><a class="waves-effect waves-cyan " href="table-basic.html"><i
                            class="material-icons">border_all</i><span class="menu-title" data-i18n="Basic Tables">Basic
                            Tables</span></a>
                </li>
                <li class="bold"><a class="waves-effect waves-cyan " href="table-data-table.html"><i
                            class="material-icons">grid_on</i><span class="menu-title" data-i18n="Data Tables">Data
                            Tables</span></a>
                </li>
                <li class="bold"><a class="collapsible-header waves-effect waves-cyan " href="JavaScript:void(0)"><i
                            class="material-icons">chrome_reader_mode</i><span class="menu-title"
                            data-i18n="Forms">Forms</span></a>
                    <div class="collapsible-body">
                        <ul class="collapsible collapsible-sub" data-collapsible="accordion">
                            <li><a href="form-elements.html"><i class="material-icons">radio_button_unchecked</i><span
                                        data-i18n="Form Elements">Form Elements</span></a>
                            </li>
                            <li><a href="form-select2.html"><i class="material-icons">radio_button_unchecked</i><span
                                        data-i18n="Form Select2">Form Select2</span></a>
                            </li>
                            <li><a href="form-validation.html"><i class="material-icons">radio_button_unchecked</i><span
                                        data-i18n="Form Validation">Form Validation</span></a>
                            </li>
                            <li><a href="form-masks.html"><i class="material-icons">radio_button_unchecked</i><span
                                        data-i18n="Form Masks">Form Masks</span></a>
                            </li>
                            <li><a href="form-editor.html"><i class="material-icons">radio_button_unchecked</i><span
                                        data-i18n="Form Editor">Form Editor</span></a>
                            </li>
                            <li><a href="form-file-uploads.html"><i class="material-icons">radio_button_unchecked</i><span
                                        data-i18n="File Uploads">File Uploads</span></a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="bold"><a class="waves-effect waves-cyan " href="form-layouts.html"><i
                            class="material-icons">image_aspect_ratio</i><span class="menu-title"
                            data-i18n="Form Layouts">Form Layouts</span></a>
                </li>
                <li class="bold"><a class="waves-effect waves-cyan " href="form-wizard.html"><i
                            class="material-icons">settings_ethernet</i><span class="menu-title"
                            data-i18n="Form Wizard">Form Wizard</span></a>
                </li>
                <li class="navigation-header"><a class="navigation-header-text">Charts</a><i
                        class="navigation-header-icon material-icons">more_horiz</i>
                </li>
                <li class="bold"><a class="collapsible-header waves-effect waves-cyan " href="JavaScript:void(0)"><i
                            class="material-icons">pie_chart_outlined</i><span class="menu-title"
                            data-i18n="Chart">Chart</span></a>
                    <div class="collapsible-body">
                        <ul class="collapsible collapsible-sub" data-collapsible="accordion">
                            <li><a href="charts-chartjs.html"><i class="material-icons">radio_button_unchecked</i><span
                                        data-i18n="ChartJS">ChartJS</span></a>
                            </li>
                            <li><a href="charts-chartist.html"><i class="material-icons">radio_button_unchecked</i><span
                                        data-i18n="Chartist">Chartist</span></a>
                            </li>
                            <li><a href="charts-sparklines.html"><i class="material-icons">radio_button_unchecked</i><span
                                        data-i18n="Sparkline Charts">Sparkline Charts</span></a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="navigation-header"><a class="navigation-header-text">Misc </a><i
                        class="navigation-header-icon material-icons">more_horiz</i>
                </li>
                <li class="bold"><a class="collapsible-header waves-effect waves-cyan " href="JavaScript:void(0)"><i
                            class="material-icons">photo_filter</i><span class="menu-title" data-i18n="Menu levels">Menu
                            levels</span></a>
                    <div class="collapsible-body">
                        <ul class="collapsible collapsible-sub" data-collapsible="accordion">
                            <li><a href="JavaScript:void(0)"><i class="material-icons">radio_button_unchecked</i><span
                                        data-i18n="Second level">Second level</span></a>
                            </li>
                            <li><a class="collapsible-header waves-effect waves-cyan" href="JavaScript:void(0)"><i
                                        class="material-icons">radio_button_unchecked</i><span
                                        data-i18n="Second level child">Second level child</span></a>
                                <div class="collapsible-body">
                                    <ul class="collapsible" data-collapsible="accordion">
                                        <li><a href="JavaScript:void(0)"><i
                                                    class="material-icons">radio_button_unchecked</i><span
                                                    data-i18n="Third level">Third level</span></a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="bold"><a class="waves-effect waves-cyan "
                        href="https://pixinvent.com/materialize-material-design-admin-template/documentation/index.html"
                        target="_blank"><i class="material-icons">import_contacts</i><span class="menu-title"
                            data-i18n="Documentation">Documentation</span></a>
                </li>
                <li class="bold"><a class="waves-effect waves-cyan " href="../../../../index.htm" target="_blank"><i
                            class="material-icons">help_outline</i><span class="menu-title"
                            data-i18n="Support">Support</span></a>
                </li>
            </ul>
            <div class="navigation-background"></div><a
                class="sidenav-trigger btn-sidenav-toggle btn-floating btn-medium waves-effect waves-light hide-on-large-only"
                href="#" data-target="slide-out"><i class="material-icons">menu</i></a>
        </aside>
        <!-- END: SideNav-->

        <!-- BEGIN: Page Main-->
        <div id="main">
            <div class="row">
                @yield('content')
            </div>
        </div>
        <!-- END: Page Main-->




        <!-- BEGIN: Footer-->

        <footer class="page-footer footer footer-static footer-light navbar-border navbar-shadow">
            <div class="footer-copyright">
                <div class="container"><span>&copy; 2023 <a href="../../../../user/pixinvent/portfolio.html?ref=pixinvent"
                            target="_blank">Blue Sky
                            Creation</a>
                        All rights reserved.</span><span class="right hide-on-small-only">Design and Developed by <a
                            href="https://kokofibo.com/">kokofibo, inc</a></span></div>
            </div>
        </footer>
        @livewireScripts
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
        @stack('script')
        <script>
            $(document).ready(function() {
                toastr.options = {
                    "progressBar": true,
                    "timeOut": "1500",
                    "progressBar": true,
                    "positionClass": "toast-top-right"
                }
                window.addEventListener('success', event => {
                    toastr.success(event.detail.message);
                });
                window.addEventListener('warning', event => {
                    toastr.warning(event.detail.message);
                });
                window.addEventListener('error', event => {
                    toastr.error(event.detail.message);
                });
            });
        </script>
        <script>
            window.addEventListener('delete_confirmation', function(e) {
                Swal.fire({
                    title: e.detail.title,
                    text: e.detail.text,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, please delete!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.livewire.emit('delete', e.detail.id)
                    }
                })
            });
        </script>
        <!-- END: Footer-->
        <!-- BEGIN VENDOR JS-->
        <script src="{{ asset('sky/assets/app-assets/js/vendors.min.js') }}"></script>
        <!-- BEGIN VENDOR JS-->
        <!-- BEGIN PAGE VENDOR JS-->
        <!-- END PAGE VENDOR JS-->
        <!-- BEGIN THEME  JS-->
        <script src="{{ asset('sky/assets/app-assets/js/plugins.min.js') }}"></script>
        <script src="{{ asset('sky/assets/app-assets/js/search.min.js') }}"></script>
        <script src="{{ asset('sky/assets/app-assets/js/custom/custom-script.min.js') }}"></script>
        <script src="{{ asset('sky/assets/app-assets/js/scripts/customizer.min.js') }}"></script>
        <!-- END THEME  JS-->
        <!-- BEGIN PAGE LEVEL JS-->
        <!-- END PAGE LEVEL JS-->
    </body>

    </html>
