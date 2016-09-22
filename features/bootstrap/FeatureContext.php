<?php

use Behat\Behat\Hook\Scope\AfterStepScope;
use Behat\Behat\Tester\Exception\PendingException;
use Behat\Behat\Context\Context;
use Behat\Behat\Context\SnippetAcceptingContext;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;
use Behat\MinkExtension\Context\MinkContext;

use PHPUnit_Framework_Assert as PHPUnit;

use Laracasts\Behat\Context\Migrator;
use Laracasts\Behat\Context\DatabaseTransactions;

use App\Calculator as Calculator;

/**
 * Defines application features from the specific context.
 */
class FeatureContext extends MinkContext implements Context, SnippetAcceptingContext
{
    use Migrator;
    use DatabaseTransactions;

    /**
     * Initializes context.
     *
     * Every scenario gets its own context instance.
     * You can also pass arbitrary arguments to the
     * context constructor through behat.yml.
     */
    public function __construct()
    {
        $this->host = env('APP_HOST');
    }

    public function iShouldBeAbleToDoSomethingWithLaravel()
    {
        $environmentFileName = app()->environmentFile();
        $environmentName = env('APP_ENV');
        PHPUnit::assertEquals('.env.behat', $environmentFileName);
        PHPUnit::assertEquals('testing', $environmentName);

    }

    /**
     * @Given the method :arg1 receives the numbers :arg2 and :arg3
     */
    public function theMethodReceivesTheNumbersAnd($arg1, $arg2, $arg3)
    {
        $this->calculator = new Calculator();
        $this->calculator->$arg1($arg2, $arg3);
    }

    /**
     * @Then the calculated value should be :arg1
     */
    public function theCalculatedValueShouldBe($arg1)
    {
        PHPUnit::assertEquals($arg1, $this->calculator->result());
    }

    /**
     * @Given I call :arg1 :arg2
     */
    public function iCall($arg1, $arg2)
    {

        $client = new \GuzzleHttp\Client();
        $this->response = $client->request($arg1, $this->host . $arg2);
    }

    /**
     * @Then I get a response status code should be :arg1
     */
    public function iGetAResponseStatusCodeShouldBe($arg1)
    {
        PHPUnit::assertEquals($arg1, $this->response->getStatusCode());
    }

    /**
     * @Then the header content type should return json
     */
    public function theHeaderContentTypeShouldReturnJson()
    {
        PHPUnit::assertEquals($this->response->getHeader('Content-Type')[0], 'application/json');
    }


    /**
     * @Then the response contains :arg1 tasks
     */
    public function theResponseContainsTasks($arg1)
    {
        $data = json_decode($this->response->getBody());
        $totalCount = count($data);
        if ($totalCount != $arg1) {
            throw new Exception("Response did not contain at least ". $arg1 ." transaction. Total count: ". $totalCount);
        }
    }
}
