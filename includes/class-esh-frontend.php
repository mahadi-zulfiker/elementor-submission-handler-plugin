<?php
class ESH_Frontend
{
    public function __construct()
    {
        add_shortcode('esh_approved_submissions', [$this, 'display_approved_submissions']);
    }

    public function display_approved_submissions()
    {
        global $wpdb;
        $table_name = $wpdb->prefix . 'elementor_submissions';

        // Fetch all approved submissions
        $submissions = $wpdb->get_results("SELECT * FROM $table_name WHERE approved = 1");

        // Start table output
        ob_start();
        ?>
        <div class="overflow-x-auto">
            <table class="table-auto w-full border-collapse border border-gray-300 text-left">
                <thead class="bg-gray-800 text-white">
                    <tr>
                        <th class="px-4 py-2 border">Name</th>
                        <th class="px-4 py-2 border">Title</th>
                        <th class="px-4 py-2 border">Description</th>
                        <th class="px-4 py-2 border">Thumbnail</th>
                        <th class="px-4 py-2 border">Audio</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($submissions): ?>
                        <?php foreach ($submissions as $submission): ?>
                            <tr class="hover:bg-gray-100">
                                <td class="px-4 py-2 border" style="text-align: center;"><?php echo esc_html($submission->name); ?></td>
                                <td class="px-4 py-2 border" style="text-align: center;"><?php echo esc_html($submission->title); ?></td>
                                <td class="px-4 py-2 border" style="text-align: center;"><?php echo esc_html($submission->description); ?></td>
                                <td class="px-4 py-2 border" style="display: block; margin:auto; text-align: center;">
                                    <img src="<?php echo esc_url($submission->audio_thumbnail); ?>" alt="Thumbnail"
                                        class="object-cover rounded"
                                        style="width: 60px; height: 60px;">
                                </td>
                                <td class="px-4 py-2 border" style="text-align: center;">
                                    <a href="<?php echo esc_url($submission->audio_file); ?>" class="text-blue-500 hover:underline"
                                        target="_blank">Play Audio</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5" class="px-4 py-2 border text-center">No approved submissions found.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
        <?php
        return ob_get_clean();
    }
}

?>