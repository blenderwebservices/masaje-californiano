<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BlogPostResource\Pages;
use App\Models\BlogPost;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class BlogPostResource extends Resource
{
    protected static ?string $model = BlogPost::class;

    protected static ?string $navigationIcon = 'heroicon-o-book-open';

    protected static ?string $navigationGroup = 'Contenido y Blog';

    protected static ?string $modelLabel = 'Artículo de Blog';

    protected static ?string $pluralModelLabel = 'Blog de Bienestar';

    protected static ?int $navigationSort = 7;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Detalles de la Publicación')
                    ->schema([
                        Forms\Components\TextInput::make('title')
                            ->label('Título del Artículo')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('slug')
                            ->label('Slug')
                            ->required()
                            ->unique(ignoreRecord: true),
                        Forms\Components\Select::make('category')
                            ->label('Categoría')
                            ->options([
                                'Masaje Californiano' => 'Masaje Californiano',
                                'Bienestar en Casa' => 'Bienestar en Casa',
                                'Técnicas de Relajación' => 'Técnicas de Relajación',
                                'Salud Integral' => 'Salud Integral',
                                'Autocuidado' => 'Autocuidado',
                            ])
                            ->required(),
                        Forms\Components\TextInput::make('reading_time')
                            ->label('Tiempo de Lectura')
                            ->default('4 min de lectura')
                            ->required(),
                    ])->columns(2),

                Forms\Components\Section::make('Contenido')
                    ->schema([
                        Forms\Components\Textarea::make('excerpt')
                            ->label('Resumen / Copete')
                            ->rows(2)
                            ->required(),
                        Forms\Components\Textarea::make('content')
                            ->label('Cuerpo del Artículo (Formato Markdown o Texto Enriquecido)')
                            ->rows(10)
                            ->required(),
                    ]),

                Forms\Components\Section::make('Publicación y Portada')
                    ->schema([
                        Forms\Components\TextInput::make('cover_image')
                            ->label('Ruta de Imagen de Portada')
                            ->default('/images/hero-massage.jpeg'),
                        Forms\Components\Toggle::make('is_published')
                            ->label('Publicado')
                            ->default(true),
                        Forms\Components\DateTimePicker::make('published_at')
                            ->label('Fecha de Publicación')
                            ->default(now()),
                    ])->columns(3),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->label('Título')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),
                Tables\Columns\TextColumn::make('category')
                    ->label('Categoría')
                    ->badge()
                    ->color('info'),
                Tables\Columns\TextColumn::make('reading_time')
                    ->label('Lectura'),
                Tables\Columns\IconColumn::make('is_published')
                    ->label('Publicado')
                    ->boolean(),
                Tables\Columns\TextColumn::make('published_at')
                    ->label('Fecha Publicación')
                    ->dateTime('d/m/Y')
                    ->sortable(),
            ])
            ->defaultSort('published_at', 'desc')
            ->filters([
                Tables\Filters\TernaryFilter::make('is_published')
                    ->label('Publicado'),
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
            'index' => Pages\ListBlogPosts::route('/'),
            'create' => Pages\CreateBlogPost::route('/create'),
            'edit' => Pages\EditBlogPost::route('/{record}/edit'),
        ];
    }
}
