// Import Bootstrap JavaScript
import * as bootstrap from 'bootstrap';

// Admin JavaScript functionality
class AdminApp {
    constructor() {
        this.init();
    }

    init() {
        this.initSidebar();
        this.initTooltips();
        this.initModals();
        this.initDataTables();
    }

    // Initialize sidebar toggle
    initSidebar() {
        const sidebarToggle = document.querySelector('.sidebar-toggle');
        const sidebar = document.querySelector('.admin-sidebar');
        
        if (sidebarToggle && sidebar) {
            sidebarToggle.addEventListener('click', () => {
                sidebar.classList.toggle('show');
            });
        }
    }

    // Initialize Bootstrap tooltips
    initTooltips() {
        const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });
    }

    // Initialize Bootstrap modals
    initModals() {
        const modalTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="modal"]'));
        modalTriggerList.map(function (modalTriggerEl) {
            return new bootstrap.Modal(modalTriggerEl);
        });
    }

    // Initialize data tables (if using Bootstrap tables)
    initDataTables() {
        const tables = document.querySelectorAll('.table-responsive');
        tables.forEach(table => {
            // Add sorting functionality
            const headers = table.querySelectorAll('th[data-sort]');
            headers.forEach(header => {
                header.addEventListener('click', () => {
                    this.sortTable(table, header);
                });
            });
        });
    }

    // Simple table sorting
    sortTable(table, header) {
        const column = header.cellIndex;
        const rows = Array.from(table.querySelectorAll('tbody tr'));
        const isAscending = header.classList.contains('sort-asc');
        
        rows.sort((a, b) => {
            const aValue = a.cells[column].textContent.trim();
            const bValue = b.cells[column].textContent.trim();
            
            if (isAscending) {
                return aValue.localeCompare(bValue);
            } else {
                return bValue.localeCompare(aValue);
            }
        });
        
        // Update table
        const tbody = table.querySelector('tbody');
        rows.forEach(row => tbody.appendChild(row));
        
        // Update header state
        header.classList.toggle('sort-asc');
        header.classList.toggle('sort-desc');
    }

    // Utility method to show notifications
    showNotification(message, type = 'info') {
        const alertDiv = document.createElement('div');
        alertDiv.className = `alert alert-${type} alert-dismissible fade show`;
        alertDiv.innerHTML = `
            ${message}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        `;
        
        const container = document.querySelector('.admin-content');
        if (container) {
            container.insertBefore(alertDiv, container.firstChild);
            
            // Auto remove after 5 seconds
            setTimeout(() => {
                alertDiv.remove();
            }, 5000);
        }
    }
}

// Initialize admin app when DOM is loaded
document.addEventListener('DOMContentLoaded', () => {
    new AdminApp();
});

// Export for use in other modules
export default AdminApp; 