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
        'category' => [
            'title' => 'Категории',
            'icon' => 'mdi-filter-outline',
            'parent' => false,
            'visible' => true
        ],
        'product' => [
            'title' => 'Продукты',
            'icon' => 'mdi-cart',
            'parent' => false,
            'visible' => true
        ],
        'service' => [
            'title' => 'Услуги',
            'icon' => 'mdi-book-open',
            'parent' => false,
            'visible' => true
        ],
        'project' => [
            'title' => 'Проекты',
            'icon' => 'mdi-presentation',
            'parent' => false,
            'visible' => true
        ],
        'client' => [
            'title' => 'Клиенты',
            'icon' => 'mdi-human-greeting',
            'parent' => false,
            'visible' => true
        ],
        'feedback' => [
            'title' => 'Отзывы',
            'icon' => 'mdi-comment-account-outline',
            'parent' => false,
            'visible' => true
        ],
        'users' => [
            'title' => 'Пользователи',
            'icon' => 'mdi-human-male-female',
            'parent' => false,
            'visible' => true
        ],
        'profile' => [
            'title' => 'Профиль',
            'visible' => false
        ],
        'settings' => [
            'title' => 'Настройки',
            'visible' => false
        ],
        'home' => [
            'title' => 'Главная',
            'visible' => false
        ],
        'homepage' => [
            'title' => 'Главная страница',
            'visible' => false
        ],
        'logout' => [
            'title' => 'Выход',
            'visible' => false
        ],
    ],
    'routes' => [
        'settings' => 'Настройки',
        'profile' => 'Профиль',
    ]
];
