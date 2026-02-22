<?php
// app/core/Router.php
// Gestion des routes

class Router {

    private $routes = [];

    // Ajouter une route
    public function add($methode, $url, $controller, $action) {
        // Convertit les paramètres dynamiques {id} en regex
        $pattern = preg_replace('/\{[a-z]+\}/', '([^/]+)', $url);
        $pattern = '#^' . $pattern . '$#';

        $this->routes[] = [
            'methode'    => strtoupper($methode),
            'url'        => $url,
            'pattern'    => $pattern,
            'controller' => $controller,
            'action'     => $action
        ];
    }

    // Lancer le routage
    public function run($uri, $methode) {
        // Nettoyer l'URI
        $uri = '/' . trim(strtok($uri, '?'), '/');

        foreach ($this->routes as $route) {
            if ($route['methode'] !== strtoupper($methode)) {
                continue;
            }

            if (preg_match($route['pattern'], $uri, $matches)) {
                // Enlever le premier match (l'URL complète)
                array_shift($matches);

                $fichierController = ROOT_PATH . '/app/controllers/' . $route['controller'] . '.php';
                require_once $fichierController;

                $ctrl = new $route['controller']();
                call_user_func_array([$ctrl, $route['action']], $matches);
                return;
            }
        }

        // 404 - Page introuvable
        http_response_code(404);
        require ROOT_PATH . '/app/views/site/404.php';
    }
}
