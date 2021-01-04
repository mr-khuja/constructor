<?php
return [
    'menu' => [
        //https://wrappixel.com/demos/admin-templates/materialpro-bootstrap-latest/material-pro/src/dark/icon-material.html
        'menu' => [
            'title' => 'Меню',
            'icon' => 'mdi-menu',
            'parent' => false,
            'visible' => true
        ],

        'basic' => [
            'title' => 'Страницы',
            'icon' => 'mdi-file-document',
            'parent' => false,
            'visible' => true
        ],
        'news' => [
            'title' => 'Новости',
            'icon' => 'mdi-newspaper',
            'parent' => false,
            'visible' => true
        ],
        'slider' => [
            'title' => 'Слайдер',
            'icon' => 'mdi-image-filter',
            'parent' => false,
            'visible' => true
        ],
        'service' => [
            'title' => 'Услуги',
            'icon' => 'mdi-book-open',
            'parent' => false,
            'visible' => false
        ],
        'category' => [
            'title' => 'Категории',
            'icon' => 'mdi-filter-outline',
            'parent' => false,
            'visible' => false
        ],
        'product' => [
            'title' => 'Продукты',
            'icon' => 'mdi-cart',
            'parent' => false,
            'visible' => false
        ],
        'client' => [
            'title' => 'Клиенты',
            'icon' => 'mdi-human-greeting',
            'parent' => false,
            'visible' => false
        ],
        'feedback' => [
            'title' => 'Отзывы',
            'icon' => 'mdi-comment-account-outline',
            'parent' => false,
            'visible' => false
        ],
        'users' => [
            'title' => 'Пользователи',
            'icon' => 'mdi-human-male-female',
            'parent' => false,
            'visible' => false
        ],
        'profile' => [
            'title' => 'Профиль',
            'visible' => false
        ],
    ],
    'routes' => [
        'settings' => 'Настройки',
        'profile' => 'Профиль',
    ]
];
