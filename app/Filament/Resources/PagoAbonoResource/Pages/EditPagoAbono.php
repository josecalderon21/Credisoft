<?php

namespace App\Filament\Resources\PagoAbonoResource\Pages;

use App\Filament\Resources\PagoAbonoResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPagoAbono extends EditRecord
{
    protected static string $resource = PagoAbonoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
