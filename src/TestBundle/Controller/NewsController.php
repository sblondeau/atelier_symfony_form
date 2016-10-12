<?php

namespace TestBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\Request;
use TestBundle\Entity\News;
use TestBundle\Form\NewsType;

class NewsController extends Controller
{
    /**
     * @Route("/news/add", name="add-news")
     */
    public function indexAction(Request $request)
    {
		$allNews = $this->getDoctrine()
        ->getRepository('TestBundle:News')
        ->findAll();
        		
		$news = new News;
		$form = $this->createForm(NewsType::class, $news);
        
		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid()) {
			 $em = $this->getDoctrine()->getManager();
			 $em->persist($news);
			 $em->flush();

			return $this->redirectToRoute('add-news');        
		}
        
        return $this->render('TestBundle:Default:index.html.twig', array('form' => $form->createView(), 'news'=>$allNews));
    }
    
    /**
     * @Route("/news/update/{id}", name="update-news")
	 * @ParamConverter("news", class="TestBundle:News")
     */
    public function updateAction(News $news, Request $request)
    {
		$allNews = $this->getDoctrine()
        ->getRepository('TestBundle:News')
        ->findAll();
        		
		$form = $this->createForm(NewsType::class, $news);
        
		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid()) {
			 $em = $this->getDoctrine()->getManager();
			 $em->persist($news);
			 $em->flush();

			return $this->redirectToRoute('update-news', array('id'=>$news->getId()));        
		}
        
        return $this->render('TestBundle:Default:index.html.twig', array('form' => $form->createView(), 'news'=>$allNews));
    }    
     /**
     * @Route("/news/delete/{id}", name="news_delete")
	 * @ParamConverter("news", class="TestBundle:News")
	 */
	public function deleteAction(News $news)
    {
		 $em = $this->getDoctrine()->getManager();
		 $em->remove($news);
		 $em->flush();
		$allNews = $this->getDoctrine()
        ->getRepository('TestBundle:News')
        ->findAll();
			return $this->redirectToRoute('add-news');        
		
	}
}
