<?php

namespace App\Filament\Resources\Pengaduans\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class PengaduanForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('nomor_pengaduan')
                    ->label('Nomor Pengaduan')
                    ->placeholder('Dibuat otomatis saat disimpan')
                    ->disabled(),
                Select::make('user_id')
                    ->label('User')
                    ->relationship('user', 'name')
                    ->default(fn (): ?int => auth()->id())
                    ->disabled()
                    ->dehydrated()
                    ->required(),
                Textarea::make('isi_pengaduan')
                    ->label('Isi Pengaduan')
                    ->required(),
                FileUpload::make('foto')
                    ->label('Foto')
                    ->helperText('Opsional')
                    ->image()
                    ->nullable()
                    ->disk('public')
                    ->directory('pengaduans')
                    ->maxSize(5120),
                Select::make('status')
                    ->label('Status')
                    ->options([
                        'pending' => 'Pending',
                        'diproses' => 'Diproses',
                        'selesai' => 'Selesai',
                    ])
                    ->default('pending'),
            ]);
    }
}
