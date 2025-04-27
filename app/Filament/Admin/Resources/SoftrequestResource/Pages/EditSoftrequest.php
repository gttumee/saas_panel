<?php

namespace App\Filament\Admin\Resources\SoftrequestResource\Pages;

use App\Filament\Admin\Resources\SoftrequestResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSoftrequest extends EditRecord
{
    protected static string $resource = SoftrequestResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
