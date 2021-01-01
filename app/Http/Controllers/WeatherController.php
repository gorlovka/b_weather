<?php

/*
 *   Created on: Dec 31, 2020   11:06:19 AM
 */

namespace App\Http\Controllers;

use App\Models\History;
use Illuminate\Support\Facades\Validator;
use function collect;

class WeatherController extends Controller
{

    /**
     * Для поддержания обращения . , производится замена . на _ , т.к.
     * в именах функций нет поддержки .
     * Возможно, если делать в проекте, то стоит добавить авторазбиение,
     * чтобы, к примеру первая часть до точки "weather"  уходила на поиск
     * контроллера, а вторая после неё getByDate, на поиск метода
     * в этом контроллере
     * 
     * Или ещё лучше, поискать готовые библиотеки для такой штуки,
     * должны быть наверняка
     */
    public function weather_getByDate(array $params)
    {
        $date = collect($params)->get('date', '');


        $validator = Validator::make([
                 'date' => $date,
                    ],
                    [
                       'date' => 'required|date'
                    ],
                    [
                       'required' => 'Date should be specified',
                       'date' => 'Wrong date format',
        ]);


        if ($validator->fails()) {
            
            $messageErrorFirst = $validator->getMessageBag()
                  ->first();

            throw new \Exception($messageErrorFirst);
        }



        $historyModel = History::query()
              ->where('date_at', '=', $date)
              ->first();



        $temperature = $historyModel ? $historyModel->getTemp() : false;

        return [
           'temperature' => $temperature
        ];
    }

    public function weather_getHistory(array $params)
    {
        $lastDays = collect($params)->get('lastDays', '');


        $historyModels = History::query()
              ->limit($lastDays)
              ->orderByDesc('date_at')
              ->get();

        /**
         * в проекте, нужно использовать ресурсы для извлечения данных
         * из моделей, а не передевать полностью модель как тут
         */
        return [
          'lastDays' => $historyModels
        ];
    }

}
