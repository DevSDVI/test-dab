<?php

declare(strict_types = 1);

namespace App\Controller;

use App\Interfaces\DabInterface;
use App\Repository\DabRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class IndexController
 */
class IndexController extends AbstractController
{
    /**
     * @Route("/")
     *
     * @return Response
     */
    public function index(Request $request, DabRepository $dabRepo, DabInterface $dabService): Response
    {
        // récupération du montant et du DAB
        $nomDab = $request->get("dab");
        $montant = (int) $request->get("montant");
        // si un DAB et un montant sont fournis
        if (!empty($nomDab) && $montant) {
            // récupération du DAB par son ID
            $dab = $dabRepo->findWithBillets($nomDab);
            // TEST du programme ==> récupération de l'instance de Retrait correspondante
            $retrait = $dabService->faireRetrait($dab, $montant);

            return $this->render("index.html.twig", [
                "retrait" => $retrait,
            ]);
        }

        return $this->render("index.html.twig");
    }
}
