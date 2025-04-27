<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BlogResource\Pages;
use App\Filament\Resources\BlogResource\RelationManagers;
use App\Models\Blog;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Resources\Resource;
use Filament\Support\Enums\FontWeight;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Infolists\Infolist;


class BlogResource extends Resource
{
    protected static ?string $model = Blog::class;
    protected static ?string $modelLabel = 'Блог';
    protected static ?string $navigationLabel = 'Блог';
    protected static ?int $navigationSort = 4;
    protected static ?string $pluralModelLabel = 'Блог';
    protected static ?string $navigationIcon = 'heroicon-s-fire';

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
                    Tables\Columns\TextColumn::make('title')
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
                ->url(fn (Blog $record) => url("/app/blogs/{$record->id}"))
                ->button(),
                Tables\Actions\Action::make('facebook')
                ->label('Share')
                ->color('info')
                ->button(),
            ]);
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
            ])
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
            'index' => Pages\ListBlogs::route('/'),
            'create' => Pages\CreateBlog::route('/create'),
            'edit' => Pages\EditBlog::route('/{record}/edit'),
            'view' => Pages\ViewBlog::route('/{record}'),

        ];
    }
}