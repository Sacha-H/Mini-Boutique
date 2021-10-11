<?php

namespace App\Form;

use App\Entity\Product;
use App\Entity\CategoryProduct;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class ProductType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nameProduct')
            ->add('descriptionProduct')
            ->add('priceProduct')
            ->add('stockProduct')
            ->add('categoryProduct', EntityType::class, [
                'class' => CategoryProduct::class,
                'choice_label' => 'nameCategoryProduct',
                ])
                ->add('imageProduct', FileType::class, [
                    'label' => 'Photo',
                    'mapped' => false,
                    'required' => false,
                    'constraints' => [
                    new File([
                    'maxSize' => '1024k',
                    'mimeTypes' => [
                    'image/*',
                    ],
                   'mimeTypesMessage' => 'Veuillez entrer un format de document valide',
                    ])
                    ],
                    ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Product::class,
        ]);
    }
}
