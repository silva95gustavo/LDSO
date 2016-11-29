<?php

/**
 * @file
 * Contains \Drupal\simplenews\Mail\MailCacheNone.
 */

namespace Drupal\simplenews\Mail;

/**
 * Cache implementation that does not cache anything at all.
 *
 * @ingroup mail
 */
class MailCacheNone extends MailCacheStatic {

  /**
   * {@inhertidoc}
   */
  public function isCacheable(MailInterface $mail, $group, $key) {
    return FALSE;
  }

}
