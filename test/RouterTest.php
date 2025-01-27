<?php

    use PHPUnit\Framework\TestCase;
    use App\Core\Router;

    /**
     * Classe RouterTest
     *
     * Esta classe contém testes para os métodos da classe Router.
     */
    class RouterTest extends TestCase {
        private $router;

        /**
         * Configuração inicial para cada teste.
         *
         * Este método é chamado antes de cada método de teste.
         */
        protected function setUp(): void {
            $this->router = new Router();
        }

        /**
         * Testa o método addRoute para garantir que uma rota seja adicionada corretamente.
         */
        public function testAddRoute() {
            $handler = function() { echo "Handler executed"; };
            $this->router->addRoute('GET', '/test', $handler);

            $reflection = new \ReflectionClass($this->router);
            $property = $reflection->getProperty('routes');
            $property->setAccessible(true);
            $routes = $property->getValue($this->router);

            $this->assertCount(1, $routes);
            $this->assertEquals('GET', $routes[0]['method']);
            $this->assertEquals('/test', $routes[0]['route']);
            $this->assertSame($handler, $routes[0]['handler']);
        }

        /**
         * Testa o método run para garantir que a rota correspondente seja executada.
         */
        public function testRunWithMatchingRoute() {
            $this->expectOutputString('Handler executed');

            $handler = function() { echo "Handler executed"; };
            $this->router->addRoute('GET', '/test', $handler);

            $_SERVER['REQUEST_METHOD'] = 'GET';
            $_SERVER['REQUEST_URI'] = '/test';

            $this->router->run();
        }

        /**
         * Testa o método run para garantir que a rota correspondente com parâmetros seja executada.
         */
        public function testRunWithMatchingRouteAndParams() {
            $this->expectOutputString('Handler executed with param 123');

            $handler = function($param) { echo "Handler executed with param $param"; };
            $this->router->addRoute('GET', '/test/{id}', $handler);

            $_SERVER['REQUEST_METHOD'] = 'GET';
            $_SERVER['REQUEST_URI'] = '/test/123';

            $this->router->run();
        }

        /**
         * Testa o método run para garantir que uma resposta de erro seja retornada quando a rota não for encontrada.
         */
        public function testRunWithNoMatchingRoute() {
            $this->expectOutputString(json_encode(['error' => 'Route not found']));

            $handler = function() { echo "Handler executed"; };
            $this->router->addRoute('GET', '/test', $handler);

            $_SERVER['REQUEST_METHOD'] = 'GET';
            $_SERVER['REQUEST_URI'] = '/non-existent';

            $this->router->run();
            
            $this->assertEquals(404, http_response_code());
        }
    }
?>
