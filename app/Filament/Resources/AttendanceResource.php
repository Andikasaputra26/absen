<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Student;
use Filament\Forms\Form;
use App\Models\Attedances;
use App\Models\Attendance;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\AttendanceResource\Pages;
use App\Filament\Resources\AttendanceResource\RelationManagers;

class AttendanceResource extends Resource
{  protected static ?string $model = Attedances::class;

    protected static ?string $navigationLabel = 'Absensi Siswa';

    public static function form(Form $form): Form
    {
        return $form
        ->schema([
            Forms\Components\Select::make('student_id')
                ->label('Siswa')
                ->options(Student::all()->pluck('name', 'id'))
                ->required(),
            Forms\Components\Select::make('status')
                ->options([
                    'present' => 'Hadir',
                    'absent' => 'Absen',
                ])
                ->default('present')
                ->required(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
        ->columns([
            Tables\Columns\TextColumn::make('student.name'),
            Tables\Columns\TextColumn::make('status'),
            Tables\Columns\TextColumn::make('attended_at')->dateTime(),
        ])
      
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAttendances::route('/'),
            'create' => Pages\CreateAttendance::route('/create'),
            'edit' => Pages\EditAttendance::route('/{record}/edit'),
        ];
    }
}
