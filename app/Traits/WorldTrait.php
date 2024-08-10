<?php

namespace App\Traits;

use Nnjeim\World\World;
use Nnjeim\World\WorldHelper;

trait WorldTrait
{


    public static function countries()
    {
        $action =  World::countries();

        if ($action->success) {

            return  $action->data;
        }
        else {
            // Handle the case where fetching cities failed
            return response()->json(['error' => 'Failed to fetch countries'], 500);
        }
    }

    public static function cities($state_id)
    {
        $world = new WorldHelper(); // Create a new instance of WorldHelper
        $action = $world->cities([
            'filters' => [
                'state_id' => $state_id, // Use the provided country ID
            ],
        ]);

        // Check if the action was successful
        if ($action->success) {
            return $action->data;
            // dd(  $cities);

        } else {
            // Handle the case where fetching cities failed
            // dd(  ['error' => 'Failed to fetch cities']);

            return response()->json(['error' => 'Failed to fetch cities'], 500);
        }

    }

    //state=>محافظات
    public static function states($countryId)
    {

        $world = new WorldHelper(); // Create a new instance of WorldHelper
        $action =  $world->states([
            'filters' => [
                'country_id' => $countryId,
            ],
        ]);

        if ($action->success) {

            return  $action->data;
        }
    }

    public static function currency($countryId)
    {
        $world = new WorldHelper(); // Create a new instance of WorldHelper
        $action = $world->currencies([
            'filters' => [
                'country_id' => $countryId, // Use the provided country ID
            ],
        ]);

        // Check if the action was successful
        if ($action->success) {
            return $action->data;
        } else {
            // Handle the case where fetching cities failed
            return response()->json(['error' => 'Failed to fetch cities'], 500);
        }
    }

    public static function languages($countryId)
    {
        $world = new WorldHelper(); // Create a new instance of WorldHelper
        $action = $world->languages([
            'filters' => [
                'country_id' => $countryId, // Use the provided country ID
            ],
        ]);

        // Check if the action was successful
        if ($action->success) {
            return $action->data;
        } else {
            // Handle the case where fetching cities failed
            return response()->json(['error' => 'Failed to fetch cities'], 500);
        }
    }

    public static function timezone($countryId)
    {
        $world = new WorldHelper(); // Create a new instance of WorldHelper
        $action = $world->timezones([
            'filters' => [
                'country_id' => $countryId, // Use the provided country ID
            ],
        ]);

        // Check if the action was succe+ssful
        if ($action->success) {
            return $action->data;
        } else {
            // Handle the case where fetching cities failed
            return response()->json(['error' => 'Failed to fetch cities'], 500);
        }
    }

    public static function countriesInfo($countryId)
    {

        $action =  World::countries([
            'fields' => 'currencies,languages,states,cities,timezones',
            'filters' => [
                'id' => $countryId,
            ]
        ]);

        if ($action->success) {

           return $action->data;
        }
        else {
            // Handle the case where fetching cities failed
            return response()->json(['error' => 'Failed to fetch countries'], 500);
        }
    }

    public static function getStatesByCountryId($countryId)
    {
        $world = new WorldHelper(); // Create a new instance of WorldHelper
        $action = $world->states([
            'filters' => [
                'country_id' => $countryId, // Use the provided country ID
            ],
        ]);

        // Check if the action was succe+ssful
        if ($action->success) {
            return $action->data;
        } else {
            // Handle the case where fetching cities failed
            return response()->json(['error' => 'Failed to fetch cities'], 500);
        }
    }

    public static function getCitiesByCountryId($countryId)
    {
        $world = new WorldHelper(); // Create a new instance of WorldHelper
        $action = $world->states([
            'filters' => [
                'country_id' => $countryId, // Use the provided country ID
            ],
        ]);

        // Check if the action was succe+ssful
        if ($action->success) {
            return $action->data;
        } else {
            // Handle the case where fetching cities failed
            return response()->json(['error' => 'Failed to fetch cities'], 500);
        }
    }
}
