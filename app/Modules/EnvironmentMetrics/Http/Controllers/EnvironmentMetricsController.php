<?php

namespace App\Modules\EnvironmentMetrics\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EnvironmentMetricsController extends Controller
{
    protected function getData($lat, $long) {
        $url = "https://api.open-meteo.com/v1/forecast?latitude=$lat&longitude=$long&current=temperature_2m,is_day,precipitation,wind_speed_10m,wind_gusts_10m&hourly=temperature_2m,relative_humidity_2m,precipitation_probability,wind_speed_10m,wind_gusts_10m&forecast_days=1";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($ch);
        curl_close($ch);
        return json_decode($output);
    }

    public function temperature()
    {
        $lat = env('APP_LATITUDE');
        $long = env('APP_LONGITUDE');

        $data = $this->getData($lat, $long);

        return response()->json([
            'temperature' => $data->current->temperature_2m,
            'is_day' => $data->current->is_day,
            'precipitation' => $data->current->precipitation,
        ]);
    }

    public function humidity()
    {
        //
    }

    public function date()
    {
        $date = new \DateTime();
        $days = ['Domingo', 'Segunda-feira', 'Terça-feira', 'Quarta-feira', 'Quinta-feira', 'Sexta-feira', 'Sábado'];
        $months = ['janeiro', 'fevereiro', 'março', 'abril', 'maio', 'junho', 'julho', 'agosto', 'setembro', 'outubro', 'novembro', 'dezembro'];
    
        $dayOfWeek = $days[$date->format('w')];
        $day = $date->format('j');
        $month = $months[$date->format('n') - 1];
    
        return response()->json([
            'date' => "$dayOfWeek, $day de $month"
        ]);
    }
}