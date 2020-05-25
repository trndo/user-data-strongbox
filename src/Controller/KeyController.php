<?php


namespace App\Controller;


use App\Form\KeyType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class KeyController extends AbstractController
{
    /**
     * @Route("/profile/personal-data/set-key", name="key_set")
     * @param Request $request
     * @return Response
     */
    public function setKey(Request $request): Response
    {
        $form = $this->createForm(KeyType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $key = $form->getData();
            $session = $request->getSession();

            $session->set('userKey', $key);

            return $this->redirect(
                $request->headers->get('referer')
            );
        }

        return $this->render('key/form.html.twig');
    }
}