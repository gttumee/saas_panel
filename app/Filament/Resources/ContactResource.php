<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ContactResource\Pages;
use App\Filament\Resources\ContactResource\RelationManagers;
use App\Models\Contact;
use Filament\Forms;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

use function Laravel\Prompts\textarea;

class ContactResource extends Resource
{
    protected static ?string $model = Contact::class;
    protected static ?string $navigationLabel = 'Холбоо барих';
    protected static ?int $navigationSort = 4;
    protected static ?string $navigationIcon = 'heroicon-s-phone-arrow-down-left';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
            TextInput::make('name')
            ->label('Нэр')
            ->required(),
            TextInput::make('email')
            ->label('И-мэйл')
            ->required(),
            TextInput::make('phone')
            ->label('Утас')
            ->required(),
            Textarea::make('contenct')
            ->label('Захиа')
            ->required()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
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
            'index' => Pages\ListContacts::route('/'),
            'create' => Pages\CreateContact::route('/create'),
            'edit' => Pages\EditContact::route('/{record}/edit'),
        ];
    }
}