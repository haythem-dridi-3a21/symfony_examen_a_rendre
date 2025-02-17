<?php

namespace App\Form;

use App\Entity\Show;
use App\Entity\TheatrePlay;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ShowType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('numshow')
            ->add('nbrseat')
            ->add('dateshow', null, [
                'widget' => 'single_text',
            ])
            ->add('theatrePlay', EntityType::class, [
                'class' => TheatrePlay::class,
                'choice_label' => 'id',
            ])
            ->add('submit', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Show::class,
        ]);
    }
}
