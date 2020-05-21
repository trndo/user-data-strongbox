<?php


namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProfileController extends AbstractController
{
    /**
     * Index user profile
     *
     * @Route("/profile", name="profile_index")
     * @return Response
     */
    public function index(): Response
    {
        return new Response('My profile');
    }
}