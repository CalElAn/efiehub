<?php

namespace App\Http\Helpers;

class PropertyTypeToFeatureMap
{
    static $propertyTypeArray = [
        ['type' => 'Chamber and hall'],
        ['type' => 'Apartment'],
        // ['type' => 'Studio apartment'],
        // ['type' => 'Service apartment'],
        ['type' => 'House'],
        ['type' => 'Single room'],
        // ['type' => 'Bed'],
    ];

    static $propertyFeatureArray = [
        ['feature' => 'Number of bedrooms', 'input_type' => 'number'],
        ['feature' => 'Number of washrooms', 'input_type' => 'number'],
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

    static $propertyTypeToFeatureArray = [
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
            'Number of washrooms',
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
        //     'Number of washrooms',
        //     'Porch / Balcony',
        //     'Kitchen',
        //     'Dining room',
        //     'Living room',
        //     'Walled',
        // ],
        'House' => [
            'Number of bedrooms',
            'Number of washrooms',
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

    public function mapPropertyTypeToFeature()
    {
        $propertyTypeToFeatureMapArray = [];

        foreach ($this::$propertyTypeToFeatureArray as $firstKey => $firstValue)
        {
            foreach($firstValue as $secondKey => $secondValue)
            {
                $propertyTypeToFeatureMapArray[] = ['type' => $firstKey, 'feature' => $secondValue];
            }

        }

        return $propertyTypeToFeatureMapArray;
    }
}
