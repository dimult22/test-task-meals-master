<?php

declare(strict_types=1);

namespace tests\Meals\Unit\Application\Component\Validator;

use Meals\Application\Component\Validator\Exception\PollResultNotAllowedDateException;
use Meals\Application\Component\Validator\PollResultAllowedAtDateValidator;
use PHPUnit\Framework\TestCase;
use Prophecy\PhpUnit\ProphecyTrait;

class PollResultAllowedAtDateValidatorTest extends TestCase
{
    use ProphecyTrait;

    private const DATE_TIME_FORMAT = 'j-M-Y H:i:s';
    private const VALID_DATE = '13-Dec-2021 12:00:00';
    private const INVALID_DATE = '15-Dec-2021 12:00:00';

    /** @dataProvider validationTestProvider */
    public function testValidation(string $dateString, bool $valid)
    {
        $date = \DateTime::createFromFormat(self::DATE_TIME_FORMAT, $dateString);
        $validator = new PollResultAllowedAtDateValidator();

        if (!$valid) {
            $this->expectException(PollResultNotAllowedDateException::class);
            $validator->validate($date);
        } else {
            verify($validator->validate($date))->null();
        }
    }

    public function validationTestProvider(): array
    {
        return [
            'tooEarly' => [
                '13-Dec-2021 05:59:59',
                false
            ],
            'valid1' => [
                '13-Dec-2021 06:00:00',
                true
            ],
            'valid2' => [
                '13-Dec-2021 12:00:00',
                true
            ],
            'valid3' => [
                '13-Dec-2021 22:00:00',
                true
            ],
            'tooLate' => [
                '13-Dec-2021 22:00:01',
                false
            ],
        ];
    }
}
