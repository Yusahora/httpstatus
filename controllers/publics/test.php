<?php
namespace controllers\publics;

use \controllers\internals\test as Internaltest;

class test extends \Controller
{
    public function __construct (\PDO $pdo)
    {
        parent::__construct($pdo);
        $this->internal_test = new Internaltest($pdo);
    }

    public function home ()
    {
        $toto = 'Bernard';

        return self::render('test/home', [
            'prenom' => $toto,
        ]);
    }

    public function minify ()
    {
        $url = $_POST['url'] ?? false;

        if (!$url || !filter_var($url, FILTER_VALIDATE_URL))
        {
            return $this->render('test/minify', ['success' => false]);
        }

        $uid = $this->internal_test->minify($url);

        if (!$uid)
        {
            return $this->render('test/minify', ['success' => false]);
        }

        return $this->render('test/minify', ['success' => true, 'url' => $url, 'uid' => $uid]);
    }

    public function develop (string $uid)
    {   
        $url = $this->internal_test->develop($uid);

        if (!$url)
        {
            return $this->render('test/develop', ['success' => false]);
        }

        header('Location: ' . $url);
        return false;
    }
}