<?php

namespace Framework\Render;



class TwigRender implements RenderInterface
{

    private $twig;
    private $loader;

    public function __construct(string $path)
    {
        $this->loader = new \Twig_Loader_Filesystem($path);
        $this->twig = new \Twig_Environment($this->loader, array('debug' => true));
        $this->twig->addExtension(new \Twig_Extension_Debug());
    }

    /**
     * @param string $namespace
     * @param null|string $path
     * @throws \Twig_Error_Loader
     */
    public function addPath(string $namespace, ?string $path = null): void
    {
        $this->loader->addPath($path, $namespace);
    }


    /**
     * @param string $view
     * @param array $params
     * @param string $type
     *
     * @return string
     *
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function render(string $view, array $params = null, $type = 'html')
    {
        if (isset($_SESSION['flash'])) {
            $params['__flash'] = $_SESSION['flash'];
            unset($_SESSION['flash']);
        }

        $params['__session'] = $_SESSION;
        $params['__auth'] = $_SESSION['auth'] ?? null;
        $params['__csrf'] = $_SESSION['__csrf'] ?? null;
        $params['__page'] = $view.".{$type}.twig";

     return $this->twig->render($view.".{$type}.twig", $params);
    }


    /**
     * @param string $key
     * @param $value
     */
    public function addGlobal(string $key, $value): void
    {
        $this->twig->addGlobal($key, $value);
    }
}
