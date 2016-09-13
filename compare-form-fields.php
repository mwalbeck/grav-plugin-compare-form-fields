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
        $blueprints = $form->toArray();

        switch ($action) {
            case "compare_fields":
                $this->CompareFields($form, $event, $params, $blueprints);
                break;
        }
    }
    
    public function CompareFields($form, Event $event, $params, $blueprints) {
        $field1 = $params["field1"];
        $field2 = $params["field2"];
        if ($form->value($field1) != $form->value(field2)) {
            $this->grav->fireEvent('onFormValidationError', new Event([
                'form'    => $form,
                'message' => $this->grav['language']->translate(['COMPARE_FIELDS.DO_NOT_MATCH', $blueprints["fields"]["$field1"]["label"], $blueprints["fields"]["$field2"]["label"]])
            ]));
            $event->stopPropagation();
            return;
        }
    }
}
