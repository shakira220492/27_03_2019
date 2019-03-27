<?php

namespace SongBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('@Song/Default/index.html.twig');
    }
    
    public function increaseAmountViewsAction(Request $request)
    {
        $current_video_id = $_POST['current_video_id'];
        
        if ($request->isXMLHttpRequest()) {
            $em = $this->getDoctrine()->getManager();
            
            $video = $em->getRepository('HomeBundle:Video')->findOneByVideoId($current_video_id);
            $current_video_amount_views = $video->getVideoAmountViews();
            $new_video_amount_views = $current_video_amount_views + 1;
            $video->setVideoAmountViews($new_video_amount_views);
            $em->persist($video);
            $em->flush();
            
            $users2 = array();
            $users2[0] = array(
                'current_video_amount_views' => $current_video_amount_views
            );
            return new Response(json_encode($users2), 200, array('Content-Type' => 'application/json'));
        }
    }
}
