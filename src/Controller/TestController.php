<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TestController extends AbstractController{

    public function hello():Response
    {
        return new Response("<h1>Hello World  <a href='/bye'>Bye</a></h1>");
    }

    /**
     * Dans les projets utilisant une version de php inférieur à 8,
     * on utilise le système d'annotations pour définir la route 
     * utilisée pour charger la méthode
     *
     * @return Response
     * @Route(path="/aurevoir", name="bye", methods={"GET"})
     */
    public function aurevoir():Response
    {
        return new Response("<h1>Au revoir!</h1>");
    }

    /**
     * Avec php8 sont arrivés les attributs qui remplacent
     * les annotations pour définir des informations 
     * telle que la route à utiliser
     * Les attributs sont plus lisibles que les annotations grâce au code couleur
     * de plus, une erreur dans les attributs s'affiche sur l'IDE
     * Les attributs permettent aussi d'avoir la proposition de class à charger
     *
     * @return Response
     */
    #[Route(path:"/message", name:"message", methods:["GET"])]
    public function message():Response
    {
        return new Response("Coucou");
    }

    #[Route("/test", name:"test")]
    public function test ():Response
    {
        return $this->render("test.html.twig", [
            "titre2" => "Titre de la deuxième partie"
        ]);
    }
}

