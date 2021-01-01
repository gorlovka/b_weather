<?php

/*
 *   Created on: Dec 31, 2020   11:06:19 AM
 */

namespace App\Http\Controllers;

use App\Models\History;
use function collect;
use function dump;

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

        $historyModel = History::query()
              ->where('date_at', '=', $date)
              ->first();

        $temperature = $historyModel ? $historyModel->getTemp() : false;

        return $temperature;
    }

}
