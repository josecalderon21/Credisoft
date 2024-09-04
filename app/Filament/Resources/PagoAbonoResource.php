<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PagoAbonoResource\Pages;
use App\Models\PagoAbono;
use App\Models\Prestamos;  // Se asegura que es en plural
use App\Models\Cliente;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;


class PagoAbonoResource extends Resource
{
    protected static ?string $model = PagoAbono::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
{
    return $form
        ->schema([
            Select::make('cliente_id')
                    ->label('Cliente')
                    ->options(
                        Cliente::all()->mapWithKeys(function ($cliente) {
                            return [$cliente->id => $cliente->full_name];
                        })
                    )
                    ->searchable()
                    ->required(),

            Select::make('prestamo_id')
                ->label('Préstamo')
                ->relationship('prestamos', 'monto') // Relación con el modelo Prestamo
                ->required(),

            DatePicker::make('fecha_pago_abono')
                ->label('Fecha de Pago/Abono')
                ->required(),

            TextInput::make('monto')
                ->label('Monto')
                ->numeric()
                ->required(),

            TextInput::make('saldo_restante')
                ->label('Saldo Restante')
                ->numeric()
                ->required(),

            Select::make('estado')
                ->label('Estado')
                ->options([
                    'pendiente' => 'Pendiente',
                    'completado' => 'Completado',
                ])
                ->required(),

            Textarea::make('notas')
                ->label('Notas')
                ->nullable(),
        ]);
}


public static function table(Table $table): Table
{
    return $table
        ->columns([
            TextColumn::make('cliente.nombre')
                ->label('Cliente')
                ->sortable()
                ->searchable(),
                

            TextColumn::make('prestamo.monto')
                ->label('Monto del Préstamo')
                ->sortable(),

            TextColumn::make('fecha_pago_abono')
                ->label('Fecha de Pago/Abono')
                ->date()
                ->sortable(),

            TextColumn::make('monto')
                ->label('Monto Pagado')
                ->sortable(),

            TextColumn::make('saldo_restante')
                ->label('Saldo Restante')
                ->sortable(),

            TextColumn::make('estado')
                ->label('Estado')
                ->sortable(),
        ])
        ->filters([
            //
        ])
        ->actions([
            Tables\Actions\EditAction::make(),
        ])
        ->bulkActions([
            Tables\Actions\DeleteBulkAction::make(),
        ]);
}
public function cliente()
{
    return $this->belongsTo(Cliente::class);
}

public function prestamos()
{
    return $this->belongsTo(Prestamos::class);
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
            'index' => Pages\ListPagoAbonos::route('/'),
            'create' => Pages\CreatePagoAbono::route('/create'),
            'edit' => Pages\EditPagoAbono::route('/{record}/edit'),
        ];
    }
}
