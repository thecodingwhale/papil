Feature: Task API

Scenario: Displaying all tasks
    Given I call "GET" "/task/all"
    Then I get a response status code should be 200
    And the header content type should return json
    And the response contains 2 tasks

Scenario: Reading a single task.
Scenario: Creating a single task.
Scenario: Updating a single task.
Scenario: Deleting a single task.