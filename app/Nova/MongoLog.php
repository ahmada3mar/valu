<?php

namespace App\Nova;

use Hyperpay\ConnectIn\Models\MongoLog as ModelsMongoLog;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Code;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;

class MongoLog extends Resource
{

    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = ModelsMongoLog::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'id';


    public static $group = 'Logs';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id', 'authentication_entityId', 'ACI.0.response.invoice_id'
    ];

    /**
     * Build an "index" query for the given resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public static function indexQuery(NovaRequest $request, $query)
    {
        if (empty($request->get('orderBy'))) {
            $query->getQuery()->orders = [];
            return $query->orderBy('created_at', 'desc');
        }
        return $query;
    }


    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */

    public function fields(Request $request)
    {
        return [

            ID::make('id', "id"),
            Text::make('Amount', "ACI.0.request.data.amount"),
            Text::make('Customer Email', "ACI.0.request.data.customer_email"),
            Code::make('ACI Log', 'ACI')->json(),
            Code::make('Mongo Log', 'Mongo')->json(),
            BelongsTo::make('Transaction', 'transaction', Transaction::class),
            BelongsTo::make('Merchant', 'merchant', Merchant::class),
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

    public static function uriKey()
    {
        return 'logs';
    }
}
