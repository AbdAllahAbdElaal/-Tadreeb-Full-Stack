// +Tadreeb Field Training Management System - JavaScript

// Sidebar Toggle
function initSidebar() {
    const menuToggle = document.querySelector('.menu-toggle');
    const sidebar = document.querySelector('.sidebar');
    const mainContent = document.querySelector('.main-content');

    if (menuToggle) {
        menuToggle.addEventListener('click', () => {
            sidebar.classList.toggle('active');
            sidebar.classList.toggle('collapsed');
            mainContent.classList.toggle('expanded');
        });
    }

    // Close sidebar when clicking outside on mobile
    document.addEventListener('click', (e) => {
        if (window.innerWidth <= 768) {
            if (!sidebar.contains(e.target) && !menuToggle.contains(e.target)) {
                sidebar.classList.remove('active');
                sidebar.classList.add('collapsed');
            }
        }
    });

    // Set active menu item
    const currentPath = window.location.pathname;
    const menuLinks = document.querySelectorAll('.sidebar-menu a');
    menuLinks.forEach(link => {
        if (link.getAttribute('href') === currentPath.split('/').pop()) {
            link.classList.add('active');
        }
    });
}

// Modal System
function initModals() {
    // Open modal
    window.openModal = function (modalId) {
        const modal = document.getElementById(modalId);
        if (modal) {
            modal.classList.add('active');
            document.body.style.overflow = 'hidden';
        }
    };

    // Close modal
    window.closeModal = function (modalId) {
        const modal = document.getElementById(modalId);
        if (modal) {
            modal.classList.remove('active');
            document.body.style.overflow = 'auto';
        }
    };

    // Close modal when clicking outside
    const modals = document.querySelectorAll('.modal');
    modals.forEach(modal => {
        modal.addEventListener('click', (e) => {
            if (e.target === modal) {
                modal.classList.remove('active');
                document.body.style.overflow = 'auto';
            }
        });
    });

    // Close buttons
    const closeButtons = document.querySelectorAll('.close-modal');
    closeButtons.forEach(btn => {
        btn.addEventListener('click', () => {
            const modal = btn.closest('.modal');
            if (modal) {
                modal.classList.remove('active');
                document.body.style.overflow = 'auto';
            }
        });
    });
}

// Form Validation
function validateForm(formId) {
    const form = document.getElementById(formId);
    if (!form) return false;

    let isValid = true;
    const inputs = form.querySelectorAll('input[required], select[required], textarea[required]');

    inputs.forEach(input => {
        if (!input.value.trim()) {
            input.style.borderColor = 'var(--danger)';
            isValid = false;
        } else {
            input.style.borderColor = 'var(--border)';
        }
    });

    // Email validation
    const emailInputs = form.querySelectorAll('input[type="email"]');
    emailInputs.forEach(input => {
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (input.value && !emailRegex.test(input.value)) {
            input.style.borderColor = 'var(--danger)';
            isValid = false;
        }
    });

    return isValid;
}

// Alert System
function showAlert(message, type = 'info') {
    const container = document.getElementById('toast-container');
    if (!container) return;

    const toast = document.createElement('div');
    toast.className = `toast ${type}`;
    toast.textContent = message;

    container.appendChild(toast);

    // اختفاء الرسالة بعد 3 ثواني
    setTimeout(() => {
        toast.style.opacity = '0';
        toast.style.transform = 'translateY(-20px)';
        setTimeout(() => toast.remove(), 500);
    }, 6000);
}


// Table Sorting
function initTableSorting() {
    const tables = document.querySelectorAll('table');

    tables.forEach(table => {
        const headers = table.querySelectorAll('th');
        headers.forEach((header, index) => {
            header.style.cursor = 'pointer';
            header.addEventListener('click', () => {
                sortTable(table, index);
            });
        });
    });
}

function sortTable(table, columnIndex) {
    const tbody = table.querySelector('tbody');
    const rows = Array.from(tbody.querySelectorAll('tr'));

    const isAscending = table.dataset.sortOrder !== 'asc';
    table.dataset.sortOrder = isAscending ? 'asc' : 'desc';

    rows.sort((a, b) => {
        const aValue = a.cells[columnIndex].textContent.trim();
        const bValue = b.cells[columnIndex].textContent.trim();

        if (!isNaN(aValue) && !isNaN(bValue)) {
            return isAscending ? aValue - bValue : bValue - aValue;
        }

        return isAscending
            ? aValue.localeCompare(bValue)
            : bValue.localeCompare(aValue);
    });

    rows.forEach(row => tbody.appendChild(row));
}

// Filter Tables
function filterTable(inputId, tableId) {
    const input = document.getElementById(inputId);
    const table = document.getElementById(tableId);

    if (!input || !table) return;

    input.addEventListener('keyup', function () {
        const filter = this.value.toLowerCase();
        const rows = table.querySelectorAll('tbody tr');

        rows.forEach(row => {
            const text = row.textContent.toLowerCase();
            row.style.display = text.includes(filter) ? '' : 'none';
        });
    });
}

// File Upload Preview
function initFileUpload() {
    const fileInputs = document.querySelectorAll('input[type="file"]');

    fileInputs.forEach(input => {
        input.addEventListener('change', function (e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    const preview = document.getElementById(input.id + '-preview');
                    if (preview) {
                        if (file.type.startsWith('image/')) {
                            preview.innerHTML = `<img src="${e.target.result}" style="max-width: 200px; border-radius: 8px;" alt="Preview">`;
                        } else {
                            preview.innerHTML = `<p>File selected: ${file.name}</p>`;
                        }
                    }
                };
                reader.readAsDataURL(file);
            }
        });
    });
}

// Simple Bar Chart
function createBarChart(canvasId, data, labels) {
    const canvas = document.getElementById(canvasId);
    if (!canvas) return;

    const ctx = canvas.getContext('2d');
    const width = canvas.width;
    const height = canvas.height;
    const barWidth = width / data.length;
    const maxValue = Math.max(...data);

    // Clear canvas
    ctx.clearRect(0, 0, width, height);

    // Draw bars
    data.forEach((value, index) => {
        const barHeight = (value / maxValue) * (height - 40);
        const x = index * barWidth;
        const y = height - barHeight - 20;

        // Bar
        ctx.fillStyle = '#4a90e2';
        ctx.fillRect(x + 10, y, barWidth - 20, barHeight);

        // Value on top
        ctx.fillStyle = '#2c3e50';
        ctx.font = '12px sans-serif';
        ctx.textAlign = 'center';
        ctx.fillText(value, x + barWidth / 2, y - 5);

        // Label at bottom
        ctx.fillText(labels[index], x + barWidth / 2, height - 5);
    });
}

// Pagination
function initPagination(tableId, rowsPerPage = 10) {
    const table = document.getElementById(tableId);
    if (!table) return;

    const tbody = table.querySelector('tbody');
    const rows = Array.from(tbody.querySelectorAll('tr'));
    let currentPage = 1;
    const totalPages = Math.ceil(rows.length / rowsPerPage);

    function showPage(page) {
        const start = (page - 1) * rowsPerPage;
        const end = start + rowsPerPage;

        rows.forEach((row, index) => {
            row.style.display = (index >= start && index < end) ? '' : 'none';
        });

        updatePaginationButtons();
    }

    function updatePaginationButtons() {
        const paginationContainer = document.getElementById(tableId + '-pagination');
        if (!paginationContainer) return;

        let html = '';
        for (let i = 1; i <= totalPages; i++) {
            html += `<button class="${i === currentPage ? 'active' : ''}" onclick="goToPage('${tableId}', ${i})">${i}</button>`;
        }
        paginationContainer.innerHTML = html;
    }

    window.goToPage = function (tableId, page) {
        currentPage = page;
        showPage(page);
    };

    showPage(1);
}

// Status Badge Generator
function getStatusBadge(status) {
    const statusMap = {
        'active': 'badge-success',
        'pending': 'badge-warning',
        'inactive': 'badge-secondary',
        'rejected': 'badge-danger',
        'approved': 'badge-success',
        'completed': 'badge-info'
    };

    const badgeClass = statusMap[status.toLowerCase()] || 'badge-secondary';
    return `<span class="badge-status ${badgeClass}">${status}</span>`;
}

// Form Submit Handlers
function handleLogin(event) {
    event.preventDefault();

    if (validateForm('loginForm')) {
        const email = document.getElementById('email').value;
        const role = email.includes('admin') ? 'admin' :
            email.includes('university') ? 'university' :
                email.includes('company') ? 'company' : 'student';

        showAlert('Login successful! Redirecting...', 'success');

        setTimeout(() => {
            if (role == 'admin') {
                window.location = "/tadreeb/admin/dashboard";
            } else if (role == 'university') {
                window.location = "/tadreeb/university/dashboard";
            } else if (role == 'company') {
                window.location = "/tadreeb/company/dashboard";
            } else {
                window.location = "/tadreeb/student/dashboard";
            }

        }, 1000);
    } else {
        showAlert('Please fill in all required fields', 'danger');
    }
}

function handleForgotPassword(event) {
    event.preventDefault();

    if (validateForm('forgotPasswordForm')) {
        showAlert('Password reset link sent to your email!', 'success');

        setTimeout(() => {
            window.location.href = '/tadreeb/login';
        }, 3000);
    }
}

// Sign Up Handler
function handleSignUp(event) {
    event.preventDefault();

    const formId = 'signupForm';
    if (!validateForm(formId)) {
        showAlert('Please fill in all required fields correctly.', 'danger');
        return;
    }

    const name = document.getElementById('name').value.trim();
    const email = document.getElementById('email').value.trim();
    const userType = document.getElementById('userType').value;
    const password = document.getElementById('password').value;
    const confirmPassword = document.getElementById('confirmPassword').value;

    if (password !== confirmPassword) {
        showAlert('Passwords do not match!', 'danger');
        return;
    }

    // هنا مكان إرسال البيانات إلى السيرفر باستخدام fetch أو axios
    // على سبيل المثال:
    /*
    fetch('/signup', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ name, email, userType, password })
    }).then(res => res.json()).then(data => {
        if (data.success) {
            showAlert('Account created successfully!', 'success');
            setTimeout(() => { window.location.href = '/tadreeb/login'; }, 2000);
        } else {
            showAlert(data.message || 'Sign up failed!', 'danger');
        }
    });
    */

    // مؤقت: عرض رسالة نجاح مباشرة
    showAlert('Account created successfully!', 'success');
    setTimeout(() => { window.location.href = '/tadreeb/login'; }, 2000);
}

// تصدير الدالة لتكون متاحة في الصفحة HTML
window.handleSignUp = handleSignUp;


function handleChangePassword(event) {
    event.preventDefault();

    const newPassword = document.getElementById('newPassword').value;
    const confirmPassword = document.getElementById('confirmPassword').value;

    if (newPassword !== confirmPassword) {
        showAlert('Passwords do not match!', 'danger');
        return;
    }

    if (validateForm('changePasswordForm')) {
        showAlert('Password changed successfully!', 'success');

        setTimeout(() => {
            window.location.href = '/login.html';
        }, 2000);
    }
}

// Initialize everything on page load
document.addEventListener('DOMContentLoaded', () => {
    initSidebar();
    initModals();
    initTableSorting();
    initFileUpload();

    // Auto-hide alerts
    const alerts = document.querySelectorAll('.alert');
    alerts.forEach(alert => {
        setTimeout(() => {
            alert.style.opacity = '0';
            setTimeout(() => alert.remove(), 300);
        }, 5000);
    });
});

// Utility Functions
function formatDate(date) {
    return new Date(date).toLocaleDateString('en-US', {
        year: 'numeric',
        month: 'short',
        day: 'numeric'
    });
}

function formatCurrency(amount) {
    return new Intl.NumberFormat('en-US', {
        style: 'currency',
        currency: 'USD'
    }).format(amount);
}

// Export functions for use in HTML
window.openModal = function (modalId) {
    const modal = document.getElementById(modalId);
    if (modal) {
        modal.classList.add('active');
        document.body.style.overflow = 'hidden';
    }
};

window.closeModal = function (modalId) {
    const modal = document.getElementById(modalId);
    if (modal) {
        modal.classList.remove('active');
        document.body.style.overflow = 'auto';
    }
};

// Logout
document.addEventListener('DOMContentLoaded', () => {

    // User Dropdown
    const userMenu = document.querySelector('.user-menu');
    const dropdown = document.querySelector('.user-dropdown');

    if (userMenu && dropdown) {
        userMenu.addEventListener('click', function (e) {
            e.stopPropagation();
            dropdown.classList.toggle('active');
        });

        document.addEventListener('click', function () {
            dropdown.classList.remove('active');
        });
    }

    // Logout from dropdown
    const logoutBtn = document.querySelector('.dropdown-item.logout');
    if (logoutBtn) {
        logoutBtn.addEventListener('click', function () {
            showAlert('Logging out...', 'info');
            setTimeout(() => {
                window.location = "/tadreeb/login";
            }, 800);
        });
    }

});


window.showAlert = showAlert;
window.getStatusBadge = getStatusBadge;
window.filterTable = filterTable;
window.handleLogin = handleLogin;
window.handleForgotPassword = handleForgotPassword;
window.handleChangePassword = handleChangePassword;
