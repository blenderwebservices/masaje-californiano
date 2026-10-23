<?php

namespace App\Filament\Resources;

use App\Filament\Resources\LeadResource\Pages;
use App\Models\Appointment;
use App\Models\Lead;
use App\Models\SpaService;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class LeadResource extends Resource
{
    protected static ?string $model = Lead::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-plus';

    protected static ?string $navigationGroup = 'Citas y Clientes';

    protected static ?string $modelLabel = 'Prospecto / Lead';

    protected static ?string $pluralModelLabel = 'Prospectos (Leads)';

    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Información del Prospecto')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->label('Nombre Completo')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('phone')
                            ->label('WhatsApp / Teléfono')
                            ->tel()
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('email')
                            ->label('Correo Electrónico')
                            ->email()
                            ->maxLength(255),
                        Forms\Components\Select::make('spa_service_id')
                            ->label('Servicio Solicitado')
                            ->relationship('spaService', 'name')
                            ->searchable()
                            ->preload(),
                    ])->columns(2),

                Forms\Components\Section::make('Ubicación y Preferencia de Cita')
                    ->schema([
                        Forms\Components\Select::make('zone')
                            ->label('Zona de Domicilio')
                            ->options([
                                'cdmx' => 'Ciudad de México',
                                'edomex' => 'Estado de México',
                                'playa_del_carmen' => 'Playa del Carmen / Riviera Maya',
                                'otra' => 'Otra Zona',
                            ])
                            ->required(),
                        Forms\Components\DatePicker::make('preferred_date')
                            ->label('Fecha Deseada'),
                        Forms\Components\TextInput::make('preferred_time_slot')
                            ->label('Horario Deseado (ej. 17:30)'),
                        Forms\Components\Textarea::make('address')
                            ->label('Dirección Completa a Domicilio')
                            ->rows(3)
                            ->columnSpanFull(),
                        Forms\Components\Textarea::make('client_notes')
                            ->label('Notas / Peticiones del Cliente')
                            ->rows(2)
                            ->columnSpanFull(),
                    ])->columns(3),

                Forms\Components\Section::make('Seguimiento y Estado del Lead')
                    ->schema([
                        Forms\Components\Select::make('status')
                            ->label('Estado del Seguimiento')
                            ->options([
                                'nuevo' => 'Nuevo Lead (Sin atender)',
                                'contactado' => 'Contactado por WhatsApp/Teléfono',
                                'cita_agendada' => 'Cita Agendada en Calendario',
                                'descartado' => 'Descartado / No interesado',
                            ])
                            ->default('nuevo')
                            ->required(),
                        Forms\Components\TextInput::make('source')
                            ->label('Origen')
                            ->default('web_landing')
                            ->readOnly(),
                        Forms\Components\Textarea::make('internal_notes')
                            ->label('Notas Internas del Terapeuta')
                            ->rows(3)
                            ->columnSpanFull(),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Nombre')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),
                Tables\Columns\TextColumn::make('phone')
                    ->label('Teléfono')
                    ->searchable()
                    ->copyable()
                    ->icon('heroicon-o-phone'),
                Tables\Columns\TextColumn::make('spaService.name')
                    ->label('Servicio')
                    ->sortable()
                    ->badge()
                    ->color('gray'),
                Tables\Columns\TextColumn::make('zone')
                    ->label('Zona')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'cdmx' => 'success',
                        'edomex' => 'warning',
                        'playa_del_carmen' => 'info',
                        default => 'gray',
                    })
                    ->formatStateUsing(fn ($state) => match ($state) {
                        'cdmx' => 'CDMX',
                        'edomex' => 'Edomex',
                        'playa_del_carmen' => 'Playa del Carmen',
                        default => ucfirst($state),
                    }),
                Tables\Columns\TextColumn::make('preferred_date')
                    ->label('Fecha Pretendida')
                    ->date('d/m/Y')
                    ->sortable(),
                Tables\Columns\TextColumn::make('preferred_time_slot')
                    ->label('Horario'),
                Tables\Columns\TextColumn::make('status')
                    ->label('Estado')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'nuevo' => 'danger',
                        'contactado' => 'warning',
                        'cita_agendada' => 'success',
                        'descartado' => 'gray',
                        default => 'info',
                    })
                    ->formatStateUsing(fn ($state) => match ($state) {
                        'nuevo' => 'Nuevo Lead',
                        'contactado' => 'Contactado',
                        'cita_agendada' => 'Cita Agendada',
                        'descartado' => 'Descartado',
                        default => ucfirst($state),
                    }),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Registrado')
                    ->since()
                    ->sortable(),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->label('Estado')
                    ->options([
                        'nuevo' => 'Nuevo Lead',
                        'contactado' => 'Contactado',
                        'cita_agendada' => 'Cita Agendada',
                        'descartado' => 'Descartado',
                    ]),
                Tables\Filters\SelectFilter::make('zone')
                    ->label('Zona')
                    ->options([
                        'cdmx' => 'Ciudad de México',
                        'edomex' => 'Estado de México',
                        'playa_del_carmen' => 'Playa del Carmen',
                    ]),
            ])
            ->actions([
                Tables\Actions\Action::make('whatsapp')
                    ->label('WhatsApp')
                    ->icon('heroicon-o-chat-bubble-left-ellipsis')
                    ->color('success')
                    ->url(function (Lead $record): string {
                        $clean = preg_replace('/[^0-9]/', '', $record->phone);
                        if (!str_starts_with($clean, '52') && strlen($clean) === 10) {
                            $clean = '52' . $clean;
                        }
                        $svc = $record->spaService?->name ?? 'Masaje Californiano';
                        $msg = "Hola {$record->name}, te saluda Jesús Arturo Robles de Masaje Californiano a Domicilio. Recibí tu mensaje interesándote en {$svc}. ¿En qué podemos apoyarte?";
                        return "https://wa.me/{$clean}?text=" . urlencode($msg);
                    }, shouldOpenInNewTab: true),

                Tables\Actions\Action::make('convert_to_appointment')
                    ->label('Crear Cita')
                    ->icon('heroicon-o-calendar-days')
                    ->color('primary')
                    ->requiresConfirmation()
                    ->modalHeading('Convertir Lead en Cita Oficial')
                    ->modalDescription('Se creará una cita en el calendario con la información de este prospecto y su estado pasará a "Cita Agendada".')
                    ->visible(fn (Lead $record) => $record->status !== 'cita_agendada')
                    ->action(function (Lead $record) {
                        $appointment = Appointment::create([
                            'lead_id' => $record->id,
                            'spa_service_id' => $record->spa_service_id ?? SpaService::first()?->id,
                            'client_name' => $record->name,
                            'client_email' => $record->email,
                            'client_phone' => $record->phone,
                            'appointment_date' => $record->preferred_date ?? now()->addDay(),
                            'time_slot' => $record->preferred_time_slot ?? '17:30',
                            'zone' => $record->zone,
                            'full_address' => $record->address ?? 'Dirección pendiente por confirmar',
                            'status' => 'confirmada',
                            'client_notes' => $record->client_notes,
                        ]);

                        $record->update(['status' => 'cita_agendada']);

                        Notification::make()
                            ->title('Cita creada exitosamente')
                            ->body("Se agendó la cita para {$record->name} el {$appointment->appointment_date->format('d/m/Y')}.")
                            ->success()
                            ->send();
                    }),

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
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListLeads::route('/'),
            'create' => Pages\CreateLead::route('/create'),
            'edit' => Pages\EditLead::route('/{record}/edit'),
        ];
    }
}
