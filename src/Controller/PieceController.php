<?php

namespace App\Controller;

use App\Entity\Piece;
use App\Repository\PieceRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class PieceController extends AbstractController
{
    #[Route('/pieces/index', name: 'app_piece.index', methods: ['GET'])]
    public function index(PieceRepository $pieceRepository,
    Request $request, PaginatorInterface $paginator): Response
    {
        $pagination = $paginator->paginate(
            $pieceRepository->paginationQuery(),
            $request->query->get('page', 1),
            20
        );

        return $this->render('piece/index.html.twig', [
            'pagination' => $pagination,
        ]);
    }

    #[Route('/pieces/seek', name: 'app_piece.findallcontain', methods: ['post'])]
    public function findAllContain(Request $request): Response{
        $descrip = $request->get("Description");
        $descrip = ($descrip == "") ? "**" : $descrip;
        $ident = $request->get("IdentifiantPes");
        $ident = ($ident == "") ? "**" : $ident;
        $annee = $request->get("Exercice");
        $annee = ($annee == "") ? "**" : $annee;
        $code = $request->get("CodeEntite");
        $code = ($code == "") ? "**" : $code;
        $obj = $request->get("Objet");
        $obj = ($obj == "") ? "**" : $obj;
        $libelle = $request->get("LibelleEntite");
        $libelle = ($libelle == "") ? "**" : $libelle;
        $bordereau = $request->get("BordereauPiece");
        $bordereau = ($bordereau == "") ? "**" : $bordereau;
        $sens = $request->get("Sens");
        $sens = ($sens == "") ? "**" : $sens;
        $annul = $request->get("AnnulationRejet");
        $annul = ($annul == "") ? "**" : $annul;

        return $this->redirectToRoute('app_piece.findallcontainReq', [
            'annee' => $annee,
            'descrip' => $descrip,
            'code' => $code,
            'obj' => $obj,
            'libelle' => $libelle,
            'ident' => $ident,
            'bordereau' => $bordereau,
            'sens' => $sens,
            'annul' => $annul
        ]);
    }

    #[Route('/pieces/{annee}/{descrip}/{code}/{obj}/{libelle}/{ident}/{bordereau}/{sens}/{annul}', name: 'app_piece.findallcontainReq', methods: ['post', 'get'])]
    public function findAllContainReq(PieceRepository $pieceRepository,
    PaginatorInterface $paginator, Request $request,
    $descrip ="", $annee = "", $code = "", $obj= "", $libelle = "",
    $ident = "", $bordereau= "", $sens = "", $annul = ""): Response{
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
        if($bordereau != "**"){
            $params += array("bordereau_piece" => $bordereau);
        }
        if($sens != "**"){
            $params += array("sens" => $sens);
        }
        if($annul != "**"){
            $params += array("annulation_rejet" => $annul);
        }
        if(count($params) == 0) {
            return $this->redirectToRoute('app_piece.index');
        }
        $pagination = $paginator->paginate(
            $pieceRepository->paginationQueryComplex($params)->getResult(),
            $request->query->get('page', 1),
            20
        );
        return $this->render('piece/index.html.twig', [
            'pagination' => $pagination,
            'descrip' => $descrip,
            'code' => $code,
            'obj' => $obj,
            'annee' => $annee,
            'libelle' => $libelle,
            'ident' => $ident,
            'bordereau' => $bordereau,
            'sens' => $sens,
            'annul' => $annul
        ]);
    }

    #[Route('/piece/{id}', name: 'app_piece.show', methods: ['GET'])]
    public function show(Piece $piece): Response
    {
        return $this->render('piece/show.html.twig', [
            'piece' => $piece,
        ]);
    }

    #[Route('/piece/download/{id}', name: 'app_piece.dl', methods: ['GET', 'POST'])]
    public function downloadAction(PieceRepository $pieceRepository, $id) : BinaryFileResponse
    {
        $piece = $pieceRepository->find($id);
        return $this->file('C:/Users/nfrere/symfony/www/html/jvspj/public/'
         .   $piece->getDossierpj() . '/' . $piece->getFichierpj());
    }

}
