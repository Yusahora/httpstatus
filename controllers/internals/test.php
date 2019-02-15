<?php
namespace controllers\internals;

use \models\test as Modeltest;

class test extends \InternalController
{
    public function __construct (\PDO $pdo)
    {
        $this->model_test = new Modeltest($pdo);
    }

    public function minify (string $url)
    {   
        $test = $this->model_test->get_one_by_url($url);

        if ($test)
        {
            return $test['uid'];
        }

        $uid = str_replace('=', '', strtr(base64_encode(random_bytes(4)), '+/', '-_'));

        $this->model_test->create($url, $uid, new \DateTime());
        return $uid;
    }

    public function develop ($uid) : ?string
    {   
        $test = $this->model_test->get_one_by_uid($uid);

        if (!$test)
        {
            return null;
        }

        $test['last_click'] = new \DateTime();

        $this->model_test->modify(
            $test['id'], 
            $test['url'], 
            $test['uid'], 
            $test['last_click']
        );

        return $test['url'];
    }


    public function delete_olds_tests ()
    {
        $date_limit = new \DateTime();
        $date_limit = $date_limit->sub(new \DateInterval('P1D'));

        $tests = $this->model_test->get_by_last_click_before($date_limit);

        foreach ($tests as $test)
        {
            echo "Remove " . $test['uid'] . "...";
            
            $result = $this->model_test->remove($test['id']);

            if ($result)
            {
                echo "ok";
            }
            else
            {
                echo "ko";
            }

            echo "\n";
        }
    }
}
