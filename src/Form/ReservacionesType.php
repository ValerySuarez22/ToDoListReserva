<?php

namespace App\Form;

use App\Entity\Reservaciones;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;


class ReservacionesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('usuario')
            ->add('telefono')
            ->add('email')
            ->add('fecha', DateType::class, [
                'attr' => ['class' => 'fecha'],
            ])
            ->add('Habitacion')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Reservaciones::class,
        ]);
    }
}
