<?php

namespace App\Controller;

use App\Entity\Engagement;
use App\Repository\EngagementRepository;
use Knp\Component\Pager\PaginatorInterface;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

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
    public function findAllContain(Request $request): Response{
        $descrip = $request->get("Description");
        $descrip = ($descrip == "") ? "**" : $descrip;
        $annee = $request->get("Exercice");
        $annee = ($annee == "") ? "**" : $annee;
        $code = $request->get("CodeEntite");
        $code = ($code == "") ? "**" : $code;
        $obj = $request->get("Objet");
        $obj = ($obj == "") ? "**" : $obj;
        $libelle = $request->get("LibelleEntite");
        $libelle = ($libelle == "") ? "**" : $libelle;
        $sens = $request->get("SensEtNumero");
        $sens = ($sens == "") ? "**" : $obj;
        $ident = $request->get("IdentifiantPes");
        $ident = ($ident == "") ? "**" : $ident;

        return $this->redirectToRoute('app_engagement.findallcontainReq', [
            'annee' => $annee,
            'descrip' => $descrip,
            'code' => $code,
            'obj' => $obj,
            'libelle' => $libelle,
            'sens' => $sens,
            'ident' => $ident

        ]);
    }

    #[Route('/engagements/{annee}/{descrip}/{code}/{obj}/{libelle}/{sens}/{ident}/', name: 'app_engagement.findallcontainReq', methods: ['post', 'get'])]
    public function findAllContainReq(EngagementRepository $engagementRepository,
    PaginatorInterface $paginator, Request $request,
    $descrip ="", $annee = "", $code = "", $obj= "", $libelle = "", $sens = "", $ident = ""): Response{
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
        if($ident != "**"){
            $params += array("identifiant_PES" => $ident);
        }
        if($obj != "**"){
            $params += array("objet" => $obj);
        }
        if($libelle != "**"){
            $params += array("objet" => $libelle);
        }
        if($sens != "**"){
            $params += array("libelle_entite" => $sens);
        }
        if(count($params) == 0) {
            return $this->redirectToRoute('app_engagement.index');
        }
        $pagination = $paginator->paginate(
            $engagementRepository->paginationQueryComplex($params)->getResult(),
            $request->query->get('page', 1),
            20
        );
        //dd($pagination);
        return $this->render('engagement/index.html.twig', [
            'pagination' => $pagination,
            'descrip' => $descrip,
            'code' => $code,
            'obj' => $obj,
            'annee' => $annee,
            'libelle' => $libelle,
            'sens' => $sens,
            'ident' => $ident
        ]);
    }

    #[Route('/engagement/{id}', name: 'app_engagement.show', methods: ['GET'])]
    public function show(Engagement $engagement): Response
    {
        return $this->render('engagement/show.html.twig', [
            'engagement' => $engagement,
        ]);
    }

    #[Route('/engagement/download/{id}', name: 'app_engagement.dl', methods: ['GET', 'POST'])]
    public function downloadAction(EngagementRepository $engagementRepository, $id) : BinaryFileResponse
    {
        $facture = $engagementRepository->find($id);
        return $this->file('C:/Users/nfrere/symfony/www/html/jvspj/public/'
         .   $facture->getDossierpj() . '/' . $facture->getFichierpj());
    }
}
