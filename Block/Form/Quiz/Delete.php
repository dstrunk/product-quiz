<?php

namespace Silentpost\ProductQuiz\Block\Form\Quiz;

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
            . __('Are you sure you want to delete this quiz?')
            . '\', \'' . $this->getUrl('*/*/delete', ['quiz_id' => $this->getQuizId()]) . '\')',
            [],
            20
        );
    }
}
