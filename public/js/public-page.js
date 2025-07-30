document.addEventListener('DOMContentLoaded', function () {
    const calendarEl = document.getElementById('calendar');
    if (!calendarEl) return;

    const eventsData = JSON.parse(calendarEl.dataset.events || '[]');

    const calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        locale: 'id',
        events: eventsData,
        displayEventTime: false,

        eventClick(info) {
            const { title, start, extendedProps } = info.event;

            document.getElementById('modalTitle').textContent = title || '-';

            const date = start ? new Date(start) : null;
            const tanggal = date
                ? date.toLocaleDateString('id-ID', {
                    weekday: 'long',
                    day: 'numeric',
                    month: 'long',
                    year: 'numeric'
                  })
                : '-';
            const jam = date
                ? date.toLocaleTimeString('id-ID', {
                    hour: '2-digit',
                    minute: '2-digit'
                  })
                : '-';

            document.getElementById('modalTime').textContent = `${tanggal} - ${jam}`;
            document.getElementById('modalLocation').textContent = extendedProps.lokasi || '-';
            document.getElementById('modalDescription').textContent = extendedProps.deskripsi || '-';

            new bootstrap.Modal(document.getElementById('eventModal')).show();
        }
    });

    calendar.render();

    // SweetAlert Success
    const flashSuccess = document.getElementById('flash-success');
    if (flashSuccess) {
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: flashSuccess.dataset.message,
            confirmButtonColor: '#28a745',
            timer: 3000,
            showConfirmButton: false
        });
    }

    // SweetAlert Errors
    const flashErrors = document.getElementById('flash-errors');
    if (flashErrors) {
        const errors = JSON.parse(flashErrors.dataset.errors);
        Swal.fire({
            icon: 'error',
            title: 'Oops!',
            html: errors.join('<br>'),
            confirmButtonColor: '#dc3545'
        });
    }

    // Auto-close alert
    const alertBox = document.querySelector('.alert');
    if (alertBox) {
        setTimeout(() => {
            alertBox.classList.remove('show');
            alertBox.classList.add('d-none');
        }, 5000);
    }

    // Disable button saat submit
    const form = document.getElementById('usulanForm');
    if (form) {
        form.addEventListener('submit', () => {
            const submitButton = document.getElementById('submitBtn');
            submitButton.disabled = true;
            submitButton.innerHTML = '<i class="bi bi-send-check"></i> Mengirim...';
        });
    }
});
