<?php

namespace Unno\YandexMapsBundle\Form;

use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class YandexMapsType extends AbstractType
{
    /**
     * @var $container ContainerInterface
     */
    protected $container;

    /**
     * @param ContainerInterface $container A ContainerInterface instance
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('latitude', 'hidden')
            ->add('longitude', 'hidden')
        ;
    }

    public function buildView(FormView $view, FormInterface $form, array $options)
    {
        $view->vars['latitude']  = $options['latitude'];
        $view->vars['longitude'] = $options['longitude'];

        $view->vars['canvasZoom']   = $options['canvasZoom'];
        $view->vars['canvasWidth']  = $options['canvasWidth'];
        $view->vars['canvasHeight'] = $options['canvasHeight'];

        $view->vars['placemark']    = $options['placemark'];
        $view->vars['placemarkDraggable'] = $options['placemarkDraggable'];
        $view->vars['placemarkGeocoderFunction'] = $options['placemarkGeocoderFunction'];

        $view->vars['hasControlsZoom']         = $options['hasControlsZoom'];
        $view->vars['hasControlsZoomSmall']    = $options['hasControlsZoomSmall'];
        $view->vars['hasControlsTypeSelector'] = $options['hasControlsTypeSelector'];
        $view->vars['hasControlsMiniMap']      = $options['hasControlsMiniMap'];
        $view->vars['hasControlsScaleLine']    = $options['hasControlsScaleLine'];

        $view->vars['behaviors'] = $options['behaviors'];
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'latitude'                  => $this->container->hasParameter('unno_yandex_maps.latitude') ? $this->container->getParameter('unno_yandex_maps.latitude') : '',
            'longitude'                 => $this->container->hasParameter('unno_yandex_maps.longitude') ? $this->container->getParameter('unno_yandex_maps.longitude') : '',

            'canvasZoom'                => $this->container->hasParameter('unno_yandex_maps.canvasZoom') ? $this->container->getParameter('unno_yandex_maps.canvasZoom') : '10',
            'canvasWidth'               => $this->container->hasParameter('unno_yandex_maps.canvasWidth') ? $this->container->getParameter('unno_yandex_maps.canvasWidth') : '100%',
            'canvasHeight'              => $this->container->hasParameter('unno_yandex_maps.canvasHeight') ? $this->container->getParameter('unno_yandex_maps.canvasHeight') : '400px',

            'placemark'                 => $this->container->hasParameter('unno_yandex_maps.placemark') ? $this->container->getParameter('unno_yandex_maps.placemark') : false,
            'placemarkDraggable'        => $this->container->hasParameter('unno_yandex_maps.placemark.draggable') ? $this->container->getParameter('unno_yandex_maps.placemark.draggable') : false,
            'placemarkGeocoderFunction' => $this->container->hasParameter('unno_yandex_maps.placemark.geocoderFunction') ? $this->container->getParameter('unno_yandex_maps.placemark.geocoderFunction') : false,

            'behaviors'                 => $this->container->hasParameter('unno_yandex_maps.behaviors') ? $this->container->getParameter('unno_yandex_maps.behaviors') : array(),

            'hasControlsZoom'           => $this->container->hasParameter('unno_yandex_maps.controls.zoom') ? $this->container->getParameter('unno_yandex_maps.controls.zoom') : false,
            'hasControlsZoomSmall'      => $this->container->hasParameter('unno_yandex_maps.controls.zoomSmall') ? $this->container->getParameter('unno_yandex_maps.controls.zoomSmall') : false,
            'hasControlsScaleLine'      => $this->container->hasParameter('unno_yandex_maps.controls.scaleLine') ? $this->container->getParameter('unno_yandex_maps.controls.scaleLine') : false,
            'hasControlsMiniMap'        => $this->container->hasParameter('unno_yandex_maps.controls.miniMap') ? $this->container->getParameter('unno_yandex_maps.controls.miniMap') : false,
            'hasControlsTypeSelector'   => $this->container->hasParameter('unno_yandex_maps.controls.typeSelector') ? $this->container->getParameter('unno_yandex_maps.controls.typeSelector') : false
        ));
    }

    public function getParent()
    {
        return 'form';
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'unno_yandex_maps';
    }
}
