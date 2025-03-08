<?php
class ESH_Admin
{
    public function __construct()
    {
        add_action("admin_menu", [$this, "add_admin_menu"]);
    }

    // Add the menu item to the admin dashboard
    public function add_admin_menu()
    {
        add_menu_page(
            'Elementor Submissions',
            'Submitted Chants',
            'manage_options',
            'esh-submissions',
            [$this, 'render_admin_page'],
            'dashicons-feedback'
        );
    }

    // Render the admin page for viewing submissions
    public function render_admin_page()
    {
        global $wpdb;

        // Get the pending submissions from the database (approved = 0)
        $table_name = $wpdb->prefix . 'elementor_submissions';
        $submissions = $wpdb->get_results("SELECT * FROM $table_name WHERE approved = 0");

        // Start rendering the page
        echo '<div class="wrap">';
        echo '<h1>Pending Submissions</h1>';
        echo '<table class="widefat striped">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Thumbnail</th>
                        <th>Audio</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>';

        if ($submissions) {
            foreach ($submissions as $submission) {
                echo '<tr>';
                echo '<td>' . esc_html($submission->name) . '</td>';
                echo '<td>' . esc_html($submission->title) . '</td>';
                echo '<td>' . esc_html($submission->description) . '</td>';
                echo '<td><img src="' . esc_url($submission->audio_thumbnail) . '" alt="Thumbnail" width="50"></td>';
                echo '<td><a href="' . esc_url($submission->audio_file) . '" target="_blank">Play Audio</a></td>';
                echo '<td>';

                // Approve Button
                echo '<form method="post" style="display:inline;">
                        <input type="hidden" name="submission_id" value="' . esc_attr($submission->id) . '">
                        <button type="submit" name="approve_submission" class="button button-primary">Approve</button>
                    </form>';

                // Reject Button
                echo '<form method="post" style="display:inline;">
                        <input type="hidden" name="submission_id" value="' . esc_attr($submission->id) . '">
                        <button type="submit" name="reject_submission" class="button button-secondary">Reject</button>
                    </form>';

                echo '</td>';
                echo '</tr>';
            }
        } else {
            echo '<tr><td colspan="6" class="text-center">No pending submissions found.</td></tr>';
        }

        echo '</tbody></table></div>';

        // Handle approve and reject actions
        if (isset($_POST['approve_submission']) || isset($_POST['reject_submission'])) {
            $this->handle_submission_action($_POST['submission_id'], isset($_POST['approve_submission']));
        }
    }

    // Handle approve and reject actions
    private function handle_submission_action($submission_id, $approve)
    {
        global $wpdb;
        $table_name = $wpdb->prefix . 'elementor_submissions';

        if ($approve) {
            // Update the approved field to 1 (approved)
            $wpdb->update($table_name, ['approved' => 1], ['id' => $submission_id]);
        } else {
            // Delete the submission if rejected
            $wpdb->delete($table_name, ['id' => $submission_id]);
        }

        // Redirect to avoid resubmission on page refresh
        wp_redirect($_SERVER['REQUEST_URI']);
        exit;
    }
}

?>