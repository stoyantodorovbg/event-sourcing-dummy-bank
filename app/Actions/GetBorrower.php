<?php

namespace App\Actions;

use App\Actions\Interfaces\GetBorrowerInterface;
use App\Dto\CreateBorrower;
use App\Events\NewBorrower;
use App\Projections\Borrower;
use App\Repositories\Interfaces\BorrowerRepositoryInterface;

readonly class GetBorrower implements GetBorrowerInterface
{
    public function __construct(
        protected BorrowerRepositoryInterface $borrowerRepository,
    )
    {
    }

    public function execute(string $borrowerName): Borrower
    {
         if (! $borrower = $this->fetchBorrower($borrowerName)) {
             NewBorrower::dispatch(new CreateBorrower($borrowerName));
             $borrower = $this->fetchBorrower($borrowerName);
         }

         return $borrower;
    }

    protected function fetchBorrower($borrowerName): Borrower|null
    {
        return $this->borrowerRepository->findByName($borrowerName);
    }
}
