<?php

namespace App\Filament\Resources;

use App\Models\Pengaduan;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;

class PengaduanResource extends Resource
{
    protected static ?string $model = Pengaduan::class;

    protected static ?string $navigationLabel = 'Pengaduan';

    public static function shouldRegisterNavigation(): bool
    {
        return false;
    }

    public static function form(Schema $schema): Schema
    {
        return \App\Filament\Resources\Pengaduans\Schemas\PengaduanForm::configure(
            schema: $schema
        );
    }

    public static function getPages(): array
    {
        return [
            'index' => \App\Filament\Resources\Pengaduans\Pages\ListPengaduan::route('/'),
            'create' => \App\Filament\Resources\Pengaduans\Pages\CreatePengaduan::route('/create'),
            'edit' => \App\Filament\Resources\Pengaduans\Pages\EditPengaduan::route('/{record}/edit'),
        ];
    }
}