<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OrderResource\Pages;
use App\Filament\Resources\OrderResource\RelationManagers;
use App\Models\Order;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\Wizard\Step;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\ColorPicker;
use Filament\Forms\Components\KeyValue;


class OrderResource extends Resource
{
    protected static ?string $model = Order::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('client_id')
                ->relationship('client', 'nombre')
                ->searchable()
                ->preload()
                ->createOptionForm([
                    TextInput::make('nombre')
                        ->required()
                        ->maxLength(255),
                    TextInput::make('direccion')
                        ->label('Direccion')
                        ->required()
                        ->maxLength(255),
                    TextInput::make('telefono')
                        ->label('Telefono')
                        ->tel()
                        ->required(),
                ])
                ->required(),
                //Se agrega el pedido 
            Repeater::make('agregar pedido')
            ->schema([
                Select::make('project_id')
                    ->relationship('project', 'nombre')
                    ->searchable()
                    ->preload()
                    ->createOptionForm([
                        TextInput::make('nombre')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('direccion')
                            ->label('Direccion')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('telefono')
                            ->label('Telefono')
                            ->tel()
                            ->required(),
                        ])
                    ->required(),
                TextInput::make('precio')
                    ->default('0')
                    ->maxLength(255),
                TextInput::make('anticipo')
                    ->default('0')
                    ->maxLength(255),
                TextInput::make('adeudo')
                    ->default('0')
                    ->maxLength(255),
                /* ColorPicker::make('color') */
                    ])
                /* KeyValue::make('meta')
                  ->keyLabel('Property name') */
                ->columns(4)
                ->columnSpan(2),
                //Se muestra la suma de los productos
                Section::make('SUMA TOTAL DE PRODUCTOS')
                    ->description('Prevent abuse by limiting the number of requests per period')
                    ->schema([
                                // ...
                ])

                ]);
                
            
                
                    

            
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                    Tables\Columns\TextColumn::make('client.nombre')
                    ->searchable(),
                   /*  Tables\Columns\TextColumn::make('project.nombre')
                    ->searchable(), */
                    Tables\Columns\TextColumn::make('anticipo'),
                    Tables\Columns\TextColumn::make('adeudo'),
                    /* Tables\Columns\TextColumn::make('estatus'), */
                    
                    Tables\Columns\TextInputColumn::make('estatus')
                        ->rules(['required', 'max:255'])
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('type')
                    ->options([
                        'cat' => 'Cat',
                        'dog' => 'Dog',
                        'rabbit' => 'Rabbit',
                    ]),
            ])
            ->actions([
                /* Tables\Actions\EditAction::make(), */
               
                
                
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListOrders::route('/'),
            'create' => Pages\CreateOrder::route('/create'),
            'edit' => Pages\EditOrder::route('/{record}/edit'),
        ];
    }
}
