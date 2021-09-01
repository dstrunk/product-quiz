<?php

namespace Silentpost\ProductQuiz\Block\Form\Answer;

use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;

/**
 * Delete entity button.
 */
class Delete extends GenericButton implements ButtonProviderInterface
{
    /**
     * Retrieve Delete button settings.
     *
     * @return array
     */
    public function getButtonData(): array
    {
        return $this->wrapButtonSettings(
            'Delete',
            'delete',
            'deleteConfirm(\''
            . __('Are you sure you want to delete this answer?')
            . '\', \'' . $this->getUrl('*/*/delete', ['answer_id' => $this->getAnswerId()]) . '\')',
            [],
            20
        );
    }
}
