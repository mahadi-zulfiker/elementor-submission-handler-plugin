<?php 
    class ESH_DB {
        public static function create_table(){
            global $wpdb;
            $table_name = $wpdb->prefix ."elementor_submissions";
            $charset_collate = $wpdb->get_charset_collate();
            $sql = "CREATE TABLE IF NOT EXISTS $table_name (
                id BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
                name VARCHAR(255) NOT NULL,
                title VARCHAR(255) NOT NULL,
                audio_thumbnail VARCHAR(255) DEFAULT NULL,
                audio_file VARCHAR(255) NOT NULL,
                description TEXT NOT NULL,
                approved TINYINT(1) DEFAULT 0,
                created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
                PRIMARY KEY (id)
            ) $charset_collate;";
            
            require_once( ABSPATH ."wp-admin/includes/upgrade.php");
            dbDelta($sql);
        }
        public static function delete_table(){
            global $wpdb;
            $table_name = $wpdb->prefix ."elementor_submissions";
            $wpdb->query("DROP TABLE IF EXISTS $table_name");
        }
        public static function insert_submission($data){
            global $wpdb;
            $table_name = $wpdb->prefix.'elementor_submissions';
            $wpdb->insert($table_name, [
                'name'              => $data['name'],
                'title'             => $data['title'],
                'audio_thumbnail'   => $data['audio_thumbnail'],
                'audio_file'        => $data['audio_file'],
                'description'       => $data['description'],
                'approved'          => 0
            ]);
            $submission_id = $wpdb->insert_id;
        }
    }
?>