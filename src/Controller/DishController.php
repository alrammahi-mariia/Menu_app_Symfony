<?php

namespace App\Controller;

use App\Entity\Dish;
use App\Form\DishType;
use App\Repository\DishRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/dish', name: 'dish.')]
class DishController extends AbstractController
{
    #[Route('/', name: 'edit')]
    public function index(DishRepository $ds): Response
    {
        $dishes = $ds->findAll();
        return $this->render('dish/index.html.twig', [
            'dishes' => $dishes
        ]);
    }

    #[Route('/create', name: 'create')]
    public function create(Request $request, ManagerRegistry $doctrine): Response
    {
        
        $dish = new Dish();
        $form = $this->createForm(DishType::class, $dish);
        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            $em = $doctrine->getManager();
            $image = $request->files->get('dish')['upload'];

            if($image){
                $filename = md5(uniqid()). '.'. $image->guessClientExtension();
            }

            $image->move(
                $this->getParameter('images_folder'),
                $filename
            );
            $dish->setImage($filename);
            $em->persist($dish);
            $em->flush();

            return $this->redirect($this->generateUrl('dish.edit'));
        }



        // $dish->setName('Pizza');
       

        return $this->render('dish/create.html.twig', [
            'createForm' => $form->createView()
        ]);

    }

    #[Route('/delete/{id}', name: 'delete')]
    public function delete($id, DishRepository $ds, ManagerRegistry $doctrine): Response
    {
        $em = $doctrine->getManager();
        $dish = $ds->find($id);
        $em->remove($dish);
        $em->flush();

        $this->addFlash('success', 'Dish was successfully deleted');

        return $this->redirect($this->generateUrl('dish.edit'));

    }

    #[Route('/show/{id}', name: 'show')]
    public function show(Dish $dish){

    return $this->render('dish/show.html.twig', [

        'dish' => $dish
            
        ]);
    }


}
