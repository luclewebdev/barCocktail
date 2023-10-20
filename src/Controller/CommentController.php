<?php

namespace App\Controller;

use App\Entity\Cocktail;
use App\Entity\Comment;
use App\Form\CommentType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CommentController extends AbstractController
{
    #[Route('/comment/{id}', name: 'app_comment')]
    public function add(Cocktail $cocktail, Request $request, EntityManagerInterface $manager): Response
    {
              $comment = new Comment();
              $commentForm = $this->createForm(CommentType::class, $comment);

              $commentForm->handleRequest($commentForm);
              if($commentForm->isSubmitted() && $commentForm->isValid())
              {
                  $comment->setCocktail($cocktail);
                  $comment->setAuthor($this->getUser());
                  $manager->persist($comment);

                  return $this->redirectToRoute('show_cocktail', ['id'=>$cocktail->getId()]);
              }




        return $this->redirectToRoute('app_cocktail');
    }
}
