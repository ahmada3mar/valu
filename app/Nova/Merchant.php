<?php

namespace App\Nova;

use Hyperpay\ConnectIn\Models\Merchant as ModelsMerchant;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Text;
use Silvanite\NovaFieldCheckboxes\Checkboxes;



class Merchant extends Resource
{

    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = ModelsMerchant::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'name';
    public static $group = 'Accounts';


    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id', 'name', 'email', 'authentication_entityId', 'authentication_userId'
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function fields(Request $request)
    {
        return [
            ID::make()->sortable(),

            Text::make('Name')
                ->sortable()
                ->rules('required', 'max:255'),

            Text::make('Email')
                ->sortable()
                ->rules('required', 'email', 'max:254')
                ->creationRules('unique:merchants,email')
                ->updateRules('unique:merchants,email,{{resourceId}}'),

            Text::make('User Id' , 'authentication_userId')
                ->sortable()
                ->rules('required',  'max:254')
                ->hideFromIndex()
                ->creationRules('unique:merchants,authentication_userId')
                ->updateRules('unique:merchants,authentication_userId,{{resourceId}}'),

            Text::make('Entity Id', 'authentication_entityId')
                ->sortable()
                ->rules('required',  'max:254')
                ->creationRules('unique:merchants,authentication_entityId')
                ->updateRules('unique:merchants,authentication_entityId,{{resourceId}}'),

            Text::make('Access Token' , 'access_token' )
                ->rules('required')
                ->hideFromIndex()
                ->creationRules('unique:merchants,access_token')
                ->updateRules('unique:merchants,access_token,{{resourceId}}'),

            Text::make('Password' , 'authentication_password')
                ->sortable()
                ->rules('required',  'max:254')
                ->hideFromIndex(),

            Text::make('Aci Secret')
                ->sortable()
                ->rules('required',  'max:254')
                ->hideFromIndex(),


            BelongsTo::make('Created By' , 'user' , User::class)
            ->onlyOnIndex(),

            HasMany::make('Transactions', 'transactions', Transaction::class),
            // HasMany::make('Kiosk Log', 'KioskLog', KioskLog::class)
        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function cards(Request $request)
    {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function filters(Request $request)
    {
        return [];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function lenses(Request $request)
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function actions(Request $request)
    {
        return [];
    }
}
