<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SpaServiceResource\Pages;
use App\Models\SpaService;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class SpaServiceResource extends Resource
{
    protected static ?string $model = SpaService::class;

    protected static ?string $navigationIcon = 'heroicon-o-sparkles';

    protected static ?string $navigationGroup = 'Servicios de Spa';

    protected static ?string $modelLabel = 'Servicio de Spa';

    protected static ?string $pluralModelLabel = 'Catálogo de Servicios';

    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Información del Servicio')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->label('Nombre del Servicio')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('slug')
                            ->label('Slug URL')
                            ->required()
                            ->unique(ignoreRecord: true),
                        Forms\Components\Select::make('category')
                            ->label('Categoría')
                            ->options([
                                'masaje_californiano' => 'Masaje Californiano',
                                'faciales' => 'Tratamientos Faciales',
                                'terapias_holisticas' => 'Terapias Holísticas',
                                'rituales' => 'Rituales Signature',
                            ])
                            ->required(),
                        Forms\Components\TextInput::make('duration_minutes')
                            ->label('Duración (minutos)')
                            ->numeric()
                            ->default(75)
                            ->required(),
                    ])->columns(2),

                Forms\Components\Section::make('Descripción y Beneficios')
                    ->schema([
                        Forms\Components\Textarea::make('short_description')
                            ->label('Descripción Breve (para tarjetas del front)')
                            ->required()
                            ->rows(3),
                        Forms\Components\Textarea::make('description')
                            ->label('Descripción Completa y Técnica')
                            ->required()
                            ->rows(5),
                        Forms\Components\TagsInput::make('benefits')
                            ->label('Beneficios Clave')
                            ->placeholder('Escribe un beneficio y presiona Enter'),
                        Forms\Components\TagsInput::make('includes')
                            ->label('Incluye en la Visita a Domicilio')
                            ->placeholder('Ej. Camilla ergonómica, aceites tibios, toallas térmicas...'),
                        Forms\Components\Textarea::make('recommended_for')
                            ->label('Recomendado Especialmente Para')
                            ->rows(2),
                    ]),

                Forms\Components\Section::make('Configuración de Visualización')
                    ->schema([
                        Forms\Components\TextInput::make('image_url')
                            ->label('Ruta o URL de Imagen')
                            ->default('/images/hero-massage.jpeg'),
                        Forms\Components\TextInput::make('sort_order')
                            ->label('Orden de Aparición')
                            ->numeric()
                            ->default(0),
                        Forms\Components\Toggle::make('is_featured')
                            ->label('Destacado en el Hero / Portada')
                            ->default(true),
                        Forms\Components\Toggle::make('is_active')
                            ->label('Activo para Citas')
                            ->default(true),
                    ])->columns(4),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Servicio')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),
                Tables\Columns\TextColumn::make('category')
                    ->label('Categoría')
                    ->badge()
                    ->color(fn ($state) => match ($state) {
                        'masaje_californiano' => 'success',
                        'faciales' => 'warning',
                        'rituales' => 'primary',
                        default => 'info',
                    })
                    ->formatStateUsing(fn ($record) => $record->category_label),
                Tables\Columns\TextColumn::make('duration_minutes')
                    ->label('Duración')
                    ->formatStateUsing(fn ($state) => "{$state} min")
                    ->sortable(),
                Tables\Columns\IconColumn::make('is_featured')
                    ->label('Destacado')
                    ->boolean(),
                Tables\Columns\IconColumn::make('is_active')
                    ->label('Activo')
                    ->boolean(),
                Tables\Columns\TextColumn::make('sort_order')
                    ->label('Orden')
                    ->sortable(),
            ])
            ->defaultSort('sort_order', 'asc')
            ->filters([
                Tables\Filters\SelectFilter::make('category')
                    ->label('Categoría')
                    ->options([
                        'masaje_californiano' => 'Masaje Californiano',
                        'faciales' => 'Tratamientos Faciales',
                        'terapias_holisticas' => 'Terapias Holísticas',
                        'rituales' => 'Rituales Signature',
                    ]),
            ])
            ->actions([
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
            'index' => Pages\ListSpaServices::route('/'),
            'create' => Pages\CreateSpaService::route('/create'),
            'edit' => Pages\EditSpaService::route('/{record}/edit'),
        ];
    }
}
