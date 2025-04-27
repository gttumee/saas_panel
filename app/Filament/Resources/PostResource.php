<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PostResource\Pages;
use App\Filament\Resources\PostResource\RelationManagers;
use App\Models\Post;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Infolists\Components\Actions\Action as ActionsAction;
use Filament\Infolists\Components\Grid;
use Filament\Infolists\Components\Group;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\Split;
use Filament\Infolists\Components\TextEntry;
use Filament\Resources\Resource;
use Filament\Support\Enums\FontWeight;
use Filament\Tables;
use Filament\Infolists\Infolist;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Infolists\Components\Actions;
use Filament\Infolists\Components\Actions\Action;

class PostResource extends Resource
{
    protected static ?string $model = Post::class;
    protected static ?string $navigationLabel = 'Гүйцэтгэсэн ажил';
    protected static ?string $modelLabel = 'Гүйцэтгэсэн ажил';
    protected static ?string $pluralModelLabel = 'Гүйцэтгэсэн ажил';
    protected static ?string $navigationIcon = 'heroicon-s-squares-plus';
    protected static ?int $navigationSort = 1;

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
                Tables\Columns\Layout\Stack::make([
                    Tables\Columns\ImageColumn::make('image')
                        ->height('100%')
                        ->width('100%'),
                    Tables\Columns\Layout\Stack::make([
                        Tables\Columns\TextColumn::make('name')
                            ->weight(FontWeight::Bold)
                    ]),
                ])->space(3),
                    Tables\Columns\Layout\Panel::make([
                    Tables\Columns\Layout\Split::make([
                    Tables\Columns\ColorColumn::make('color')
                            ->grow(false),
                        Tables\Columns\TextColumn::make('description')
                            ->color('gray'),
                    ]),
                ])->collapsible(),
            ])
            ->filters([
                //
            ])
            ->contentGrid([
                'md' => 2,
                'xl' => 3,
                ])
            ->actions([
                Tables\Actions\Action::make('detail')
                ->label('Дэлгэрэнгүй')
                ->url(fn (Post $record) => url("/app/posts/{$record->id}"))
                ->button(),
                Tables\Actions\Action::make('demo')
                ->label('Туршиж үзэх')
                ->url(fn (Post $record) => $record->link)
                ->openUrlInNewTab()
                ->button()
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function infolist(Infolist $infolist): Infolist
    {
               return $infolist
            ->schema([
               Section::make()
                    ->schema([
                        TextEntry::make('name')
                            ->prose()
                            ->markdown()
                            ->hiddenLabel(),
                        TextEntry::make('detail')
                            ->prose()
                            ->markdown()
                            ->hiddenLabel(),
                            Actions::make([
                                Action::make('star')
                                    ->label('Туршиж үзэх')
                                    ->url(fn (Post $record) => $record->link)
                                    ->openUrlInNewTab(), 
                            ]),
                    ])
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPosts::route('/'),
            'create' => Pages\CreatePost::route('i/create'),
            'edit' => Pages\EditPost::route('/{record}/edit'),
            'view' => Pages\ViewPost::route('/{record}'),
        ];
    }
}