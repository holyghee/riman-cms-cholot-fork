<?php

namespace App\Filament\Resources\MediationCaseResource\Pages;

use App\Filament\Resources\MediationCaseResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditMediationCase extends EditRecord
{
    protected static string $resource = MediationCaseResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
