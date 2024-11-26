<?php

namespace App\Filament\Admin\Resources\TeamResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Infolists;
use Filament\Infolists\Infolist;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;

class MembersRelationManager extends RelationManager
{
    protected static string $relationship = 'members';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->maxLength(255),
                Forms\Components\TextInput::make('email')
                    ->email()
                    ->required()
                    ->maxLength(255),
                Forms\Components\DateTimePicker::make('email_verified_at'),
                Forms\Components\TextInput::make('stripe_customer_id')
                    ->maxLength(255),
                Forms\Components\TextInput::make('subscription_status')
                    ->required()
                    ->maxLength(255)
                    ->default('inactive'),
                Forms\Components\TextInput::make('subscription_level')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('current_projects_count')
                    ->numeric()
                    ->required(),
            ]);
    }

    public function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Infolists\Components\TextEntry::make('name'),
                Infolists\Components\TextEntry::make('email'),
                Infolists\Components\TextEntry::make('email_verified_at')
                    ->dateTime(),
                Infolists\Components\TextEntry::make('stripe_customer_id'),
                Infolists\Components\TextEntry::make('subscription_status'),
                Infolists\Components\TextEntry::make('subscription_level'),
                Infolists\Components\TextEntry::make('current_projects_count')
                    ->numeric(),
                Infolists\Components\TextEntry::make('created_at')
                    ->dateTime(),
                Infolists\Components\TextEntry::make('updated_at')
                    ->dateTime(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->searchable(),
                Tables\Columns\TextColumn::make('email_verified_at')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('stripe_customer_id')
                    ->searchable(),
                Tables\Columns\TextColumn::make('subscription_status')
                    ->searchable(),
                Tables\Columns\TextColumn::make('subscription_level')
                    ->searchable(),
                Tables\Columns\TextColumn::make('current_projects_count')
                    ->numeric()
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
            ->headerActions([
                Tables\Actions\CreateAction::make(),
                Tables\Actions\AttachAction::make(),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DetachAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DetachBulkAction::make(),
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->recordTitleAttribute('name');
    }
}
