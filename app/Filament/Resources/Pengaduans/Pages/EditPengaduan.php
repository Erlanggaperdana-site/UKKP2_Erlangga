<?php

namespace App\Filament\Resources\Pengaduans\Pages;

use App\Filament\Resources\PengaduanResource;
use Filament\Resources\Pages\EditRecord;

class EditPengaduan extends EditRecord
{
    protected static string $resource = PengaduanResource::class;

    protected static string $model = \App\Models\Pengaduan::class;

    protected static ?string $title = 'Edit Pengaduan';

    protected function getFormSchema(): array
    {
        return [
            \App\Filament\Resources\Pengaduans\Schemas\PengaduanForm::configure(
                schema: app(\Filament\Schemas\Schema::class)
            ),
        ];
    }
}