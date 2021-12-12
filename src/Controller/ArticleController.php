<?php

namespace App\Controller;

//<editor-fold desc="use statements">
use App\Entity\Article;
use App\Repository\ArticleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
//</editor-fold>

#[Route('/articles', name: 'article_')]
class ArticleController extends AbstractController
{
    public function __construct(private ArticleRepository $articleRepository)
    {
    }

    /**
     * Home page.
     *
     * @return Response
     */
    #[Route('/', name: 'homepage')]
    public function index(): Response
    {
        $articles = $this->articleRepository->findBy(
            criteria: ['draft' => false],
            orderBy: ['publicationDate' => 'DESC']
        );

        return $this->render(view: 'article/index.html.twig', parameters: ['articles' => $articles]);
    }


    /**
     * Edit article.
     *
     * @param Article $article The article instance to be edited
     *
     * @return Response Html page containing the article requested
     */
    #[Route('/article/edit/{id}', name: 'edit_article')]
    public function editArticle(Article $article): Response
    {
        // ...
        $this->denyAccessUnlessGranted('edit', $article);

        //<editor-fold desc="//...">
        return $this->render('article/index.html.twig', [
            'article' => $article,
        ]);
        //</editor-fold>
    }

    /**
     * View article.
     *
     * @param Article $article The article instance to be viewed
     *
     * @return Response Html page containing the article requested
     */
    #[Route('/{slug}', name: 'view')]
    public function showArticle(Article $article): Response
    {
        $this->denyAccessUnlessGranted('view', $article);

        //<editor-fold desc="//...">
        return $this->render('article/show.html.twig', [
            'article' => $article,
        ]);
        //</editor-fold>
    }
}
