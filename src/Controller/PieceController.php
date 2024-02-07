<?php

namespace App\Controller;

use App\Entity\Piece;
use App\Form\Piece2Type;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/piece')]
class PieceController extends AbstractController
{
    #[Route('/', name: 'app_piece.index', methods: ['GET'])]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $pieces = $entityManager
            ->getRepository(Piece::class)
            ->findAll();

        return $this->render('piece/index.html.twig', [
            'pieces' => $pieces,
        ]);
    }

    #[Route('/new', name: 'app_piece_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $piece = new Piece();
        $form = $this->createForm(Piece2Type::class, $piece);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($piece);
            $entityManager->flush();

            return $this->redirectToRoute('app_piece_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('piece/new.html.twig', [
            'piece' => $piece,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_piece_show', methods: ['GET'])]
    public function show(Piece $piece): Response
    {
        return $this->render('piece/show.html.twig', [
            'piece' => $piece,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_piece_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Piece $piece, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(Piece2Type::class, $piece);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_piece_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('piece/edit.html.twig', [
            'piece' => $piece,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_piece_delete', methods: ['POST'])]
    public function delete(Request $request, Piece $piece, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$piece->getId(), $request->request->get('_token'))) {
            $entityManager->remove($piece);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_piece_index', [], Response::HTTP_SEE_OTHER);
    }
}
