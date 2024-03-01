<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CustomerResource\Pages;
use App\Filament\Resources\CustomerResource\RelationManagers;
use App\Models\Customer;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Pelmered\FilamentMoneyField\Forms\Components\MoneyInput;
use Pelmered\FilamentMoneyField\Tables\Columns\MoneyColumn;

class CustomerResource extends Resource
{
    protected static ?string $model = Customer::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->columnSpanFull(),
                MoneyInput::make('salary_usd')
                    ->currency('USD')
                    ->locale('en_US'),
                MoneyInput::make('salary_idr')
                    ->currency('IDR')
                    ->locale('id_ID'),
                MoneyInput::make('salary_sar')
                    ->currency('SAR')
                    ->locale('ar_SA'),
                MoneyInput::make('salary_aed')
                    ->currency('AED')
                    ->locale('ar_AE'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                MoneyColumn::make('salary_usd')
                    ->currency('USD')
                    ->locale('en_US')
                    ->sortable(),
                MoneyColumn::make('salary_idr')
                    ->currency('IDR')
                    ->locale('id_ID')
                    ->sortable(),
                MoneyColumn::make('salary_sar')
                    ->currency('SAR')
                    ->locale('ar_SA')
                    ->sortable(),
                MoneyColumn::make('salary_aed')
                    ->currency('AED')
                    ->locale('ar_AE')
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
                Tables\Actions\ViewAction::make(),
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
            'index' => Pages\ListCustomers::route('/'),
            'create' => Pages\CreateCustomer::route('/create'),
            'edit' => Pages\EditCustomer::route('/{record}/edit'),
        ];
    }
}
