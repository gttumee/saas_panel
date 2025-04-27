<?php

namespace App\Filament\Pages;

use App\Models\Contact as ModelsContact;
use Filament\Actions\Action;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Support\Exceptions\Halt;

class Contact extends Page
{
    use InteractsWithForms;
    public ?array $data = [];

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
        return $form
        ->statePath('data')
        ->schema([
            Section::make('')
            ->schema([
                TextInput::make('name')
                ->label('Нэр')
                ->placeholder('Нэр')
                ->required()
                ->validationMessages([
                    'required' => 'Заавал та өөрийн нэрээ оруулна уу.',
                ]),
                TextInput::make('phone')
                ->placeholder('Утас')
                ->label('Холбоо барих дугаар')
                ->required()
                ->validationMessages([
                    'required' => 'Заавал та өөрийн утасны дугаар оруулна уу.',
                ]),
                TextInput::make('email')
                ->label(' И-мэйл')
                ->placeholder('И-мэйл')
                ->required()
                ->validationMessages([
                    'required' => 'Заавал та өөрийн и-мэйл хаяг оруулна уу.',
                ]),
                Textarea::make('content')
                ->placeholder('Санал хүсэлт')
                ->label('Санал хүсэлт')
                ->required()
                ->validationMessages([
                    'required' => 'Заавал та өөрийн санал хүсэлтээ оруулна уу.',
                ])
                ->columnSpanFull()
            ])->columns(3),
        ]);
    }
    
    public function getFormActions(): array
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
            $requestSoft = new ModelsContact();  
            $requestSoft->name = $data['name'];
            $requestSoft->phone = $data['phone'];
            $requestSoft->email = $data['email'];
            $requestSoft->content = $data['content'];
            $requestSoft->save();
            } 
            catch (Halt $exception) 
            {
            return;
            }
            
            Notification::make() 
            ->success()
            ->title('Таны хүсэлт амжилттай илгээгдлээ бид таньтай эргэн холбогдох болно баярлалаа')
            ->send(); 
    }

}