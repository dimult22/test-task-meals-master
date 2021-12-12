<?php

declare(strict_types=1);

namespace Meals\Application\Component\Validator;

use Meals\Application\Component\Validator\Exception\PollResultNotAllowedDateException;

class PollResultAllowedAtDateValidator
{
    private const TIME_FORMAT = 'H:i:s';
    private const VALID_DAY_NAME = 'Monday';
    private const ALLOWED_FROM_TIME = '06:00:00';
    private const ALLOWED_UNTIL_TIME = '22:00:00';

    public function validate(\DateTime $dateTime): void
    {
        $currentDayName = date('l', $dateTime->getTimestamp());
        $currentTime = \DateTime::createFromFormat(self::TIME_FORMAT, $dateTime->format(self::TIME_FORMAT));
        $allowedFrom = \DateTime::createFromFormat(self::TIME_FORMAT, self::ALLOWED_FROM_TIME);
        $allowedUntil = \DateTime::createFromFormat(self::TIME_FORMAT, self::ALLOWED_UNTIL_TIME);

        if ($currentDayName !== self::VALID_DAY_NAME || $currentTime < $allowedFrom || $currentTime > $allowedUntil) {
            throw new PollResultNotAllowedDateException();
        }
    }
}
