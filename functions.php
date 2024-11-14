<?php
function add_target_blank_to_follow_us()
{
?>
    <script type="text/javascript">
        document.addEventListener('DOMContentLoaded', function() {
            console.log('Document loaded');

            // Function to apply validation to a textarea and its submit button
            function applyValidation(textarea, submitButton) {
                function validateTextareaContent() {
                    const value = textarea.value.trim();

                    // Disallowed content patterns
                    const urlPattern = /(http:\/\/|https:\/\/|www\.|\.com|\.net|\.org|ftp:\/\/|mailto:)/i;
                    const emailPattern = /\b[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,}\b/i;
                    const phonePattern = /\+?\d{1,4}?[-.\s]?\(?\d{1,4}?\)?[-.\s]?\d{1,4}[-.\s]?\d{1,4}[-.\s]?\d{1,9}/;
                    const htmlTagPattern = /<[^>]*>/; // Detects any HTML tags
                    const sqlInjectionPattern = /(\b(SELECT|INSERT|DELETE|UPDATE|DROP|ALTER|EXEC)\b|['";]|--)/i;
                    const specialCharPattern = /[{}<>$%^&*[\]|]/; // Blocks special characters used in code
                    const commonXSSPattern = /(<script\b|javascript:|onload=|onerror=)/i; // XSS attack patterns
                    const spamKeywords = /automation|data collection|scraping|bot|web scraping|contact|Viber|WhatsApp|Skype|Facebook|catalog|MySQL|data engineer/i;
                    const repeatedCharacterPattern = /(.)\1{3,}/; // Prevents long repeated characters
                    const maxLength = 500; // Set a character limit to block overly long submissions

                    // Validate the content with all security patterns
                    if (
                        urlPattern.test(value) ||
                        emailPattern.test(value) ||
                        phonePattern.test(value) ||
                        htmlTagPattern.test(value) ||
                        sqlInjectionPattern.test(value) ||
                        specialCharPattern.test(value) ||
                        commonXSSPattern.test(value) ||
                        spamKeywords.test(value) ||
                        repeatedCharacterPattern.test(value) ||
                        value.length > maxLength
                    ) {
                        submitButton.disabled = true; // Disable submit button if invalid content is detected
                        submitButton.style.cursor = 'not-allowed';
                        console.log('Submission blocked due to disallowed content');
                    } else {
                        submitButton.disabled = false; // Enable the submit button if content is valid
                        submitButton.style.cursor = 'pointer';
                        console.log('Submit button enabled');
                    }
                }

                // Validate content on textarea input
                textarea.addEventListener('input', validateTextareaContent);

                // Initial validation check to set button state on page load
                validateTextareaContent();
            }

            document.querySelectorAll('form').forEach(form => {
                const submitButton = form.querySelector('input[type="submit"], button[type="submit"]');

                // Find the first textarea in the form (without needing a specific ID)
                const textarea = form.querySelector('textarea');

                if (textarea && submitButton) {
                    applyValidation(textarea, submitButton);
                }
            });
        });
    </script>
<?php
}
// Hook into 'wp_footer' to load the script in the footer
add_action('wp_footer', 'add_target_blank_to_follow_us');
