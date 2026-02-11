<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
    <title>Link.tz - Shorten your links!</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico">
    <link href="https://fonts.googleapis.com/css2?family=SN+Pro:ital,wght@0,200..900;1,200..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        body {
            font-family: "SN Pro", sans-serif;
            background-color: #a2acb49a;
            color: #ffffff;
        }
        .btn-primary {
            background-color: #f09329;
            transition: all 0.3s ease;
        }
        .btn-primary:hover {
            transform: scale(1.05);
            background-color: #da7604;
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
