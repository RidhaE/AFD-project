<?php

namespace App\Services\Article\Manager;

use App\Entity\Article;
use App\Entity\ContentFile;
use App\Repository\ArticleRepository;
use App\Services\Uploader;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use App\Services\SimpleXLSX;

class ArticleManager
{
    /**
     * @var TokenStorageInterface
     */
    private $tokenStorage;

    /**
     * @var Uploader
     */
    private $uploader;

    /**
     * @var ArticleRepository
     */
    private $repository;

    /**
     * @var EntityManagerInterface
     */
    private $em;


    /**
     * @var SimpleXLSX
     */
    private $simpleXLSX;

    public function __construct(
        TokenStorageInterface $tokenStorage,
        Uploader $uploader,
        ArticleRepository $repository,
        EntityManagerInterface $em,
        SimpleXLSX $simpleXLSX
    ) {
        $this->tokenStorage = $tokenStorage;
        $this->uploader = $uploader;
        $this->repository = $repository;
        $this->em = $em;
        $this->simpleXLSX = $simpleXLSX;
    }

    public function create(Article $article): void
    {
        $article->setAuthor($this->tokenStorage->getToken()->getUser());

        if (null !== $article->getImage()) {
            if ($this->uploader->hasNewImage($article->getImage())) {
                $this->uploadImage($article);
            }
        }

        $this->repository->saveNewArticle($article);
    }

    public function edit(Article $article)
    {
        $image = $article->getImage();

        if (null !== $image) {
            if ($this->uploader->hasNewImage($image)) {
                if ($this->uploader->hasActiveImage($image)) {
                    $this->uploader->removeImage($image->getAlt());
                }
                $this->uploadImage($article);
            } else {
                if ($this->uploader->hasActiveImage($image) && $this->uploader->isDeleteImageChecked($image)) {
                    $this->uploader->removeImage($image->getAlt());
                    $this->em->remove($image);
                    $article->setImage(null);
                }
            }
        }

        $this->repository->saveExistingArticle();
    }

    public function remove(Article $article): void
    {
        $this->repository->remove($article);
    }

    private function uploadImage(Article $article): void
    {
        $alt = $this->uploader->generateAlt($article->getImage()->getFile());
       
        $article->getImage()->setAlt($alt);
        $this->uploader->uploadImage($article->getImage()->getFile(), $alt);
        $this->saveFile($article, $this->uploader->getTargetDir().$alt);
       
    }

    private function saveFile($article, $file) {
        if ($xlsx = $this->simpleXLSX::parse($file)) {
            foreach ( $xlsx->rows() as $r => $row ) {
                if ($r == 0 ) 
                    continue;
                    $this->save($article, $row);
            }
        } else {
            echo $this->simpleXLSX::parseError();
        }
    }

    private function save($article, $row) {
        $identifiant = $row[0]; 
        $name = $row[1]; 
        $codeBanque = $row[2]; 
        $nomBanque = $row[3]; 
        $codeguichet = $row[4]; 
        $numerocompte = $row[5]; 
        $montant = $row[6];
        $motif = $row[7];

        $contentFile = new ContentFile();
        $contentFile->setIdentifiant(rtrim($identifiant));
        $contentFile->setNomprenon(rtrim($name));
        $contentFile->setCodebancque(rtrim($codeBanque));
        $contentFile->setNombanque(rtrim($nomBanque));
        $contentFile->setCodeguichet(rtrim($codeguichet));
        $contentFile->setNumcompte(rtrim($numerocompte));
        $contentFile->setMontant(rtrim($montant));
        $contentFile->setMotif(rtrim($motif));
        $contentFile->setImage($article->getImage());
        $this->em->persist($contentFile);

        $this->em->flush();

    }
}
