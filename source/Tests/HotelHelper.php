<?php


trait HotelHelper
{
    private function getHotelsRequestExample()
    {
        return ["hotels"=>[
                [
                "name" => "Rotana Hotel",
                "price" => "102",
                "city" => "Cairo",
                "availability" => [
                    [
                        "from" => "10-10-2020",
                        "to" => "15-10-2020"
                    ],
                    [
                        "from" => "20-10-2020",
                        "to" => "25-10-2020"
                    ]
                ]
            ]
        ]];
    }

}