<?php
// src/Controller/ProgramController.php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\CategoryRepository;
use App\Repository\ProgramRepository;



#[Route('/category', name: 'category_')]
Class CategoryController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(CategoryRepository $categoryRepository): Response
    {
        $categories = $categoryRepository->findAll();
        return $this->render(
            'category/index.html.twig',
            ['categories' => $categories]
        );
   }

   #[Route('/{categoryName}', name: 'show')]
   public function show(string $categoryName, CategoryRepository $categoryRepository, ProgramRepository $programRepository): Response
   {
   
    $categories = $categoryRepository->findOneBy(['name' => $categoryName]);
 
 //   return $this->render('category/show.html.twig', ['seriesByCategories' => '$seriesByCategories']);

    
    if (!$categories) {
      throw $this->createNotFoundException('The category does not exist' .$categoryName);
     }
     $programs = $programRepository->findBy(['category'=>$categories], ['id' => 'DESC'], 3);
 //    $programs = $categoryRepository->findBy(['id' => $categoryName]);

      return $this->render('category/show.html.twig', ['programs' => $programs, 'categories' => $categories]);
   }
}
