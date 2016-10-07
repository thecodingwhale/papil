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
    protected $taskRepository;
    public $oldTaskCount;

    public function __construct()
    {
        $this->host = env('APP_HOST');
        $this->taskRepository = App::make('Papil\Infrastructure\Repositories\TaskRepository');
    }

    private function isClassHasMethodName($class, $method)
    {
        $oReflectionClass = new ReflectionClass($class);
        PHPUnit::assertTrue($oReflectionClass->hasMethod($method));
    }

    /**
     * @Given I have :arg1 tasks
     */
    public function iHaveTasks($arg1)
    {
        $totalCount = count(json_decode($this->taskRepository->all()));
        $this->oldTaskCount = $totalCount;
        PHPUnit::assertEquals($totalCount, $arg1);
    }

    /**
     * @When I try to access method :methodName
     */
    public function iTryToAccessMethod($methodName)
    {
        $this->isClassHasMethodName($this->taskRepository, $methodName);
    }

    /**
     * @Then it should also return :total tasks
     */
    public function itShouldAlsoReturnTasks($total)
    {
        $totalCount = count(json_decode($this->taskRepository->all()));
        PHPUnit::assertEquals($totalCount, $total);
    }

    /**
     * @Given I have the following task
     */
    public function iHaveTheFollowingTask()
    {
        $this->newTask = [
            'user_id' => 1,
            'text' => 'task',
            'completed' => false
        ];
    }

    /**
     * @When I try to create a task
     */
    public function iTryToCreateATask()
    {
        $this->taskRepository->create($this->newTask);
    }

    /**
     * @Then it should have a method name :methodName
     */
    public function itShouldHaveAMethodName($methodName)
    {
        $this->isClassHasMethodName($this->taskRepository, $methodName);
    }


    /**
     * @Then it should return a :newTaskCount tasks
     */
    public function itShouldReturnATasks($newTaskCount)
    {
        $totalCount = count(json_decode($this->taskRepository->all()));
        PHPUnit::assertEquals($newTaskCount, $totalCount);
    }


    /**
     * @Given I have a task id: :taskId
     */
    public function iHaveATaskId($taskId)
    {
        $this->taskId = $taskId;
    }

    /**
     * @When I try to find a task
     */
    public function iTryToFindATask()
    {
        $this->findTask = $this->taskRepository->find($this->taskId);
    }

    /**
     * @Then it should return a :count task
     */
    public function itShouldReturnATask($count)
    {
        PHPUnit::assertEquals(count($this->findTask), $count);
    }

    /**
     * @When I try to delete a single task form the current tasks.
     */
    public function iTryToDeleteASingleTaskFormTheCurrentTasks()
    {
        $this->isClassHasMethodName($this->taskRepository, "delete");
        $this->taskRepository->delete(1);
    }

    /**
     * @Then the total count should be equal to :total
     */
    public function theTotalCountShouldBeEqualTo($total)
    {
        $totalCount = count(json_decode($this->taskRepository->all()));
        PHPUnit::assertEquals($totalCount, $total);
    }


    /**
     * @Given I have the following task id: :taskId, user_id: :taskUserId, title: :taskTitle and status :taskStatus
     */
    public function iHaveTheFollowingTaskIdUserIdTitleAndStatus($taskId, $taskUserId, $taskTitle, $taskStatus)
    {
        $this->taskId = $taskId;
        $this->taskUserId = $taskUserId;
        $this->task = [
            "text" => $taskTitle,
            "completed" => false
        ];
    }

    /**
     * @When I try to update a task.
     */
    public function iTryToUpdateATask()
    {
        $this->isClassHasMethodName($this->taskRepository, "update");
        $this->taskRepository->update($this->taskId, $this->taskUserId, $this->task);
    }

    /**
     * @Then the task title should be :taskTitle
     */
    public function theTaskTitleShouldBe($taskTitle)
    {
        PHPUnit::assertEquals($this->taskRepository->find($this->taskId)->text, $taskTitle);
    }

    /**
     * @Then the task status should be :taskStatus
     */
    public function theTaskStatusShouldBe($taskStatus)
    {
        PHPUnit::assertEquals($this->taskRepository->find($this->taskId)->completed, false);
    }
}
