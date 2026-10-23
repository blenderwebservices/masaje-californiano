<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BlockedDateResource\Pages;
use App\Models\BlockedDate;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class BlockedDateResource extends Resource
{
    protected static ?string $model = BlockedDate::class;

    protected static ?string $navigationIcon = 'heroicon-o-no-symbol';

    protected static ?string $navigationGroup = 'Disponibilidad y Zonas';

    protected static ?string $modelLabel = 'Día Bloqueado / Viaje';

    protected static ?string $pluralModelLabel = 'Días Bloqueados';

    protected static ?int $navigationSort = 5;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\DatePicker::make('date')
                    ->label('Fecha No Disponible')
                    ->required(),
                Forms\Components\Select::make('zone_affected')
                    ->label('Zona Afectada por el Bloqueo')
                    ->options([
                        'todas' => 'Todas las Zonas (Vacaciones / Descanso general)',
                        'cdmx' => 'Solo CDMX y Edomex (Terapeuta de viaje en Playa del Carmen)',
                        'playa_del_carmen' => 'Solo Playa del Carmen (Terapeuta en CDMX)',
                    ])
                    ->default('todas')
                    ->required(),
                Forms\Components\TextInput::make('reason')
                    ->label('Motivo / Notas')
                    ->placeholder('Ej. Estancia en Playa del Carmen / Feriado')
                    ->columnSpanFull(),
            ])->columns(2);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('date')
                    ->label('Fecha')
                    ->date('d/m/Y (l)')
                    ->sortable()
                    ->weight('bold'),
                Tables\Columns\TextColumn::make('zone_affected')
                    ->label('Zona Afectada')
                    ->badge()
                    ->color(fn ($state) => match ($state) {
                        'cdmx' => 'warning',
                        'playa_del_carmen' => 'info',
                        default => 'danger',
                    })
                    ->formatStateUsing(fn ($state) => match ($state) {
                        'cdmx' => 'Solo CDMX / Edomex',
                        'playa_del_carmen' => 'Solo Playa del Carmen',
                        default => 'Todas las Zonas',
                    }),
                Tables\Columns\TextColumn::make('reason')
                    ->label('Motivo')
                    ->searchable(),
            ])
            ->defaultSort('date', 'asc')
            ->filters([
                //
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
            'index' => Pages\ListBlockedDates::route('/'),
            'create' => Pages\CreateBlockedDate::route('/create'),
            'edit' => Pages\EditBlockedDate::route('/{record}/edit'),
        ];
    }
}
