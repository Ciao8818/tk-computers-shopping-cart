document.addEventListener('DOMContentLoaded', () => {
    const forms = document.querySelectorAll('.add-to-cart-form');
    const successMessage = document.getElementById('success-message');

    forms.forEach(form => {
        form.addEventListener('submit', (e) => {
            // Show success message
            successMessage.style.display = 'block';
            setTimeout(() => {
                successMessage.style.display = 'none';
            }, 2000);
        });
    });
});