<?php

namespace App\Http\Controllers;

use App\Models\People;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class APIController extends Controller
{
    function savePeopleFromApiToDB() {
        // https://swapi.dev/api/people/?page=1&format=json
        // Recuperem de 10 en 10 els personatges i els guardem a la base de dades
        $url = "https://swapi.dev/api/people/?page=1&format=json";

        while ($url != null) {


            // Recuperar personatges
            $people = HTTP::get($url . "&format=json");
            $peopleArray = $people->json();

            // Guardar personatges
            foreach($peopleArray['results'] as $elem) {
                // Guardar a la base de dades
                People::create([
                    'nom' => $elem['name'],
                    'alcada' => $elem['height'],
                    'pes' => $elem['mass'],
                    'colorCabell' => $elem['hair_color'],
                    'colorPell' => $elem['skin_color'],
                    'colorUlls' => $elem['eye_color'],
                    'anyNaixement' => $elem['birth_year'],
                    'genere' => $elem['gender']
                ]);
            }

            $url = $peopleArray['next'];
        }

        if (People::count() > 0) {
            echo "Personatges desats correctament";
            echo "<p><a href='http://localhost:8000'>Tornar</a>";
        } else {
            echo "No s'han afegit els personatges";
            echo "<p><a href='http://localhost:8000'>Tornar</a>";
        }

    }

    function getPeopleFromDB() {
        $people = People::paginate(10);
        return view("people", compact("people"));
    }
}