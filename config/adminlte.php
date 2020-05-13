<?php

return [
    /*
      |--------------------------------------------------------------------------
      | Title
      |--------------------------------------------------------------------------
      |
      | Here you can change the default title of your admin panel.
      |
      | For more detailed instructions you can look here:
      | https://github.com/jeroennoten/Laravel-AdminLTE/#61-title
      |
     */

    'title' => 'SGGA - SISTEMA DE GERENCIAMENTO DE GRANJAS AVIÁRIAS',
    'title_prefix' => '',
    'title_postfix' => '',
    /*
      |--------------------------------------------------------------------------
      | Logo
      |--------------------------------------------------------------------------
      |
      | Here you can change the logo of your admin panel.
      |
      | For more detailed instructions you can look here:
      | https://github.com/jeroennoten/Laravel-AdminLTE/#62-logo
      |
     */
    'logo' => '<b>SGGA</b>',
    'logo_img' => 'vendor/adminlte/dist/img/AdminLTELogo.png',
    'logo_img_class' => 'brand-image-xl',
    'logo_img_xl' => null,
    'logo_img_xl_class' => 'brand-image-xs',
    'logo_img_alt' => 'SGGA',
    /*
      |--------------------------------------------------------------------------
      | Layout
      |--------------------------------------------------------------------------
      |
      | Here we change the layout of your admin panel.
      |
      | For more detailed instructions you can look here:
      | https://github.com/jeroennoten/Laravel-AdminLTE/#63-layout
      |
     */
    'layout_topnav' => null,
    'layout_boxed' => null,
    'layout_fixed_sidebar' => 1,
    'layout_fixed_navbar' => null,
    'layout_fixed_footer' => null,
    /*
      |--------------------------------------------------------------------------
      | Extra Classes
      |--------------------------------------------------------------------------
      |
      | Here you can change the look and behavior of the admin panel.
      |
      | For more detailed instructions you can look here:
      | https://github.com/jeroennoten/Laravel-AdminLTE/#64-classes
      |
     */
    'classes_body' => '',
    'classes_brand' => '',
    'classes_brand_text' => '',
    'classes_content_header' => 'container-fluid',
    'classes_content' => 'container-fluid',
    'classes_sidebar' => 'sidebar-dark-primary elevation-4',
    'classes_sidebar_nav' => '',
    'classes_topnav' => 'navbar-white navbar-light',
    'classes_topnav_nav' => 'navbar-expand-md',
    'classes_topnav_container' => 'container',
    /*
      |--------------------------------------------------------------------------
      | Sidebar
      |--------------------------------------------------------------------------
      |
      | Here we can modify the sidebar of the admin panel.
      |
      | For more detailed instructions you can look here:
      | https://github.com/jeroennoten/Laravel-AdminLTE/#65-sidebar
      |
     */
    'sidebar_mini' => true,
    'sidebar_collapse' => false,
    'sidebar_collapse_auto_size' => false,
    'sidebar_collapse_remember' => false,
    'sidebar_collapse_remember_no_transition' => true,
    'sidebar_scrollbar_theme' => 'os-theme-light',
    'sidebar_scrollbar_auto_hide' => 'l',
    'sidebar_nav_accordion' => true,
    'sidebar_nav_animation_speed' => 300,
    /*
      |--------------------------------------------------------------------------
      | Control Sidebar (Right Sidebar)
      |--------------------------------------------------------------------------
      |
      | Here we can modify the right sidebar aka control sidebar of the admin panel.
      |
      | For more detailed instructions you can look here:
      | https://github.com/jeroennoten/Laravel-AdminLTE/#66-control-sidebar-right-sidebar
      |
     */
    'right_sidebar' => false,
    'right_sidebar_icon' => 'fas fa-cogs',
    'right_sidebar_theme' => 'dark',
    'right_sidebar_slide' => true,
    'right_sidebar_push' => true,
    'right_sidebar_scrollbar_theme' => 'os-theme-light',
    'right_sidebar_scrollbar_auto_hide' => 'l',
    /*
      |--------------------------------------------------------------------------
      | URLs
      |--------------------------------------------------------------------------
      |
      | Here we can modify the url settings of the admin panel.
      |
      | For more detailed instructions you can look here:
      | https://github.com/jeroennoten/Laravel-AdminLTE/#67-urls
      |
     */
    'use_route_url' => false,
    'dashboard_url' => '/',
    'logout_url' => 'logout',
    'login_url' => 'login',
    'register_url' => 'register',
    'password_reset_url' => 'password/reset',
    'password_email_url' => 'password/email',
    /*
      |--------------------------------------------------------------------------
      | Laravel Mix
      |--------------------------------------------------------------------------
      |
      | Here we can enable the Laravel Mix option for the admin panel.
      |
      | For more detailed instructions you can look here:
      | https://github.com/jeroennoten/Laravel-AdminLTE/#68-laravel-mix
      |
     */
    'enabled_laravel_mix' => false,
    /*
      |--------------------------------------------------------------------------
      | Menu Items
      |--------------------------------------------------------------------------
      |
      | Here we can modify the sidebar/top navigation of the admin panel.
      |
      | For more detailed instructions you can look here:
      | https://github.com/jeroennoten/Laravel-AdminLTE/#69-menu
      |
     */
    'menu' => [
        [
            'text' => 'search',
            'search' => true,
            'topnav' => true,
        ],
//        [
//            'text' => ' Início',
//            'url' => '/',
//            'icon' => 'fa fa-fw fa-home',
//             'topnav' => true,
//            'class' => 'ml-auto'
//        ],
//        [
//            'text' => 'blog',
//            'url' => 'admin/blog',
//            'can' => 'manage-blog',
//        ],
        [
            'text' => ' Início',
            'url' => '/',
            'icon' => 'fa fa-fw fa-home',
//            'label'       => 4,
//            'label_color' => 'success',
        ],
        [
            'text' => ' Períodos',
            'url' => 'periodos',
            'icon' => 'fas fa-fw fa-clock'
        ],
        [
            'text' => ' Lotes e aviários',
            'icon' => 'fas fa-fw fa-cubes',
            'area-private' => '',
            'submenu' => [
                [
                    'text' => ' Lotes',
                    'url' => 'lotes',
                    'active' => ['lotes', 'lotes/*', 'regex:@^lotes/[0-9]+$@'],
                    'icon' => 'fas fa-fw fa-caret-right'
                ],
                [
                    'text' => ' Aviários',
                    'url' => 'aviarios',
                    'active' => ['aviarios', 'aviarios/*', 'regex:@^aviarios/[0-9]+$@'],
                    'icon' => 'fas fa-fw fa-caret-right'
                ],
            ],
        ],
        [
            'text' => ' Coletas',
            'url' => 'coletas',
            'icon' => 'fas fa-fw fa-cart-plus',
            'area-private' => ''
        ],
        [
            'text' => ' Envio de ovos',
            'url' => 'envios',
            'active' => ['envios', 'envios/*', 'regex:@^envios/[0-9]+$@'],
            'icon' => 'fas fa-fw fa-truck',
            'area-private' => ''
        ],
        [
            'text' => 'Aves',
            'icon' => 'fas fa-fw fa-kiwi-bird',
            'area-private' => '',
            'submenu' => [
                [
                    'text' => 'Baixa de aves',
                    'url' => 'aves',
                    'active' => ['aves', 'aves/*', 'regex:@^aves/[0-9]+$@'],
                    'icon' => 'fas fa-fw fa-caret-right'
                ],
                [
                    'text' => 'Peso das aves',
                    'url' => 'pesos',
                    'active' => ['pesos', 'pesos/*', 'regex:@^pesos/[0-9]+$@'],
                    'icon' => 'fas fa-fw fa-caret-right'
                ],
            ],
        ],
        [
            'text' => 'Ração',
            'icon' => 'fas fa-fw fa-pallet',
            'area-private' => '',
            'submenu' => [
                [
                    'text' => 'Recebimento',
                    'url' => 'racao/recebimentos',
                    'active' => ['racao/recebimentos', 'racao/recebimentos/*', 'regex:@^racao/recebimentos/[0-9]+$@'],
                    'icon' => 'fas fa-fw fa-caret-right'
                ],
                [
                    'text' => 'Consumo',
                    'url' => 'racao/consumos',
                    'active' => ['racao/consumos', 'racao/consumos/*', 'regex:@^racao/consumos/[0-9]+$@'],
                    'icon' => 'fas fa-fw fa-caret-right'
                ],
            ],
        ],
        [
            'text' => 'Relatórios',
            'icon' => 'fas fa-fw fa-list-alt',
            'area-private' => '',
            'submenu' => [
                [
                    'text' => 'Coletas',
                    'url' => '#',
                    'icon' => 'fas fa-fw fa-caret-right'
                ],
                [
                    'text' => 'Lotes e aviários',
                    'url' => '#',
                    'icon' => 'fas fa-fw fa-caret-right'
                ],
                [
                    'text' => 'Envio de ovos',
                    'url' => '#',
                    'icon' => 'fas fa-fw fa-caret-right'
                ],
                [
                    'text' => 'Aves',
                    'url' => '#',
                    'icon' => 'fas fa-fw fa-caret-right'
                ],
                [
                    'text' => 'Ração',
                    'url' => '#',
                    'icon' => 'fas fa-fw fa-caret-right'
                ],
                [
                    'text' => 'Fertilidade',
                    'url' => '#',
                    'icon' => 'fas fa-fw fa-caret-right'
                ],
                [
                    'text' => 'Eclosão',
                    'url' => '#',
                    'icon' => 'fas fa-fw fa-caret-right'
                ],
            ],
        ],
        [
            'text' => 'Estatísticas',
            'icon' => 'fas fa-fw fa-chart-line',
            'area-private' => '',
            'submenu' => [
                [
                    'text' => 'Checklist',
                    'url' => '#',
                    'icon' => 'fas fa-fw fa-caret-right'
                ],
                [
                    'text' => 'Eclosão',
                    'url' => '#',
                    'icon' => 'fas fa-fw fa-caret-right'
                ],
                [
                    'text' => 'Fertilidade',
                    'url' => '#',
                    'icon' => 'fas fa-fw fa-caret-right'
                ],
                [
                    'text' => 'Produção',
                    'url' => '#',
                    'icon' => 'fas fa-fw fa-caret-right'
                ],
            ],
        ],
        [
            'text' => 'Financeiro',
            'icon' => 'fas fa-fw fa-coins',
            'area-private' => '',
            'submenu' => [
                [
                    'text' => 'Despesas',
                    'url' => '#',
                    'icon' => 'fas fa-fw fa-caret-right'
                ],
                [
                    'text' => 'Conf. financeiro',
                    'url' => '#',
                    'icon' => 'fas fa-fw fa-caret-right'
                ],
            ],
        ],
        [
            'text' => 'Configurações',
            'icon' => 'fas fa-fw fa-cog',
            'submenu' => [
                [
                    'text' => 'Empresa',
                    'url' => '#',
                    'icon' => 'fas fa-fw fa-caret-right'
                ],
                [
                    'text' => 'E-mail',
                    'url' => '#',
                    'icon' => 'fas fa-fw fa-caret-right'
                ],
                [
                    'text' => 'Backup',
                    'url' => '#',
                    'icon' => 'fas fa-fw fa-caret-right'
                ],
            ],
        ],
        [
            'text' => 'Tarefas',
            'icon' => 'fas fa-fw fa-check-square',
            'submenu' => [
                [
                    'text' => 'Diárias',
                    'url' => '#',
                    'icon' => 'fas fa-fw fa-caret-right'
                ],
                [
                    'text' => 'Específicas',
                    'url' => '#',
                    'icon' => 'fas fa-fw fa-caret-right'
                ],
            ],
        ],
        [
            'text' => 'Usuários',
            'icon' => 'fas fa-fw fa-user',
            'icon_color' => 'aqua',
        ],
    ],
    /*
      |--------------------------------------------------------------------------
      | Menu Filters
      |--------------------------------------------------------------------------
      |
      | Here we can modify the menu filters of the admin panel.
      |
      | For more detailed instructions you can look here:
      | https://github.com/jeroennoten/Laravel-AdminLTE/#610-menu-filters
      |
     */
    'filters' => [
        JeroenNoten\LaravelAdminLte\Menu\Filters\HrefFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\SearchFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\ActiveFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\SubmenuFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\ClassesFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\GateFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\LangFilter::class,
    ],
    /*
      |--------------------------------------------------------------------------
      | Plugins Initialization
      |--------------------------------------------------------------------------
      |
      | Here we can modify the plugins used inside the admin panel.
      |
      | For more detailed instructions you can look here:
      | https://github.com/jeroennoten/Laravel-AdminLTE/#611-plugins
      |
     */
    'plugins' => [
        [
            'name' => 'Datatables',
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdn.datatables.net/v/bs/dt-1.10.18/datatables.min.js',
                ],
                [
                    'type' => 'css',
                    'asset' => false,
                    'location' => '//cdn.datatables.net/v/bs/dt-1.10.18/datatables.min.css',
                ],
            ],
        ],
        [
            'name' => 'Select2',
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js',
                ],
                [
                    'type' => 'css',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.css',
                ],
            ],
        ],
        [
            'name' => 'Chartjs',
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.0/Chart.bundle.min.js',
                ],
            ],
        ],
        [
            'name' => 'Sweetalert2',
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdn.jsdelivr.net/npm/sweetalert2@8',
                ],
            ],
        ],
        [
            'name' => 'Pace',
            'active' => false,
            'files' => [
                [
                    'type' => 'css',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/pace/1.0.2/themes/blue/pace-theme-center-radar.min.css',
                ],
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/pace/1.0.2/pace.min.js',
                ],
            ],
        ],
        [
            'name' => 'JQuery-UI',
            'active' => true,
            'files' => [
                [
                    'type' => 'css',
                    'asset' => true,
                    'location' => 'vendor/plugins/jquery-ui/jquery-ui.min.css',
                ],
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => 'vendor/plugins/jquery-ui/jquery-ui.min.js',
                ],
            ],
        ],
    ],
];
