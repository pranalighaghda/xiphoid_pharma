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
        language: {
            paginate: {
                previous: "<i class='fas fa-angle-left'>",
                next: "<i class='fas fa-angle-right'>"
            }
        },
        buttons: [{
            extend: 'copyHtml5',
            title: new Date().toISOString()
        },
        {
            extend: 'excelHtml5',
            title: new Date().toISOString()
        },
        {
            extend: 'csvHtml5',
            title: new Date().toISOString()
        },
        {
            extend: 'pdfHtml5',
            title: new Date().toISOString()
        },
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
});