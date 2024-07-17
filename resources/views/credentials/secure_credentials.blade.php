<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Secure Credentials Access</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background: #edf2f7;
            color: #4a5568;
            margin: 0;
            padding: 40px 0;
            display: flex;
            justify-content: center;
            min-height: 100vh;
            align-items: center;
            flex-direction: column;
        }

        .container {
            width: 100%;
            max-width: 600px;
            margin: 0 auto;
            background: #ffffff;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 6px 20px rgba(0,0,0,0.05);
            border: 1px solid #e2e8f0;
        }

        h1 {
            font-size: 26px;
            color: #2d3748;
            margin-bottom: 16px;
            text-align: center;
            font-weight: 700;
        }

        p.description {
            text-align: center;
            margin-bottom: 30px;
            font-size: 16px;
            color: #718096;
        }

        .card {
            background: #f7fafc;
            border-left: 5px solid #4299e1;
            margin-bottom: 20px;
            padding: 15px;
            border-radius: 8px;
        }

        .card-header {
            font-size: 20px;
            font-weight: 500;
            color: #2d3748;
            margin-bottom: 10px;
        }

        .card-body {
            font-size: 15px;
            line-height: 1.7;
            color: #4a5568;
        }

        .card-title {
            font-weight: 500;
            color: #2d3748;
        }

        .password-wrapper {
            display: flex;
            align-items: center;
            margin-top: 10px;
        }

        .password {
            flex-grow: 1;
            padding: 10px;
            border: 1px solid #cbd5e0;
            border-radius: 6px;
            background: #edf2f7;
            margin-right: 8px;
        }

        .toggle-password {
            padding: 10px;
            background: #4299e1;
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .toggle-password:hover {
            background: #3182ce;
        }

        .footer {
            text-align: center;
            padding-top: 20px;
            font-size: 14px;
            color: #a0aec0;
            margin-top: 30px;
        }

        .video-container {
            margin-top: 30px;
            text-align: center;
        }

        .video-container video {
            width: 100%;
            max-width: 400px;
            height: auto;
            border-radius: 8px;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.05);
        }

        /* Modal styles */
        .modal {
            display: none; 
            position: fixed; 
            z-index: 1; 
            padding-top: 60px; 
            left: 0;
            top: 0;
            width: 100%; 
            height: 100%; 
            overflow: auto; 
            background-color: rgb(0,0,0); 
            background-color: rgba(0,0,0,0.4); 
        }

        .modal-content {
            background-color: #fefefe;
            margin: 5% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%; 
            max-width: 600px;
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
    </style>
</head>
<body>
<div class="container">
    <h1>Secure Access to Credentials</h1>
    <p class="description">These credentials have been shared securely. Please handle this information with care.</p>
    @foreach ($credentials as $credential)
    <div class="card">
        <div class="card-header">Service: {{ $credential->name }}</div>
        <div class="card-body">
            <h5 class="card-title">Username: {{ $credential->username }}</h5>
            <div class="password-wrapper">
                <input class="password" type="password" value="{{ $credential->password }}" id="password-{{ $credential->id }}" readonly>
                <button class="toggle-password" onclick="togglePasswordVisibility('{{ $credential->id }}')">Show</button>
            </div>
        </div>
    </div>
    @endforeach

    <!-- Documents Section -->
    <div>
        <h2>Documents</h2>
        @foreach ($documents as $document)
        <div class="card">
            <div class="card-header">{{ ucfirst($document->type) }}</div>
            <div class="card-body">
                <a href="{{ Storage::url($document->document_path) }}" target="_blank" class="text-blue-500 hover:text-blue-700">View Document</a>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Assets Section -->
    <div>
        <h2>Assets</h2>
        @foreach ($assets as $asset)
        <div class="card">
            <div class="card-header">{{ $asset->name }}</div>
            <div class="card-body">
                <a href="{{ Storage::url($asset->document_path) }}" target="_blank" class="text-blue-500 hover:text-blue-700">View Asset Document</a>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Video Section -->
    @if ($user->agreement_video)
    <div class="video-container">
        <h2>Agreement Video</h2>
        <button id="viewVideoBtn">View Video</button>
    </div>
    @endif

    <div class="footer">
        Please contact scrs@support.com if you have any issues or questions.
    </div>
</div>

<!-- The Modal -->
<div id="myModal" class="modal">
  <div class="modal-content">
    <span class="close">&times;</span>
    <video controls>
        <source src="{{ asset('storage/' . $user->agreement_video) }}" type="video/mp4">
        Your browser does not support the video tag.
    </video>
  </div>
</div>

<script>
    function togglePasswordVisibility(id) {
        var passwordInput = document.getElementById('password-' + id);
        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            event.target.textContent = 'Hide';
        } else {
            passwordInput.type = 'password';
            event.target.textContent = 'Show';
        }
    }

    // Get the modal
    var modal = document.getElementById("myModal");

    // Get the button that opens the modal
    var btn = document.getElementById("viewVideoBtn");

    // Get the <span> element that closes the modal
    var span = document.getElementsByClassName("close")[0];

    // When the user clicks the button, open the modal 
    btn.onclick = function() {
      modal.style.display = "block";
    }

    // When the user clicks on <span> (x), close the modal
    span.onclick = function() {
      modal.style.display = "none";
    }

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
      if (event.target == modal) {
        modal.style.display = "none";
      }
    }
</script>
</body>
</html>
