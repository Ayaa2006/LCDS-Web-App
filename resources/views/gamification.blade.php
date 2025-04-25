@php
    // Check if the user is logged in
    $userRole = session('role');
    $isLoggedIn = Auth::check();
@endphp
@auth
    @php
        $userId = Auth::id();
        $username = Auth::user()->name;
        $gamificationResponse = app('App\Http\Controllers\GamificationController')->getGamificationData($userId);
        $gamificationData = $gamificationResponse->getData(true); // Decode JSON response to array
        $gamification = $gamificationData['gamification'];
        $rang = $gamificationData['rang'];
        $remainingTasks = $gamificationData['remaining_tasks'];
    @endphp
<script>
        //if remainingTasks is 0 , reload the page

        document.addEventListener("DOMContentLoaded", function() {
            if ({{ $remainingTasks }} === 0) {
                window.location.reload();
            }
        });
</script>
    @php
    $progressPercentage = $remainingTasks > 0 
        ? ($gamification['tasks_done'] / ($gamification['tasks_done'] + $remainingTasks)) * 100 
        : 100;

    $currentLevelProgress = round($progressPercentage, 2); // Ensure $currentLevelProgress is defined
    @endphp
   
@endauth

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

</head>

<body>
    @include('navbar')

    <script>
  function getRangColor(libelle) {
    if (!libelle) return '#000000';

    const normalizedLibelle = libelle.toLowerCase().trim();

    const rangColors = {
      'recrue': '#A9A9A9',
      'apprenti': '#CD7F32',
      'novice': '#C0C0C0',
      'adepte': '#2E8B57',
      'expert': '#4169E1',
      'maitre': '#800080',
      'champion': '#FFA500',
      'legende': '#FFD700',
      'heros': '#00FFFF',
      'genie': '#E5E4E2',
      'icone': '#DC143C',
      'virtuose': '#000000',
      'legendaire': '#FF00FF',
      'immortel': '#E6E6FA',
      'divin': '#8A2BE2'
    };

    return rangColors[normalizedLibelle] || '#000000';
  }
</script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const rangLibelle = "{{ $rang['libelle'] }}";
        const color = getRangColor(rangLibelle);
        const rankElements = document.querySelectorAll('.rank');

        rankElements.forEach(element => {
            element.style.color = color;
        });
    });
</script>


<div class="gamification-container">
    <!-- Header -->
    <style>
    .header-container {
        position: relative;
        text-align: center;
        margin-bottom: 30px;
    }

    .header-image {
        width: 100%;
        border-radius: 8px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        filter: blur(2.5px); /* Apply blur effect to the image */
    }

    .header-text {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        color: white;
        z-index: 1;
        text-shadow: 0 2px 4px rgba(0, 0, 0, 0.5);
    }

    .header-text h1,
    .header-text h2,
    .header-text h4 {
        margin: 0;
    }
    </style>

    <div class="header-container">
        <img src="{{ asset('banner.jpg') }}" alt="Header Image" class="header-image">
        <div class="header-text">
            <h1>Revoilà , {{$username}}</h1>
            <h2 class='rank'>{{$rang['libelle']}}</h2>
            <h4 class='rank'>{{$rang['description']}}</h4>
        </div>
    </div>

        <!-- Points Box -->
        <div class="points-box">
            @if ($gamification)
                <div class="stat-item">
                    <div class="stat-icon text-primary">
                        <i class="fas fa-trophy"></i>
                    </div>
                    <div class="stat-value">{{ $gamification['level'] }}</div>
                    <div class="stat-label">Current Level</div>
                </div>
                <div class="stat-item">
                    <div class="stat-icon text-warning">
                        <i class="fas fa-star"></i>
                    </div>
                    <div class="stat-value">{{ $gamification['point'] }}</div>
                    <div class="stat-label">Total Points</div>
                </div>
                <div class="stat-item">
                    <div class="stat-icon text-success">
                        <i class="fas fa-check-circle"></i>
                    </div>
                    <div class="stat-value">{{ $gamification['tasks_done'] }}</div>
                    <div class="stat-label">Tasks Completed</div>
                </div>
                <div class="stat-item">
                    <div class="stat-icon text-info">
                        <i class="fas fa-arrow-up"></i>
                    </div>
                    <div class="stat-value">{{ $remainingTasks }}</div>
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
                                @if($task->CanLink && $task->id >2)
                                <button type="button" class="btn btn-info-custom" onclick="toggleUploadContainer({{ $task->id }})">
                                    <i class="fas fa-images"></i> Images
                                </button>
                                
                                <button type="button" 
                                        onclick="submitTask({{ $task->id }})" 
                                        class="btn btn-primary-custom">
                                    <i class="fas fa-paper-plane"></i> Submit
                                </button>
                                @endif
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
    var container = document.getElementById('submissions-container');

    fetch(`/get-submissions/${userId}`)
        .then(response => {
            if (!response.ok) throw new Error('Erreur réseau');
            return response.json();
        })
        .then(submissions => {
            if (submissions.length > 0) {
                renderSubmissionsTable(submissions);
            } else {
                showNoSubmissions(container);
            }
        })
        .catch(error => {
            console.error('Erreur:', error);
            showError(container);
        });
    @else
    showLoginRequired(document.getElementById('submissions-container'));
    @endauth

    function renderSubmissionsTable(submissions) {
        const container = document.getElementById('submissions-container');
        let tableHtml = `
        <h3 class="section-title">
                <i class="fas fa-table"></i>
                Mes Soumissions
            </h3>
            
            <table class="submissions-table">
                <thead>
                    <tr>
                        <th>Tâche</th>
                        <th>Statut</th>
                        <th>Fichiers</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>`;

        const deleteRoute = "{{ route('submissions.delete', ':id') }}";

        submissions.forEach(submission => {
            const statusClass = getStatusClass(submission.status);
            const files = submission.files ? submission.files.split(',') : [];
            //console.log(submission);
            tableHtml += `
                <tr>
                    <td>${submission.task_title || 'Tâche sans nom'}</td>
                    <td><span class="${statusClass}">${submission.status}</span></td>
                    <td class="file-links">${
                        files.length > 0 
                            ? renderFileLinks(files) 
                            : 'Aucun fichier'
                    }</td>
                    <td>
                        <button type="button" class="btn btn-primary btn-sm" onclick="deleteSubmission(${submission.id_Sub_task})">
                            <i class="fas fa-trash"></i>
                </tr>`;
        });

        tableHtml += `</tbody></table>`;
        container.innerHTML = tableHtml;

        setupDownloadHandlers();
    }

    function getStatusClass(status) {
        const lowerStatus = status.toLowerCase();
        return lowerStatus.includes('approv') ? 'status-approved' :
               lowerStatus.includes('reject') ? 'status-rejected' : 'status-pending';
    }

    function renderFileLinks(files) {
        return files.map((file, index) => {
            const cleanPath = cleanFilePath(file);
            const fileName = generateDisplayName(cleanPath);
            const fileExt = getFileExtension(cleanPath);
            
            return `
                <a href="#" 
                   class="download-btn" 
                   data-path="${encodeURIComponent(cleanPath)}"
                   data-filename="${fileName}${fileExt ? '.' + fileExt : ''}">
                    ${fileName}
                </a>`;
        }).join('');
    }

    function cleanFilePath(path) {
        return path.replace(/\\/g, '/').replace(/^"|"$/g, '');
    }

    function getFileExtension(path) {
        return path.split('.').pop();
    }

    function generateDisplayName(filename) {
        const baseName = filename.split('/').pop();
        
        // Format: X_username_TaskY_ImageZ.ext → Image Z
        const imageMatch = baseName.match(/Image(\d+)/);
        if (imageMatch) return `Image ${imageMatch[1]}`;
        
        // Format: X_username_TaskY_original.ext → original
        const taskMatch = baseName.match(/_\w+_Task\d+_(.*?)(\..*)?$/);
        if (taskMatch) return taskMatch[1];
        
        // Sinon retourner le nom de fichier sans extension
        return baseName.replace(/\.[^/.]+$/, '');
    }

    function setupDownloadHandlers() {
        document.querySelectorAll('.download-btn').forEach(btn => {
            btn.addEventListener('click', function(e) {
                e.preventDefault();
                const path = this.getAttribute('data-path');
                const filename = this.getAttribute('data-filename');
                triggerDownload(path, filename);
            });
        });
    }

    function triggerDownload(fullPath, displayName) {
        const cleanPath = decodeURIComponent(fullPath)
            .replace(/^"|"$/g, '')
            .replace(/\\/g, '/')
            .replace(/^\/+/, '');
        
        const url = `/storage/${cleanPath.replace('public/', '')}`;
        
        const link = document.createElement('a');
        link.href = url;
        link.download = displayName || cleanPath.split('/').pop();
        document.body.appendChild(link);
        link.click();
        document.body.removeChild(link);
    }

    function showNoSubmissions(container) {
        container.innerHTML = `
            <div class="no-submissions">
                <i class="fas fa-inbox"></i>
                <p>Aucune soumission trouvée</p>
            </div>`;
    }

    function showError(container) {
        container.innerHTML = `
            <div class="no-submissions error">
                <i class="fas fa-exclamation-triangle"></i>
                <p>Erreur de chargement des soumissions</p>
            </div>`;
    }

    function showLoginRequired(container) {
        container.innerHTML = `
            <div class="no-submissions">
                <i class="fas fa-user-lock"></i>
                <p>Veuillez vous connecter pour voir vos soumissions</p>
            </div>`;
    }
});
        function deleteSubmission(submissionId) {
            Swal.fire({
                title: 'Êtes-vous sûr?',
                text: "Cette action est irréversible!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Oui, supprimer!',
                cancelButtonText: 'Annuler'
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch(`/submissions/delete/${submissionId}`, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                        }
                    })
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Erreur réseau');
                        }
                        return response.json();
                    })
                    .then(data => {
                        if (data.success) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Supprimé!',
                                text: data.message,
                                confirmButtonText: 'OK'
                            }).then(() => {
                                window.location.reload();
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Erreur!',
                                text: data.message || 'Une erreur est survenue.',
                                confirmButtonText: 'OK'
                            });
                        }
                    })
                    .catch(error => {
                        console.error('Erreur:', error);
                        Swal.fire({
                            icon: 'error',
                            title: 'Erreur!',
                            text: 'Une erreur inattendue est survenue.',
                            confirmButtonText: 'OK'
                        });
                    });
                }
            });
        }

</script>

 <!-- Parrainage Section -->
 <div class="parrainage-box">
            <h4><i class="fas fa-user-friends"></i> Programme de parrainage</h4>

            <!-- Form to Use a Friend's Code -->
            <div class="mb-4">
            <label for="your-code" class="form-label">Votre code de parrainage personnel</label>
                <div class="d-flex">
                    <input type="text" class="form-control me-2" id="your-code" readonly 
                           value="{{ $gamification['code'] ?? '' }}" 
                           placeholder="Votre code apparaîtra ici">
                    <button class="btn btn-dark-custom" id="copy-code">
                        <i class="fas fa-copy"></i> Copier
                    </button>
                </div>
                <small class="text-muted">Partagez ce code avec vos amis pour gagner des points bonus!</small>
          
            </div>

            <!-- Form to Generate and Share Your Code -->
            <div>
            <label for="friend-code" class="form-label">Utiliser le code de parrainage d'un ami</label>
                <div class="d-flex">
                    <input type="text" class="form-control me-2" id="friend-code" placeholder="Entrez le code de votre ami">
                    <button class="btn btn-dark-custom" id="validate-code">
                        <i class="fas fa-check"></i> Valider
                    </button>
                </div>  </div>

            <!-- Alert Messages -->
            <div id="alert-container" class="mt-3"></div>
        </div>
    </div>

<script>
document.getElementById('validate-code').addEventListener('click', async function() {
    const button = this;
    const codeInput = document.getElementById('friend-code');
    const code = codeInput.value.trim();
    const alertContainer = document.getElementById('alert-container');

    // Validation de base
    if (!code || code.length !== 7) {
        showAlert('Le code doit contenir exactement 7 caractères', 'danger');
        return;
    }

    button.disabled = true;
    button.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Validation...';

    try {
        const response = await fetch('/validate-referral-code', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Accept': 'application/json'
            },
            body: JSON.stringify({ code })
        });
        console.log(document.querySelector('meta[name="csrf-token"]').content)
        const data = await response.json();

        if (!response.ok) {
            throw new Error(data.message || 'Erreur lors de la validation');
        }

        showAlert(data.message, 'success');
        codeInput.value = '';
        setTimeout(() => window.location.reload(), 1500);

    } catch (error) {
        showAlert(error.message || 'Une erreur est survenue', 'danger');
        console.error('Error:', error);
    } finally {
        button.disabled = false;
        button.innerHTML = '<i class="fas fa-check"></i> Valider';
    }
});

function showAlert(message, type) {
    const alert = document.createElement('div');
    alert.className = `alert alert-${type} alert-dismissible fade show`;
    alert.innerHTML = `
        ${message}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    `;
    document.getElementById('alert-container').appendChild(alert);
}
</script>





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