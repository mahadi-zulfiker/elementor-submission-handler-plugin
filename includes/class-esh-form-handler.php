<?php
    class ESH_Form_Handler {
        public function __construct() {
            add_action("elementor_pro/forms/new_record", [ $this,"handle_form_submission"],10,2 );
        }
        public function handle_form_submission($record, $handler){
            $raw_fields = $record->get("fields");
            $fields = [];
            foreach ($raw_fields as $id => $field) {
                $fields[$id] = $field['value'];
            }
            ESH_DB::insert_submission([
                'name'              => $fields['name'] ?? '',
                'title'             => $fields['title'] ?? '',
                'audio_thumbnail'   => $fields['audio_thumbnail'] ?? '',
                'audio_file'        => $fields['audio_file'] ?? '',
                'description'       => $fields['description'] ?? '',
            ]);
        }
    }
?>