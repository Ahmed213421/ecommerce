<?php

namespace App\Services;

use App\Repositories\Admin\Contracts\TestmonialContract;

class TestmonialService
{
    protected $testmonialRepository;

    public function __construct(TestmonialContract $testmonialRepository)
    {
        $this->testmonialRepository = $testmonialRepository;
    }

    public function submitTestmonial(array $data)
    {
        return $this->testmonialRepository->create($data);
    }
}
