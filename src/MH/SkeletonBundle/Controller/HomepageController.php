<?php
namespace MH\SkeletonBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class HomepageController extends Controller
{
    public function indexAction()
    {
        return $this->render('MHSkeletonBundle:Homepage:index.html.twig');
    }
}
