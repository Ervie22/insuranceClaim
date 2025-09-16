@extends('layouts.app')

@section('content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
    #filePreviewTable {
        display: none;
    }


    #drop-zone {
        border: 2px dashed #4f46e5;
        border-radius: 10px;
        padding: 30px;
        cursor: pointer;
        color: #4f46e5;
        transition: background-color 0.3s;
    }

    #drop-zone.bg-light {
        background-color: #f0f0f0;
    }
</style>
@if($isEnabled == 1)
<div class="container mt-1">
    <h2 class="text-center  fw-bold" style="color: #4f46e5;">Upload Slide(s)</h2>
    <p class="text-center text-muted">Upload folder and assign appropriate file types</p>
    <p class="text-center text-muted">Note: Empty folders will not trigger upload. Please select a folder with files.</p>

    <!-- <div class="drop-zone" id="dropZone">
        <input type="file" id="fileInput" webkitdirectory directory multiple hidden>
        <button class="btn btn-primary me-2" onclick="$('#fileInput').attr('webkitdirectory', false).click()">Upload file</button>
        <button class="btn btn-primary" onclick="$('#fileInput').attr('webkitdirectory', true).click()">Upload folder</button>
    </div> -->
    <div id="drop-zone" class=" drop-area  p-5 text-center" style="min-height: 150px;">
        Drag & drop a folder here <br> or <br> <button type="button" class="btn btn-primary" id="upload-folder-button">Upload folder</button>
        <input type="file" id="fileInputFolder" webkitdirectory multiple hidden />
    </div>
    <div id="uploadStatus" class="text-center" style=" display:none; margin-top: 10px; font-weight: bold;">
        <span id="statusText"></span>
    </div>
    <form id="uploadForm">
        <div class="mt-4" id="filePreviewTable">
            <h5 class="fw-bold">File Preview</h5>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>File Name</th>
                        <th>Size</th>
                        <th>Study Name</th>
                        <th>File Type</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody id="filePreviewBody">
                    <!-- Rows will be inserted dynamically -->
                </tbody>
            </table>
            <button type="submit" id="submitBtn" class="btn btn-success" disabled>Submit</button>
        </div>
    </form>
</div>
@else
<div class="container mt-1">
    <h2 class="text-center  text-danger fw-bold">! Upload Option not enabled, Contact your Admin !</h2>
</div>
@endif
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<script>
    window.addEventListener("dragover", function(e) {
        e.preventDefault();
    }, false);
    window.addEventListener("drop", function(e) {
        e.preventDefault();
    }, false);
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    let fileData = [];

    const allowedTypes = ['H&E', 'HER2', 'Ki-67', 'ER', 'PGR'];

    function updateSubmitButton() {
        const allSelected = fileData.every(f => f.type);
        $('#submitBtn').prop('disabled', !allSelected);
    }


    function renderTable() {
        $('#upload-folder-button').prop('disabled', true);
        const tbody = $('#filePreviewBody').empty();
        const selectedTypes = fileData.map(f => f.type).filter(t => t);

        fileData.forEach((file, index) => {
            const row = $(`
            <tr data-index="${index}">
                <td>${file.name}</td>
                <td>${(file.size / 1024).toFixed(2)} KB</td>
                <td><input type="text" class="form-control study-name-input" name="study_name[]" data-index="${index}" value="${file.folder}" placeholder="Study Name"></td>
                <td>
                    <select class="form-select form-select-sm file-type-select" data-index="${index}">
                        <option value="">Select</option>
                        ${allowedTypes.map(type => {
                            const isSelected = file.type === type;
                            const isDisabled = selectedTypes.includes(type) && !isSelected;
                            return `<option value="${type}" ${isSelected ? 'selected' : ''} ${isDisabled ? 'disabled' : ''}>${type}</option>`;
                        }).join('')}
                    </select>
                </td>
                <td>
                    <div class="progress mt-2">
                        <div class="progress-bar bg-info" role="progressbar" style="width: 0%">0%</div>
                    </div>
                </td>
                <td><button id="delete-button${index}" type="button" class="btn btn-sm btn-danger delete-btn" data-index="${index}">Delete</button></td>
            </tr>
        `);
            tbody.append(row);
        });

        $('#filePreviewTable').toggle(fileData.length > 0);
        updateSubmitButton();
    }
    // Handle dropdown change to update fileData and rerender table
    $(document).on('change', '.file-type-select', function() {
        const index = $(this).data('index');
        const selectedType = $(this).val();
        fileData[index].type = selectedType;
        renderTable(); // Rerender to enforce uniqueness
    });

    // Handle delete
    $(document).on('click', '.delete-btn', function() {
        const index = $(this).data('index');
        fileData.splice(index, 1);
        renderTable();
    });

    // $('#fileInput').on('change', function(e) {
    //     const files = Array.from(e.target.files);
    //     fileData = files.map(f => ({
    //         name: f.name,
    //         size: f.size,
    //         type: '',
    //         file: f
    //     }));
    //     renderTable();
    // });
    // $('#fileInputFile').on('change', function(e) {
    //     const files = Array.from(e.target.files);
    //     fileData = files.map(f => ({
    //         name: f.name,
    //         size: f.size,
    //         type: '',
    //         file: f
    //     }));
    //     renderTable();
    // });
    $('#upload-folder-button').on('click', () => {
        $('#fileInputFolder').click();
    });
    $('#fileInputFolder').on('change', function(e) {
        const files = Array.from(e.target.files);
        // alert(files.length);
        if (files.length === 0) {
            alert('The selected folder is empty.');
            return;
        }
        if (files.length < 2) {
            alert('The selected folder have lesser than 2 files.');
            return;
        }
        if (files.length > 5) {
            alert('The selected folder have more than 5 files.');
            return;
        }

        // Get folder name from first file path
        const firstPath = files[0].webkitRelativePath;
        const folderName = firstPath.split('/')[0]; // root folder name

        // Store folder name in each file object
        fileData = files.map(f => ({
            name: f.name,
            size: f.size,
            type: '',
            folder: f.webkitRelativePath.split('/')[0], // or use folderName
            file: f
        }));

        renderTable();
    });
    document.getElementById('drop-zone').addEventListener('dragover', function(e) {
        e.preventDefault();
    });

    document.getElementById('drop-zone').addEventListener('drop', async function(e) {
        e.preventDefault();

        const items = e.dataTransfer.items;
        if (!items || items.length === 0) {
            alert("No items found in drop.");
            return;
        }

        const firstEntry = items[0].webkitGetAsEntry?.();
        if (!firstEntry || !firstEntry.isDirectory) {
            alert("❌ Please drop a *folder*, not files.");
            return;
        }

        // ✅ Get root folder name from first entry
        const folderName = firstEntry.name;

        // ✅ Collect all files
        const files = await getFilesFromItems(items, folderName);

        if (files.length === 0) {
            alert("❌ Folder is empty.");
            return;
        }

        fileData = files.map(f => ({
            name: f.name,
            size: f.size,
            type: '',
            folder: folderName, // ✅ use root folder name here
            file: f
        }));

        renderTable();
    });


    async function getFilesFromItems(items) {
        const fileList = [];

        async function traverseDirectory(entry, path = '') {
            return new Promise((resolve) => {
                if (entry.isFile) {
                    entry.file(file => {
                        file.webkitRelativePath = path + file.name;
                        fileList.push(file);
                        resolve();
                    });
                } else if (entry.isDirectory) {
                    const reader = entry.createReader();
                    reader.readEntries(async (entries) => {
                        for (const ent of entries) {
                            await traverseDirectory(ent, path + entry.name + '/');
                        }
                        resolve();
                    });
                }
            });
        }

        for (let i = 0; i < items.length; i++) {
            const entry = items[i].webkitGetAsEntry();
            if (entry) {
                await traverseDirectory(entry);
            }
        }

        return fileList;
    }

    const statusContainer = document.getElementById('uploadStatus');
    const statusText = document.getElementById('statusText');

    setInterval(() => {
        if (!currentStudyName || !folderTimestamp) return; // skip if not set

        const studyId = currentStudyName + '_' + folderTimestamp;

        fetch(`/file-status/${studyId}`)
            .then(res => res.json())
            .then(files => {
                const {
                    pendingCount,
                    uploadedCount
                } = files;

                if (pendingCount > 0) {
                    statusText.innerText = `🟡 ${studyId} in progress: ${uploadedCount - pendingCount}/${uploadedCount} uploaded`;
                    statusContainer.style.display = 'block';
                } else {
                    // All files uploaded, hide the container
                    statusText.innerText = `✅ ${studyId} upload complete.`;
                    setTimeout(() => {
                        statusContainer.style.display = 'none';
                    }, 3000); // hide after 3s
                }
            })
            .catch(err => {
                console.error("Error fetching status:", err);
            });
    }, 5000);


    const dropZone = document.getElementById('drop-zone');
    dropZone.addEventListener('dragover', () => dropZone.classList.add('bg-light'));
    dropZone.addEventListener('dragleave', () => dropZone.classList.remove('bg-light'));
    dropZone.addEventListener('drop', () => dropZone.classList.remove('bg-light'));




    $('#filePreviewBody').on('change', '.file-type-select', function() {
        const index = $(this).data('index');
        fileData[index].type = $(this).val();
        // alert(index);
        updateSubmitButton();
    });

    $('#filePreviewBody').on('click', '.delete-btn', function() {
        const index = $(this).data('index');
        fileData.splice(index, 1);
        renderTable();
    });

    var currentStudyName = '';
    var folderTimestamp = '';
    const CHUNK_SIZE = 1 * 1024 * 1024; // 1 MB
    document.getElementById('submitBtn').addEventListener('click', function(e) {
        e.preventDefault();
        this.disabled = true;
        this.innerText = 'Uploading...'; // Optional: show progress
        $('#upload-button').prop('disabled', true);
        const uploadStatus = document.getElementById('progress-bar');
        const now = new Date();
        const folderTimestamp = `${String(now.getMinutes()).padStart(2, '0')}${String(now.getSeconds()).padStart(2, '0')}`;
        $('#progress-bar').html('');
        let completedFiles = 0;
        const studyName = fileData[0]?.folder || 'study_name'; // use first file's study name (or customize if multiple studies)
        // const folderName = fileData[0]?.folder || 'folder_name';
        const folderRequest = new FormData();
        folderRequest.append('folderTimestamp', folderTimestamp);
        folderRequest.append('study_name', studyName);
        fetch('/prepare-upload-folder', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                },
                body: folderRequest
            })
            .then(response => response.json())
            .then(data => {
                const createdFolder = data.folder_path;
                const folder_name = data.folder_name;
                currentStudyName = folder_name;

                // Now start file uploads
                let completedFiles = 0;
                fileData.forEach((fileItem, index) => {
                    const file = fileItem.file;
                    const studyName = fileItem.folder;
                    const type = fileItem.type;

                    const uploadId = `${Date.now()}-${file.name}-${index}`;
                    const totalChunks = Math.ceil(file.size / CHUNK_SIZE);
                    $('#delete-button' + index).prop('disabled', true);
                    let currentChunk = 0;

                    function uploadChunk() {
                        const start = currentChunk * CHUNK_SIZE;
                        const end = Math.min(start + CHUNK_SIZE, file.size);
                        const chunk = file.slice(start, end);

                        const formData = new FormData();
                        formData.append('chunk', chunk);
                        formData.append('upload_id', uploadId);
                        formData.append('index', currentChunk);
                        formData.append('total_chunks', totalChunks);
                        formData.append('file_name', file.name);
                        formData.append('type', type);
                        formData.append('study_name', studyName);
                        formData.append('folder_name', folder_name);
                        formData.append('upload_folder_id', folderTimestamp);
                        formData.append('final_folder_path', createdFolder);

                        const xhr = new XMLHttpRequest();
                        xhr.open('POST', '/chunk-upload', true);
                        xhr.setRequestHeader('X-CSRF-TOKEN', document.querySelector('meta[name="csrf-token"]').getAttribute('content'));

                        xhr.onload = () => {
                            const progressEl = document.querySelector(`tr[data-index="${index}"] .progress-bar`);

                            if (xhr.status === 200) {
                                currentChunk++;
                                const percent = (currentChunk / totalChunks) * 100;

                                if (progressEl) {
                                    progressEl.style.width = `${percent}%`;
                                    progressEl.innerText = `${percent.toFixed(1)}%`;
                                }

                                if (currentChunk < totalChunks) {
                                    uploadChunk();
                                } else {
                                    // File upload complete
                                    if (progressEl) {
                                        progressEl.innerText = `${file.name} upload complete!`;
                                    }

                                    completedFiles++;
                                    if (completedFiles === fileData.length) {
                                        $.ajax({
                                            type: 'POST',
                                            url: '{{ route("update-job-status") }}',
                                            data: {
                                                studyName: studyName,
                                                folderTimestamp: folderTimestamp
                                            },
                                            headers: {
                                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                            },
                                            success: function(response) {

                                                // ✅ All files uploaded
                                                setTimeout(() => {
                                                    window.location.href = '/view';
                                                }, 1000); // Small delay to show "upload complete"

                                            },
                                            error: function(xhr) {
                                                alert('Please check the form for errors.');

                                            }
                                        });

                                    }
                                }
                            } else {
                                if (progressEl) {
                                    progressEl.innerText = `${file.name} upload failed.`;
                                }
                            }
                        };
                        xhr.onerror = () => {
                            document.getElementById(`progress-${index}`).innerText = `${file.name} network error.`;
                        };

                        xhr.send(formData);
                    }

                    // Create progress entry
                    // const p = document.createElement('p');
                    // p.id = `progress-${index}`;
                    // p.innerText = `Uploading ${file.name}: 0%`;
                    // uploadStatus.appendChild(p);

                    uploadChunk();
                });
            });
    });
</script>
<!-- <script>
    $(document).ready(function() {
        var $dropZone = $('#dropZone');

        $dropZone.on('dragover', function(e) {
            e.preventDefault();
            e.stopPropagation();
            $dropZone.addClass('bg-light');
        });

        $dropZone.on('dragleave', function(e) {
            e.preventDefault();
            e.stopPropagation();
            $dropZone.removeClass('bg-light');
        });

        $dropZone.on('drop', function(e) {
            e.preventDefault();
            e.stopPropagation();
            $dropZone.removeClass('bg-light');

            var items = e.originalEvent.dataTransfer.items;

            for (var i = 0; i < items.length; i++) {
                var item = items[i].webkitGetAsEntry();
                if (item) {
                    traverseFileTree(item);
                }
            }
        });

        function traverseFileTree(item, path = "") {
            if (item.isFile) {
                item.file(function(file) {
                    file.fullPath = path + file.name;
                    console.log("Dropped file:", file.fullPath);
                    // Call your upload function here with 'file'
                    // uploadFile(file); // <-- Optional
                });
            } else if (item.isDirectory) {
                var dirReader = item.createReader();
                dirReader.readEntries(function(entries) {
                    $.each(entries, function(i, entry) {
                        traverseFileTree(entry, path + item.name + "/");
                    });
                });
            }
        }
    });
</script> -->
@endsection