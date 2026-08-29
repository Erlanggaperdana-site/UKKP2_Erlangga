<?php

namespace Tests\Feature;

use App\Filament\Resources\PengaduanResource;
use App\Filament\Resources\Pengaduans\Pages\CreatePengaduan;
use App\Filament\Resources\Pengaduans\Pages\EditPengaduan;
use App\Filament\Resources\Pengaduans\Pages\ListPengaduan;
use App\Filament\Resources\Pengaduans\Schemas\PengaduanForm;
use Tests\TestCase;

class PengaduanResourcePageTest extends TestCase
{
    public function test_pengaduan_pages_are_bound_to_the_resource(): void
    {
        $this->assertSame(PengaduanResource::class, CreatePengaduan::getResource());
        $this->assertSame(PengaduanResource::class, EditPengaduan::getResource());
        $this->assertSame(PengaduanResource::class, ListPengaduan::getResource());
    }

    public function test_pengaduan_form_schema_can_be_built(): void
    {
        $schema = app(\Filament\Schemas\Schema::class);

        $this->assertInstanceOf(
            \Filament\Schemas\Schema::class,
            PengaduanForm::configure($schema)
        );
    }
}
