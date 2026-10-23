<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AppointmentResource\Pages;
use App\Models\Appointment;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class AppointmentResource extends Resource
{
    protected static ?string $model = Appointment::class;

    protected static ?string $navigationIcon = 'heroicon-o-calendar-days';

    protected static ?string $navigationGroup = 'Citas y Clientes';

    protected static ?string $modelLabel = 'Cita Agendada';

    protected static ?string $pluralModelLabel = 'Agenda de Citas';

    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Datos del Cliente')
                    ->schema([
                        Forms\Components\Select::make('lead_id')
                            ->label('Prospecto Asociado (Opcional)')
                            ->relationship('lead', 'name')
                            ->searchable()
                            ->preload(),
                        Forms\Components\TextInput::make('client_name')
                            ->label('Nombre del Cliente')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('client_phone')
                            ->label('WhatsApp / Teléfono')
                            ->tel()
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('client_email')
                            ->label('Correo Electrónico')
                            ->email()
                            ->maxLength(255),
                    ])->columns(2),

                Forms\Components\Section::make('Detalles de la Cita y Domicilio')
                    ->schema([
                        Forms\Components\Select::make('spa_service_id')
                            ->label('Servicio a Realizar')
                            ->relationship('spaService', 'name')
                            ->required()
                            ->searchable()
                            ->preload(),
                        Forms\Components\DatePicker::make('appointment_date')
                            ->label('Fecha de la Cita')
                            ->required(),
                        Forms\Components\Select::make('time_slot')
                            ->label('Horario / Turno')
                            ->options([
                                '09:30' => '09:30 AM',
                                '10:00' => '10:00 AM',
                                '12:00' => '12:00 PM',
                                '13:00' => '01:00 PM',
                                '15:00' => '03:00 PM',
                                '16:00' => '04:00 PM',
                                '17:30' => '05:30 PM',
                                '18:30' => '06:30 PM',
                                '20:00' => '08:00 PM',
                            ])
                            ->required(),
                        Forms\Components\Select::make('zone')
                            ->label('Zona de Cobertura')
                            ->options([
                                'cdmx' => 'Ciudad de México',
                                'edomex' => 'Estado de México',
                                'playa_del_carmen' => 'Playa del Carmen / Riviera Maya',
                            ])
                            ->required(),
                        Forms\Components\Textarea::make('full_address')
                            ->label('Dirección Completa a Domicilio (Calle, Número, Depto, Colonia, Referencias)')
                            ->required()
                            ->rows(3)
                            ->columnSpanFull(),
                    ])->columns(2),

                Forms\Components\Section::make('Estado y Notas Terapéuticas')
                    ->schema([
                        Forms\Components\Select::make('status')
                            ->label('Estado de la Cita')
                            ->options([
                                'pendiente' => 'Pendiente de Confirmación',
                                'confirmada' => 'Confirmada',
                                'en_camino' => 'Terapeuta en Camino',
                                'completada' => 'Sesión Completada',
                                'cancelada' => 'Cancelada',
                            ])
                            ->default('pendiente')
                            ->required(),
                        Forms\Components\Toggle::make('reminder_sent')
                            ->label('Recordatorio Enviado')
                            ->default(false),
                        Forms\Components\Textarea::make('client_notes')
                            ->label('Comentarios / Dolores previos expresados por el cliente')
                            ->rows(2)
                            ->columnSpanFull(),
                        Forms\Components\Textarea::make('therapist_notes')
                            ->label('Notas del Terapeuta (aceites recomendados, evolución, etc.)')
                            ->rows(3)
                            ->columnSpanFull(),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('appointment_date')
                    ->label('Fecha')
                    ->date('d/m/Y')
                    ->sortable()
                    ->weight('bold'),
                Tables\Columns\TextColumn::make('time_slot')
                    ->label('Hora')
                    ->badge()
                    ->color('info'),
                Tables\Columns\TextColumn::make('client_name')
                    ->label('Cliente')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('client_phone')
                    ->label('Teléfono')
                    ->copyable()
                    ->icon('heroicon-o-phone'),
                Tables\Columns\TextColumn::make('spaService.name')
                    ->label('Servicio')
                    ->limit(28)
                    ->tooltip(fn ($record) => $record->spaService?->name),
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
                Tables\Columns\TextColumn::make('status')
                    ->label('Estado')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'pendiente' => 'warning',
                        'confirmada' => 'success',
                        'en_camino' => 'primary',
                        'completada' => 'gray',
                        'cancelada' => 'danger',
                        default => 'info',
                    })
                    ->formatStateUsing(fn ($state) => match ($state) {
                        'pendiente' => 'Pendiente',
                        'confirmada' => 'Confirmada',
                        'en_camino' => 'En Camino',
                        'completada' => 'Completada',
                        'cancelada' => 'Cancelada',
                        default => ucfirst($state),
                    }),
                Tables\Columns\IconColumn::make('reminder_sent')
                    ->label('Recordatorio')
                    ->boolean(),
            ])
            ->defaultSort('appointment_date', 'asc')
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->label('Estado')
                    ->options([
                        'pendiente' => 'Pendiente',
                        'confirmada' => 'Confirmada',
                        'en_camino' => 'En Camino',
                        'completada' => 'Completada',
                        'cancelada' => 'Cancelada',
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
                    ->url(fn (Appointment $record) => $record->whatsapp_link, shouldOpenInNewTab: true),

                Tables\Actions\Action::make('marcar_en_camino')
                    ->label('En Camino')
                    ->icon('heroicon-o-truck')
                    ->color('primary')
                    ->visible(fn (Appointment $record) => $record->status === 'confirmada')
                    ->action(function (Appointment $record) {
                        $record->update(['status' => 'en_camino']);
                        Notification::make()->title('Estado actualizado a: En Camino')->success()->send();
                    }),

                Tables\Actions\Action::make('completar')
                    ->label('Completar')
                    ->icon('heroicon-o-check-circle')
                    ->color('success')
                    ->visible(fn (Appointment $record) => in_array($record->status, ['confirmada', 'en_camino']))
                    ->action(function (Appointment $record) {
                        $record->update(['status' => 'completada']);
                        Notification::make()->title('Sesión marcada como completada')->success()->send();
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
            'index' => Pages\ListAppointments::route('/'),
            'create' => Pages\CreateAppointment::route('/create'),
            'edit' => Pages\EditAppointment::route('/{record}/edit'),
        ];
    }
}
