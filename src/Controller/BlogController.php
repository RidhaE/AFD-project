<?php

namespace App\Controller;

use App\Entity\Article;
use App\Entity\Image;
use App\Entity\ContentFile;
use App\Entity\Comment;
use App\Form\CommentType;
use App\Form\ContentFileType;
use App\Repository\ArticleRepository;
use App\Services\Paginator;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Cache;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ContentFileRepository;
use App\Services\FlashMessage;
use App\Twig\AppExtension;
use \Datetime;
class BlogController extends AbstractController
{
   /**
     * @var FlashMessage
     */
    private $flashMessage;

    /**
     * @var AppExtension
     */
    private $appExtension;

    public function __construct(

        FlashMessage $flashMessage,
        AppExtension $appExtension

    ) {

        $this->flashMessage = $flashMessage;
        $this->appExtension = $appExtension;

    }
    /**
     * @Route("/", name="homepage", methods={"GET"})
     * @Cache(smaxage="5")
     */
    public function index(Paginator $paginator, ArticleRepository $articleRepository): Response
    {
        $page = $paginator->getPage();
        $articles = $paginator->getItemList($articleRepository, $page);
        $nbPages = $paginator->countPage($articles);

        return $this->render('blog/home/index.html.twig', [
            'articles' => $articles,
            'nbPages' => $nbPages,
            'page' => $page,
        ]);
    }

    /**
     * @Route("article/{slug}", name="article_show", methods={"GET", "POST"})
     */
    public function show($slug, Request $request, ContentFileRepository $contentFileRepository, Paginator $paginator): Response
    {

       
        $data = $request->request->all();
        if(!empty($data)) {
        $contentFile = $this->save($data);
        if ($this->appExtension->validateall($contentFile)){
            $this->flashMessage->createMessage(
                $request,
                FlashMessage::INFO_MESSAGE,
                'Modification avec sucéés'
            );
         } else {
            $this->flashMessage->createMessage(
                $request,
                FlashMessage::ERROR_MESSAGE,
                'il reste des erreurs à corriger'
            ); 
         }
         } 
        $page = $paginator->getPage();
       
        $contentFile = $paginator->getItemListContent($contentFileRepository, $page, $slug);
        
        $nbPages = $paginator->countPage($contentFile);
        
        return $this->render('blog/article/show.html.twig', [
            'contentFile' => $contentFile,
            'nbPages' => $nbPages,
            'page' => $page,
        ]);
    }

    private function save($data) {
        $key = array_keys($data);
        $entityManager = $this->getDoctrine()->getManager();
        $contentFile = $entityManager
        ->getRepository(ContentFile::class)->find($data['id']);
        foreach ($key as $name) {
            if ($name == 'nomprenom') {
                $contentFile->setNomprenon($data['nomprenom']);
            }
            if ($name == 'codebanque') {
                $contentFile->setCodebancque($data['codebanque']);
            }
            if ($name == 'codeguichet') {
                $contentFile->setCodeguichet($data['codeguichet']);
            }
            if ($name == 'numcompte') {
                $contentFile->setNumcompte($data['numcompte']);
            }
            if ($name == 'montant') {
                $contentFile->setMontant($data['montant']);
            }
            if ($name == 'motif') {
                $contentFile->setMotif($data['motif']);
            }
        }
        $entityManager->flush();
        return $contentFile;
    }

    /**
     * @Route("article/edit/{line}", name="file_edit", methods={"GET", "POST"})
     */
    public function editLineFile(ContentFile $line,  ContentFileRepository $contentFileRepository): Response
    {
    
        return $this->render('blog/article/editFile.html.twig', [
            'contentFile' => $line,
        ]);
    }
     

    /**
     * @Route("article/{slug}/comment/new", name="comment_new", methods={"POST"})
     */
    public function newComment(Request $request, Article $article): Response
    {
        $comment = new Comment();
        $form = $this->createForm(CommentType::class, $comment);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $user = $this->getUser();
            $article->addComment($comment);
            $user->addComment($comment);

            $em->persist($comment);
            $em->flush();
        }

        return $this->redirectToRoute('article_show', ['slug' => $article->getSlug()]);
    }

    /**
     * @ParamConverter()
     */
    public function commentForm(Article $article): Response
    {
        $form = $this->createForm(CommentType::class);

        return $this->render('blog/article/_comment_form.html.twig', [
            'form' => $form->createView(),
            'article' => $article,
        ]);
    }

    /**
     * @Route("/switch-locale/{locale}", name="switch_locale", methods={"GET"})
     */
    public function switchLocale(Request $request, string $locale)
    {
        $request->getSession()->set('locale', $locale);

        return $this->redirectToRoute('homepage');
    }

    /**
     * @Route("article/generateAFB/{slug}", name="afb", methods={"GET", "POST"})
     */
    public function generateafb(Image $slug, Request $request, ContentFileRepository $contentFileRepository): Response
    {
        $data = $request->request->all();
        if(!empty($data)) {
            $file = $this->generateFileAfb($data, $slug);
            $filegenrated = $this->getParameter('kernel.project_dir')."/files/". $file;
            var_dump($filegenrated);
            return $this->render('blog/article/afb.html.twig', [
                'slug' => $slug,
                'filegenrated' => $filegenrated
            ]);
            
        }
         
        return $this->render('blog/article/afb.html.twig', [
            'slug' => $slug,
             
        ]);
    }

    private function generateFileAfb($data, $slug) {
        $key = array_keys($data);
        foreach ($key as $name) {
            if ($name == 'entete') {
                $entete = $data['entete'];
            }
            if ($name == 'numservice') {
                $num_service = $data['numservice'];
            }
            if ($name == 'nomentreprise') {
                $nom_entreprise = $data['nomentreprise'];
            }
            if ($name == 'devise') {
                $devise = $data['devise'];
            } 
            if ($name == 'numcompteentreprise') {
                $numcompteEntreprise = $data['numcompteentreprise'];
            } 
            if ($name == 'codeagence') {
                $codeagence = $data['codeagence'];
            } 
            if ($name == 'codebanque') {
                $codebanque = $data['codebanque'];
            } 
        } 
        $entityManager = $this->getDoctrine()->getManager();
        $contentFile = $entityManager
        ->getRepository(ContentFile::class)->findBy(
            ['image' => $slug->getId()]
        );
       

        $now = new DateTime();
        $current = $now->format('Y-m-d H:i:s');
        $handle = fopen($current.".txt", "w");
        $line = "";
        $j = date("j");
        $m = date("n");
        $y = substr(date("Y"), -1);
        $line = $line.str_pad($entete,12).str_pad($num_service,10).str_pad($j.$m.$y.$nom_entreprise,24).str_pad("0000000",33).str_pad($devise,7).str_pad($codeagence.$numcompteEntreprise,64).$codebanque.PHP_EOL;
        
        
        $i = 1;
        $montantTotal = 0;
        foreach($contentFile as $object) {
            $line = $line.str_pad("0602",12)."00000600000000000".$i.str_pad($object->getNomprenon(),24).str_pad($object->getNombanque(),32).str_pad($object->getCodeguichet().$object->getNumcompte()."0000000000".$object->getMontant().$object->getMotif(),63).$object->getCodebancque().PHP_EOL;
            $montantTotal += $object->getMontant();
            $i++;
        }
        $line = $line.str_pad("0802",12).str_pad("0602",80)."0000000000".$montantTotal;
        fwrite($handle, $line);
        file_put_contents($this->getParameter('kernel.project_dir')."/files/".$current.'.txt', $line);
        fclose($handle);
        
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename='.basename($current.'.txt'));
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($current.'.txt'));
        readfile($current.'.txt');
        $file =  $current.'.txt';
        return $file;
        //var_dump($contentFile);

    }
}
