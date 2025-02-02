<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Under Development - Portal Desa</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <div class="min-h-screen flex items-center justify-center">
        <div class="text-center px-4">
            <!-- Animasi Konstruksi -->
            <div class="mb-8 relative">
                <i class="fas fa-hard-hat text-yellow-500 text-6xl animate-bounce"></i>
                <i class="fas fa-tools text-gray-600 text-4xl absolute -right-4 top-0 animate-pulse"></i>
            </div>

            <!-- Teks Utama -->
            <h1 class="text-4xl font-bold text-gray-800 mb-4">Under Development</h1>
            <p class="text-xl text-gray-600 mb-8">Mohon maaf, fitur ini sedang dalam tahap pengembangan</p>

            <!-- Loading Progress -->
            <div class="w-64 h-3 bg-gray-200 rounded-full mx-auto overflow-hidden mb-8">
                <div class="h-full bg-blue-500 rounded-full animate-progress"></div>
            </div>

            <!-- Animasi Code -->
            <div class="mb-8 bg-gray-800 rounded-lg p-4 max-w-sm mx-auto overflow-hidden">
                <div class="animate-typing overflow-hidden whitespace-nowrap text-left font-mono text-green-400">
                    <span class="typing-text">&lt;code&gt;</span><br>
                    <span class="typing-text">Building feature...</span><br>
                    <span class="typing-text">&lt;/code&gt;</span>
                </div>
            </div>

            <!-- Tombol Kembali -->
            <a href="/" class="inline-flex items-center px-6 py-3 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition-colors duration-200">
                <i class="fas fa-arrow-left mr-2"></i>
                Kembali ke Beranda
            </a>
        </div>
    </div>

    <style>
        @keyframes progress {
            0% { width: 0%; }
            50% { width: 70%; }
            100% { width: 95%; }
        }

        @keyframes typing {
            from { width: 0 }
            to { width: 100% }
        }

        .animate-progress {
            animation: progress 2s ease-in-out infinite;
        }

        .typing-text {
            display: inline-block;
            overflow: hidden;
            animation: typing 3s steps(30, end) infinite;
        }

        .animate-typing {
            border-right: .15em solid orange;
        }
    </style>
</body>
</html> 