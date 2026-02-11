<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
    <title>URL Shortener</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=PT+Serif&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        body {
            font-family: 'PT Serif', serif;
            background-color: #02021f;
            color: #ffffff;
        }
        .btn-primary {
            background-color: #d43d26;
            transition: all 0.3s ease;
        }
        .btn-primary:hover {
            transform: scale(1.05);
            background-color: #b8321f;
        }
        @keyframes fadeIn {
            from { opacity:0; transform:translateY(20px); }
            to { opacity:1; transform:translateY(0); }
        }
        .animate-fadeIn {
            animation: fadeIn 0.8s ease-in-out;
        }

    </style>
</head>
<body class="min-h-screen flex flex-col">
