<?php

namespace App\Filament\Resources;

use App\Filament\Resources\KnowledgeDocumentResource\Pages;
use App\Models\KnowledgeDocument;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class KnowledgeDocumentResource extends Resource
{
    protected static ?string $model = KnowledgeDocument::class;

    protected static ?string $navigationIcon = 'heroicon-o-cpu-chip';

    protected static ?string $navigationGroup = 'Asistente Virtual RAG';

    protected static ?string $modelLabel = 'Documento RAG / FAQ';

    protected static ?string $pluralModelLabel = 'Base de Conocimiento RAG';

    protected static ?int $navigationSort = 6;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Metadatos del Documento de Conocimiento')
                    ->schema([
                        Forms\Components\TextInput::make('title')
                            ->label('Título / Pregunta')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\Select::make('category')
                            ->label('Categoría Temática')
                            ->options([
                                'faq' => 'Preguntas Frecuentes (FAQ)',
                                'tecnica_masaje' => 'Técnica de Masaje Californiano',
                                'preparacion_domicilio' => 'Preparación para el Hogar',
                                'zonas_cobertura' => 'Zonas y Cobertura a Domicilio',
                                'terapeuta' => 'Sobre Jesús Arturo Robles',
                                'beneficios' => 'Beneficios Terapéuticos y Físicos',
                            ])
                            ->required(),
                        Forms\Components\TextInput::make('keywords')
                            ->label('Palabras Clave (Separadas por comas)')
                            ->placeholder('californiano, duracion, domicilio, camilla, costo'),
                        Forms\Components\TextInput::make('sort_order')
                            ->label('Prioridad / Orden')
                            ->numeric()
                            ->default(0),
                        Forms\Components\Toggle::make('is_active')
                            ->label('Activo para el Chatbot')
                            ->default(true),
                    ])->columns(2),

                Forms\Components\Section::make('Contenido para Inyección en el Chatbot')
                    ->schema([
                        Forms\Components\Textarea::make('content')
                            ->label('Texto Informativo Completo (Se inyecta como contexto en el RAG)')
                            ->rows(8)
                            ->required()
                            ->columnSpanFull(),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->label('Título / Asunto')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),
                Tables\Columns\TextColumn::make('category')
                    ->label('Categoría')
                    ->badge()
                    ->color(fn ($state) => match ($state) {
                        'tecnica_masaje' => 'success',
                        'faq' => 'warning',
                        'zonas_cobertura' => 'info',
                        'terapeuta' => 'primary',
                        default => 'gray',
                    })
                    ->formatStateUsing(fn ($record) => $record->category_label),
                Tables\Columns\IconColumn::make('is_active')
                    ->label('Activo en RAG')
                    ->boolean(),
                Tables\Columns\TextColumn::make('sort_order')
                    ->label('Orden')
                    ->sortable(),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Actualizado')
                    ->dateTime('d/m/Y H:i')
                    ->sortable(),
            ])
            ->defaultSort('sort_order', 'asc')
            ->filters([
                Tables\Filters\SelectFilter::make('category')
                    ->label('Categoría')
                    ->options([
                        'faq' => 'Preguntas Frecuentes',
                        'tecnica_masaje' => 'Técnica de Masaje',
                        'preparacion_domicilio' => 'Preparación en Hogar',
                        'zonas_cobertura' => 'Zonas y Cobertura',
                        'terapeuta' => 'Sobre el Terapeuta',
                        'beneficios' => 'Beneficios',
                    ]),
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
            'index' => Pages\ListKnowledgeDocuments::route('/'),
            'create' => Pages\CreateKnowledgeDocument::route('/create'),
            'edit' => Pages\EditKnowledgeDocument::route('/{record}/edit'),
        ];
    }
}
