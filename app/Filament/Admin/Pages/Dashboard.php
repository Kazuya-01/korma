<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use App\Filament\Widgets\WelcomeWidget;
use App\Filament\Widgets\RekapKeuangan;

class Dashboard extends Page
{
    protected static string $view = 'filament.pages.dashboard';

    protected function getHeaderWidgets(): array
    {
        return [
            WelcomeWidget::class,
        ];
    }

    protected function getFooterWidgets(): array
    {
        return [
            RekapKeuangan::class,
        ];
    }
}
