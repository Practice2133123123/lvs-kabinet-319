// Confirm before delete
document.addEventListener('DOMContentLoaded', function() {
    const deleteLinks = document.querySelectorAll('a[data-confirm]');
    deleteLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            if (!confirm(this.getAttribute('data-confirm'))) {
                e.preventDefault();
            }
        });
    });

    // Auto-dismiss alerts after 5 seconds
    const alerts = document.querySelectorAll('.alert-success');
    alerts.forEach(alert => {
        setTimeout(() => {
            alert.style.display = 'none';
        }, 5000);
    });

    // Close alert on click
    document.querySelectorAll('.alert .close').forEach(btn => {
        btn.addEventListener('click', function() {
            this.closest('.alert').style.display = 'none';
        });
    });
});
