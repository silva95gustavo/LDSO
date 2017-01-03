<?php

/**
 * @file
 * Contains \Drupal\text_resize\Plugin\Block\textResizeBlock.
 */

namespace Drupal\text_resize\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Component\Annotation\Plugin;
use Drupal\Core\Annotation\Translation;
use Drupal\Core\Session\AccountInterface;

/**
 * Provides a text resize block.
 *
 * @Block(
 *   id = "text_resize_block",
 *   admin_label = @Translation("Text Resize"),
 * )
 */
class textResizeBlock extends BlockBase {

	/**
	 * {@inheritdoc}
	 */
	/* public function access(AccountInterface $account) {
		return $account->hasPermission('access content');
	} */
	public function access(AccountInterface $account, $return_as_object = FALSE) {
		$access = $this->blockAccess($account);
		return $return_as_object ? $access : $access->isAllowed('access content');
		/* return $account->hasPermission('access content'); */
	}
	/**
	 * {@inheritdoc}
	 */
	public function build() {
		return array(
			'#theme' => 'text_resize_block',
			'#attached' => array(
				'library' => array('text_resize/text_resize.resize'),
			),
		);
	}

}
