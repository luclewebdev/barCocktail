<?php

namespace App\Controller;

use App\Entity\Cocktail;
use App\Entity\Comment;
use App\Form\CocktailType;
use App\Form\CommentType;
use App\Repository\CocktailRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CocktailController extends AbstractController
{
    #[Route('/cocktail', name: 'app_cocktail')]
    public function index(CocktailRepository $cocktailRepository): Response
    {


        return $this->render('cocktail/index.html.twig', [
            'cocktails' => $cocktailRepository->findAll()
        ]);
    }

#[Route('/cocktail/show/{id}', name:'cocktail_show')]
public function show(Cocktail $cocktail){
    $comment = new Comment();
    $commentForm = $this->createForm(CommentType::class, $comment);
        return $this->render('cocktail/show.html.twig', [
            "cocktail"=>$cocktail,
            'commentForm'=>$commentForm->createView()
        ]);
}


#[Route('/cocktail/create', name:'create_cocktail')]
#[Route('/cocktail/edit/{id}', name:'edit_cocktail')]

public function create(Cocktail $cocktail =null,Request $request, EntityManagerInterface $manager){

        if(!$this->getUser()){return $this->redirectToRoute('app_cocktail');}

        if(!$cocktail){
            $cocktail = new Cocktail();

        }


        $form = $this->createForm(CocktailType::class, $cocktail);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            $cocktail->setAuthor($this->getUser());
            $manager->persist($cocktail);
            $manager->flush();
            return $this->redirectToRoute('app_cocktail');

        }


        return $this->render('cocktail/create.html.twig', [
            "form"=> $form->createView()
        ]);
}

#[Route('/cocktail/delete/{id}', name:'delete_cocktail')]
public function delete(Cocktail $cocktail, EntityManagerInterface $manager)
{

    $manager->remove($cocktail);
    $manager->flush();
    return $this->redirectToRoute('app_cocktail');

}


}
