<?php
namespace MH\SkeletonBundle\Composer;

use Composer\Script\CommandEvent;

class ScriptHandler
{
    public static function touchParametersLocal(CommandEvent $event)
    {
        $options = self::getOptions($event);
        $appDir = $options['symfony-app-dir'];

        $parametersLocalFilename = 'parameters_local.yml';

        if (!is_dir($appDir)) {
            echo 'The symfony-app-dir ('.$appDir.') specified in composer.json was not found in '.getcwd().', can not create ' . $parametersLocalFilename . PHP_EOL;

            return 1;
        }

        touch($appDir . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . $parametersLocalFilename);
    }

    protected static function getOptions(CommandEvent $event)
    {
        $options = array_merge(array(
            'symfony-app-dir' => 'app'
        ), $event->getComposer()->getPackage()->getExtra());

        return $options;
    }
}
