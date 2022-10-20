<?php

namespace App\Form;

use App\Entity\Student;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use App\Entity\ClassRoom;
use App\Form\ClassRoomType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
class StudentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('ref')
            ->add('username')
        //  ->add('classRoom')
             ->add('classRoom',EntityType::class,array('class'=>ClassRoom::class, 'choice_label'=>'name'))
            ->add("submit",SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Student::class,
        ]);
    }
}
//fi 3oudh l tostring najmou nzidou fel form fazet okhrin