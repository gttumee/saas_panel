<?php

namespace App\Infolists\Components;

use Filament\Infolists\Components\Component;

class About extends Component
{
    protected string $view = 'infolists.components.about';

    public static function make(): static
    {
        return app(static::class);
    }
}
