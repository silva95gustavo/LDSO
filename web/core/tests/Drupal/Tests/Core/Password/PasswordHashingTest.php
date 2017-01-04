<?php

/**
 * @file
 * Contains \Drupal\Tests\Core\Password\PasswordHashingTest.
 */

namespace Drupal\Tests\Core\Password;

use Drupal\Core\Password\PhpassHashedPassword;
use Drupal\Core\Password\PasswordInterface;
use Drupal\Tests\UnitTestCase;

/**
 * Unit tests for password hashing API.
 *
 * @coversDefaultClass \Drupal\Core\Password\PhpassHashedPassword
 * @group System
 */
class PasswordHashingTest extends UnitTestCase {

  /**
   * The user for testing.
   *
   * @var \PHPUnit_Framework_MockObject_MockObject|\Drupal\user\UserInterface
   */
  protected $user;

  /**
   * The raw password.
   *
   * @var string
   */
  protected $password;

  /**
   * The md5 password.
   *
   * @var string
   */
  protected $md5HashedPassword;

  /**
   * The hashed password.
   *
   * @var string
   */
  protected $hashedPassword;

  /**
   * The password hasher under test.
   *
   * @var \Drupal\Core\Password\PhpassHashedPassword
   */
  protected $passwordHasher;

  /**
   * {@inheritdoc}
   */
  protected function setUp() {
    parent::setUp();
    $this->password = $this->randomMachineName();
    $this->passwordHasher = new PhpassHashedPassword(1);
    $this->hashedPassword = $this->passwordHasher->hash($this->password);
    $this->md5HashedPassword = 'U' . $this->passwordHasher->hash(md5($this->password));
  }

  /**
   * Provides the test matrix for testLongPassword().
   */
  public function providerLongPasswords() {
    // '512 byte long password is allowed.'
    $passwords['allowed'] = array(str_repeat('x', PasswordInterface::PASSWORD_MAX_LENGTH), TRUE);
    // 513 byte long password is not allowed.
    $passwords['too_long'] = array(str_repeat('x', PasswordInterface::PASSWORD_MAX_LENGTH + 1), FALSE);

    // Check a string of 3-byte UTF-8 characters, 510 byte long password is
    // allowed.
    $len = floor(PasswordInterface::PASSWORD_MAX_LENGTH / 3);
    $diff = PasswordInterface::PASSWORD_MAX_LENGTH % 3;
    $passwords['utf8'] = array(str_repeat('€', $len), TRUE);
    // 512 byte long password is allowed.
    $passwords['ut8_extended'] = array($passwords['utf8'][0] . str_repeat('x', $diff), TRUE);

    // Check a string of 3-byte UTF-8 characters, 513 byte long password is
    // allowed.
    $passwords['utf8_too_long'] = array(str_repeat('€', $len + 1), FALSE);
    return $passwords;
  }

}

/**
 * A fake class for tests.
 */
class FakePhpassHashedPassword extends PhpassHashedPassword {

  function __construct() {
    // Noop.
  }

  /**
   * Exposes this method as public for tests.
   */
  public function enforceLog2Boundaries($count_log2) {
    return parent::enforceLog2Boundaries($count_log2);
  }

}
