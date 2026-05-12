<?php

namespace App\Filament\Resources\QrCodes\Tables;

use App\Models\QrCode;
use Endroid\QrCode\Builder\Builder;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\ErrorCorrectionLevel;
use Endroid\QrCode\Writer\SvgWriter;
use Endroid\QrCode\Writer\PngWriter;
use FPDF;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\Action;
use Filament\Tables;
use Filament\Tables\Table;

class QrCodesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->label('Nombre')->searchable(),
                Tables\Columns\TextColumn::make('url')->label('URL')->searchable(),
                Tables\Columns\IconColumn::make('is_active')->label('Activo')->boolean(),
                Tables\Columns\TextColumn::make('created_at')->label('Creado')->date('d/m/Y'),
            ])
            ->filters([
                Tables\Filters\Filter::make('active')
                    ->label('Solo activos')
                    ->query(fn ($query) => $query->where('is_active', true)),
            ])
            ->recordActions([
                EditAction::make(),
                Action::make('downloadSvg')
                    ->label('SVG')
                    ->icon('heroicon-o-arrow-down-tray')
                    ->color('gray')
                    ->action(function (QrCode $record) {
                        $result = (new Builder(
                            writer: new SvgWriter(),
                            writerOptions: [],
                            validateResult: false,
                            data: $record->url,
                            encoding: new Encoding('UTF-8'),
                            errorCorrectionLevel: ErrorCorrectionLevel::High,
                            size: 300,
                            margin: 10,
                        ))->build();

                        return response()->streamDownload(
                            fn () => print($result->getString()),
                            "qr-{$record->name}.svg",
                            ['Content-Type' => 'image/svg+xml']
                        );
                    }),
                Action::make('downloadPng')
                    ->label('PNG')
                    ->icon('heroicon-o-photo')
                    ->color('gray')
                    ->action(function (QrCode $record) {
                        $result = (new Builder(
                            writer: new PngWriter(),
                            writerOptions: [],
                            validateResult: false,
                            data: $record->url,
                            encoding: new Encoding('UTF-8'),
                            errorCorrectionLevel: ErrorCorrectionLevel::High,
                            size: 300,
                            margin: 10,
                        ))->build();

                        return response()->streamDownload(
                            fn () => print($result->getString()),
                            "qr-{$record->name}.png",
                            ['Content-Type' => 'image/png']
                        );
                    }),
                Action::make('downloadPdf')
                    ->label('PDF')
                    ->icon('heroicon-o-document')
                    ->color('gray')
                    ->action(function (QrCode $record) {
                        $qrResult = (new Builder(
                            writer: new PngWriter(),
                            writerOptions: [],
                            validateResult: false,
                            data: $record->url,
                            encoding: new Encoding('UTF-8'),
                            errorCorrectionLevel: ErrorCorrectionLevel::High,
                            size: 400,
                            margin: 0,
                        ))->build();

                        $pngData = $qrResult->getString();

                        $pdf = new FPDF('P', 'mm', 'A4');
                        $pdf->AddPage();
                        $pdf->SetFillColor(255, 255, 255);
                        $pdf->Rect(0, 0, 210, 297, 'F');

                        $qrSize = 80;
                        $x = (210 - $qrSize) / 2;
                        $y = (297 - $qrSize) / 2;

                        $tempFile = tempnam(sys_get_temp_dir(), 'qr_') . '.png';
                        file_put_contents($tempFile, $pngData);
                        $pdf->Image($tempFile, $x, $y, $qrSize, $qrSize);
                        unlink($tempFile);

                        return response()->streamDownload(
                            fn () => print($pdf->Output('S')),
                            "qr-{$record->name}.pdf",
                            ['Content-Type' => 'application/pdf']
                        );
                    }),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}