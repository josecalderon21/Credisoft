<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PrestamosResource\Pages;
use App\Models\Prestamos;
use App\Models\Cliente;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;

class PrestamosResource extends Resource
{
    protected static ?string $model = Prestamos::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('cliente_id')
                    ->label('Cliente')
                    ->options(
                        Cliente::all()->mapWithKeys(function ($cliente) {
                            return [$cliente->id => $cliente->full_name];
                        })
                    )
                    ->searchable()
                    ->required(),

                Forms\Components\TextInput::make('monto')
                    ->label('Monto')
                    ->numeric()
                    ->minValue(0)
                    ->formatStateUsing(fn ($state) => number_format($state, 0, ',', '.'))
                    ->required(),

                Forms\Components\TextInput::make('tasa_interes')
                    ->label('Tasa de Interés')
                    ->numeric()
                    ->minValue(0)
                    ->required(),

                Forms\Components\DatePicker::make('fecha_prestamo')
                    ->required(),

                Forms\Components\Select::make('cuotas')
                    ->options([
                        'diaria' => 'Diaria',
                        'semanal' => 'Semanal',
                        'quincenal' => 'Quincenal',
                        'mensual' => 'Mensual',
                        'semestral' => 'Semestral',
                        'anual' => 'Anual',
                    ])
                    ->default('mensual')
                    ->required(),

                Forms\Components\Select::make('estado')
                    ->options([
                        'pendiente' => 'Pendiente',
                        'pagado' => 'Pagado',
                    ])
                    ->default('pendiente')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('cliente.nombre')
                    ->label('Nombre')
                    ->sortable(),

                Tables\Columns\TextColumn::make('cliente.apellido')
                    ->label('Apellido')
                    ->sortable(),

                Tables\Columns\TextColumn::make('monto')
                    ->label('Monto')
                    ->formatStateUsing(fn ($state) => number_format($state, 0, ',', '.')),

                Tables\Columns\TextColumn::make('tasa_interes')
                    ->label('Tasa de Interés'),

                Tables\Columns\TextColumn::make('fecha_prestamo')
                    ->label('Fecha de Préstamo')
                    ->date(),

                Tables\Columns\TextColumn::make('cuotas')
                    ->label('Cuotas'),

                Tables\Columns\TextColumn::make('estado')
                    ->label('Estado'),
            ])
            ->filters([
                Tables\Filters\Filter::make('search')
                    ->form([
                        Forms\Components\TextInput::make('search')
                            ->placeholder('Buscar por nombre o apellido')
                            ->label('Buscar'),
                    ])
                    ->query(function (Builder $query, array $data) {
                        if (!empty($data['search'])) {
                            $query->whereHas('cliente', function (Builder $query) use ($data) {
                                $query->where('nombre', 'like', '%' . $data['search'] . '%')
                                      ->orWhere('apellido', 'like', '%' . $data['search'] . '%');
                            });
                        }
                    }),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPrestamos::route('/'),
            'create' => Pages\CreatePrestamos::route('/create'),
            'edit' => Pages\EditPrestamos::route('/{record}/edit'),
        ];
    }
}
