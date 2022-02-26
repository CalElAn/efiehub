<?php

namespace App\Http\Helpers;

class PropertyTypesToFeaturesMap
{
    static $propertyTypesArray = [
        ['type' => 'Chamber and hall'],
        ['type' => 'Apartment'],
        // ['type' => 'Studio apartment'],
        // ['type' => 'Service apartment'],
        ['type' => 'House'],
        ['type' => 'Single room'],
        // ['type' => 'Bed'],
    ];

    static $propertyFeaturesArray = [
        ['feature' => 'Number of bedrooms', 'input_type' => 'number'],
        ['feature' => 'Number of bathrooms', 'input_type' => 'number'],
        ['feature' => 'Self contained', 'input_type' => 'checkbox'],
        ['feature' => 'Porch / Balcony', 'input_type' => 'checkbox'],
        ['feature' => 'Kitchen', 'input_type' => 'checkbox'],
        ['feature' => 'Dining room', 'input_type' => 'checkbox'],
        ['feature' => 'Living room', 'input_type' => 'checkbox'],
        ['feature' => 'Furnished', 'input_type' => 'radio'],
        ['feature' => 'Semi-furnished', 'input_type' => 'radio'],
        ['feature' => 'Unfurnished', 'input_type' => 'radio'],
        ['feature' => 'Walled', 'input_type' => 'checkbox'],
    ];

    static $propertyTypesToFeaturesArray = [
        'Chamber and hall' => [
            'Self contained',
            'Porch / Balcony',
            'Kitchen',
            'Furnished',
            'Semi-furnished',
            'Unfurnished',
            'Walled',
        ],
        'Apartment' => [
            'Number of bathrooms',
            'Number of bedrooms',
            'Self contained',
            'Porch / Balcony',
            'Kitchen',
            'Dining room',
            'Living room',
            'Furnished',
            'Semi-furnished',
            'Unfurnished',
            'Walled',
        ],
        // 'Studio apartment' => [
        //     'Porch / Balcony',
        //     'Kitchen',
        //     'Dining room',
        //     'Living room',
        //     'Furnished',
        //     'Semi-furnished',
        //     'Unfurnished',
        //     'Walled',
        // ],
        // 'Service apartment' => [
        //     'Number of bedrooms',
        //     'Number of bathrooms',
        //     'Porch / Balcony',
        //     'Kitchen',
        //     'Dining room',
        //     'Living room',
        //     'Walled',
        // ],
        'House' => [
            'Number of bedrooms',
            'Number of bathrooms',
            'Self contained',
            'Porch / Balcony',
            'Kitchen',
            'Dining room',
            'Living room',
            'Furnished',
            'Semi-furnished',
            'Unfurnished',
            'Walled',
        ],
        'Single room' => [
            'Self contained',
            'Porch / Balcony',
            'Furnished',
            'Semi-furnished',
            'Unfurnished',
            'Walled',
        ],
        // 'Bed' => [
        //     //*Add option for campus?
        // ],
    ];

    public function mapPropertyTypesToFeatures()
    {
        $propertyTypesToFeaturesMapArray = [];

        foreach ($this::$propertyTypesToFeaturesArray as $firstKey => $firstValue)
        {
            foreach($firstValue as $secondKey => $secondValue)
            {
                $propertyTypesToFeaturesMapArray[] = ['type' => $firstKey, 'feature' => $secondValue];
            }

        }

        return $propertyTypesToFeaturesMapArray;
    }
}
