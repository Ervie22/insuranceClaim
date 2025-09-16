    document.addEventListener('DOMContentLoaded', function(e) {
        const inputElement = document.querySelector('input[type="file"]');
        const submitButton = document.getElementById('sub-btn-form');
        var isFileAdded = false;

        pond = FilePond.create(inputElement, {
            acceptedFileTypes: ['.pdf', '.docx', '.doc'],
            maxFileSize: '5MB',
            labelIdle: '<span class="filepond--label-action">Upload Your Resume</span>',
            server: {
                process: {
                    url: "/upload/file",
                    method: 'POST',
                    withCredentials: false,
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                    },
                    onprocessfile: () => {
                        if (!isFileAdded) {
                            showCustomLoadingOverlay();
                            isFileAdded = true;
                        }
                        submitButton.disabled = true;
                    },
                    onload: (response) => {
                        try {
                            const res = JSON.parse(response);
                            if (res.error) {
                                let wait = showMessage('#error', res.error);
                            } else {
                                filepath = res.path;
                                submitButton.disabled = false;
                                let wait = showMessage('#success', res.message);
                            }
                        } catch (error) {
                            console.error("Error parsing JSON response:", error);
                            let wait = showMessage('#error', 'Unexpected response format');
                        }
                    },
                    onerror: (file, error) => {
                        let wait = showMessage('#error', 'Something went wrong, try after sometime!');
                    }
                }
            },
            onaddfile: (error, file) => {
                if (error) {
                    let wait = showMessage('#error', 'Error adding file.');
                    return;
                }
                submitButton.disabled = true;
            }
        });

        pond.on('removefile', (error, file) => {
            if (error) {
                let wait = showMessage('#error', 'Error Removing file.');
                return;
            }
            submitButton.disabled = false;
        });
    });
