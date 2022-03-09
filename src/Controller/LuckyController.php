<?php

namespace App\Controller;

use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class LuckyController extends AbstractController
{
    /**
     * @Route("/lucky/number", name="app_lucky_number")
     */
    public function number()
    {
        $number = random_int(0, 100);

        return $this->render(
            'lucky/number.html.twig',
            [
                'number' => $number
            ]
        );
    }

    /**
     * @Route("/time/now", name="app_time_now")
     */
    public function timeNow()
    {
        $date = new DateTime();

        return $this->render(
            'lucky/time.html.twig',
            [
                'date' => $date
            ]
        );
    }

    /**
     * @Route("/color/{color}", name="app_color")
     */
    public function color($color)
    {

        return $this->render(
            'lucky/color.html.twig',
            [
                'couleur' => $color
            ]
        );
    }

    /**
     * @Route("/request", name="app_request")
     */
    public function mesinfos(Request $request)
    {
        return $this->render('lucky/request.html.twig', [
            'request' => $request
        ]);
    }

    /**
     * @Route("/page", defaults={"page": "nopage"}, name="blog_index")
     * @Route("/page/{page}", name="blog_index")
     */
    public function indexAction($page)
    {
        echo $page;

        return $this->redirectToRoute('route_redirection');
    }
}
