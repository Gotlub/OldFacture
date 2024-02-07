<?php

namespace App\Form;

use App\Entity\Piece;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class Piece2Type extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('description')
            ->add('identifiantPes')
            ->add('nom')
            ->add('codeEntite')
            ->add('libelleEntite')
            ->add('elementRattache')
            ->add('exercice')
            ->add('sens')
            ->add('annulationRejet')
            ->add('bordereauPiece')
            ->add('objet')
            ->add('dossierpj')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Piece::class,
        ]);
    }
}
