Feature: CRUD Task Model
In order to check if all the expected Task model methods are working properly
As a developer

Scenario: Displaying all the tasks.
    Given I have "2" tasks
    When I try to access method "all"
    Then it should also return "2" tasks

Scenario: Storing a new single task.
    Given I have the following task
    When I try to create a task
    Then it should have a method name "create"
    And it should return a "3" tasks

Scenario: Getting a single task.
    Given I have a task id: "1"
    When I try to find a task
    Then it should return a "1" task

Scenario: Deleting a single task.
    When I try to delete a single task form the current tasks.
    Then the total count should be equal to "1"

Scenario: Updating a single task.
  Given I have the following task id: "1", user_id: "1", title: "a updated new task." and status false
  When I try to update a task.
  Then the task title should be "a updated new task."
  And the task status should be false