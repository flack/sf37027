<?php
namespace App\Controller;

use Symfony\Component\Form\Extension\Core\EventListener\ResizeFormListener;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use App\Subform;


class DefaultController extends AbstractController
{
    public function index(Request $request)
    {
        $data = ['parent' => [
            new \ArrayObject(['txt' => 'xxx']),
            new \ArrayObject(['txt' => 'yyy']),
            new \ArrayObject(['txt' => '']),
        ]];

        $builder = $this->createFormBuilder(null, ['attr' => ['novalidate' => 'novalidate']]);
        $builder->add('parent', CollectionType::class, [
            'allow_add' => true,
            'allow_delete' => true,
            'prototype' => true,
            'prototype_name' => '__name__',
            'error_bubbling' => false
        ]);
        $builder->get('parent')->addEventSubscriber(new ResizeFormListener(Subform::class));
        $form = $builder->getForm();
        $form->setData($data);
        $form->handleRequest($request);

        return $this->render('form.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
