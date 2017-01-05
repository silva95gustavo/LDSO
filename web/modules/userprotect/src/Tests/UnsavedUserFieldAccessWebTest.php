<?php

namespace Drupal\userprotect\Tests;

use Drupal\user\Entity\User;

/**
 * Tests field access for a user that has not been saved, such as when a user
 * is created via REST POST.
 *
 * @group userprotect
 */
class UnsavedUserFieldAccessWebTest extends UserProtectWebTestBase {
  /**
   * {@inheritdoc}
   */
  public static $modules = ['userprotect'];

  /**
   * The operating account.
   *
   * @var \Drupal\user\UserInterface
   */
  protected $account;

  /**
   * {@inheritdoc}
   */
  protected function setUp() {
    parent::setUp();

    $this->account = $this->drupalCreateUser(['administer users', 'administer permissions']);
    $this->drupalLogin($this->account);
  }

  /**
   * Tests if userprotect doesn't interfere with creating users.
   */
  protected function testUserCreate() {
    // Create an account using the user interface.
    $name = $this->randomMachineName();
    $edit = [
      'name' => $name,
      'mail' => $this->randomMachineName() . '@example.com',
      'pass[pass1]' => $pass = $this->randomString(),
      'pass[pass2]' => $pass,
      'notify' => FALSE,
    ];
    $this->drupalPostForm('admin/people/create', $edit, t('Create new account'));
    $this->assertText(t('Created a new user account for @name. No email has been sent.', ['@name' => $edit['name']]), 'User created');

    // Try to create an user with the same name and assert that it doesn't
    // result into a fatal error.
    $edit = array(
      'name' => $name,
      'mail' => $this->randomMachineName() . '@example.com',
      'pass[pass1]' => $pass = $this->randomString(),
      'pass[pass2]' => $pass,
      'notify' => FALSE,
    );
    $this->drupalPostForm('admin/people/create', $edit, t('Create new account'));
    $this->assertText(t('The username @name is already taken.', ['@name' => $edit['name']]));
  }

  /**
   * Tests field access for an unsaved user's name.
   */
  protected function testNameAccessForUnsavedUser() {
    $module_handler = \Drupal::moduleHandler();
    $module_installer = \Drupal::service('module_installer');

    // Create an unsaved user entity.
    $unsavedUserEntity = User::Create([]);

    // The logged in user should have the privileges to edit the unsaved user's
    // name.
    $this->assertTrue($unsavedUserEntity->isAnonymous(), 'Unsaved user is considered anonymous when userprotect is installed.');
    $this->assertTrue($unsavedUserEntity->get('name')->access('edit'), 'Logged in user is allowed to edit name field when userprotect is installed.');

    // Uninstall userprotect and verify that logged in user has privileges to
    // edit the unsaved user's name.
    $module_installer->uninstall(['userprotect']);

    $this->assertFalse($module_handler->moduleExists('userprotect'), 'Userprotect uninstalled successfully.');
    $this->assertTrue($unsavedUserEntity->isAnonymous(), 'Unsaved user is considered anonymous when userprotect is uninstalled.');
    $this->assertTrue($unsavedUserEntity->get('name')->access('edit'), 'Logged in user is allowed to edit name field when userprotect is uninstalled.');
  }
}
