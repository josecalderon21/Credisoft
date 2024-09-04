<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ClienteResource\Pages;
use App\Models\Cliente;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Tables;

class ClienteResource extends Resource
{
    protected static ?string $model = Cliente::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nombre')
                    ->required(),
                Forms\Components\TextInput::make('apellido')
                    ->required(),
                Forms\Components\Select::make('tipo_documento')
                    ->options([
                        'DNI' => 'DNI',
                        'CC' => 'CC',
                        'Pasaporte' => 'Pasaporte',
                        'Licencia de Conducir' => 'Licencia de Conducir',
                    ])
                    ->required(),
                Forms\Components\TextInput::make('documento_identidad')
                    ->required(),
                Forms\Components\TextInput::make('telefono')
                    ->required(),
                Forms\Components\TextInput::make('direccion')
                    ->required(),
                Forms\Components\TextInput::make('email')
                    ->email()
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nombre'),
                Tables\Columns\TextColumn::make('apellido'),
                Tables\Columns\TextColumn::make('tipo_documento'),
                Tables\Columns\TextColumn::make('documento_identidad'),
                Tables\Columns\TextColumn::make('telefono'),
                Tables\Columns\TextColumn::make('direccion'),
                Tables\Columns\TextColumn::make('email'),
            ])
            ->filters([
                //
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
            'index' => Pages\ListClientes::route('/'),
            'create' => Pages\CreateCliente::route('/create'),
            'edit' => Pages\EditCliente::route('/{record}/edit'),
        ];
    }
}