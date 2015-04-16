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
class MainPageAdmin extends Admin{

    protected function configureRoutes(RouteCollection $collection)
    {
        $collection->remove('create');
        $collection->remove('delete');
    }

    // Fields to be shown on create/edit forms
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper

            ->tab('Общие')
                ->with('Содержание страницы')
                    ->add('title', 'text', array('label' => 'Название'))
                    ->add('header', 'text', array('label' => 'Шапка', 'required' => false))
                    ->add('contacts', null, array('label' => 'Контакты', 'attr'=>array('class' => 'tinymce')))
                    ->add('content', 'textarea', array('label' => 'Содержание', 'attr'=>array('class' => 'tinymce')))
                    ->add('footer', 'text', array('label' => 'Футер', 'required' => false))
                ->end()
                ->with('Отображение блоков')
                    ->add('news', null, array('label' => 'Отображать новости', 'required' => false))
                    ->add('articles', null, array('label' => 'Отображать статьи', 'required' => false))
                    ->add('actions', null, array('label' => 'Отображать акции', 'required' => false))
                ->end()
            ->end()
            ->tab('SEO')
                ->with('Параметры для продвижения')
                    ->add('keywords', null, array('label' => 'Ключевые слова', 'required' => false))
                    ->add('description', null, array('label' => 'Описание страницы', 'required' => false))
                ->end()
            ->end()
        ;
    }

    // Fields to be shown on filter forms
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('title', null, array('label' => 'Название'))
            ->add('content', null, array('label' => 'Содержание'))
        ;
    }

    // Fields to be shown on lists
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('title', null, array('label' => 'Название'))
            ->add('news', null, array('label' => 'Отображать новости', 'editable' => true))
            ->add('articles', null, array('label' => 'Отображать статьи', 'editable' => true))
            ->add('actions', null, array('label' => 'Отображать акции', 'editable' => true))
        ;
    }

} 