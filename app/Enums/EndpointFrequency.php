<?php
namespace App\Enums;

enum EndpointFrequency: int {
// These are states that carry values they represent
    case ONE_MINUTE = 1 * 60;
    case FIVE_MINUTES = 5 * 60;
    case THIRTY_MINUTES = 30 * 60;
    case ONE_HOUR = 60 * 60;

    // this is where we begin to match the values and their labels
    public function label(): string{
        return match($this){
            self::ONE_MINUTE => '1 minute',
            self::FIVE_MINUTES => '5 minutes',
            self::THIRTY_MINUTES => '30 minutes',
            self::ONE_HOUR => '1 hour',
        };
    }

}
