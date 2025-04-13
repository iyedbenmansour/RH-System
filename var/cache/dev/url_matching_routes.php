<?php

/**
 * This file has been auto-generated
 * by the Symfony Routing Component.
 */

return [
    false, // $matchHost
    [ // $staticRoutes
        '/_profiler' => [[['_route' => '_profiler_home', '_controller' => 'web_profiler.controller.profiler::homeAction'], null, null, null, true, false, null]],
        '/_profiler/search' => [[['_route' => '_profiler_search', '_controller' => 'web_profiler.controller.profiler::searchAction'], null, null, null, false, false, null]],
        '/_profiler/search_bar' => [[['_route' => '_profiler_search_bar', '_controller' => 'web_profiler.controller.profiler::searchBarAction'], null, null, null, false, false, null]],
        '/_profiler/phpinfo' => [[['_route' => '_profiler_phpinfo', '_controller' => 'web_profiler.controller.profiler::phpinfoAction'], null, null, null, false, false, null]],
        '/_profiler/xdebug' => [[['_route' => '_profiler_xdebug', '_controller' => 'web_profiler.controller.profiler::xdebugAction'], null, null, null, false, false, null]],
        '/_profiler/open' => [[['_route' => '_profiler_open_file', '_controller' => 'web_profiler.controller.profiler::openAction'], null, null, null, false, false, null]],
        '/admin/login' => [[['_route' => 'admin_login', '_controller' => 'App\\Controller\\AdminController::login'], null, null, null, false, false, null]],
        '/admin/dashboard' => [[['_route' => 'admin_dashboard', '_controller' => 'App\\Controller\\AdminController::dashboard'], null, null, null, false, false, null]],
        '/admin/profile' => [[['_route' => 'admin_profile', '_controller' => 'App\\Controller\\AdminController::profile'], null, null, null, false, false, null]],
        '/admin/profile/edit' => [[['_route' => 'admin_profile_edit', '_controller' => 'App\\Controller\\AdminController::editProfile'], null, null, null, false, false, null]],
        '/admin/profile/delete-image' => [[['_route' => 'admin_profile_delete_image', '_controller' => 'App\\Controller\\AdminController::deleteImage'], null, ['POST' => 0], null, false, false, null]],
        '/admin/logout' => [[['_route' => 'admin_logout', '_controller' => 'App\\Controller\\AdminController::logout'], null, null, null, false, false, null]],
        '/candidat/register' => [[['_route' => 'candidat_register', '_controller' => 'App\\Controller\\CandidatController::register'], null, null, null, false, false, null]],
        '/candidat/login' => [[['_route' => 'candidat_login', '_controller' => 'App\\Controller\\CandidatController::login'], null, null, null, false, false, null]],
        '/candidat/dashboard' => [[['_route' => 'candidat_dashboard', '_controller' => 'App\\Controller\\CandidatController::dashboard'], null, null, null, false, false, null]],
        '/candidat/profile' => [[['_route' => 'candidat_profile', '_controller' => 'App\\Controller\\CandidatController::profile'], null, null, null, false, false, null]],
        '/candidat/profile/edit' => [[['_route' => 'candidat_profile_edit', '_controller' => 'App\\Controller\\CandidatController::editProfile'], null, null, null, false, false, null]],
        '/candidat/profile/delete-image' => [[['_route' => 'candidat_profile_delete_image', '_controller' => 'App\\Controller\\CandidatController::deleteImage'], null, ['POST' => 0], null, false, false, null]],
        '/candidat/logout' => [[['_route' => 'candidat_logout', '_controller' => 'App\\Controller\\CandidatController::logout'], null, null, null, false, false, null]],
        '/company/register' => [[['_route' => 'company_register', '_controller' => 'App\\Controller\\CompanyController::register'], null, null, null, false, false, null]],
        '/company/login' => [[['_route' => 'company_login', '_controller' => 'App\\Controller\\CompanyController::login'], null, null, null, false, false, null]],
        '/company/dashboard' => [[['_route' => 'company_dashboard', '_controller' => 'App\\Controller\\CompanyController::dashboard'], null, null, null, false, false, null]],
        '/company/profile' => [[['_route' => 'company_profile', '_controller' => 'App\\Controller\\CompanyController::profile'], null, null, null, false, false, null]],
        '/company/profile/edit' => [[['_route' => 'company_profile_edit', '_controller' => 'App\\Controller\\CompanyController::editProfile'], null, null, null, false, false, null]],
        '/company/profile/delete-image' => [[['_route' => 'company_profile_delete_image', '_controller' => 'App\\Controller\\CompanyController::deleteImage'], null, ['POST' => 0], null, false, false, null]],
        '/company/logout' => [[['_route' => 'company_logout', '_controller' => 'App\\Controller\\CompanyController::logout'], null, null, null, false, false, null]],
        '/' => [[['_route' => 'home', '_controller' => 'App\\Controller\\MainController::index'], null, null, null, false, false, null]],
    ],
    [ // $regexpList
        0 => '{^(?'
                .'|/_(?'
                    .'|error/(\\d+)(?:\\.([^/]++))?(*:38)'
                    .'|wdt/([^/]++)(*:57)'
                    .'|profiler/(?'
                        .'|font/([^/\\.]++)\\.woff2(*:98)'
                        .'|([^/]++)(?'
                            .'|/(?'
                                .'|search/results(*:134)'
                                .'|router(*:148)'
                                .'|exception(?'
                                    .'|(*:168)'
                                    .'|\\.css(*:181)'
                                .')'
                            .')'
                            .'|(*:191)'
                        .')'
                    .')'
                .')'
            .')/?$}sDu',
    ],
    [ // $dynamicRoutes
        38 => [[['_route' => '_preview_error', '_controller' => 'error_controller::preview', '_format' => 'html'], ['code', '_format'], null, null, false, true, null]],
        57 => [[['_route' => '_wdt', '_controller' => 'web_profiler.controller.profiler::toolbarAction'], ['token'], null, null, false, true, null]],
        98 => [[['_route' => '_profiler_font', '_controller' => 'web_profiler.controller.profiler::fontAction'], ['fontName'], null, null, false, false, null]],
        134 => [[['_route' => '_profiler_search_results', '_controller' => 'web_profiler.controller.profiler::searchResultsAction'], ['token'], null, null, false, false, null]],
        148 => [[['_route' => '_profiler_router', '_controller' => 'web_profiler.controller.router::panelAction'], ['token'], null, null, false, false, null]],
        168 => [[['_route' => '_profiler_exception', '_controller' => 'web_profiler.controller.exception_panel::body'], ['token'], null, null, false, false, null]],
        181 => [[['_route' => '_profiler_exception_css', '_controller' => 'web_profiler.controller.exception_panel::stylesheet'], ['token'], null, null, false, false, null]],
        191 => [
            [['_route' => '_profiler', '_controller' => 'web_profiler.controller.profiler::panelAction'], ['token'], null, null, false, true, null],
            [null, null, null, null, false, false, 0],
        ],
    ],
    null, // $checkCondition
];
