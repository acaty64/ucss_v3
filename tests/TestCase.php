<?php
use App\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;

abstract class TestCase extends Illuminate\Foundation\Testing\TestCase
{
    use DatabaseTransactions;
    /**
     * The base URL to use while testing the application.
     *
     * @var string
     */
    protected $baseUrl = 'http://localhost';

    protected $defaultUser;
    /**
     * Creates the application.
     *
     * @return \Illuminate\Foundation\Application
     */
    public function createApplication()
    {
        $app = require __DIR__.'/../bootstrap/app.php';

        $app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

        return $app;
    }

    public function defaultUser(array $attributes = [])
    {
        if($this->defaultUser){
            return $this->defaultUser;
        }
        return $this->defaultUser = factory(User::class)->create($attributes);
    }
}
