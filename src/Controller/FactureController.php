<?php

namespace App\Controller;

use App\Entity\Facture;
use App\Repository\FactureRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class FactureController extends AbstractController
{
    #[Route('/factures', name: 'app_facture.index', methods: ['GET'])]
    public function index(FactureRepository $factureRepository,
    Request $request, PaginatorInterface $paginator): Response
    {
        $pagination = $paginator->paginate(
            $factureRepository->paginationQuery(),
            $request->query->get('page', 1),
            20
        );
        return $this->render('facture/index.html.twig', [
            'pagination' => $pagination,
        ]);
    }

    #[Route('/factures/seek', name: 'app_facture.findallcontain', methods: ['post'])]
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
        $ident = $request->get("IdentifiantPes");
        $ident = ($ident == "") ? "**" : $ident;
        $numero = $request->get("Numero");
        $numero = ($numero == "") ? "**" : $numero;

        return $this->redirectToRoute('app_facture.findallcontainReq', [
            'annee' => $annee,
            'descrip' => $descrip,
            'ident' => $ident,
            'code' => $code,
            'obj' => $obj,
            'libelle' => $libelle,
            'numero' => $numero
        ]);
    }

    #[Route('/factures/{annee}/{descrip}/{code}/{obj}/{libelle}/{ident}/{numero}', name: 'app_facture.findallcontainReq', methods: ['post', 'get'])]
    public function findAllContainReq(FactureRepository $factureRepository,
    PaginatorInterface $paginator, Request $request,
    $descrip ="", $annee = "", $code = "", $obj= "", $libelle = "", $ident = "", $numero = ""): Response{
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
        if($libelle != "**"){
            $params += array("libelle_entite" => $libelle);
        }
        if($ident != "**"){
            $params += array("identifiant_PES" => $ident);
        }
        if($numero != "**"){
            $params += array("numero" => $numero);
        }
        if(count($params) == 0) {
            return $this->redirectToRoute('app_facture.index');
        }
        $pagination = $paginator->paginate(
            $factureRepository->paginationQueryComplex($params)->getResult(),
            $request->query->get('page', 1),
            20
        );
        return $this->render('facture/index.html.twig', [
            'pagination' => $pagination,
            'descrip' => $descrip,
            'code' => $code,
            'obj' => $obj,
            'ident' => $ident,
            'annee' => $annee,
            'libelle' => $libelle,
            'numero' => $numero
        ]);
    }

    #[Route('/facture/{id}', name: 'app_facture.show', methods: ['GET'])]
    public function show(Facture $facture): Response
    {
        return $this->render('facture/show.html.twig', [
            'facture' => $facture,
        ]);
    }

    #[Route('/facture/download/{id}', name: 'app_facture.dl', methods: ['GET', 'POST'])]
    public function downloadAction(FactureRepository $factureRepository, $id) : BinaryFileResponse
    {
        $facture = $factureRepository->find($id);
        return $this->file('/var/www/html/jvspj/public/'
         .   $facture->getDossierpj() . '/' . $facture->getFichierpj());
    }

}
