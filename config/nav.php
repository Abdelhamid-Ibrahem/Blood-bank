<?php

return [
    [
        'icon'   => 'fa fa-home nav-icon',
        'route'  => 'dashboard',
        'title'  => 'Dashboard',
        'active' => 'dashboard',
        'ability' => 'dashboard.view',
    ],

    [
        'icon'   => 'fa fa-map-marker nav-icon',
        'route'  => 'governorates.index',
        'title'  => 'Governorates',
        'active' => 'governorates.*',
        'ability' => 'governorates.view',
    ],
    [
        'icon'    => 'fa fa-flag nav-icon',
        'route'   => 'cities.index',
        'title'   => 'Cities',
        'active'  => 'cities.*',
        'ability' => 'cities.view',
    ],
    [
        'icon'    => 'fas fa-tags nav-icon',
        'route'   => 'categories.index',
        'title'   => 'Categories',
        'active'  => 'categories.*',
        'badge'   => 'New',
        'ability' => 'categories.view',
    ],
    [
        'icon'    => 'fa fa-users nav-icon',
        'route'   => 'clients.index',
        'title'   => 'Clients',
        'active'  => 'clients.*',
        'ability' => 'clients.view',
    ],

    [
        'icon'    => 'fa fa-comment nav-icon',
        'route'   => 'posts.index',
        'title'   => 'Posts',
        'badge'   => 'New',
        'active'  => 'posts.*',
        'ability' => 'posts.view',
    ],
    [
        'icon'    => 'fa fa-heart nav-icon',
        'route'   => 'donations.index',
        'title'   => 'Donations',
        'active'  => 'donations.*',
        'badge'   => 'New',
        'ability' => 'donations.view',
    ],
    [
        'icon'    => 'fa fa-list nav-icon',
        'route'   => 'roles.index',
        'title'   => 'Roles',
        'active'  => 'roles.*',
        'ability' => 'roles.view',
    ],
    [
        'icon'    => 'fa fa-users nav-icon',
        'route'   => 'users.index',
        'title'   => 'Users',
        'active'  => 'users.*',
        'ability' => 'users.view',
    ],
    [
        'icon'    => 'fa fa-phone nav-icon',
        'route'   => 'contact.index',
        'title'   => 'Contact us',
        'active'  => 'contact.*',
        'badge'   => 'New',
        'ability' => 'contact.view',
    ],
    [
        'icon'    => 'fa fa-cogs nav-icon',
        'route'   => 'setting.index',
        'title'   => 'Settings',
        'active'  => 'setting.*',
        'ability' => 'setting.view',
    ],



];
