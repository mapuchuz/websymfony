<?php

namespace HB\BlogBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ArticleType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', 'text', array('required'=>false))
            ->add('content', 'text')
        //    ->add('creationDate')
            ->add('lastEditDate', 'datetime')
            ->add('publishDate', 'datetime')
            ->add('published', 'checkbox', array('required'=>false))
            ->add('enabled', 'checkbox', array('required'=>false))
            ->add('author', 'entity',  array(
                'class'=> 'HBBlogBundle:User',
                'property'=>'name',
                'required'=>false
              //  ,'attr'=>array('class'=>'ici')
                )   )
            ->add('banner', new ImageType())     //formulaire imbriqué!!!    
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'HB\BlogBundle\Entity\Article'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'hb_blogbundle_article';
    }
}
