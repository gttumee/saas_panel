<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\SoftrequestResource\Pages;
use App\Filament\Admin\Resources\SoftrequestResource\RelationManagers;
use App\Models\Request;
use App\Models\Softrequest;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SoftrequestResource extends Resource
{
    protected static ?string $model = Request::class;

    protected static ?string $modelLabel = 'Програм захиалга';
    protected static ?string $navigationIcon = 'heroicon-o-qr-code';
    protected static ?string $navigationLabel = 'Програм захиалга';
    protected static string $view = 'filament.pages.softrequest';
    protected static ?int $navigationSort = 4;


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
        ->columns([
            TextColumn::make('name')
            ->label('Нэр'),
            TextColumn::make('phone')
            ->label('Утас'),
            TextColumn::make('created_at')
            ->label('Илгээсэн')

        ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSoftrequests::route('/'),
            'create' => Pages\CreateSoftrequest::route('/create'),
            'edit' => Pages\EditSoftrequest::route('/{record}/edit'),
        ];
    }
}