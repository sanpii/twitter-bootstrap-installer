<?php

namespace Sanpi\TwitterBootstrap\Composer;

use \Composer\Script\CommandEvent;

class ScriptHandler
{
    static public function postInstall(CommandEvent $event)
    {
        self::installBootstrap($event);
    }

    static public function postUpdate(CommandEvent $event)
    {
        self::installBootstrap($event);
    }

    static private function installBootstrap(CommandEvent $event)
    {
        $event->getIO()->write('<info>Generating bootstrap assets</info>');

        $options = self::getOptions($event);
        $webDir = $options['symfony-web-dir'];

        if (!is_dir($webDir)) {
            echo "The symfony-web-dir ($webDir) specified in composer.json was not found in " . getcwd() . ", can not build bootstrap file.\n";

            return;
        }

        $bootstrapDir = "vendor/twitter/bootstrap";

        self::createDirectory("$webDir/css");
        self::createDirectory("$webDir/js");
        self::createDirectory("$webDir/img");

        $lessc = new \Less_Parser();
        $css = $lessc->parseFile("$bootstrapDir/less/bootstrap.less");
        file_put_contents("$webDir/css/bootstrap.css", $css->getCss());

        if (is_file("$bootstrapDir/less/responsive.less")) {
            $css = $lessc->parseFile("$bootstrapDir/less/responsive.less");
            file_put_contents("$webDir/css/bootstrap-responsive.css", $css->getCss());
        }

        foreach (glob("$bootstrapDir/js/*.js") as $src) {
            $dst = "$webDir/js/" . basename($src);
            copy($src, $dst);
        }

        foreach (glob("$bootstrapDir/img/*.png") as $src) {
            $dst = "$webDir/img/" . basename($src);
            copy($src, $dst);
        }
    }

    static private function createDirectory($name)
    {
        if (!is_dir($name)) {
            mkdir($name);
        }
    }

    static protected function getOptions(CommandEvent $event)
    {
        $options = array_merge(array(
            'symfony-web-dir' => 'web',
        ), $event->getComposer()->getPackage()->getExtra());

        return $options;
    }
}
