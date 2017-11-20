<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\EventDispatcher\Event;
use AppBundle\Entity\Producers;
use AppBundle\Entity\Pays;


/**
 * @Route("/producers")
 */
class ProducersController extends Controller
{
    /**
     * @Route("/index",name="producers_index")
     */
    public function indexAction()
    {
         $producers=$this->getDoctrine()->getRepository(Producers::class)->findAll();
        return $this->render('AppBundle:Producers:index.html.twig', array(
            'producers'=>$producers
        ));
    }

    /**
     * @Route("/add",name="producers_add")
     */
    public function addAction(Request $request)
    {       $producers= new Producers();
             $forma = $this->createFormBuilder($producers)
             ->add('name',TextType::class,array())
            ->add('type', CheckboxType::class, array(
              'label'    => 'Private',
               'required' => false ))
               ->add('pays',EntityType::class,array(
                 'class' => 'AppBundle:Pays',
                 'choice_label'=> 'name',
               ))
             ->add('submit',SubmitType::class,array(
               'label'=> 'Add'
             ))
             ->getForm();
            $forma->handleRequest($request);
            if ($forma->isSubmitted()) {
              $producers = $forma->getData();
              $em = $this->getDoctrine()->getManager();
              $em->persist($producers);
              $em->flush();
              return $this->redirectToRoute('producers_index');
            }
        return $this->render('AppBundle:Producers:add.html.twig', array(
            'forma'=>$forma->createView()
         ));
    }

    /**
   * @Route("/delete/{id}", name="producers_delete")
   *
   */
     public function deleteAction($id)
     {
       $producers = $this->getDoctrine()->getRepository(Producers::class)->find($id);
       $em = $this->getDoctrine()->getManager();
       $em->remove($producers);
       $em->flush();
       return $this->redirectToRoute('producers_index');
     }
    /**
     * @Route("/edit/{id}", name="producers_edit")
     */
    public function editAction(Request $request,$id)
    {
      $producers = $this->getDoctrine()->getRepository(Producers::class)->find($id);
      $em = $this->getDoctrine()->getManager();
      if ($request->getMethod() == 'POST') {
      $producers->setName($request->request->get('name'));
      ($request->request->get('type'))
       ? $producers->setType(true)
      : $producers->setType(false);
      $em->flush();
      return $this->redirectToRoute('producers_index');
    }
    return $this->render('AppBundle:Producers:edit.html.twig', array(
      'producers' => $producers
    ));
  }
    }
