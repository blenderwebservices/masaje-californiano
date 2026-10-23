<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ScheduleSlotResource\Pages;
use App\Models\ScheduleSlot;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ScheduleSlotResource extends Resource
{
    protected static ?string $model = ScheduleSlot::class;

    protected static ?string $navigationIcon = 'heroicon-o-clock';

    protected static ?string $navigationGroup = 'Disponibilidad y Zonas';

    protected static ?string $modelLabel = 'Horario de Atención';

    protected static ?string $pluralModelLabel = 'Horarios Disponibles';

    protected static ?int $navigationSort = 4;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('day_of_week')
                    ->label('Día de la Semana')
                    ->options(ScheduleSlot::daysList())
                    ->required(),
                Forms\Components\TextInput::make('time_slot')
                    ->label('Horario / Turno (ej. 09:30, 15:00, 20:00)')
                    ->required()
                    ->placeholder('17:30'),
                Forms\Components\Toggle::make('is_active')
                    ->label('Turno Activo para Citas')
                    ->default(true)
                    ->required(),
            ])->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('day_of_week')
                    ->label('Día')
                    ->formatStateUsing(fn ($record) => $record->day_name)
                    ->sortable()
                    ->badge()
                    ->color('primary'),
                Tables\Columns\TextColumn::make('time_slot')
                    ->label('Hora / Turno')
                    ->sortable()
                    ->weight('bold'),
                Tables\Columns\IconColumn::make('is_active')
                    ->label('Disponible')
                    ->boolean(),
            ])
            ->defaultSort('day_of_week', 'asc')
            ->filters([
                Tables\Filters\SelectFilter::make('day_of_week')
                    ->label('Filtrar por Día')
                    ->options(ScheduleSlot::daysList()),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
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
            'index' => Pages\ListScheduleSlots::route('/'),
            'create' => Pages\CreateScheduleSlot::route('/create'),
            'edit' => Pages\EditScheduleSlot::route('/{record}/edit'),
        ];
    }
}
