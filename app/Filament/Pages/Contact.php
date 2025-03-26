<?php

namespace App\Filament\Pages;

use Filament\Actions\Action;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Pages\Page;

class Contact extends Page
{
    protected static ?string $navigationIcon = 'heroicon-c-phone-arrow-up-right';
    protected static ?string $modelLabel = 'Холбоо барих';
    protected static ?string $navigationLabel = 'Холбоо барих';
    protected static string $view = 'filament.pages.contact';
    protected static ?int $navigationSort = 5;
    
    public function getTitle(): string
    {
        return self::$modelLabel ?? 'Холбоо барих';
    }
    public function mount(){
        $this->form->fill();
    }

    public function form(Form $form):Form{
        return $form->schema([
            Section::make('')
            ->schema([
                TextInput::make('name')
                ->label('Нэр')
                ->placeholder('Нэр')
                ->required(),
                TextInput::make('phone')
                ->placeholder('Утас')
                ->label('Холбоо барих дугаар')
                ->required(),
                TextInput::make('mail')
                ->label(' И-мэйл')
                ->placeholder('И-мэйл')
                ->required(),
                Textarea::make('phone')
                ->placeholder('Санал хүсэлт')
                ->label('Санал хүсэлт')
                ->required()
                ->columnSpanFull()
                
            ])->columns(3),
           
        ]);
    }
    protected function getFormActions(): array
    {
        return [
            Action::make('save')
                ->label('Илгээх')
                ->submit('save'),
        ];
    }

    public function save(): void
    {
        try {
            $data = $this->form->getState();
        } catch (Halt $exception) {
            return;
        }
    }

}