<?php

namespace App\Filament\Resources\MediationCaseResource\Pages;

use App\Filament\Resources\MediationCaseResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListMediationCases extends ListRecords
{
    protected static string $resource = MediationCaseResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
