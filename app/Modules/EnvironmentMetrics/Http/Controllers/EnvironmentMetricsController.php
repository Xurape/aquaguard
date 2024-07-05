<?php

namespace App\Modules\EnvironmentMetrics\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EnvironmentMetricsController extends Controller
{
    public $lat;
    public $long;
    private $data;

    public function __construct() {
        $this->lat = env('APP_LATITUDE');
        $this->long = env('APP_LONGITUDE');
    }

    protected function getData() {
        $lat = $this->lat;
        $long = $this->long;

        $url = "https://api.open-meteo.com/v1/forecast?latitude=$lat&longitude=$long&current=temperature_2m,is_day,precipitation,wind_speed_10m,wind_gusts_10m&hourly=temperature_2m,relative_humidity_2m,precipitation_probability,wind_speed_10m,wind_gusts_10m&forecast_days=1&daily=sunrise,sunset&timezone=Europe%2FLondon";

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($ch);
        curl_close($ch);

        return json_decode($output);
    }

    public function temperature()
    {
        $this->data = $this->getData();

        return response()->json([
            'temperature' => $this->data->current->temperature_2m,
            'is_day' => $this->data->current->is_day,
            'precipitation' => $this->data->current->precipitation,
        ]);
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

    public function all() {
        if($this->data == null) {
            $this->data = $this->getData();
        }

        $sunrise = substr($this->data->daily->sunrise[0], 11, 5);
        $sunset = substr($this->data->daily->sunset[0], 11, 5);

        return response()->json([
            'temperature' => $this->data->current->temperature_2m,
            'wind_speed' => $this->data->current->wind_speed_10m,
            'precipitation' => $this->data->current->precipitation,
            'sunrise' => $sunrise,
            'sunset' => $sunset,
        ]);
    }
}