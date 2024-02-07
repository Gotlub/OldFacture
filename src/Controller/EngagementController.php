<?php

namespace App\Controller;

use App\Entity\Engagement;
use App\Repository\EngagementRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EngagementController extends AbstractController
{
    #[Route('/', name: 'app_engagement.index', methods: ['GET'])]
    public function index(EngagementRepository $engagementRepository,
        Request $request, PaginatorInterface $paginator): Response
    {
        $pagination = $paginator->paginate(
            $engagementRepository->paginationQuery(),
            $request->query->get('page', 1),
            20

        );
        return $this->render('engagement/index.html.twig', [
            'pagination' => $pagination,
        ]);
    }


    #[Route('/engagements/', name: 'app_engagement.findallcontain', methods: ['post'])]
    public function findAllContain(EngagementRepository $engagementRepository,
    Request $request, PaginatorInterface $paginator): Response{
        $descrip = $request->get("Description");
        $descrip = ($descrip == "") ? "**" : $descrip;
        $annee = $request->get("Exercice");
        $annee = ($annee == "") ? "**" : $annee;
        $code = $request->get("CodeEntite");
        $code = ($code == "") ? "**" : $code;
        $obj = $request->get("Objet");
        $obj = ($obj == "") ? "**" : $obj;

        return $this->redirectToRoute('app_engagement.findallcontainReq', [
            'annee' => $annee,
            'descrip' => $descrip,
            'code' => $code,
            'obj' => $obj
        ]);
    }

    #[Route('/engagements/{annee}/{descrip}/{code}/{obj}', name: 'app_engagement.findallcontainReq', methods: ['post', 'get'])]
    public function findAllContainReq(EngagementRepository $engagementRepository,
    PaginatorInterface $paginator, Request $request,
    $descrip ="", $annee = "", $code = "", $obj= ""): Response{
        $params = array();
        if($annee != "**" && is_numeric($annee)){
            $params += array("exercice" => (int)$annee);
        }
        if($descrip != "**"){
            $params += array("description" => $descrip);
        }
        if($code != "**"){
            $params += array("code_entite" => $code);
        }
        if($obj != "**"){
            $params += array("objet" => $obj);
        }
        if(count($params) == 0) {
            return $this->redirectToRoute('app_engagement.index');
        }
        $pagination = $paginator->paginate(
            $engagementRepository->paginationQueryComplex($params)->getResult(),
            $request->query->get('page', 1),
            20
        );
        return $this->render('engagement/index.html.twig', [
            'pagination' => $pagination,
            'descrip' => $descrip,
            'code' => $code,
            'obj' => $obj,
            'annee' => $annee
        ]);
    }

    #[Route('/{id}', name: 'app_engagement.show', methods: ['GET'])]
    public function show(Engagement $engagement): Response
    {
        return $this->render('engagement/show.html.twig', [
            'engagement' => $engagement,
        ]);
    }
}
