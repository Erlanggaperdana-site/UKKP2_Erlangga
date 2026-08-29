<?php

namespace App\Filament\Resources\Pengaduans\Pages;

use App\Filament\Resources\PengaduanResource;
use App\Filament\Resources\Pengaduans\Schemas\PengaduanForm;
use App\Models\Pengaduan;
use Filament\Resources\Pages\CreateRecord;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Auth;

class CreatePengaduan extends CreateRecord
{
    protected static string $resource = PengaduanResource::class;

    protected static string $model = Pengaduan::class;

    protected static ?string $title = 'Buat Pengaduan';

    protected function getFormSchema(): array
    {
        return [
            PengaduanForm::configure(
                schema: app(Schema::class)
            ),
        ];
    }

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $user = Auth::user();
        $data['user_id'] = $user->id;
        $data['nomor_pengaduan'] = $this->generateNomorPengaduan();
        $data['role_id'] = $user->role_id ?? $user->roles()->value('id');

        return $data;
    }

    private function generateNomorPengaduan(): string
    {
        for ($attempt = 0; $attempt < 100; $attempt++) {
            $letters = implode('', array_map(
                fn (): string => chr(random_int(65, 90)),
                range(1, 3),
            ));
            $nomorPengaduan = sprintf('PGD-%s%08d', $letters, random_int(0, 99_999_999));

            if (! Pengaduan::query()->where('nomor_pengaduan', $nomorPengaduan)->exists()) {
                return $nomorPengaduan;
            }
        }

        throw new \RuntimeException('Gagal membuat nomor pengaduan yang unik.');
    }
}
