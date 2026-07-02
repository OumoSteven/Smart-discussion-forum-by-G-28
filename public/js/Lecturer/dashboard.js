// public/js/Lecturer/dashboard.js
// Replaces Bootstrap's modal JS — no CDN dependency, works fully offline.

document.addEventListener('DOMContentLoaded', function () {

    // Open: any element with data-bs-toggle="modal" and data-bs-target="#id"
    document.querySelectorAll('[data-bs-toggle="modal"]').forEach(function (trigger) {
        trigger.addEventListener('click', function () {
            var targetSelector = trigger.getAttribute('data-bs-target');
            var modal = document.querySelector(targetSelector);
            if (modal) openModal(modal);
        });
    });

    // Close: any element with data-bs-dismiss="modal" (inside a modal)
    document.querySelectorAll('[data-bs-dismiss="modal"]').forEach(function (btn) {
        btn.addEventListener('click', function () {
            var modal = btn.closest('.modal');
            if (modal) closeModal(modal);
        });
    });

    function openModal(modal) {
        modal.classList.add('show');
        modal.style.display = 'block';

        var backdrop = document.createElement('div');
        backdrop.className = 'modal-backdrop';
        backdrop.setAttribute('data-for', modal.id);
        document.body.appendChild(backdrop);

        // click outside the modal-content closes it
        backdrop.addEventListener('click', function () {
            closeModal(modal);
        });
    }

    function closeModal(modal) {
        modal.classList.remove('show');
        modal.style.display = 'none';

        document.querySelectorAll('.modal-backdrop[data-for="' + modal.id + '"]').forEach(function (b) {
            b.remove();
        });
    }

});