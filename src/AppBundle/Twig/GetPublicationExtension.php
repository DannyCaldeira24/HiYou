<?php

namespace AppBundle\Twig;

use Symfony\Bridge\Doctrine\RegistryInterface;

class GetPublicationExtension extends \Twig_Extension{

    protected $doctrine;

    public function __construct(RegistryInterface $doctrine) {
        $this->doctrine = $doctrine;
    }

    public function getFilters() {
        return array(
            new \Twig_SimpleFilter('get_extra', array($this, 'getPublicationFilter'))
        );
    }

    public function getPublicationFilter($publication_id) {
        $publication_repo = $this->doctrine->getRepository('BackendBundle:Publication');
        $publication = $publication_repo->findOneBy(array(
            "id" => $publication_id
        ));
        
        if(!empty($publication) && is_object($publication)){
            $result = $publication;
        }else{
            $result = false;
        }
        
        return $result;
        
    }
    
    public function getName(){
        return 'get_publication_extension';
    }
    
}
