<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;

class About extends Page
{
    protected static ?string $modelLabel = 'Бидний тухай';
    protected static ?string $navigationIcon = 'heroicon-s-rocket-launch';
    protected static ?string $navigationLabel = 'Бидний тухай';
    protected static ?int $navigationSort = 1;
    protected static string $view = 'filament.pages.about';
    public function getTitle(): string
    {
        return self::$modelLabel ?? 'Бидний тухай';
    }
}