<?php

namespace App\Filament\Resources\PagoAbonoResource\Pages;

use App\Filament\Resources\PagoAbonoResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPagoAbonos extends ListRecords
{
    protected static string $resource = PagoAbonoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
