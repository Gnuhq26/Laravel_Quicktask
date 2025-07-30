// Import admin template functionality
import AdminApp from '../../laravel-admin-template/src/admin.js';

// Laravel specific admin functionality
class LaravelAdminApp extends AdminApp {
    constructor() {
        super();
        this.initLaravelFeatures();
    }

    initLaravelFeatures() {
        this.initCSRF();
        this.initAjaxSetup();
        this.initFormValidation();
        this.initDataTables();
    }

    // Setup CSRF token for AJAX requests
    initCSRF() {
        const token = document.querySelector('meta[name="csrf-token"]');
        if (token) {
            window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.getAttribute('content');
        }
    }

    // Setup AJAX defaults
    initAjaxSetup() {
        if (window.axios) {
            window.axios.defaults.headers.common['Accept'] = 'application/json';
        }
    }

    // Enhanced form validation
    initFormValidation() {
        const forms = document.querySelectorAll('.needs-validation');
        forms.forEach(form => {
            form.addEventListener('submit', (event) => {
                if (!form.checkValidity()) {
                    event.preventDefault();
                    event.stopPropagation();
                }
                form.classList.add('was-validated');
            });
        });
    }

    // Enhanced data tables with Laravel pagination
    initDataTables() {
        super.initDataTables();
        
        // Add Laravel pagination support
        const paginationLinks = document.querySelectorAll('.pagination a');
        paginationLinks.forEach(link => {
            link.addEventListener('click', (e) => {
                e.preventDefault();
                const url = link.getAttribute('href');
                if (url) {
                    window.location.href = url;
                }
            });
        });
    }

    // Show Laravel flash messages
    showFlashMessages() {
        const flashMessages = document.querySelectorAll('.alert');
        flashMessages.forEach(message => {
            setTimeout(() => {
                message.style.opacity = '0';
                setTimeout(() => {
                    message.remove();
                }, 300);
            }, 5000);
        });
    }

    // Handle delete confirmations
    initDeleteConfirmations() {
        const deleteButtons = document.querySelectorAll('[data-confirm]');
        deleteButtons.forEach(button => {
            button.addEventListener('click', (e) => {
                const message = button.getAttribute('data-confirm') || 'Are you sure?';
                if (!confirm(message)) {
                    e.preventDefault();
                }
            });
        });
    }
}

// Initialize when DOM is loaded
document.addEventListener('DOMContentLoaded', () => {
    const adminApp = new LaravelAdminApp();
    
    // Show flash messages
    adminApp.showFlashMessages();
    
    // Initialize delete confirmations
    adminApp.initDeleteConfirmations();
});

// Export for use in other modules
export default LaravelAdminApp; 