<?php

declare(strict_types=1);

namespace Meals\Application\Feature\PollResult\UseCase\EmployeeGetsPollResult;

use Meals\Application\Component\Provider\EmployeeProviderInterface;
use Meals\Application\Component\Provider\PollResultProviderInterface;
use Meals\Application\Component\Validator\PollResultAllowedAtDateValidator;
use Meals\Application\Component\Validator\UserHasAccessToViewPollResultValidator;
use Meals\Domain\Poll\PollResult;

class Interactor
{
    public function __construct(
        private EmployeeProviderInterface $employeeProvider,
        private PollResultProviderInterface $pollResultProvider,
        private UserHasAccessToViewPollResultValidator $userHasAccessToPollResultValidator,
        private PollResultAllowedAtDateValidator $pollResultAllowedAtDateValidator
    ) {}

    public function getPollResult(int $employeeId, \DateTime $dateTime): PollResult
    {
        $employee = $this->employeeProvider->getEmployee($employeeId);
        $this->userHasAccessToPollResultValidator->validate($employee->getUser());
        $this->pollResultAllowedAtDateValidator->validate($dateTime);

        return $this->pollResultProvider->getPollResult();
    }
}
