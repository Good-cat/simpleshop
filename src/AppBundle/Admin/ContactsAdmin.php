<?php

namespace AppBundle\Admin;

use Knp\Menu\ItemInterface;
use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Admin\AdminInterface;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Route\RouteCollection;
use Sonata\AdminBundle\Show\ShowMapper;
class ContactsAdmin extends Admin{

    protected function configureRoutes(RouteCollection $collection)
    {
        $collection->remove('create');
        $collection->remove('delete');
    }

    // Fields to be shown on create/edit forms
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper

            ->tab('Контакты')
                ->with('Контакты')
                    ->add('phones', null, array('label' => 'Телефоны', 'attr'=>array('class' => 'tinymce')))
                    ->add('email', null, array('label' => 'Электронная почта', 'attr'=>array('class' => 'tinymce')))
                    ->add('skype', null, array('label' => 'Скайп', 'attr'=>array('class' => 'tinymce')))
                ->end()
            ->end()
            ->tab('Карта')
                ->with('Код карты')
                    ->add('mapCode', null, array('label' => 'Код Яндекс-карты', 'required' => false))
                ->end()
            ->end()
        ;
    }

    // Fields to be shown on lists
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('phones', null, array('label' => 'Телефоны'))
            ->add('email', null, array('label' => 'Электронная почта'))
            ->add('skype', null, array('label' => 'Скайп'))
        ;
    }

} 