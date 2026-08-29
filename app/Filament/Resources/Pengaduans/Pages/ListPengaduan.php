<?php

namespace App\Filament\Resources\Pengaduans\Pages;

use App\Filament\Resources\PengaduanResource;
use Filament\Resources\Pages\ListRecords;

class ListPengaduan extends ListRecords
{
    protected static string $resource = PengaduanResource::class;

    protected static string $model = \App\Models\Pengaduan::class;

    protected static ?string $title = 'Daftar Pengaduan';

    protected function getHeaderActions(): array
    {
        return [
            \Filament\Actions\CreateAction::make()
                ->label('Buat Pengaduan'),
        ];
    }
}