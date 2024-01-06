<?php

namespace App\Form;

use App\Entity\Artiste;
use App\Entity\Chanson;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ChansonType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('titre')
            ->add('dateSortie')
            ->add('genre')
            ->add('langue')
            ->add('photoCouverture')
            ->add('artistes', EntityType::class, [
                // looks for choices from this entity
                'class' => Artiste::class,
                // used to render a select box, check boxes or radios
                 'multiple' => true,
                'row_attr' => [
                    'class' => 'd-flex flex-column mb-4',
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Chanson::class,
        ]);
    }
}
