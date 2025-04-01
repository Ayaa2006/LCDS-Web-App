@php
    // Check if the user is logged in
    $userRole = session('role');
    $isLoggedIn = Auth::check();
@endphp


@if ($userRole === 'admin')
    <script>
        window.location.href = "{{ route('dashboard') }}";
    </script>
@endif

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Gamification | La Casa de Selfie</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
    :root {
        --primary-color: #2c3e50;
        --secondary-color: #e74c3c;
        --accent-color: #3498db;
        --light-bg: #f8f9fa;
        --border-color: #ecf0f1;
        --text-dark: #2c3e50;
        --text-medium: #7f8c8d;
    }

    body {
        background-color: var(--light-bg);
        font-family: 'Arial', sans-serif;
        color: var(--text-dark);
    }

    .gamification-container {
        max-width: 1100px;
        margin: 50px auto;
        background-color: white;
        border-radius: 8px;
        padding: 30px 40px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        border: 1px solid var(--border-color);
    }

    .header-image {
        background-image: linear-gradient(rgba(44, 62, 80, 0.8), rgba(44, 62, 80, 0.8)), 
                          url("{{ asset('banner.jpg') }}");
        background-size: cover;
        color: white;
        text-align: center;
        padding: 80px 0;
        position: relative;
        height: auto;
        border-radius: 8px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        margin-bottom: 30px;
    }

    .header-image h1 {
        font-weight: 700;
        font-size: 2.5rem;
        margin-bottom: 10px;
    }

    .header-image p {
        font-size: 1.2rem;
        opacity: 0.9;
    }

    .points-box {
        display: flex;
        justify-content: space-between;
        padding: 30px;
        background-color: white;
        border-radius: 15px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
        margin-top: -40px;
        z-index: 1;
        position: relative;
        border: 1px solid var(--border-color);
    }

    .stat-item {
        text-align: center;
        padding: 0 15px;
        position: relative;
    }

    .stat-item:not(:last-child)::after {
        content: "";
        position: absolute;
        right: 0;
        top: 50%;
        transform: translateY(-50%);
        height: 60%;
        width: 1px;
        background-color: var(--border-color);
    }

    .stat-icon {
        font-size: 2rem;
        margin-bottom: 10px;
    }

    .stat-value {
        font-size: 1.8rem;
        font-weight: 700;
        color: var(--primary-color);
        margin-bottom: 5px;
    }

    .stat-label {
        font-size: 0.9rem;
        color: var(--text-medium);
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .progress-container {
        margin: 30px 0;
        padding: 20px;
        background-color: white;
        border-radius: 8px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        border: 1px solid var(--border-color);
    }

    .progress-title {
        display: flex;
        justify-content: space-between;
        margin-bottom: 10px;
        font-weight: 600;
        color: var(--primary-color);
    }

    .progress {
        height: 12px;
        border-radius: 6px;
        background-color: #e9ecef;
    }

    .progress-bar {
        background-color: var(--accent-color);
        border-radius: 6px;
    }

    .task-list {
        margin-top: 40px;
    }

    .section-title {
        font-size: 1.5rem;
        font-weight: 600;
        color: var(--primary-color);
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .section-title i {
        color: var(--accent-color);
    }

    .task-item {
        transition: all 0.3s;
        padding: 20px;
        margin-bottom: 15px;
        background-color: white;
        border-radius: 8px;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.05);
        border: 1px solid var(--border-color);
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .task-item:hover {
        transform: translateY(-3px);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    }

    .task-info {
        flex: 1;
    }

    .task-title {
        font-weight: 600;
        color: var(--primary-color);
        margin-bottom: 5px;
    }

    .task-desc {
        color: var(--text-medium);
        font-size: 0.9rem;
        margin-bottom: 10px;
    }

    .task-points {
        background-color: var(--accent-color);
        color: white;
        padding: 3px 10px;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 600;
        display: inline-block;
    }

    .task-actions {
        display: flex;
        gap: 10px;
    }

    .btn-primary-custom {
        background-color: var(--primary-color);
        color: white;
        border-radius: 30px;
        padding: 8px 20px;
        font-weight: 600;
        transition: all 0.3s;
        border: none;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }

    .btn-primary-custom:hover {
        background-color: #1a252f;
        color: white;
        transform: translateY(-2px);
    }

    .btn-info-custom {
        background-color: var(--accent-color);
        color: white;
        border-radius: 30px;
        padding: 8px 20px;
        font-weight: 600;
        transition: all 0.3s;
        border: none;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }

    .btn-info-custom:hover {
        background-color: #2980b9;
        color: white;
        transform: translateY(-2px);
    }

    .image-upload-container {
        margin-top: 15px;
        display: none;
        padding: 15px;
        background-color: var(--light-bg);
        border-radius: 8px;
    }

    .image-preview {
        width: 100px;
        height: 100px;
        object-fit: cover;
        margin-right: 10px;
        margin-bottom: 10px;
        border-radius: 8px;
        border: 2px solid white;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .file-input-wrapper {
        margin-bottom: 10px;
    }

    .image-previews {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        margin-top: 15px;
    }

    .parrainage-box {
        margin-top: 40px;
        padding: 25px;
        background-color: white;
        border-radius: 8px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        border: 1px solid var(--border-color);
    }

    .parrainage-box h4 {
        font-size: 1.3rem;
        font-weight: 600;
        color: var(--primary-color);
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .parrainage-box h4 i {
        color: var(--accent-color);
    }

    .form-label {
        font-weight: 600;
        color: var(--primary-color);
        margin-bottom: 10px;
    }

    .btn-dark-custom {
        background-color: var(--primary-color);
        color: white;
        border-radius: 30px;
        padding: 10px 20px;
        font-weight: 600;
        transition: all 0.3s;
        border: none;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }

    .btn-dark-custom:hover {
        background-color: #1a252f;
        color: white;
        transform: translateY(-2px);
    }

    .alert {
        border-radius: 8px;
    }

    @media (max-width: 768px) {
        .points-box {
            flex-direction: column;
            gap: 20px;
            padding: 20px;
        }
        
        .stat-item:not(:last-child)::after {
            display: none;
        }
        
        .task-item {
            flex-direction: column;
            align-items: flex-start;
            gap: 15px;
        }
        
        .task-actions {
            width: 100%;
            justify-content: flex-end;
        }
        /* SweetAlert2 Customization */
.swal2-popup {
    border-radius: 8px !important;
    font-family: 'Arial', sans-serif !important;
}

.swal2-title {
    color: var(--primary-color) !important;
    font-weight: 600 !important;
}

.swal2-success {
    color: #28a745 !important;
}

.swal2-error {
    color: #dc3545 !important;
}

.swal2-confirm {
    background-color: var(--primary-color) !important;
    border-radius: 30px !important;
    padding: 8px 20px !important;
    font-weight: 600 !important;
    transition: all 0.3s !important;
    border: none !important;
}

.swal2-confirm:hover {
    background-color: #1a252f !important;
    transform: translateY(-2px) !important;
}
    }
    <style>
    /* Style du tableau */
    .table {
        border-radius: 8px;
        overflow: hidden;
    }
    
    .table th {
        background-color: #f8f9fa;
        color: #2c3e50;
        font-weight: 600;
    }
    
    .table td, .table th {
        padding: 12px 15px;
        vertical-align: middle;
    }
    
    .table tr:not(:last-child) {
        border-bottom: 1px solid #ecf0f1;
    }
    
    /* Badges */
    .badge {
        padding: 6px 10px;
        font-size: 0.85rem;
        font-weight: 500;
    }
    
    .bg-success {
        background-color: #28a745 !important;
    }
    
    .bg-danger {
        background-color: #dc3545 !important;
    }
    
    .bg-warning {
        background-color: #ffc107 !important;
        color: #212529 !important;
    }
    
    /* Liens des fichiers */
    .table a {
        color: #3498db;
        text-decoration: none;
        transition: color 0.2s;
    }
    
    .table a:hover {
        color: #1a5276;
        text-decoration: underline;
    }
</style>
    </style>
</head>

<body>
    @include('navbar')

    <div class="gamification-container">
        <!-- Header -->
        <div class="header-image">
            <h1>Gamification Dashboard</h1>
            <p>Complete tasks, earn points, and unlock rewards!</p>
        </div>

        <!-- Points Box -->
        <div class="points-box">
            @if ($gamification)
                <div class="stat-item">
                    <div class="stat-icon text-primary">
                        <i class="fas fa-trophy"></i>
                    </div>
                    <div class="stat-value">{{ $gamification->level }}</div>
                    <div class="stat-label">Current Level</div>
                </div>
                <div class="stat-item">
                    <div class="stat-icon text-warning">
                        <i class="fas fa-star"></i>
                    </div>
                    <div class="stat-value">{{ $gamification->point }}</div>
                    <div class="stat-label">Total Points</div>
                </div>
                <div class="stat-item">
                    <div class="stat-icon text-success">
                        <i class="fas fa-check-circle"></i>
                    </div>
                    <div class="stat-value">{{ $gamification->tasks_done }}</div>
                    <div class="stat-label">Tasks Completed</div>
                </div>
                <div class="stat-item">
                    <div class="stat-icon text-info">
                        <i class="fas fa-arrow-up"></i>
                    </div>
                    <div class="stat-value">{{ $pointsToNextLevel }}</div>
                    <div class="stat-label">To Next Level</div>
                </div>
            @else
                <div class="alert alert-warning w-100">No gamification data found. Complete tasks to earn points!</div>
            @endif
        </div>

        <!-- Progress Bar - Only shown if $currentLevelProgress is defined -->
        @if ($gamification && isset($currentLevelProgress))
        <div class="progress-container">
            <div class="progress-title">
                <span>Progress to Next Level</span>
                <span>{{ $currentLevelProgress }}%</span>
            </div>
            <div class="progress">
                <div class="progress-bar" role="progressbar" style="width: {{ $currentLevelProgress }}%" 
                     aria-valuenow="{{ $currentLevelProgress }}" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
        </div>
        @endif

        <!-- Task List -->
        <div class="task-list">
            <h3 class="section-title">
                <i class="fas fa-tasks"></i>
                Available Tasks
            </h3>
            
            @if($tasks->isEmpty())
                <div class="alert alert-info">No tasks available at the moment. Check back later!</div>
            @else
                <ul class="list-unstyled">
                    @foreach ($tasks as $task)
                        <li class="task-item">
                            <div class="task-info">
                                <div class="task-title">{{ $task->title }}</div>
                                <div class="task-desc">{{ $task->description }}</div>
                                <span class="task-points">{{ $task->point }} points</span>
                                
                                @if($task->CanLink)
                                <div class="image-upload-container" id="upload-container-{{ $task->id }}">
                                    <div class="d-flex align-items-center mb-2">
                                        <button type="button" 
                                                id="add-image-btn-{{ $task->id }}" 
                                                class="btn btn-info-custom btn-sm me-2">
                                            <i class="fas fa-plus"></i> Add Image
                                        </button>
                                        <label class="form-label mb-0">(Maximum 4 images allowed)</label>
                                    </div>
                                    
                                    <div class="file-inputs-container">
                                        <!-- Dynamically added file inputs will go here -->
                                    </div>
                                    
                                    <div class="image-previews" id="previews-{{ $task->id }}">
                                        <!-- Image previews will be displayed here -->
                                    </div>
                                </div>
                                @endif
                            </div>
                            <div class="task-actions">
                                @if($task->CanLink)
                                <button type="button" class="btn btn-info-custom" onclick="toggleUploadContainer({{ $task->id }})">
                                    <i class="fas fa-images"></i> Images
                                </button>
                                @endif
                                <button type="button" 
                                        onclick="submitTask({{ $task->id }})" 
                                        class="btn btn-primary-custom">
                                    <i class="fas fa-paper-plane"></i> Submit
                                </button>
                            </div>
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>



<!-- User Submissions Section -->
<div id="submissions-container" class="gamification-table">
    </div>
<style>
    .gamification-table {
        background-color: #f8f9fa;
        border-radius: 10px;
        padding: 20px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        margin-top: 20px;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .gamification-table table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0;
        background: white;
        border-radius: 8px;
        overflow: hidden;
    }

    .gamification-table th {
        background-color: #2c3e50;
        color: white;
        padding: 12px 15px;
        text-align: left;
        font-weight: 600;
    }

    .gamification-table td {
        padding: 12px 15px;
        border-bottom: 1px solid #e0e0e0;
        vertical-align: middle;
    }

    .gamification-table tr:last-child td {
        border-bottom: none;
    }

    .gamification-table tr:hover {
        background-color: #f1f7fd;
    }

    .gamification-table a {
        color: #3498db;
        text-decoration: none;
        transition: color 0.2s;
    }

    .gamification-table a:hover {
        color: #2980b9;
        text-decoration: underline;
    }

    .no-submissions {
        text-align: center;
        padding: 20px;
        color: #7f8c8d;
        font-style: italic;
        background: white;
        border-radius: 8px;
    }

    /* Badges pour les statuts */
    .gamification-table .status-pending {
        background-color: #f39c12;
        color: white;
        padding: 4px 8px;
        border-radius: 12px;
        font-size: 12px;
        display: inline-block;
    }

    .gamification-table .status-approved {
        background-color: #2ecc71;
        color: white;
        padding: 4px 8px;
        border-radius: 12px;
        font-size: 12px;
        display: inline-block;
    }

    .gamification-table .status-rejected {
        background-color: #e74c3c;
        color: white;
        padding: 4px 8px;
        border-radius: 12px;
        font-size: 12px;
        display: inline-block;
    }
</style>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        @auth
            var userId = @json(auth()->id());
            console.log('ID de l\'utilisateur récupéré :', userId);

            fetch(`/get-submissions/${userId}`)
                .then(response => response.json())
                .then(submissions => {
                    const container = document.getElementById('submissions-container');
                    
                    if (submissions.length > 0) {
                        let tableHtml = `
                            <h3>Mes Soumissions</h3>
                            <table>
                                <thead>
                                    <tr>
                                        <th>Tâche</th>
                                        <th>Statut</th>
                                        <th>Fichiers</th>
                                    </tr>
                                </thead>
                                <tbody>`;
                        
                        submissions.forEach(submission => {
                            let statusClass = 'status-pending';
                            if (submission.status.toLowerCase().includes('approv')) {
                                statusClass = 'status-approved';
                            } else if (submission.status.toLowerCase().includes('reject')) {
                                statusClass = 'status-rejected';
                            }

                            tableHtml += `
                                <tr>
                                    <td><strong>${submission.task_title}</strong></td>
                                    <td><span class="${statusClass}">${submission.status}</span></td>
                                    <td>`;
                            
                            let files = submission.files ? submission.files.split(',') : [];
                            if (files.length > 0) {
                                files.forEach(file => {
                                    const fileName = file.split('/').pop();
                                    tableHtml += `
                                        <div class="file-link">
                                            <a href="#" class="download-link" data-file="${file}" data-filename="${fileName}">
                                                <i class="fas fa-file-alt"></i> ${fileName}
                                            </a>
                                        </div>`;
                                });
                            } else {
                                tableHtml += 'Aucun fichier';
                            }

                            tableHtml += `</td></tr>`;
                        });
                        
                        tableHtml += `</tbody></table>`;
                        container.innerHTML = tableHtml;

                        // Gestionnaire pour les liens de téléchargement
                        document.querySelectorAll('.download-link').forEach(link => {
                            link.addEventListener('click', function(e) {
                                e.preventDefault();
                                const fileUrl = this.getAttribute('data-file');
                                const fileName = this.getAttribute('data-filename');
                                downloadFile(fileUrl, fileName);
                            });
                        });
                    } else {
                        container.innerHTML = `
                            <div class="no-submissions">
                                <i class="fas fa-inbox" style="font-size: 24px; margin-bottom: 10px;"></i>
                                <p>Aucune soumission trouvée.</p>
                            </div>`;
                    }
                })
                .catch(error => {
                    console.error('Erreur lors de la récupération des soumissions :', error);
                    document.getElementById('submissions-container').innerHTML = `
                        <div class="no-submissions">
                            <i class="fas fa-exclamation-triangle" style="font-size: 24px; margin-bottom: 10px;"></i>
                            <p>Une erreur est survenue lors de la récupération des soumissions.</p>
                        </div>`;
                });
        @else
            console.log('Utilisateur non authentifié');
            document.getElementById('submissions-container').innerHTML = `
                <div class="no-submissions">
                    <i class="fas fa-user-lock" style="font-size: 24px; margin-bottom: 10px;"></i>
                    <p>Veuillez vous connecter pour voir vos soumissions.</p>
                </div>`;
        @endauth

        // Fonction pour télécharger les fichiers
        function downloadFile(url, filename) {
            // Solution alternative pour forcer le téléchargement
            const a = document.createElement('a');
            a.href = url;
            a.download = filename || 'download';
            a.target = '_blank'; // Optionnel: ouvre dans un nouvel onglet si le téléchargement échoue
            document.body.appendChild(a);
            a.click();
            document.body.removeChild(a);
            
            // Alternative plus robuste pour les fichiers distants:
            /*
            fetch(url, { mode: 'no-cors' })
                .then(response => response.blob())
                .then(blob => {
                    const blobUrl = window.URL.createObjectURL(blob);
                    const a = document.createElement('a');
                    a.href = blobUrl;
                    a.download = filename || 'download';
                    document.body.appendChild(a);
                    a.click();
                    window.URL.revokeObjectURL(blobUrl);
                    document.body.removeChild(a);
                })
                .catch(() => {
                    // Fallback si fetch échoue (ouvre le lien normalement)
                    window.open(url, '_blank');
                });
            */
        }
    });
</script>


        <!-- Parrainage Section -->
        <div class="parrainage-box">
            <h4><i class="fas fa-user-friends"></i> Referral Program</h4>

            <!-- Form to Use a Friend's Code -->
            <div class="mb-4">
                <label for="friend-code" class="form-label">Use a friend's referral code</label>
                <div class="d-flex">
                    <input type="text" class="form-control me-2" id="friend-code" placeholder="Enter your friend's code">
                    <button class="btn btn-dark-custom" id="validate-code">
                        <i class="fas fa-check"></i> Validate
                    </button>
                </div>
            </div>

            <!-- Form to Generate and Share Your Code -->
            <div>
                <label for="your-code" class="form-label">Your personal referral code</label>
                <div class="d-flex">
                    <input type="text" class="form-control me-2" id="your-code" readonly 
                           value="{{ $gamification->Code ?? '' }}" 
                           placeholder="Your code will appear here">
                    <button class="btn btn-dark-custom" id="copy-code">
                        <i class="fas fa-copy"></i> Copy
                    </button>
                </div>
                <small class="text-muted">Share this code with friends to earn bonus points!</small>
            </div>

            <!-- Alert Messages -->
            <div id="alert-container" class="mt-3"></div>
        </div>
    </div>

    <script>
        function toggleUploadContainer(taskId) {
            const container = document.getElementById(`upload-container-${taskId}`);
            container.style.display = container.style.display === 'none' ? 'block' : 'none';
        }

        function createImageUploadContainer(taskId) {
            const container = document.getElementById(`upload-container-${taskId}`);
            const fileInputsContainer = container.querySelector('.file-inputs-container');
            const previewsContainer = container.querySelector('.image-previews');
            
            // Check if we already have 4 inputs
            if (fileInputsContainer.children.length >= 4) {
                alert('You can upload a maximum of 4 images');
                return;
            }

            // Determine the next available image number
            let nextImageNumber = 1;
            const existingInputs = fileInputsContainer.querySelectorAll('input[type="file"]');
            const usedNumbers = Array.from(existingInputs).map(input => 
                parseInt(input.dataset.imageNumber) || 0
            );
            
            while (usedNumbers.includes(nextImageNumber)) {
                nextImageNumber++;
            }

            // Create the wrapper
            const inputWrapper = document.createElement('div');
            inputWrapper.classList.add('file-input-wrapper', 'mb-2', 'd-flex', 'align-items-center');

            // Create the file input with image number
            const fileInput = document.createElement('input');
            fileInput.type = 'file';
            fileInput.name = `images[${nextImageNumber}]`;
            fileInput.dataset.imageNumber = nextImageNumber;
            fileInput.accept = 'image/*';
            fileInput.classList.add('form-control', 'me-2');
            fileInput.id = `file-input-${taskId}-${nextImageNumber}`;

            // Create the label
            const label = document.createElement('span');
            label.textContent = `Image ${nextImageNumber}`;
            label.classList.add('me-2', 'badge', 'bg-secondary');

            // Remove button
            const removeBtn = document.createElement('button');
            removeBtn.type = 'button';
            removeBtn.innerHTML = '<i class="fas fa-times"></i>';
            removeBtn.classList.add('btn', 'btn-sm', 'btn-outline-danger');
            removeBtn.addEventListener('click', () => {
                const previewToRemove = document.querySelector(`#preview-${fileInput.id}`);
                if (previewToRemove) previewToRemove.remove();
                inputWrapper.remove();
            });

            // Preview handling
            fileInput.addEventListener('change', function(e) {
                const existingPreview = document.querySelector(`#preview-${fileInput.id}`);
                if (existingPreview) existingPreview.remove();

                if (this.files.length > 0) {
                    const reader = new FileReader();
                    reader.onload = function(event) {
                        const img = document.createElement('img');
                        img.src = event.target.result;
                        img.id = `preview-${fileInput.id}`;
                        img.classList.add('image-preview', 'me-2', 'mb-2');
                        previewsContainer.appendChild(img);
                    }
                    reader.readAsDataURL(this.files[0]);
                }
            });

            // Assemble elements
            inputWrapper.appendChild(label);
            inputWrapper.appendChild(fileInput);
            inputWrapper.appendChild(removeBtn);
            fileInputsContainer.appendChild(inputWrapper);
        }

        async function submitTask(taskId) {
    const fileInputs = document.querySelectorAll(`#upload-container-${taskId} input[type='file']`);
    const formData = new FormData();
    
    fileInputs.forEach(input => {
        if (input.files.length > 0) {
            const imageNumber = input.dataset.imageNumber;
            formData.append(`images[${imageNumber}]`, input.files[0]);
        }
    });

    if (formData.entries().next().done) {
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Veuillez sélectionner au moins une image',
            confirmButtonText: 'OK'
        });
        return;
    }

    try {
        const response = await fetch(`/tasks/${taskId}/submit`, {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Accept': 'application/json'
            }
        });

        const result = await response.json();
        
        if (result.success) {
            Swal.fire({
                icon: 'success',
                title: 'Succès!',
                text: result.message,
                confirmButtonText: 'OK',
                willClose: () => {
                    window.location.reload();
                }
            });
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Erreur',
                text: result.message || 'Une erreur est survenue',
                confirmButtonText: 'OK'
            });
        }
    } catch (error) {
        console.error('Error:', error);
        Swal.fire({
            icon: 'error',
            title: 'Erreur',
            text: 'Une erreur inattendue est survenue',
            confirmButtonText: 'OK'
        });
    }
}

        function showAlert(message, type) {
            const alertDiv = document.createElement('div');
            alertDiv.className = `alert alert-${type} alert-dismissible fade show`;
            alertDiv.innerHTML = `
                ${message}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            `;
            document.getElementById('alert-container').appendChild(alertDiv);
            
            setTimeout(() => {
                alertDiv.remove();
            }, 5000);
        }

        // Attach event listeners for add image buttons
        document.addEventListener('DOMContentLoaded', () => {
            @foreach ($tasks as $task)
                @if($task->CanLink)
                    document.getElementById('add-image-btn-{{ $task->id }}').addEventListener('click', () => {
                        createImageUploadContainer({{ $task->id }});
                    });
                @endif
            @endforeach

            // Copy code to clipboard
            document.getElementById('copy-code').addEventListener('click', function() {
                const codeInput = document.getElementById('your-code');
                codeInput.select();
                document.execCommand('copy');
                
                showAlert('Code copied to clipboard!', 'success');
            });
            
            // Validate code 
            document.getElementById('validate-code').addEventListener('click', function() {
                const codeInput = document.getElementById('friend-code');
                if (!codeInput.value) {
                    showAlert('Please enter a referral code', 'danger');
                    return;
                }
                
                // In a real implementation, you would make an AJAX call here
                showAlert('Code validation would be processed here in a real implementation', 'info');
            });
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js"></script>

   
</body>
</html>