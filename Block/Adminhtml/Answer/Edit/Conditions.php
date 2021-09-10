<?php

namespace Silentpost\ProductQuiz\Block\Adminhtml\Answer\Edit;

use Magento\Backend\Block\Template\Context;
use Magento\Backend\Block\Widget\Form\Generic;
use Magento\Backend\Block\Widget\Form\Renderer\Fieldset;
use Magento\Backend\Block\Widget\Tab\TabInterface;
use Magento\Framework\Data\FormFactory;
use Magento\Framework\ObjectManagerInterface;
use Magento\Framework\Registry;
use Magento\Rule\Model\Condition\AbstractCondition;
use Silentpost\ProductQuiz\Model\AnswerModel;
use Silentpost\ProductQuiz\Model\AnswerModelFactory;

class Conditions extends Generic implements TabInterface
{
    /** @var \Magento\Rule\Block\Conditions */
    private $conditions;

    /** @var Fieldset */
    private $fieldsetRenderer;

    /** @var mixed|AnswerModelFactory */
    private $answerModelFactory;

    /** @var \Magento\Framework\ObjectManager\ObjectManager */
    private $objectManager;

    public function __construct(
        Context $context,
        Registry $registry,
        FormFactory $formFactory,
        \Magento\Rule\Block\Conditions $conditions,
        Fieldset $fieldsetRenderer,
        AnswerModelFactory $answerModelFactory,
        ObjectManagerInterface $objectManager,
        array $data = []
    ) {
        $this->conditions = $conditions;
        $this->fieldsetRenderer = $fieldsetRenderer;
        $this->answerModelFactory = $answerModelFactory;
        $this->objectManager = $objectManager;
        parent::__construct(
            $context,
            $registry,
            $formFactory,
            $data
        );
    }

    public function getTabClass()
    {
        return null;
    }

    public function getTabUrl()
    {
        return null;
    }

    public function isAjaxLoaded()
    {
        return false;
    }

    public function getTabLabel()
    {
        return __('Conditions');
    }

    public function getTabTitle()
    {
        return __('Conditions');
    }

    public function canShowTab()
    {
        return true;
    }

    public function isHidden()
    {
        return false;
    }

    protected function _prepareForm()
    {
        $model = $this->buildModel();
        $form = $this->addTabToForm($model);
        $this->setForm($form);

        return parent::_prepareForm();
    }

    protected function addTabToForm($model, $fieldsetId = AnswerModel::FIELDSET_ID, $formName = AnswerModel::FORM_NAME)
    {
        $conditionsFieldSetId = $model->getConditionsFieldSetId($formName);
        $newChildUrl = $this->getUrl(
            'catalog_rule/promo_catalog/newConditionHtml/form/' . $conditionsFieldSetId,
            ['form_namespace' => $formName]
        );

        $form = $this->_formFactory->create();
        $form->setHtmlIdPrefix('rule_');
        $renderer = $this->fieldsetRenderer
            ->setTemplate('Magento_CatalogRule::promo/fieldset.phtml')
            ->setNewChildUrl($newChildUrl)
            ->setFieldSetId($conditionsFieldSetId);

        $fieldset = $form->addFieldset($fieldsetId, [
            'legend' => __('Conditions to filter products by for quiz answer (do not add conditions if a rule applies to all products within the quiz).'),
        ])->setRenderer($renderer);

        $fieldset->addField('conditions', 'text', [
            'name' => 'conditions',
            'label' => __('Conditions'),
            'title' => __('Conditions'),
            'required' => true,
            'data-form-part' => $formName,
        ])->setRule($model)
            ->setRenderer($this->conditions);

        $form->setValues($model->getData());
        $this->setConditionFormName($model->getConditions());

        return $form;
    }

    private function buildModel()
    {
        $id = $this->getRequest()->getParam('answer_id');
        if ($id) {
            $model = $this->answerModelFactory->create();
            $model->load($id);
        } else {
            $model = $this->objectManager->create(AnswerModel::class);
        }

        $model->getConditions()->setFormName(AnswerModel::FORM_NAME);
        $model->getConditions()->setJsFormObject($model->getConditionsFieldSetId($model->getConditions()->getFormName()));

        $this->_coreRegistry->register('current_answer', $model);

        return $model;
    }

    private function setConditionFormName(AbstractCondition $conditions)
    {
        $conditions->setFormName(AnswerModel::FORM_NAME);
        $conditions->setJsFormObject(AnswerModel::FIELDSET_ID);

        if ($conditions->getConditions() && is_array($conditions->getConditions())) {
            foreach ($conditions->getConditions() as $condition) {
                $this->setConditionFormName($condition);
            }
        }
    }
}
