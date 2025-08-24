<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MediationCaseResource\Pages;
use App\Filament\Resources\MediationCaseResource\RelationManagers;
use App\Models\MediationCase;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class MediationCaseResource extends Resource
{
    protected static ?string $model = MediationCase::class;

    protected static ?string $navigationIcon = 'heroicon-o-scale';
    
    protected static ?string $navigationGroup = 'Mediation';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('case_number')
                    ->required(),
                Forms\Components\TextInput::make('title')
                    ->required(),
                Forms\Components\Textarea::make('description')
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('status')
                    ->required(),
                Forms\Components\TextInput::make('type')
                    ->required(),
                Forms\Components\TextInput::make('priority')
                    ->required(),
                Forms\Components\Select::make('mediator_id')
                    ->relationship('mediator', 'name'),
                Forms\Components\Textarea::make('participants')
                    ->columnSpanFull(),
                Forms\Components\Textarea::make('documents')
                    ->columnSpanFull(),
                Forms\Components\Textarea::make('notes')
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('estimated_value')
                    ->numeric(),
                Forms\Components\DatePicker::make('deadline'),
                Forms\Components\DateTimePicker::make('started_at'),
                Forms\Components\DateTimePicker::make('completed_at'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('case_number')
                    ->searchable(),
                Tables\Columns\TextColumn::make('title')
                    ->searchable(),
                Tables\Columns\TextColumn::make('status')
                    ->searchable(),
                Tables\Columns\TextColumn::make('type')
                    ->searchable(),
                Tables\Columns\TextColumn::make('priority')
                    ->searchable(),
                Tables\Columns\TextColumn::make('mediator.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('estimated_value')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('deadline')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('started_at')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('completed_at')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
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
            'index' => Pages\ListMediationCases::route('/'),
            'create' => Pages\CreateMediationCase::route('/create'),
            'edit' => Pages\EditMediationCase::route('/{record}/edit'),
        ];
    }
}
