<?php

declare(strict_types = 1);

namespace App\Interfaces;

use App\Entity\Dab;
use App\Entity\Retrait;

/**
 * Class DabInterface
 */
interface DabInterface
{
    public function faireRetrait(Dab $dab, int $montant): ?Retrait;
}
