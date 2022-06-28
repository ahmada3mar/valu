<?php

namespace App\Nova;

use Carbon\Carbon;
use Hyperpay\ConnectIn\Models\Transaction as ModelsTransaction;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Badge;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\Code;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Panel;

class Transaction extends Resource
{

    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = ModelsTransaction::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'UUID';



    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'authentication_entityId', 'merchantTransactionId', 'UUID'
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

            ID::make(),
            Text::make('UUID' , "UUID"),

            Text::make('Amount', "amount"),
            Text::make("Merchant Transaction Id", "merchantTransactionId"),
            Text::make("Notification Url", "notificationUrl")->hideFromIndex(),
            Text::make("Shopper Result Url", "shopperResultUrl")->hideFromIndex(),
            Badge::make('Status')->map([
                'Pending' => 'info',
                'Paid' => 'success',
                'Inactive' => 'info',
                'Failed' => 'warning',
                'Cancelled' => 'danger',
            ]),

            BelongsTo::make('Merchant', 'merchant', Merchant::class),
            (new Panel('Mongo Log', $this->MongoLogFields())),

            Date::make("Created At", "created_at"),
        ];
    }


    protected function MongoLogFields()
    {
        return [
            BelongsTo::make('Mongo Log ID', 'mongoLog', MongoLog::class),
            Code::make('ACI Log', 'mongoLog.ACI')->json()->onlyOnDetail(),
            Code::make('Kiosk Log', 'mongoLog.Valu')->json()->onlyOnDetail(),
            Code::make('Merchant Log', 'mongoLog.MerchantLog')->json()->onlyOnDetail(),
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
