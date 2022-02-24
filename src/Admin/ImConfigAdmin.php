<?php

declare(strict_types=1);

namespace App\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;

final class ImConfigAdmin extends AbstractAdmin
{

    protected function configureDatagridFilters(DatagridMapper $filter): void
    {
        $filter
            ->add('id')
            ->add('name')
            ->add('category')
            ->add('type')
            ->add('value')
            ;
    }

    protected function configureListFields(ListMapper $list): void
    {
        $list
            //->add('id')
            ->add('name')
            ->add('category')
            ->add('type')
            ->add('value')
            ->add(ListMapper::NAME_ACTIONS, null, [
                'actions' => [
                    'show' => [],
                    'edit' => [],
                    'delete' => [],
                ],
            ]);
    }

    protected function configureFormFields(FormMapper $form): void
    {
        $form
            //->add('id')
            ->add('name')
            ->add('category')
            ->add('type',CheckboxType::class,['label'    => 'Show this entry publicly?'])
            ->add('value')
            ;
    }

    protected function configureShowFields(ShowMapper $show): void
    {
        $show
            //->add('id')
            ->add('name')
            ->add('category')
            ->add('type',CheckboxType::class,['label'    => 'Show this entry publicly?'])
            ->add('value')
            ;
    }
}
