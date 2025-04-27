<?php

namespace App\Filament\Resources\PostResource\Pages;

use App\Filament\Resources\PostResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewPost extends ViewRecord
{
    protected static string $resource = PostResource::class;
    public function getTitle(): string
    {
        // Зөвхөн 'Гүйцэтгэсэн ажил' гэх мэт харагдуулна
        return static::$modelLabel ?? 'Гүйцэтгэсэн ажил';
    }
}