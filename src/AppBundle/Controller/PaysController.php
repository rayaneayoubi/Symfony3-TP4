<?php

namespace AppBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\EventDispatcher\Event;
use AppBundle\Entity\Pays;
/**
 * @Route("/pays")
 */
class PaysController extends Controller
{
    /**
     * @Route("/add",name="pays_add")
     */
    public function addAction(Request $request)
    {
            $pays= new Pays();
            $forma = $this->createFormBuilder($pays)
            ->add('name',TextType::class,array())
            // ->add('producers',EntityType::class,array(
            //   'class' => 'AppBundle:Producers',
            //   'choice_label'=> 'name',
            // ))
            ->add('submit',SubmitType::class,array(
              'label'=> 'Add Country'
            ))
            ->getForm();
           $forma->handleRequest($request);
           if ($forma->isSubmitted()) {
             $pays = $forma->getData();
             $em = $this->getDoctrine()->getManager();
             $em->persist($pays);
             $em->flush();
             return $this->redirectToRoute('pays_index');
           }
       return $this->render('AppBundle:Pays:add.html.twig', array(
           'forma'=>$forma->createView()
        ));
    }

    /**
     * @Route("/delete/{id}",name="pays_delete")
     */
    public function deleteAction($id)
    {
      $pays = $this->getDoctrine()->getRepository(Pays::class)->find($id);
      $em = $this->getDoctrine()->getManager();
      $em->remove($pays);
      $em->flush();
      return $this->redirectToRoute('pays_index');
    }

    /**
     * @Route("/index",name="pays_index")
     */
    public function indexAction()
    {   $pays=$this->getDoctrine()->getRepository(Pays::class)->findAll();
      return $this->render('AppBundle:Pays:index.html.twig', array(
          'pays'=>$pays
      ));
    }

}
