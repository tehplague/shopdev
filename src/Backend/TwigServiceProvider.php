<?php

namespace Jtl\Shop4\Backend;

use Silex\Application;
use Silex\ServiceProviderInterface;
use Symfony\Bridge\Twig\Extension\RoutingExtension;
use Symfony\Bridge\Twig\Extension\TranslationExtension;
use Symfony\Bridge\Twig\Extension\FormExtension;
use Symfony\Bridge\Twig\Extension\SecurityExtension;
use Symfony\Bridge\Twig\Extension\HttpKernelExtension;
use Symfony\Bridge\Twig\Form\TwigRendererEngine;
use Symfony\Bridge\Twig\Form\TwigRenderer;

/**
 * Specialized Twig service provider tailored to the needs of the Shop4 backend
 *
 * @author Christian Spoo <christian.spoo@jtl-software.com>
 */
class TwigServiceProvider implements ServiceProviderInterface
{
    public function register(Application $app)
    {
        $app['backend.twig.options'] = array();
        $app['backend.twig.form.templates'] = array('form_div_layout.html.twig');
        $app['backend.twig.path'] = array(
            APP_ROOT . '/templates/backend/default'
        );
        $app['backend.twig.templates'] = array();

        $app['backend.twig'] = function ($app) {
            $app['backend.twig.options'] = array_replace(
                array(
                    'charset'          => isset($app['charset']) ? $app['charset'] : 'UTF-8',
                    'debug'            => isset($app['debug']) ? $app['debug'] : false,
                    'strict_variables' => isset($app['debug']) ? $app['debug'] : false,
                ), $app['backend.twig.options']
            );

            $twig = $app['backend.twig.environment_factory']($app);
            $twig->addGlobal('app', $app);

            if (isset($app['debug']) && $app['debug']) {
                $twig->addExtension(new \Twig_Extension_Debug());
            }

            if (class_exists('Symfony\Bridge\Twig\Extension\RoutingExtension')) {
                if (isset($app['url_generator'])) {
                    $twig->addExtension(new RoutingExtension($app['url_generator']));
                }

                if (isset($app['translator'])) {
                    $twig->addExtension(new TranslationExtension($app['translator']));
                }

                if (isset($app['security'])) {
                    $twig->addExtension(new SecurityExtension($app['security']));
                }

                if (isset($app['fragment.handler'])) {
                    $app['fragment.renderer.hinclude']->setTemplating($twig);

                    $twig->addExtension(new HttpKernelExtension($app['fragment.handler']));
                }

                if (isset($app['form.factory'])) {
                    $app['backend.twig.form.engine'] = function ($app) {
                        return new TwigRendererEngine($app['backend.twig.form.templates']);
                    };

                    $app['backend.twig.form.renderer'] = function ($app) {
                        return new TwigRenderer($app['backend.twig.form.engine'], $app['form.csrf_provider']);
                    };

                    $twig->addExtension(new FormExtension($app['backend.twig.form.renderer']));

                    // add loader for Symfony built-in form templates
                    $reflected = new \ReflectionClass('Symfony\Bridge\Twig\Extension\FormExtension');
                    $path = dirname($reflected->getFileName()).'/../Resources/views/Form';
                    $app['backend.twig.loader']->addLoader(new \Twig_Loader_Filesystem($path));
                }
            }

            return $twig;
        };

        $app['backend.twig.loader.filesystem'] = function ($app) {
            return new \Twig_Loader_Filesystem($app['backend.twig.path']);
        };

        $app['backend.twig.loader.array'] = function ($app) {
            return new \Twig_Loader_Array($app['backend.twig.templates']);
        };

        $app['backend.twig.loader'] = function ($app) {
            return new \Twig_Loader_Chain(array(
                $app['backend.twig.loader.array'],
                $app['backend.twig.loader.filesystem'],
            ));
        };

        $app['backend.twig.environment_factory'] = $app->protect(function ($app) {
            return new \Twig_Environment($app['backend.twig.loader'], $app['backend.twig.options']);
        });
    }

    public function boot(Application $app)
    {
    }
}
