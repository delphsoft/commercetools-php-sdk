Feature: I want to delete an inventory
  Scenario: Delete inventory
    Given a "inventory" is identified by "id" and version 1
    And i want to delete a "inventory"
    Then the path should be "inventory/id?version=1"
    And the method should be "DELETE"
