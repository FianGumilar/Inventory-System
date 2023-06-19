<?php

namespace App\Actions\Utility\Dashboard;

class GetSidebarMenuAction
{
    public function handle()
    {
        return [
            [
                'text' => 'Dashboard',
                'url' => route('dashboard.index'),
                'icon' => 'VDashboard',
                'can' => 'view_general_dashboard'
            ],
            [
                'text' => 'Fungsi Category',
                'url' => route('utility.index'),
                'icon' => 'VTransaction',
                'can' => 'view_utility'
            ],
            [
                'text' => 'Departemen Category',
                'url' => route('category.index'),
                'icon' => 'VTag',
                'can' => 'view_category'
            ],
            [
                'text' => 'Book',
                'url' => route('book.index'),
                'icon' => 'VProduct',
                'can' => 'view_book'
            ],
            [
                'text' => 'Settings',
                'icon' => 'VSetting',
                'group' => true,
                'can' => ['view_settings_role_management', 'view_settings_user_management'],
                'submenu' => [
                    [
                        'text' => 'Role Management',
                        'url' => route('settings.role.index'),
                        'can' => 'view_settings_role_management',
                    ],
                    [
                        'text' => 'User Management',
                        'url' => route('settings.user.index'),
                        'can' => 'view_settings_user_management',
                    ],
                ],
            ],
        ];
    }
}