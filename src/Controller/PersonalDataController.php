<?php


namespace App\Controller;


use App\Entity\PersonalData;
use App\Form\PersonalDataType;
use App\Model\PersonalDataModel;
use App\Service\DataPersister\PersonalDataPersisterInterface;
use App\Service\DataProvider\PersonalDataProviderInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PersonalDataController extends AbstractController
{
    /**
     * @Route("/profile/personal-data", name="personal_data_index")
     * @param PersonalDataProviderInterface $personalDataProvider
     * @return Response
     */
    public function index(PersonalDataProviderInterface $personalDataProvider): Response
    {
        $user = $this->getUser();
        $personalData = $personalDataProvider->getPersonalData($user);

        return $this->render('personal_data/index.html.twig', [
            'personalData' => $personalData
        ]);
    }

    /**
     * @Route("/profile/personal-data/create", name="personal_data_create")
     * @param Request $request
     * @param PersonalDataPersisterInterface $personalDataPersister
     * @return RedirectResponse
     */
    public function create(
        Request $request,
        PersonalDataPersisterInterface $personalDataPersister
    ): Response {
        $form = $this->createForm(PersonalDataType::class, new PersonalDataModel());
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $personalDataPersister->save($form->getData(), $this->getUser());

            return $this->redirectToRoute('personal_data_index');
        }

        return $this->render('personal_data/form.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/profile/personal-data/edit/{personalData}", name="personal_data_edit")
     * @param Request $request
     * @param PersonalData $personalData
     * @param PersonalDataPersisterInterface $personalDataPersister
     * @param PersonalDataProviderInterface $personalDataProvider
     * @return Response
     */
    public function edit(
        Request $request,
        PersonalData $personalData,
        PersonalDataPersisterInterface $personalDataPersister,
        PersonalDataProviderInterface $personalDataProvider
    ): Response {
        $userKey = $request->getSession()->get('userKey');

        if (!$userKey) {
           return $this->redirectToRoute('key_set');
        }

        $model = $personalDataProvider->getPersonalDataModel($personalData, $userKey);
        $form = $this->createForm(PersonalDataType::class, $model);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $personalDataPersister->update($form->getData(), $personalData, $this->getUser());

            return $this->redirectToRoute('personal_data_index');
        }

        return $this->render('personal_data/form.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/profile/personal-data/delete/{personalData}", name="personal_data_delete")
     * @param PersonalData $personalData
     * @param PersonalDataPersisterInterface $personalDataPersister
     * @return RedirectResponse
     */
    public function delete(
        PersonalData $personalData,
        PersonalDataPersisterInterface $personalDataPersister
    ): RedirectResponse {
        $personalDataPersister->remove($personalData);

        return $this->redirectToRoute('personal_data_index');
    }
}