<?php

namespace App\Filament\Pages;

use App\Models\Request;
use Filament\Actions\Action;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Pages\Page;

class Softrequest extends Page implements HasForms
{
    use InteractsWithForms;
    protected static ?string $modelLabel = 'Програм захиалга';
    protected static ?string $navigationIcon = 'heroicon-o-qr-code';
    protected static ?string $navigationLabel = 'Програм захиалга';
    protected static string $view = 'filament.pages.softrequest';
    protected static ?int $navigationSort = 4;

    
    public function getTitle(): string
    {
        return self::$modelLabel ?? 'Програм захиалга';
    }

    public function getPageLabel(): string
    {
        return self::$pluralModelLabel ?? 'Програм захиалга';
    }
    
    public function mount(){
        $this->form->fill();
    }

    public function form(Form $form):Form{
        return $form->schema([
            Section::make('')
            ->description('Энэхүү талбар дээр та өөрийн нэр болон холбоо барих дугаараа үлдээж тайлбар хэсэгт дэлгэрэгүй тайлбар бичнэ үү')
            ->schema([
                TextInput::make('name')
                ->label('Нэр')
                ->placeholder('Нэр'),
                TextInput::make('phone')
                ->placeholder('Утас эсвэл И-мэйл')
                ->label('Холбоо барих дугаар эсвэл И-мэйл'),
                RichEditor::make('content')
                ->label('Тайлбар')
                ->placeholder('Захиалга хийх програмын дэлгэрэнгүй')
                ->toolbarButtons([
                    'bold',
                    'bulletList',
                    'h2',
                    'italic',
                    'orderedList',
                    'redo',
                    'underline',
                    'undo',
                ])
                ->columnSpanFull(),
            ])->columns(2)
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