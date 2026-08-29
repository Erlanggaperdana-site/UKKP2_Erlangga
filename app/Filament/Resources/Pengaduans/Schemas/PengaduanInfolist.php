<?php

namespace App\Filament\Resources\Pengaduans\Schemas;

use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class PengaduanInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('nomor_pengaduan')
                    ->label('Nomor Pengaduan')
                    ->copyable(),
                TextEntry::make('user.name')
                    ->label('Pelapor')
                    ->placeholder('-'),
                TextEntry::make('role.name')
                    ->label('Role')
                    ->placeholder('-'),
                TextEntry::make('status')
                    ->label('Status')
                    ->formatStateUsing(fn (?string $state): string => match ($state) {
                        'pending' => 'Pending',
                        'diproses' => 'Diproses',
                        'selesai' => 'Selesai',
                        default => '-',
                    })
                    ->badge()
                    ->color(fn (?string $state): string => match ($state) {
                        'pending' => 'warning',
                        'diproses' => 'info',
                        'selesai' => 'success',
                        default => 'gray',
                    }),
                TextEntry::make('isi_pengaduan')
                    ->label('Isi Pengaduan')
                    ->placeholder('-')
                    ->columnSpanFull(),
                ImageEntry::make('foto')
                    ->label('Foto')
                    ->disk('public')
                    ->imageHeight('12rem')
                    ->placeholder('Tidak ada foto')
                    ->columnSpanFull(),
                TextEntry::make('created_at')
                    ->label('Dibuat')
                    ->dateTime('d M Y H:i')
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->label('Diperbarui')
                    ->dateTime('d M Y H:i')
                    ->placeholder('-'),
            ]);
    }
}
