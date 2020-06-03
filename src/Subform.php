<?php
namespace App;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\AbstractType;

class Subform extends AbstractType
{
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefault('compound', true);
    }
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('txt', TextType::class, ['constraints' => new NotBlank()]);
    }
}