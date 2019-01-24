<?php

namespace App\Service;
use Doctrine\Common\Persistence\ObjectManager;

class PaginationService {
    private $entityClass;
    private $limit = 12; 
    private $currentPage = 1;
    private $manager;

    public function __construct(ObjectManager $manager) {
        $this->manager = $manager;
    }

    public function getPages() {
        // connaitre le total des enregistrement de la table
        $repo = $this->manager->getRepository($this->entityClass);
        $total = count($repo->findAll());
        //faire la division et e renvoyer
        $pages =  ceil($total / $this->limit);
        return $pages;
    }

    public function getData() {
        //calcul de l'offset
        $offset =  $this->currentPage * $this->limit - $this->limit;
        //demande au repo de trouver les elements
        $repo = $this->manager->getRepository($this->entityClass);
        $data = $repo->findBy([], [], $this->limit, $offset);
        //renvoyer les elements en question
        return $data;

    }

    public function setPage($page) {
        $this->currentPage = $page;

        return $this;
    }

    public function getPage() {
        return $this->$currentPage;
    }

    public function setLimit($limit) {
        $this->limit = $limit;

        return $this;
    }

    public function getLimit() {
        return $this->$limit;
    }

    public function setEntityClass($entityClass) {
        $this->entityClass = $entityClass; 
        return $this;
    }

    public function getEntityClass() {
        return $this->entityClass;
    }
}