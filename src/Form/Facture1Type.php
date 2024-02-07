<?php

namespace App\Form;

use App\Entity\Facture;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class Facture1Type extends AbstractType
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
            ->add('numero')
            ->add('objet')
            ->add('dossierpj')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Facture::class,
        ]);
    }
}
