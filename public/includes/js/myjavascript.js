// login start
var csrf = $('meta[name="csrf-token"]').attr('content');
var base_url = $('meta[name="base_url"]').attr('content');
var curr_url = window.location.origin + window.location.pathname;

jQuery(".form-control")
    .on("blur", function () {
        if (jQuery(this).val().length <= 0) {
            jQuery(this)
                .siblings("label")
                .removeClass("moveUp");
            jQuery(this).removeClass("outline");
        }
    })
    .on("focus", function () {
        if (jQuery(this).val().length >= 0) {
            jQuery(this)
                .siblings("label")
                .addClass("moveUp");
            jQuery(this).addClass("outline");
        }
    });

// login over
function previewImage(event) {
    const input = event.target;
    const previewWrapper = document.getElementById('media-preview-wrapper');
    const preview = document.getElementById('media-preview');

    if (input.files && input.files[0]) {
        const reader = new FileReader();

        reader.onload = function (e) {
            preview.src = e.target.result;
            previewWrapper.style.display = 'block'; // Show wrapper when image loaded
        };

        reader.readAsDataURL(input.files[0]);
    } else {
        // No file selected, hide preview wrapper and clear src
        previewWrapper.style.display = 'none';
        preview.src = '';
    }
}


function deleteMedia(mediaId, baseUrl) {
    Swal.fire({
        title: 'Are you sure?',
        text: "This will permanently delete the media.",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
            fetch(`${baseUrl}/${mediaId}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': csrf,
                    'Accept': 'application/json',
                }
            })
                .then(response => response.json())
                .then(data => {
                    if (data.status) {
                        Swal.fire('Deleted!', data.message, 'success');
                        document.getElementById('media-preview-wrapper').style.display = 'none';
                        document.getElementById('media-preview').src = '';
                    } else {
                        Swal.fire('Error!', data.message, 'error');
                    }
                })
                .catch(() => {
                    Swal.fire('Error!', 'Something went wrong.', 'error');
                });
        }
    });
}


$(document).ready(function () {

    // Select2
    $(".select2").select2({
        width: '-webkit-fill-available'
    });

    // Datatable
    $('#dataTable').DataTable({
        dom: 'Bfrtip',
        destroy: true,
        deferRender: true,
        language: {
            paginate: {
                previous: "<i class='fas fa-angle-left'>",
                next: "<i class='fas fa-angle-right'>"
            }
        },
        buttons: [
            { extend: 'copyHtml5', title: new Date().toISOString() },
            { extend: 'excelHtml5', title: new Date().toISOString() },
            { extend: 'csvHtml5', title: new Date().toISOString() },
            { extend: 'pdfHtml5', title: new Date().toISOString() }
        ]
    });


    if (document.querySelector('.ck_editor')) {
        document.querySelectorAll('.ck_editor').forEach(editorEl => {
            ClassicEditor
                .create(editorEl)
                .catch(error => {
                    console.error(error);
                });
        });
    }

    $('.delete-button').click(function () {
        const href = $(this).data('href');
        Swal.fire({
            title: 'Are you sure to delete?',
            text: "This will permanently delete the record.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                fetch(href, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': csrf,
                        'Accept': 'application/json',
                    }
                })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            // Show toastr success message (sent from server in session)
                            toastr.success(data.message);

                            // Reload after short delay to let toastr show briefly
                            setTimeout(() => {
                                location.reload();
                            }, 1500);
                        } else {
                            Swal.fire('Error!', data.message, 'error');
                        }
                    })
                    .catch(() => {
                        Swal.fire('Error!', 'Something went wrong.', 'error');
                    });
            }
        });
    });

    $(document).on('click', '.btn-view', function () {
        let url = $(this).data('href');
        $.ajax({
            url: url,
            method: 'GET',
            success: function (response) {
                $('#enquirySubjectValue').text(response.data.subject || 'N/A');
                $('#enquiryContentValue').text(response.data.content || 'N/A');
                $('#enquiryModal').modal('show');
            },
            error: function () {
                alert('Failed to fetch enquiry data.');
            }
        });
    });


});

document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.sortable-list').forEach(function (list) {
        new Sortable(list, {
            animation: 150,
            handle: '.handle',
        });
    });

    document.querySelectorAll('.save-order-btn').forEach(function (button) {
        button.addEventListener('click', function () {
            const list = document.querySelector('.sortable-list'); // safer than previousElementSibling
            if (!list) return;

            const url = list.dataset.href;
            const order = Array.from(list.querySelectorAll('li')).map(item => item.dataset.id);

            fetch(url, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({ ids: order })
            })
                .then(res => res.json())
                .then(data => {
                    if (data.success || data.message) {
                        toastr.success(data.message || 'Order saved');
                        setTimeout(() => location.reload(), 1500);
                    } else {
                        toastr.error('Order update failed');
                    }
                });
        });
    });

});
