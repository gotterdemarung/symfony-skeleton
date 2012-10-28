<?php
namespace MH\SkeletonBundle\Menu;

use Knp\Menu\FactoryInterface;
use Symfony\Component\DependencyInjection\ContainerAware;

class NavBarBuilder extends ContainerAware
{
    public function leftMenu(FactoryInterface $factory, array $options)
    {
        $menu = $factory->createItem('root');

        $menu->setChildrenAttribute('class', 'nav');
        $menu->addChild('homepage', ['route' => 'homepage']);

        return $menu;
    }

    public function rightMenu(FactoryInterface $factory, array $options)
    {
        $menu = $factory->createItem('root');

        $menu->setChildrenAttribute('class', 'dropdown-menu');

        if ($this->container->get('security.context')->isGranted('IS_AUTHENTICATED_FULLY')) {
            $menu->addChild('profile.settings', ['route' => 'fos_user_profile_edit']);
            $menu->addChild('profile.change_password', ['route' => 'fos_user_change_password']);
            $menu->addChild('logout', ['route' => 'fos_user_security_logout']);
        } else {
            $menu->addChild('login', ['route' => 'fos_user_security_login']);
            $menu->addChild('register', ['route' => 'fos_user_registration_register']);
        }

        return $menu;
    }
}
