<?php

namespace App\Filament\Pages;

use App\Models\Request;  
use Filament\Actions\Action;
use Filament\Forms\Components\Actions;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Support\Exceptions\Halt;
use Illuminate\Notifications\Notification as NotificationsNotification;

class Softrequest extends Page implements HasForms
{
    use InteractsWithForms;

    public ?array $data = []; 
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

    public function mount(): void
    {
        $this->form->fill();
    }

    public function form(Form $form): Form
    {
        return $form
            ->statePath('data') // <-- bind form data to $data
            ->schema([
                Section::make('')
                    ->description('Энэхүү талбар дээр та өөрийн нэр болон холбоо барих дугаараа үлдээж тайлбар хэсэгт дэлгэрэнгүй тайлбар бичнэ үү')
                    ->schema([
                        TextInput::make('name')
                            ->label('Нэр')
                            ->placeholder('Нэр')
                            ->required()
                            ->validationMessages([
                                'required' => 'Заавал та өөрийн нэрээ оруулна уу.',
                            ]),
                        TextInput::make('phone')
                            ->placeholder('Утас эсвэл И-мэйл')
                            ->label('Холбоо барих дугаар эсвэл И-мэйл')
                            ->required()
                            ->validationMessages([
                                'required' => 'Заавал та өөрийн и-мэйл эсвэл утасны дугаар оруулна уу.',
                            ]),
                        Select::make('price')
                            ->options(config('status.price'))
                            ->label('Төлөвлөж буй өртөг')
                            ->required()
                            ->placeholder('Сонгох')
                            ->validationMessages([
                                'required' => 'Сонголт хийнэ үү',
                            ]),
                        Select::make('period')
                            ->options(config('status.period'))
                            ->label('Төлөвлөж буй хугацаа')
                            ->required()
                            ->placeholder('Сонгох')
                            ->validationMessages([
                                'required' => 'Сонголт хийнэ үү',
                            ]),
                        Textarea::make('content')
                            ->label('Захиалгын дэлгэрэнгүй')
                            ->placeholder('Захиалга хийх програмын дэлгэрэнгүй')
                            ->autosize()
                            ->columnSpanFull()
                            ->required()
                            ->validationMessages([
                                'required' => 'Захиалгын дэлгэрэнгүй оруулана уу',
                            ]),
                    ])
                    ->columns(4),
            ]);
    }
    
    

    public function getFormActions(): array
    {
        return [
            Action::make('save')
                ->label('Илгээх')
                ->submit('save') 
                    ];
    }
    
    public function save(): void
    {
        try {
            $data = $this->form->getState();
            $requestSoft = new Request();  
            $requestSoft->name = $data['name'];
            $requestSoft->period = $data['period'];
            $requestSoft->price = $data['price'];
            $requestSoft->phone = $data['phone'];
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