<?php
namespace Grav\Plugin;

use Grav\Common\Plugin;
use Grav\Plugin\Form;
use RocketTheme\Toolbox\Event\Event;

/**
 * Class CompareFormFieldsPlugin
 * @package Grav\Plugin
 */
class CompareFormFieldsPlugin extends Plugin {
    public static function getSubscribedEvents()
    {
        return [
            "onFormProcessed" => ["onFormProcessed", 0]
        ];
    }

    public function onFormProcessed(Event $event) {
        // Don't proceed if we are in the admin plugin
        if ($this->isAdmin()) {
            return;
        }
        
        $form = $event["form"];
        $action = $event["action"];
        $params = $event["params"];

        switch ($action) {
            case "compare_fields":
                $this->CompareFields($form, $event);
                break;
        }
    }
    
    public function CompareFields($form, Event $event) {
        if ($form->value("username") != $form->value("cvr")) {
            $this->grav->fireEvent('onFormValidationError', new Event([
                'form'    => $form,
                'message' => $this->grav['language']->translate(['COMPARE_FIELDS.DO_NOT_MATCH', "CVR-nr.", "Gentag CVR-nr."])
            ]));
            $event->stopPropagation();
            return;
        }
    }
}
