<?php

namespace App\Filament\Admin\Resources\SoftrequestResource\Pages;

use App\Filament\Admin\Resources\SoftrequestResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSoftrequests extends ListRecords
{
    protected static string $resource = SoftrequestResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
