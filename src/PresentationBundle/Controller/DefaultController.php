<?php

namespace PresentationBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('@Profile/Default/index.html.twig');
    }
    
    public function checkWindowPropertiesAction (Request $request)
    {
        if ($request->isXMLHttpRequest()) {
            $em = $this->getDoctrine()->getManager();

            if (isset($_SESSION['loginSession'])) {
                $userId = $_SESSION['loginSession'];
                
                

                $window = $em->createQuery(
                    "SELECT w.windowId, w.windowVideospeed, w.windowGeolocalization, 
                    w.windowVolume, w.windowVideosize, w.windowConfigurationareasize, 
                    w.windowCurrentvideo, w.windowCurrentlist, w.windowReplay, 
                    w.windowThemeconfigurationarea, w.windowThemesessionarea, 
                    w.windowThemepresentationarea, w.windowThemecolor, 
                    u.userId 

                    FROM HomeBundle:Window w 
                    JOIN HomeBundle:User u 

                    WITH u.userId = w.user 
                    WHERE u.userId = '$userId'"
                );

                $window_e = $window->getResult();
            
                if (isset($window_e[0]['windowId']))
                {
                    $windowId_value = $window_e[0]['windowId'];
                    $windowVideospeed_value = $window_e[0]['windowVideospeed'];
                    $windowGeolocalization_value = $window_e[0]['windowGeolocalization'];
                    $windowVolume_value = $window_e[0]['windowVolume'];
                    $windowVideosize_value = $window_e[0]['windowVideosize'];
                    $windowConfigurationareasize_value = $window_e[0]['windowConfigurationareasize'];
                    $windowCurrentvideo_value = $window_e[0]['windowCurrentvideo'];
                    $windowCurrentlist_value = $window_e[0]['windowCurrentlist'];
                    $windowReplay_value = $window_e[0]['windowReplay'];
                    $windowThemeconfigurationarea_value = $window_e[0]['windowThemeconfigurationarea'];
                    $windowThemesessionarea_value = $window_e[0]['windowThemesessionarea'];
                    $windowThemepresentationarea_value = $window_e[0]['windowThemepresentationarea'];
                    $windowThemecolor_value = $window_e[0]['windowThemecolor'];
                    $userId_value = $window_e[0]['userId'];

                } else 
                {
                    $windowId_value = 0;
                    $windowVideospeed_value = 0;
                    $windowGeolocalization_value = "";
                    $windowVolume_value = 0;
                    $windowVideosize_value = 0;
                    $windowConfigurationareasize_value = 0;
                    $windowCurrentvideo_value = 0;
                    $windowCurrentlist_value = 0;
                    $windowReplay_value = 0;
                    $windowThemeconfigurationarea_value = 0;
                    $windowThemesessionarea_value = 0;
                    $windowThemepresentationarea_value = 0;
                    $windowThemecolor_value = 0;
                    $userId_value = 0;
                }

                $window_properties = array();
                $window_properties[0] = array(
                    'windowId' => $windowId_value,
                    'windowVideospeed' => $windowVideospeed_value,
                    'windowGeolocalization' => $windowGeolocalization_value,
                    'windowVolume' => $windowVolume_value,
                    'windowVideosize' => $windowVideosize_value,
                    'windowConfigurationareasize' => $windowConfigurationareasize_value,
                    'windowCurrentvideo' => $windowCurrentvideo_value,
                    'windowCurrentlist' => $windowCurrentlist_value,
                    'windowReplay' => $windowReplay_value,
                    'windowThemeconfigurationarea' => $windowThemeconfigurationarea_value,
                    'windowThemesessionarea' => $windowThemesessionarea_value,
                    'windowThemepresentationarea' => $windowThemepresentationarea_value,
                    'windowThemecolor' => $windowThemecolor_value,
                    'userId' => $userId_value
                );
            }
            else {
                // en caso de que no exista una sesión
                $window_properties = array();
                $window_properties[0] = array(
                    'windowId' => 0,
                    'windowVideospeed' => 0,
                    'windowGeolocalization' => "",
                    'windowVolume' => 0,
                    'windowVideosize' => 0,
                    'windowConfigurationareasize' => 0,
                    'windowCurrentvideo' => 0,
                    'windowCurrentlist' => 0,
                    'windowReplay' => 0,
                    'windowThemeconfigurationarea' => 0,
                    'windowThemesessionarea' => 0,
                    'windowThemepresentationarea' => 0,
                    'windowThemecolor' => 0,
                    'userId' => 0
                );
            }
            return new Response(json_encode($window_properties), 200, array('Content-Type' => 'application/json'));
        }
    }
    
    public function getWindowPropertiesAction (Request $request)
    {
        $user_name = $_POST['user_name'];
        $user_password = $_POST['user_password'];
        
        if ($request->isXMLHttpRequest()) {

            $em = $this->getDoctrine()->getManager();
            
            $window = $em->createQuery(
                "SELECT w.windowId, w.windowVideospeed, w.windowGeolocalization, 
                w.windowVolume, w.windowVideosize, w.windowConfigurationareasize, 
                w.windowCurrentvideo, w.windowCurrentlist, w.windowReplay, 
                w.windowThemeconfigurationarea, w.windowThemesessionarea, 
                w.windowThemepresentationarea, w.windowThemecolor, 
                u.userId 

                FROM HomeBundle:Window w 
                JOIN HomeBundle:User u 
                
                WITH u.userId = w.user 
                WHERE u.userName = '$user_name' and u.userPassword = '$user_password'"
            );

            $window_e = $window->getResult();
            
            
            if (isset($window_e[0]['windowId']))
            {
                $windowId_value = $window_e[0]['windowId'];
                $windowVideospeed_value = $window_e[0]['windowVideospeed'];
                $windowGeolocalization_value = $window_e[0]['windowGeolocalization'];
                $windowVolume_value = $window_e[0]['windowVolume'];
                $windowVideosize_value = $window_e[0]['windowVideosize'];
                $windowConfigurationareasize_value = $window_e[0]['windowConfigurationareasize'];
                $windowCurrentvideo_value = $window_e[0]['windowCurrentvideo'];
                $windowCurrentlist_value = $window_e[0]['windowCurrentlist'];
                $windowReplay_value = $window_e[0]['windowReplay'];
                $windowThemeconfigurationarea_value = $window_e[0]['windowThemeconfigurationarea'];
                $windowThemesessionarea_value = $window_e[0]['windowThemesessionarea'];
                $windowThemepresentationarea_value = $window_e[0]['windowThemepresentationarea'];
                $windowThemecolor_value = $window_e[0]['windowThemecolor'];
                $userId_value = $window_e[0]['userId'];

            } else 
            {
                $windowId_value = 0;
                $windowVideospeed_value = 0;
                $windowGeolocalization_value = "";
                $windowVolume_value = 0;
                $windowVideosize_value = 0;
                $windowConfigurationareasize_value = 0;
                $windowCurrentvideo_value = 0;
                $windowCurrentlist_value = 0;
                $windowReplay_value = 0;
                $windowThemeconfigurationarea_value = 0;
                $windowThemesessionarea_value = 0;
                $windowThemepresentationarea_value = 0;
                $windowThemecolor_value = 0;
                $userId_value = 0;
            }
            
            $window_properties = array();
            $window_properties[0] = array(
                'windowId' => $windowId_value,
                'windowVideospeed' => $windowVideospeed_value,
                'windowGeolocalization' => $windowGeolocalization_value,
                'windowVolume' => $windowVolume_value,
                'windowVideosize' => $windowVideosize_value,
                'windowConfigurationareasize' => $windowConfigurationareasize_value,
                'windowCurrentvideo' => $windowCurrentvideo_value,
                'windowCurrentlist' => $windowCurrentlist_value,
                'windowReplay' => $windowReplay_value,
                'windowThemeconfigurationarea' => $windowThemeconfigurationarea_value,
                'windowThemesessionarea' => $windowThemesessionarea_value,
                'windowThemepresentationarea' => $windowThemepresentationarea_value,
                'windowThemecolor' => $windowThemecolor_value,
                'userId' => $userId_value
            );
            return new Response(json_encode($window_properties), 200, array('Content-Type' => 'application/json'));
        }
    }
    
    public function setWindowPropertiesAction (Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        
        $windowVideospeed = $_POST['windowVideospeed'];
        $windowGeolocalization = $_POST['windowGeolocalization'];
        $windowVolume = $_POST['windowVolume'];
        $windowVideosize = $_POST['windowVideosize'];
        $windowConfigurationareasize = $_POST['windowConfigurationareasize'];
        $windowCurrentvideo = $_POST['windowCurrentvideo'];
        $windowCurrentlist = $_POST['windowCurrentlist'];
        $windowReplay = $_POST['windowReplay'];
        $windowThemeconfigurationarea = $_POST['windowThemeconfigurationarea'];
        $windowThemesessionarea = $_POST['windowThemesessionarea'];
        $windowThemepresentationarea = $_POST['windowThemepresentationarea'];
        $windowThemecolor = $_POST['windowThemecolor'];
        $userId = $_POST['userId'];
        
        $windowId = $this->getWindowId_value($em, $userId);
            
        
        if ($request->isXMLHttpRequest()) {

            if ($userId == 0)
            {
            } else 
            {
                if ($windowId == 0)
                {
                    $user = $em->getRepository('HomeBundle:User')->findOneByUserId($userId);
                    $window = new \HomeBundle\Entity\Window();
                } else {
                    $user = $em->getRepository('HomeBundle:User')->findOneByUserId($userId);
                    $window = $em->getRepository('HomeBundle:Window')->findOneByWindowId($windowId);
                }
            }
            
            if ($userId == 0)
            {
            } else
            {
                $window->setWindowVideospeed($windowVideospeed);
                $window->setWindowGeolocalization($windowGeolocalization);
                $window->setWindowVolume($windowVolume);
                $window->setWindowVideosize($windowVideosize);
                $window->setWindowConfigurationareasize($windowConfigurationareasize);
                $window->setWindowCurrentvideo($windowCurrentvideo);
                $window->setWindowCurrentlist($windowCurrentlist);
                $window->setWindowReplay($windowReplay);
                $window->setWindowThemeconfigurationarea($windowThemeconfigurationarea);
                $window->setWindowThemesessionarea($windowThemesessionarea);
                $window->setWindowThemepresentationarea($windowThemepresentationarea);
                $window->setWindowThemecolor($windowThemecolor);
                $window->setUser($user);

                $em->persist($window);
                $em->flush();
            }
            
            $users2 = array();
            $users2[0] = array(
                'windowId' => "_"
            );
            return new Response(json_encode($users2), 200, array('Content-Type' => 'application/json'));
        }
    }
    
    function getWindowId_value($em, $userId)
    {
        $window = $em->createQuery(
            "SELECT w.windowId 

            FROM HomeBundle:Window w 
            JOIN HomeBundle:User u 

            WITH u.userId = w.user 
            WHERE u.userId = '$userId'"
        );

        $window_e = $window->getResult();
                
        if (isset($window_e[0]['windowId']))
        {
            $windowId_value = $window_e[0]['windowId'];
        } else {
            // valores por defecto
            $windowId_value = 0;
        }
        return $windowId_value;
    }
    
}
