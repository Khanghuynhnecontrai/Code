<?php 
require_once 'auth.php'; 
checkAuth(); 
?> 
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KHANG HUYNH - HE THONG CAU HINH THIET BI CAO CAP</title>
    <style>
        :root {
            --accent-color: #38bdf8; 
            --premium-color: #f59e0b; 
            --text-main: #f8fafc;
            --text-muted: #cbd5e1;
            --border-color: rgba(255, 255, 255, 0.12); 
        }
        body {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
            background: radial-gradient(circle at top left, #0f172a, #020617);
            background-attachment: fixed;
            color: var(--text-main);
            margin: 0;
            padding: 0;
            -webkit-font-smoothing: antialiased;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            position: relative;
            overflow-x: hidden;
        }

        .glow-bg-1 {
            position: absolute;
            width: 400px;
            height: 400px;
            background: radial-gradient(circle, rgba(56, 189, 248, 0.15) 0%, rgba(0,0,0,0) 70%);
            top: 10%;
            left: -100px;
            z-index: -1;
            pointer-events: none;
        }
        .glow-bg-2 {
            position: absolute;
            width: 500px;
            height: 500px;
            background: radial-gradient(circle, rgba(147, 51, 234, 0.12) 0%, rgba(0,0,0,0) 70%);
            bottom: 20%;
            right: -150px;
            z-index: -1;
            pointer-events: none;
        }

        header {
            background: rgba(15, 23, 42, 0.6);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border-bottom: 1px solid var(--border-color);
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1000;
        }

        .header-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 14px 24px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            font-size: 16px;
            font-weight: 800;
            letter-spacing: -0.5px;
            color: var(--text-main);
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .logo span {
            width: 8px;
            height: 8px;
            background-color: #34d399;
            border-radius: 50%;
            display: inline-block;
        }

        .header-controls {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .countdown-box {
            font-size: 12px;
            font-weight: 700;
            color: #f87171;
            background: rgba(248, 113, 113, 0.1);
            padding: 6px 14px;
            border-radius: 8px;
            border: 1px solid rgba(248, 113, 113, 0.2);
            display: none; 
        }

        .account-trigger {
            font-size: 12px;
            font-weight: 700;
            color: var(--accent-color);
            background: rgba(56, 189, 248, 0.1);
            padding: 6px 14px;
            border-radius: 8px;
            cursor: pointer;
            border: 1px solid rgba(56, 189, 248, 0.2);
            transition: all 0.2s;
            display: none; 
        }

        .account-trigger:hover {
            background: var(--accent-color);
            color: #0f172a;
        }

        main {
            flex: 1;
            max-width: 850px;
            width: 100%;
            margin: 140px auto 60px auto; 
            padding: 0 20px;
            box-sizing: border-box;
            z-index: 1;
        }

        .hero-section {
            text-align: center;
            margin-bottom: 30px;
        }

        .hero-section h1 {
            font-size: 36px;
            font-weight: 800;
            letter-spacing: -1px;
            margin: 0 0 12px 0;
            color: #ffffff;
        }

        .hero-section h1.neon-title-style {
            font-size: 24px; 
            white-space: nowrap; 
            overflow: hidden;
            text-overflow: ellipsis;
            animation: slowNeonPulse 4s infinite ease-in-out; 
        }

        @keyframes slowNeonPulse {
            0%, 100% { color: #38bdf8; text-shadow: 0 0 15px rgba(56, 189, 248, 0.6); }
            50% { color: #60a5fa; text-shadow: 0 0 25px rgba(96, 165, 250, 0.8); }
        }

        .premium-neon-title {
            font-size: 24px;
            font-weight: 900;
            text-align: center;
            margin: 40px 0 20px 0;
            letter-spacing: 1px;
            animation: neon5Colors 6s infinite ease-in-out;
        }

        @keyframes neon5Colors {
            0%, 100% { color: #f59e0b; text-shadow: 0 0 15px rgba(245, 158, 11, 0.8), 0 0 30px rgba(245, 158, 11, 0.4); } 
            20% { color: #ef4444; text-shadow: 0 0 15px rgba(239, 68, 68, 0.8), 0 0 30px rgba(239, 68, 68, 0.4); }   
            40% { color: #3b82f6; text-shadow: 0 0 15px rgba(59, 130, 246, 0.8), 0 0 30px rgba(59, 130, 246, 0.4); }   
            60% { color: #a855f7; text-shadow: 0 0 15px rgba(168, 85, 247, 0.8), 0 0 30px rgba(168, 85, 247, 0.4); }   
            80% { color: #10b981; text-shadow: 0 0 15px rgba(16, 185, 129, 0.8), 0 0 30px rgba(16, 185, 129, 0.4); }   
        }

        .hero-section p {
            font-size: 15px;
            color: var(--text-muted);
            margin: 0 auto;
            max-width: 550px;
            line-height: 1.6;
        }

        .system-status-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 12px;
            margin-bottom: 30px;
        }

        .status-mini-card {
            background: rgba(30, 41, 59, 0.3);
            border: 1px solid rgba(255, 255, 255, 0.05);
            padding: 12px;
            border-radius: 14px;
            text-align: center;
            backdrop-filter: blur(5px);
        }

        .status-mini-label {
            font-size: 10px;
            text-transform: uppercase;
            color: #94a3b8;
            font-weight: 600;
            letter-spacing: 0.5px;
        }

        .status-mini-value {
            font-size: 13px;
            font-weight: 700;
            color: #ffffff;
            margin-top: 4px;
        }
        .status-mini-value.green { color: #34d399; }

        .content-card {
            background: rgba(30, 41, 59, 0.45);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border: 1px solid var(--border-color);
            border-radius: 24px;
            padding: 40px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
        }

        .step {
            display: none;
        }

        .step.active {
            display: block;
            animation: sheetUp 0.5s cubic-bezier(0.16, 1, 0.3, 1);
        }

        @keyframes sheetUp {
            from { opacity: 0; transform: translateY(15px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .admin-card {
            background: rgba(15, 23, 42, 0.4);
            border: 1px solid var(--border-color);
            border-left: 4px solid var(--accent-color);
            padding: 20px;
            border-radius: 16px;
            margin-bottom: 32px;
        }

        .admin-label {
            font-size: 11px;
            color: var(--accent-color);
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .admin-name {
            font-size: 20px;
            font-weight: 800;
            color: #ffffff;
            margin-top: 2px;
        }

        .admin-desc {
            font-size: 13px;
            color: var(--text-muted);
            margin-top: 8px;
            line-height: 1.6;
        }

        .form-group {
            margin-bottom: 28px;
            position: relative;
        }

        label {
            display: block;
            margin-bottom: 10px;
            font-weight: 600;
            font-size: 14px;
            color: #cbd5e1;
        }

        .input-key-container {
            position: relative;
            width: 100%;
        }

        input[type="text"], input[type="password"], select {
            width: 100%;
            padding: 16px;
            border: 1px solid rgba(255, 255, 255, 0.15);
            border-radius: 14px;
            font-size: 15px;
            box-sizing: border-box;
            background-color: rgba(15, 23, 42, 0.6);
            color: #ffffff;
            transition: all 0.2s ease;
        }

        input[type="text"]:focus, input[type="password"]:focus, select:focus {
            outline: none;
            border-color: var(--accent-color);
            box-shadow: 0 0 0 4px rgba(56, 189, 248, 0.15);
            background-color: rgba(15, 23, 42, 0.8);
        }

        .toggle-password-btn {
            position: absolute;
            right: 16px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: #64748b;
            cursor: pointer;
            font-size: 13px;
            font-weight: 700;
            padding: 4px 8px;
            user-select: none;
            transition: color 0.2s;
        }
        .toggle-password-btn:hover {
            color: var(--accent-color);
        }

        select option {
            background-color: #0f172a;
            color: #ffffff;
        }

        select optgroup {
            background-color: #020617;
            color: var(--accent-color);
            font-style: normal;
            font-weight: 700;
        }

        .device-divider {
            text-align: center;
            margin: 24px 0;
            font-size: 11px;
            color: #64748b;
            font-weight: 700;
            letter-spacing: 2px;
        }

        button.btn-main {
            width: 100%;
            padding: 16px;
            background-color: #ffffff;
            color: #0f172a;
            border: none;
            border-radius: 14px;
            font-size: 15px;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.25s ease;
        }

        button.btn-main:hover {
            background-color: var(--accent-color);
            color: #0f172a;
            box-shadow: 0 8px 24px rgba(56, 189, 248, 0.3);
        }

        .section-group-title {
            font-size: 13px;
            font-weight: 800;
            color: var(--accent-color);
            letter-spacing: 0.5px;
            text-transform: uppercase;
            margin: 25px 0 12px 0;
            padding-left: 10px;
            border-left: 3px solid var(--accent-color);
            white-space: nowrap;
            overflow-x: auto;
            overflow-y: hidden;
        }

        .section-group-title.premium-type {
            color: var(--premium-color);
            border-left-color: var(--premium-color);
        }

        .file-list {
            display: flex;
            flex-direction: column;
            gap: 12px;
            margin-bottom: 20px;
        }

        .file-item {
            background: rgba(255, 255, 255, 0.02);
            border: 1px solid var(--border-color);
            padding: 16px 20px; 
            border-radius: 14px;
            display: flex;
            flex-direction: column; 
            gap: 12px;
            transition: all 0.3s ease;
            position: relative;
        }

        .file-item:hover {
            background: rgba(255, 255, 255, 0.05);
            border-color: rgba(255, 255, 255, 0.2);
        }

        .file-info {
            width: 100%;
            text-align: left;
        }

        .file-title {
            font-weight: 700;
            font-size: 15px;
            color: #e2e8f0;
            word-wrap: break-word; 
            line-height: 1.4;
        }

        .file-title.neon-free-glow {
            animation: neonFreeGlow 3s infinite ease-in-out;
        }

        @keyframes neonFreeGlow {
            0%, 100% { color: #4ade80; text-shadow: 0 0 10px rgba(74, 222, 128, 0.3); }
            50% { color: #60a5fa; text-shadow: 0 0 10px rgba(96, 165, 250, 0.3); }
        }

        .file-title.premium-text-style {
            color: #fde047;
            text-shadow: 0 0 8px rgba(253, 224, 71, 0.3);
            font-weight: 700;
        }

        .file-action-wrapper {
            display: flex;
            justify-content: flex-end;
            width: 100%;
        }

        .btn-action {
            background: rgba(255, 255, 255, 0.08);
            border: 1px solid rgba(255, 255, 255, 0.1);
            color: #ffffff;
            padding: 10px 24px;
            border-radius: 10px;
            font-size: 13px;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.2s;
        }

        .btn-action:hover {
            background: var(--accent-color);
            color: #0f172a;
            border-color: var(--accent-color);
        }

        .btn-action.btn-premium {
            border-color: rgba(245, 158, 11, 0.3);
            background: rgba(245, 158, 11, 0.1);
            color: #fef08a;
        }

        .btn-action.btn-premium:hover {
            background: var(--premium-color);
            color: #0f172a;
            border-color: var(--premium-color);
            box-shadow: 0 0 12px rgba(245, 158, 11, 0.4);
        }

        .premium-error-container {
            display: none;
            width: 100%;
            background: rgba(239, 68, 68, 0.1);
            border: 1px solid rgba(239, 68, 68, 0.3);
            border-radius: 10px;
            padding: 12px 16px;
            box-sizing: border-box;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            margin-top: 4px;
            animation: sheetUp 0.3s ease;
        }

        .premium-error-text {
            color: #f87171;
            font-size: 13px;
            font-weight: 600;
        }

        .btn-buy-key {
            background: #f59e0b;
            color: #0f172a;
            border: none;
            padding: 6px 14px;
            border-radius: 6px;
            font-size: 12px;
            font-weight: 800;
            text-decoration: none;
            transition: all 0.2s;
            white-space: nowrap;
        }

        .btn-buy-key:hover {
            background: #fbbf24;
            box-shadow: 0 0 10px rgba(245, 158, 11, 0.5);
        }

        .premium-separator-line {
            border: 0;
            height: 1px;
            background: linear-gradient(to right, rgba(245, 158, 11, 0), rgba(245, 158, 11, 0.4), rgba(245, 158, 11, 0));
            margin: 40px 0;
        }

        .zalo-contact-box {
            margin-top: 30px;
            text-align: center;
        }

        .zalo-link-item {
            font-size: 15px;
            color: #ffffff;
            margin-bottom: 14px;
            font-weight: 700;
        }

        .zalo-link-item a {
            color: var(--accent-color);
            text-decoration: none;
            font-weight: 800;
            margin-left: 4px;
            text-shadow: 0 0 10px rgba(56, 189, 248, 0.2);
        }

        .zalo-link-item a:hover {
            text-decoration: underline;
        }

        .live-log-box {
            margin-top: 24px;
            background: rgba(15, 23, 42, 0.4);
            border: 1px solid var(--border-color);
            border-radius: 16px;
            padding: 16px 20px;
            font-size: 12px;
            display: flex;
            align-items: center;
            gap: 12px;
            color: #94a3b8;
        }

        .log-badge {
            background: rgba(52, 211, 153, 0.1);
            color: #34d399;
            padding: 4px 8px;
            border-radius: 6px;
            font-weight: 700;
            text-transform: uppercase;
            font-size: 10px;
            letter-spacing: 0.5px;
            animation: pulseActive 2s infinite;
        }

        @keyframes pulseActive {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.5; }
        }

        .log-text {
            flex: 1;
            font-family: monospace;
            color: #cbd5e1;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .account-page-view {
            display: none;
            background: rgba(30, 41, 59, 0.45);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border: 1px solid var(--border-color);
            border-radius: 24px;
            padding: 40px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
            animation: sheetUp 0.5s cubic-bezier(0.16, 1, 0.3, 1);
        }

        .page-title {
            font-size: 20px;
            font-weight: 800;
            text-align: center;
            margin-bottom: 30px;
            color: #ffffff;
            letter-spacing: -0.5px;
        }

        .page-info-box {
            background: rgba(15, 23, 42, 0.4);
            border-radius: 16px;
            padding: 8px 20px;
            margin-bottom: 40px;
            border: 1px solid var(--border-color);
        }

        .page-info-row {
            display: flex;
            justify-content: space-between;
            font-size: 14px;
            padding: 16px 0;
            border-bottom: 1px solid rgba(255, 255, 255, 0.08);
        }
        .page-info-row:last-child {
            border-bottom: none;
        }
        .page-label {
            color: var(--text-muted);
            font-weight: 500;
        }
        .page-value {
            color: #ffffff;
            font-weight: 600;
        }
        .page-value.status-green { color: #4ade80; }
        .page-value.status-admin { color: #f87171; text-transform: uppercase; }

        footer {
            background: rgba(15, 23, 42, 0.7);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border-top: 1px solid var(--border-color);
            padding: 24px;
            text-align: center;
            font-size: 12px;
            color: var(--text-muted);
            margin-top: auto;
        }

        .error-msg {
            color: #f87171;
            font-size: 13px;
            margin-top: 8px;
            display: none;
            font-weight: 600;
            text-align: center;
        }

        .buy-key-link {
            text-align: center;
            margin-top: 20px;
            font-size: 13px;
            color: var(--text-muted);
        }
        .buy-key-link a {
            color: var(--accent-color);
            text-decoration: none;
            font-weight: 600;
        }

        .modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(2, 6, 23, 0.85);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 9999;
            opacity: 0;
            pointer-events: none;
            transition: opacity 0.3s ease;
        }

        .modal-overlay.active {
            opacity: 1;
            pointer-events: auto;
        }

        .modal-card {
            background: #1e293b;
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 20px;
            padding: 30px;
            width: 90%;
            max-width: 380px;
            text-align: center;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
            transform: scale(0.85);
            transition: transform 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
        }

        .modal-overlay.active .modal-card {
            transform: scale(1);
        }

        .loading-spinner {
            width: 50px;
            height: 50px;
            border: 4px solid rgba(56, 189, 248, 0.1);
            border-left-color: var(--accent-color);
            border-radius: 50%;
            margin: 0 auto 20px auto;
            animation: spinEffect 0.8s linear infinite;
            display: block;
        }

        @keyframes spinEffect {
            to { transform: rotate(360deg); }
        }

        .success-checkmark {
            width: 50px;
            height: 50px;
            background: rgba(52, 211, 153, 0.1);
            border: 2px solid #34d399;
            border-radius: 50%;
            margin: 0 auto 20px auto;
            display: none;
            justify-content: center;
            align-items: center;
            color: #34d399;
            font-size: 24px;
            font-weight: bold;
            animation: scaleInCheck 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }

        @keyframes scaleInCheck {
            from { transform: scale(0); opacity: 0; }
            to { transform: scale(1); opacity: 1; }
        }

        .modal-title {
            font-size: 16px;
            font-weight: 800;
            color: #ffffff;
            margin-bottom: 8px;
            letter-spacing: -0.3px;
        }

        .modal-sub {
            font-size: 13px;
            color: #94a3b8;
            line-height: 1.5;
            min-height: 40px;
        }

        .feature-interactive-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 14px;
            margin: 20px 0;
        }
        .interactive-card {
            background: rgba(15, 23, 42, 0.3);
            border: 1px solid var(--border-color);
            padding: 16px;
            border-radius: 14px;
        }
        .interactive-card-title {
            font-size: 12px;
            font-weight: 700;
            color: var(--accent-color);
            margin-bottom: 8px;
            text-transform: uppercase;
        }
        .interactive-status-bar {
            height: 6px;
            background: rgba(255,255,255,0.05);
            border-radius: 3px;
            overflow: hidden;
            margin-top: 8px;
        }
        .interactive-status-fill {
            height: 100%;
            background: linear-gradient(90deg, #38bdf8, #34d399);
            width: 0%;
            transition: width 2s ease-in-out;
        }
        .review-box {
            background: rgba(255,255,255,0.01);
            border: 1px dashed var(--border-color);
            border-radius: 12px;
            padding: 12px;
            margin-top: 20px;
        }
        .review-item {
            font-size: 12px;
            color: #94a3b8;
            margin-bottom: 6px;
            line-height: 1.4;
        }
        .review-user {
            color: #fbbf24;
            font-weight: 600;
        }

        /* STYLE MỚI CHO BẢNG ĐỘ NHẠY */
        .status-item {
            background: rgba(15, 23, 42, 0.5);
            border: 1px solid rgba(255, 255, 255, 0.1);
            padding: 14px;
            border-radius: 12px;
            text-align: center;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            user-select: none;
            transition: all 0.2s;
            color: #cbd5e1;
        }
        .status-item.selected {
            background: rgba(56, 189, 248, 0.15);
            border-color: #38bdf8;
            color: #38bdf8;
        }
        .ai-overlay {
            position: fixed; 
            top: 0; left: 0; right: 0; bottom: 0;
            background: rgba(2, 6, 23, 0.85);
            backdrop-filter: blur(8px);
            -webkit-backdrop-filter: blur(8px);
            z-index: 99999;
            display: flex;
            justify-content: center;
            align-items: center;
            opacity: 0;
            pointer-events: none;
            transition: opacity 0.3s ease;
        }
        .ai-overlay.active { opacity: 1 !important; pointer-events: auto !important; }
        .sensitivity-row {
            display: flex;
            justify-content: space-between;
            padding: 12px 0;
            border-bottom: 1px solid rgba(255,255,255,0.05);
            font-size: 15px;
        }
        .sensitivity-row:last-child { border-bottom: none; }
        @keyframes spinSens { to { transform: rotate(360deg); } }
    </style>
</head>
<body>

    <div class="glow-bg-1"></div>
    <div class="glow-bg-2"></div>

    <div class="modal-overlay" id="keyCheckModal">
        <div class="modal-card">
            <div class="loading-spinner" id="modalSpinner"></div>
            <div class="success-checkmark" id="modalCheckmark">✓</div>
            <div class="modal-title" id="modalTitleText">Đang xác thực mã khóa...</div>
            <div class="modal-sub" id="modalSubText">Kết nối cơ sở dữ liệu...</div>
        </div>
    </div>

    <div class="ai-overlay" id="aiOverlay">
        <div style="background: #059669; padding: 40px 50px; border-radius: 24px; text-align: center; box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5); max-width: 90%; width: 400px;">
            <div id="aiSpinner" style="width: 50px; height: 50px; border: 5px solid rgba(255,255,255,0.3); border-top-color: #ffffff; border-radius: 50%; margin: 0 auto; animation: spinSens 1s linear infinite;"></div>
            <div id="aiCheckmark" style="display: none; width: 50px; height: 50px; margin: 0 auto; border-radius: 50%; background: #ffffff; color: #059669; font-size: 32px; line-height: 50px; font-weight: bold;">✓</div>
            <div id="aiOverlayText" style="font-size: 20px; font-weight: 800; color: #ffffff; margin: 20px 0 0 0; letter-spacing: 0.5px;">Đang Bắt Đầu Phân Tích AI</div>
        </div>
    </div>

    <header>
        <div class="header-container">
            <div class="logo"><span></span> KHANG HUYNH CLOUD SYSTEM</div>
            <div class="header-controls">
                <div class="countdown-box" id="countdownTimer">30d 00h 00m 00s</div>
                <div class="account-trigger" id="btnAccount" onclick="showAccountPage()">Tài Khoản</div>
            </div>
        </div>
    </header>

    <main>
        <div class="hero-section" id="heroWrapper">
            <h1 id="mainTitle">Hệ Thống Phân Phối Dữ Liệu</h1>
            <p id="mainSub">Hạ tầng mã hóa tự động tối ưu hóa tệp tin hệ thống và tinh chỉnh cấu hình riêng cho từng dòng thiết bị di động.</p>
        </div>

        <div class="system-status-grid" id="systemStatusGrid">
            <div class="status-mini-card">
                <div class="status-mini-label">MÁY CHỦ BĂNG THÔNG</div>
                <div class="status-mini-value green">10 Gbps Node</div>
            </div>
            <div class="status-mini-card">
                <div class="status-mini-label">TRẠNG THÁI CORE</div>
                <div class="status-mini-value green">Uptime 99.9%</div>
            </div>
            <div class="status-mini-card">
                <div class="status-mini-label">PHIÊN BẢN</div>
                <div class="status-mini-value" style="color: var(--accent-color);">Build v3.8</div>
            </div>
            <div class="status-mini-card">
                <div class="status-mini-label">ĐÃ KHỞI TẠO VIP</div>
                <div class="status-mini-value">124.5K+</div>
            </div>
        </div>

        <div class="content-card" id="mainContentCard">
            
            <div id="step1" class="step active">
                <div class="admin-card">
                    <div class="admin-label">Cấp phép ủy quyền chính thức</div>
                    <div class="admin-name">ADMIN KHANG HUYNH</div>
                    <div class="admin-desc">
                        Vui lòng nhập Khóa mã hóa truy cập (Key) được cung cấp bởi nhà phát triển hệ thống để tiếp tục quy trình định danh thiết bị.
                    </div>
                </div>

                <div class="form-group">
                    <label for="activationKey">Khóa bảo mật hệ thống / Key VIP:</label>
                    <div class="input-key-container">
                        <input type="password" id="activationKey" placeholder="Nhập khóa bảo mật của bạn...">
                        <button type="button" class="toggle-password-btn" id="toggleKeyBtn" onclick="toggleKeyVisibility()">HIỆN</button>
                    </div>
                    <div id="keyError" class="error-msg">Mã khóa không đúng hoặc đã hết hạn sử dụng.</div>
                </div>
                
                <button class="btn-main" onclick="checkKey()">Tiếp Tục Quy Trình</button>
                
                <div class="buy-key-link">
                    Chưa có khóa bảo mật? Đăng ký sở hữu mã VIP <a href="https://zalo.me/0775893691" target="_blank">tại đây</a>
                </div>
            </div>

            <div id="step2" class="step">
                <div class="form-group">
                    <label for="iosSelect">Lựa chọn hệ điều hành iOS (Apple iPhone):</label>
                    <select id="iosSelect" onchange="clearOther('androidSelect')">
                        <option value="" selected>-- Lựa chọn chính xác dòng máy iPhone của bạn --</option>
                        <optgroup label="iPhone 17 Series (Mới nhất)">
                            <option value="iPhone 17 Pro Max">iPhone 17 Pro Max</option>
                            <option value="iPhone 17 Pro">iPhone 17 Pro</option>
                            <option value="iPhone 17 / 17 Plus">iPhone 17 / 17 Plus</option>
                            <option value="iPhone 17 Slim / Air">iPhone 17 Slim / Air</option>
                        </optgroup>
                        <optgroup label="iPhone 16 Series">
                            <option value="iPhone 16 Pro Max">iPhone 16 Pro Max</option>
                            <option value="iPhone 16 Pro">iPhone 16 Pro</option>
                            <option value="iPhone 16 Plus">iPhone 16 Plus</option>
                            <option value="iPhone 16">iPhone 16</option>
                        </optgroup>
                        <optgroup label="iPhone 15 Series">
                            <option value="iPhone 15 Pro Max">iPhone 15 Pro Max</option>
                            <option value="iPhone 15 Pro">iPhone 15 Pro</option>
                            <option value="iPhone 15 Plus">iPhone 15 Plus</option>
                            <option value="iPhone 15">iPhone 15</option>
                        </optgroup>
                        <optgroup label="iPhone 14 Series">
                            <option value="iPhone 14 Pro Max">iPhone 14 Pro Max</option>
                            <option value="iPhone 14 Pro">iPhone 14 Pro</option>
                            <option value="iPhone 14 Plus">iPhone 14 Plus</option>
                            <option value="iPhone 14">iPhone 14</option>
                        </optgroup>
                        <optgroup label="iPhone 13 Series">
                            <option value="iPhone 13 Pro Max">iPhone 13 Pro Max</option>
                            <option value="iPhone 13 Pro">iPhone 13 Pro</option>
                            <option value="iPhone 13 / 13 Mini">iPhone 13 / 13 Mini</option>
                        </optgroup>
                        <optgroup label="iPhone 12 Series">
                            <option value="iPhone 12 Pro Max">iPhone 12 Pro Max</option>
                            <option value="iPhone 12 Pro / 12">iPhone 12 Pro / iPhone 12</option>
                            <option value="iPhone 12 Mini">iPhone 12 Mini</option>
                        </optgroup>
                        <optgroup label="iPhone 11 Series">
                            <option value="iPhone 11 Pro Max">iPhone 11 Pro Max</option>
                            <option value="iPhone 11 Pro / 11">iPhone 11 Pro / iPhone 11</option>
                        </optgroup>
                        <optgroup label="Các dòng iPhone X / Cũ hơn">
                            <option value="iPhone XS Max / XS / XR">iPhone XS Max / XS / XR</option>
                            <option value="iPhone X / iPhone 8 Plus">iPhone X / iPhone 8 Plus</option>
                            <option value="iPhone 7 Plus / Các máy SE">iPhone 7 Plus / iPhone SE Series</option>
                            <option value="Các dòng iPhone cũ hơn">Các dòng iPhone thế hệ cũ khác</option>
                        </optgroup>
                    </select>
                </div>

                <div class="device-divider">HOẶC HỆ ĐIỀU HÀNH KHÁC</div>

                <div class="form-group">
                    <label for="androidSelect">Lựa chọn hệ điều hành Android (Các hãng):</label>
                    <select id="androidSelect" onchange="clearOther('iosSelect')">
                        <option value="" selected>-- Lựa chọn chính xác cấu hình Android phù hợp --</option>
                        <optgroup label="SAMSUNG">
                            <option value="Samsung Galaxy S26 Ultra / S26 Series">Galaxy S26 Ultra / S26+ / S26</option>
                            <option value="Samsung Galaxy S25 Ultra / S25 Series">Galaxy S25 Ultra / S25+ / S25</option>
                            <option value="Samsung Galaxy S24 Ultra / S24 Series">Galaxy S24 Ultra / S24+ / S24</option>
                            <option value="Samsung Galaxy S23 Ultra / S23 Series">Galaxy S23 Ultra / S23+ / S23</option>
                            <option value="Samsung Galaxy S22 Ultra / S22 Series">Galaxy S22 Ultra / S22 Series</option>
                            <option value="Samsung Galaxy Z Fold / Z Flip Series">Galaxy Z Fold / Z Flip (Mọi thế hệ)</option>
                            <option value="Samsung Galaxy Dòng A / M / F">Galaxy A Series / M Series</option>
                        </optgroup>
                        <optgroup label="XIAOMI">
                            <option value="Xiaomi 16 / 16 Pro / 16 Ultra">Xiaomi 16 / 16 Pro / 16 Ultra</option>
                            <option value="Xiaomi 15 / 15 Pro / 15 Ultra">Xiaomi 15 / 15 Pro / 15 Ultra</option>
                            <option value="Xiaomi 14 / 14 Ultra / 13 Series">Xiaomi 14 Series / Xiaomi 13 Series</option>
                            <option value="Redmi K80 / K70 / K60 Gaming Series">Redmi K80 / K70 / K60 Series</option>
                            <option value="Redmi Note 14 / 13 / 12 Pro">Redmi Note 14 / 13 / 12 Pro Series</option>
                            <option value="POCO F6 / F5 / X6 Pro / M Series">POCO F Series / X Series Pro</option>
                        </optgroup>
                        <optgroup label="OPPO">
                            <option value="Oppo Find X8 / X7 Ultra">Oppo Find X8 / X7 / Ultra</option>
                            <option value="Oppo Reno 13 / 12 / 11 Pro">Oppo Reno 13 / 12 / 11 Pro Series</option>
                            <option value="Oppo Dòng A / K Series">Oppo A Series / K Series</option>
                        </optgroup>
                        <optgroup label="VIVO / IQOO">
                            <option value="Vivo X200 / X100 / X90 Pro+">Vivo X200 / X100 / X90 Series</option>
                            <option value="iQOO 13 / 12 / 11 / Neo Pro">iQOO 13 / 12 / 11 / Neo Series</option>
                        </optgroup>
                        <optgroup label="ASUS ROG / NUBIA RED MAGIC">
                            <option value="ROG Phone 9 / 8 / 7 Ultimate">ROG Phone 9 / 8 / 7 Series</option>
                            <option value="Red Magic 10 / 9 / 8 Pro+">Red Magic 10 / 9 / 8 Pro Series</option>
                        </optgroup>
                        <optgroup label="CÁC DÒNG MÁY KHÁC">
                            <option value="Google Pixel 10 / 9 / 8 Pro">Google Pixel Series</option>
                            <option value="Sony Xperia 1 / 5 Series">Sony Xperia Series</option>
                            <option value="Dòng Máy Android Khác">Thiết bị Android cấu hình khác</option>
                        </optgroup>
                    </select>
                </div>

                <div id="deviceError" class="error-msg">Bạn cần chọn ít nhất một thông số thiết bị để tiến hành biên dịch dữ liệu.</div>

                <button class="btn-main" onclick="processDownload()">Bắt Đầu Biên Dịch</button>
            </div>

            <div id="step3" class="step">
                
                <div class="feature-interactive-grid">
                    <div class="interactive-card">
                        <div class="interactive-card-title">⚡ Tốc độ phản hồi (Ping)</div>
                        <div style="font-size:18px; font-weight:800; color:#34d399;" id="pingVal">Tính toán...</div>
                        <div class="interactive-status-bar"><div class="interactive-status-fill" id="pingBar"></div></div>
                    </div>
                    <div class="interactive-card">
                        <div class="interactive-card-title">⚙️ Xung nhịp mô phỏng</div>
                        <div style="font-size:18px; font-weight:800; color:var(--premium-color);" id="hzVal">Đang đồng bộ...</div>
                        <div class="interactive-status-bar"><div class="interactive-status-fill" id="hzBar"></div></div>
                    </div>
                </div>

                <div class="section-group-title" style="color: #a855f7; border-left-color: #a855f7;">Hệ Thống Phân Tích & Kiểm Định File Auto-Check</div>
                <div style="background: rgba(15,23,42,0.3); padding: 14px; border-radius:14px; font-size:12px; border: 1px solid var(--border-color); margin-bottom:20px;">
                    <div style="display:flex; justify-content: space-between; margin-bottom: 6px;">
                        <span>Trạng thái tệp tin gốc (.imazingapp / .zip):</span><span style="color:#34d399; font-weight:700;">AN TOÀN 100%</span>
                    </div>
                    <div style="display:flex; justify-content: space-between; margin-bottom: 6px;">
                        <span>Chứng chỉ Bypass Anticheat độc quyền:</span><span style="color:#38bdf8; font-weight:700;">ĐÃ TÍCH HỢP VIP</span>
                    </div>
                    <div style="display:flex; justify-content: space-between;">
                        <span>Tỷ lệ khóa mục tiêu chính xác (Delta core):</span><span style="color:var(--premium-color); font-weight:700;">99.8% Perfect</span>
                    </div>
                </div>

                <div class="section-group-title">File Thiết Kế Cho Khách Hàng Free</div>
                <div class="file-list">
                    <div class="file-item">
                        <div class="file-info"><div class="file-title neon-free-glow">Aimlock Delta Prxpin New</div></div>
                        <div class="file-action-wrapper"><button class="btn-action" onclick="triggerDownload('aimlock')">Cài đặt</button></div>
                    </div>
                    <div class="file-item">
                        <div class="file-info"><div class="file-title neon-free-glow">AimNec + Antena Avatar Imz</div></div>
                        <div class="file-action-wrapper"><button class="btn-action" onclick="triggerDownload('aimneck')">Cài đặt</button></div>
                    </div>
                    <div class="file-item">
                        <div class="file-info"><div class="file-title neon-free-glow">ShotTrick Nano Plus</div></div>
                        <div class="file-action-wrapper"><button class="btn-action" onclick="triggerDownload('shottrick')">Cài đặt</button></div>
                    </div>
                </div>

                <div class="premium-separator-line"></div>

                <div class="premium-neon-title">Khanghuynhdelta - Premium</div>
                
                <div class="section-group-title premium-type">Các Dạng AimLock + Data Game ( IOS )</div>
                <div class="file-list">
                    <div class="file-item" id="item_vip_aimlock_mode">
                        <div class="file-info"><div class="file-title premium-text-style">AimLock Mode Full Version</div></div>
                        <div class="file-action-wrapper"><button class="btn-action btn-premium" onclick="triggerDownload('vip_aimlock_mode', 'item_vip_aimlock_mode')">Download</button></div>
                        <div class="premium-error-container"><span class="premium-error-text">Cần mua key vip để sử dụng chức năng</span><a href="https://zalo.me/0775893691" target="_blank" class="btn-buy-key">Mua Key</a></div>
                    </div>
                    <div class="file-item" id="item_vip_aimlock_beta">
                        <div class="file-info"><div class="file-title premium-text-style">AimLock Beta Full Version</div></div>
                        <div class="file-action-wrapper"><button class="btn-action btn-premium" onclick="triggerDownload('vip_aimlock_beta', 'item_vip_aimlock_beta')">Download</button></div>
                        <div class="premium-error-container"><span class="premium-error-text">Cần mua key vip để sử dụng chức năng</span><a href="https://zalo.me/0775893691" target="_blank" class="btn-buy-key">Mua Key</a></div>
                    </div>
                    <div class="file-item" id="item_vip_custom_apple">
                        <div class="file-info"><div class="file-title premium-text-style">Custom Data Apple</div></div>
                        <div class="file-action-wrapper"><button class="btn-action btn-premium" onclick="triggerDownload('vip_custom_apple', 'item_vip_custom_apple')">Download</button></div>
                        <div class="premium-error-container"><span class="premium-error-text">Cần mua key vip để sử dụng chức năng</span><a href="https://zalo.me/0775893691" target="_blank" class="btn-buy-key">Mua Key</a></div>
                    </div>
                </div>

                <div class="section-group-title premium-type">Các Dạng AimLock Speed + Data ( ADR )</div>
                <div class="file-list">
                    <div class="file-item" id="item_vip_aimlock_speed">
                        <div class="file-info"><div class="file-title premium-text-style">AimLock Speed Full Version</div></div>
                        <div class="file-action-wrapper"><button class="btn-action btn-premium" onclick="triggerDownload('vip_aimlock_speed', 'item_vip_aimlock_speed')">Download</button></div>
                        <div class="premium-error-container"><span class="premium-error-text">Cần mua key vip để sử dụng chức năng</span><a href="https://zalo.me/0775893691" target="_blank" class="btn-buy-key">Mua Key</a></div>
                    </div>
                    <div class="file-item" id="item_vip_custom_adr_new">
                        <div class="file-info"><div class="file-title premium-text-style">Custom Data New</div></div>
                        <div class="file-action-wrapper"><button class="btn-action btn-premium" onclick="triggerDownload('vip_custom_adr_new', 'item_vip_custom_adr_new')">Download</button></div>
                        <div class="premium-error-container"><span class="premium-error-text">Cần mua key vip để sử dụng chức năng</span><a href="https://zalo.me/0775893691" target="_blank" class="btn-buy-key">Mua Key</a></div>
                    </div>
                </div>

                <div class="section-group-title premium-type">Các Dạng Hack - Pmt3</div>
                <div class="file-list">
                    <div class="file-item" id="item_vip_ffth_body">
                        <div class="file-info"><div class="file-title premium-text-style">FFTH Aim Body</div></div>
                        <div class="file-action-wrapper"><button class="btn-action btn-premium" onclick="triggerDownload('vip_ffth_body', 'item_vip_ffth_body')">Download</button></div>
                        <div class="premium-error-container"><span class="premium-error-text">Cần mua key vip để sử dụng chức năng</span><a href="https://zalo.me/0775893691" target="_blank" class="btn-buy-key">Mua Key</a></div>
                    </div>
                    <div class="file-item" id="item_vip_ffth_drag">
                        <div class="file-info"><div class="file-title premium-text-style">FFTH Aim Drag</div></div>
                        <div class="file-action-wrapper"><button class="btn-action btn-premium" onclick="triggerDownload('vip_ffth_drag', 'item_vip_ffth_drag')">Download</button></div>
                        <div class="premium-error-container"><span class="premium-error-text">Cần mua key vip để sử dụng chức năng</span><a href="https://zalo.me/0775893691" target="_blank" class="btn-buy-key">Mua Key</a></div>
                    </div>
                    <div class="file-item" id="item_vip_ffth_r8">
                        <div class="file-info"><div class="file-title premium-text-style">FFTH Aim R8</div></div>
                        <div class="file-action-wrapper"><button class="btn-action btn-premium" onclick="triggerDownload('vip_ffth_r8', 'item_vip_ffth_r8')">Download</button></div>
                        <div class="premium-error-container"><span class="premium-error-text">Cần mua key vip để sử dụng chức năng</span><a href="https://zalo.me/0775893691" target="_blank" class="btn-buy-key">Mua Key</a></div>
                    </div>
                    <div class="file-item" id="item_vip_mod_minecraft">
                        <div class="file-info"><div class="file-title premium-text-style">FFTH Mod Súng Minecraft</div></div>
                        <div class="file-action-wrapper"><button class="btn-action btn-premium" onclick="triggerDownload('vip_mod_minecraft', 'item_vip_mod_minecraft')">Download</button></div>
                        <div class="premium-error-container"><span class="premium-error-text">Cần mua key vip để sử dụng chức năng</span><a href="https://zalo.me/0775893691" target="_blank" class="btn-buy-key">Mua Key</a></div>
                    </div>
                </div>

                <div class="section-group-title premium-type">Các Dạng File Ăn Sâu Vào Hệ Thống ( IOS )</div>
                <div class="file-list">
                    <div class="file-item" id="item_vip_ultraview_dynamics">
                        <div class="file-info"><div class="file-title premium-text-style">Setup UltraView Dynamics</div></div>
                        <div class="file-action-wrapper"><button class="btn-action btn-premium" onclick="triggerDownload('vip_ultraview_dynamics', 'item_vip_ultraview_dynamics')">Download</button></div>
                        <div class="premium-error-container"><span class="premium-error-text">Cần mua key vip để sử dụng chức năng</span><a href="https://zalo.me/0775893691" target="_blank" class="btn-buy-key">Mua Key</a></div>
                    </div>
                    <div class="file-item" id="item_vip_globalsecure">
                        <div class="file-info"><div class="file-title premium-text-style">UltraViewer GlobalSecure</div></div>
                        <div class="file-action-wrapper"><button class="btn-action btn-premium" onclick="triggerDownload('vip_globalsecure', 'item_vip_globalsecure')">Download</button></div>
                        <div class="premium-error-container"><span class="premium-error-text">Cần mua key vip để sử dụng chức năng</span><a href="https://zalo.me/0775893691" target="_blank" class="btn-buy-key">Mua Key</a></div>
                    </div>
                    <div class="file-item" id="item_vip_apple_modern">
                        <div class="file-info"><div class="file-title premium-text-style">Apple Configuration Modern</div></div>
                        <div class="file-action-wrapper"><button class="btn-action btn-premium" onclick="triggerDownload('vip_apple_modern', 'item_vip_apple_modern')">Download</button></div>
                        <div class="premium-error-container"><span class="premium-error-text">Cần mua key vip để sử dụng chức năng</span><a href="https://zalo.me/0775893691" target="_blank" class="btn-buy-key">Mua Key</a></div>
                    </div>
                </div>

                <div class="premium-separator-line"></div>
                <button type="button" onclick="toggleSensitivityPanel()" style="background: linear-gradient(135deg, #1e293b, #0f172a); border: 1px solid var(--border-color); color: #ffffff; font-weight: 700; padding: 16px; border-radius: 14px; width: 100%; cursor: pointer; font-size: 15px; display: flex; justify-content: center; align-items: center; gap: 10px; transition: all 0.3s; box-shadow: 0 4px 12px rgba(0,0,0,0.1); margin-top: 25px;">
                    🛠️ TINH CHỈNH ĐỘ NHẠY SÚNG CHUYÊN SÂU
                </button>

                <div id="sensPanel" style="display: none; margin-top: 24px; border-top: 1px dashed rgba(255, 255, 255, 0.1); padding-top: 24px;">
                    <div class="form-group" style="margin-bottom: 24px;">
                        <label>XÁC NHẬN DÒNG MÁY PHÂN TÍCH</label>
                        <select id="deviceSelect" style="width: 100%;">
                            <option value="" disabled selected>-- Chọn hệ điều hành tối ưu độ nhạy --</option>
                            <option value="ios12-17">Điện thoại iPhone (iOS Core System)</option>
                            <option value="iphone11up">Điện thoại Android (Android DPI Core)</option>
                        </select>
                    </div>

                    <div class="form-group" id="problemSection" style="margin-bottom: 24px;">
                        <label>TÌNH TRẠNG LỖI TÂM HIỆN TẠI (CHỌN NHIỀU MỤC):</label>
                        <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 12px;">
                            <div class="status-item" onclick="toggleStatusEffect(this)">Nặng tâm‼️</div>
                            <div class="status-item" onclick="toggleStatusEffect(this)">Lố Đầu🎯</div>
                            <div class="status-item" onclick="toggleStatusEffect(this)">Rung Tâm🔥</div>
                            <div class="status-item" onclick="toggleStatusEffect(this)">Giật Tâm⚙️</div>
                            <div class="status-item" onclick="toggleStatusEffect(this)">Lạc Đạn👻</div>
                            <div class="status-item" onclick="toggleStatusEffect(this)">Khó Kéo💀</div>
                        </div>
                    </div>

                    <button type="button" class="btn-main" onclick="startAIAnalysis()" style="background: linear-gradient(135deg, #2563eb, #1d4ed8); color: white; font-size: 16px; box-shadow: 0 8px 20px rgba(37, 99, 235, 0.3);">PHÂN TÍCH ĐỘ NHẠY BẰNG AI</button>

                    <div id="resultSensBox" style="display: none; background: rgba(15, 23, 42, 0.7); border: 1px solid #38bdf8; border-radius: 18px; padding: 24px; margin-top: 24px; animation: sheetUp 0.4s ease;">
                        <div id="resultSensTitle" style="color: #38bdf8; font-size: 15px; font-weight: 700; text-align: center; margin-bottom: 16px; border-bottom: 1px solid rgba(255,255,255,0.1); padding-bottom: 10px; text-transform: uppercase;">THÔNG SỐ ĐỘ NHẠY ĐÃ TỐI ƯU</div>
                        <div id="sensRowsContainer"></div>
                    </div>
                </div>

                <div class="review-box">
                    <div style="font-size:11px; font-weight:800; color:#94a3b8; text-transform:uppercase; margin-bottom:8px; letter-spacing:0.5px;">⭐ ĐÁNH GIÁ TỪ CỘNG ĐỒNG GAMER (LIVE FEED)</div>
                    <div id="liveReviewContainer">
                        <div class="review-item"><span class="review-user">Trần Nam (iPhone 15 Pro Max):</span> "File custom data mượt thực sự, kéo tâm không bị sượng tí nào."</div>
                    </div>
                </div>

                <div class="zalo-contact-box">
                    <div class="zalo-link-item">
                        Liên Hệ Mua Key VIP <a href="https://zalo.me/0775893691" target="_blank">Tại Đây</a>
                    </div>
                    <div class="zalo-link-item">
                        Link Box Share File <a href="https://zalo.me/g/zwgpo7p0qwxndqlk8zcf" target="_blank">Tại Đây</a>
                    </div>
                </div>
            </div>

            <div class="live-log-box">
                <span class="log-badge">Live Log</span>
                <span class="log-text" id="liveLogText">Đang thiết lập kênh lắng nghe hạ tầng đám mây...</span>
            </div>

        </div>

        <div class="account-page-view" id="accountPageView">
            <div class="page-title">Quản Lý Tài Khoản Hệ Thống</div>
            <div class="page-info-box">
                <div class="page-info-row">
                    <span class="page-label">Trạng Thái Tài Khoản:</span>
                    <span class="page-value" id="userStatusField">Đang Hoạt Động</span>
                </div>
                <div class="page-info-row">
                    <span class="page-label">Loại Khóa Bảo Mật:</span>
                    <span class="page-value" id="userKeyTypeField">Khách Hàng Miễn Phí (Free Key)</span>
                </div>
                <div class="page-info-row">
                    <span class="page-label">Thời Hạn Truy Cập Còn Lại:</span>
                    <span class="page-value" id="accountPageDays">30d 00h 00m 00s</span>
                </div>
                <div class="page-info-row">
                    <span class="page-label">Nền Tảng Đăng Ký:</span>
                    <span class="page-value">Khang Huỳnh Cloud Infrastructure</span>
                </div>
            </div>
            <button class="btn-main" onclick="resetForm()" style="background: #ef4444; color: #ffffff;">Đăng Xuất</button>
        </div>
    </main>

    <footer>
        <div style="max-width: 1200px; margin: 0 auto;">
            © 2026 KHANG HUYNH CLOUD INFRASTRUCTURE. Bảo lưu mọi quyền hệ thống.
        </div>
    </footer>

    <script>
        const FREE_KEY = "KHANGHUYNH-FREE30D";
        const ADMIN_KEY = "ADMIN123"; 
        let countdownInterval;
        let loggedInKeyType = ""; 

        const randomUsers = ["0975***", "0342***", "0866***", "0705***", "0912***", "0582***", "0399***"];
        const randomDevices = ["iPhone 16 Pro Max", "Samsung Ultra", "iPhone 17 Pro", "Xiaomi K70", "Oppo Reno"];
        const randomFiles = ["Aimlock Delta", "AimLock VIP", "FFTH Aim Drag", "UltraView Dynamics"];
        
        const feedbackPool = [
            {user: "Hoàng Anh (S24 Ultra)", text: "Aimlock speed adr xài ngon vcl, mượt mà không bị văng game."},
            {user: "Minh Tuấn (iPhone 16 Pro)", text: "Cài cái ShotTrick Nano Plus phát headshot uy tín hẳn."},
            {user: "Quốc Bảo (Xiaomi K70)", text: "Data bên Khang Huỳnh hồi giờ vẫn là chất lượng nhất, đáng đồng tiền."},
            {user: "Văn Đức (iPhone 14 Plus)", text: "Mới lên bản VIP Custom Apple bắn sướng tê người, không uổng công mua."},
            {user: "Lê Minh (ROG Phone 8)", text: "Bản Minecraft mod súng chạy cực kỳ ổn định nha ae."}
        ];

        setInterval(() => {
            const u = randomUsers[Math.floor(Math.random() * randomUsers.length)];
            const d = randomDevices[Math.floor(Math.random() * randomDevices.length)];
            const f = randomFiles[Math.floor(Math.random() * randomFiles.length)];
            const liveLog = document.getElementById('liveLogText');
            if(liveLog) {
                liveLog.innerText = `Thành viên [${u}] cấu hình máy [${d}] đã tải file ${f} (${Math.floor(Math.random() * 10) + 1}s trước)`;
            }

            const reviewContainer = document.getElementById('liveReviewContainer');
            if (reviewContainer) {
                const item = feedbackPool[Math.floor(Math.random() * feedbackPool.length)];
                reviewContainer.innerHTML = `<div class="review-item" style="animation: sheetUp 0.4s ease;"><span class="review-user">${item.user}:</span> "${item.text}"</div>`;
            }
        }, 3500);

        function toggleKeyVisibility() {
            const keyInput = document.getElementById('activationKey');
            const toggleBtn = document.getElementById('toggleKeyBtn');
            if (keyInput.type === "password") {
                keyInput.type = "text";
                toggleBtn.innerText = "ẨN";
            } else {
                keyInput.type = "password";
                toggleBtn.innerText = "HIỆN";
            }
        }

        function checkKey() {
            const inputEl = document.getElementById('activationKey');
            const inputKey = inputEl.value.trim().toUpperCase(); 
            const errorMsg = document.getElementById('keyError');

            if (inputKey !== FREE_KEY && inputKey !== ADMIN_KEY) {
                errorMsg.style.display = 'block';
                return;
            }

            errorMsg.style.display = 'none';

            const modal = document.getElementById('keyCheckModal');
            const spinner = document.getElementById('modalSpinner');
            const checkmark = document.getElementById('modalCheckmark');
            const titleText = document.getElementById('modalTitleText');
            const subText = document.getElementById('modalSubText');

            spinner.style.display = 'block';
            checkmark.style.display = 'none';
            titleText.innerText = "Đang xác thực mã khóa...";
            titleText.style.color = "#ffffff";
            subText.innerText = "Đang thiết lập cổng kết nối bảo mật đám mây...";
            modal.classList.add('active');

            setTimeout(() => { subText.innerText = "Đang truy xuất thông tin mã hóa phần cứng..."; }, 1000);
            setTimeout(() => { subText.innerText = "Áp dụng chứng chỉ xác thực gói tài nguyên..."; }, 2000);

            setTimeout(() => {
                spinner.style.display = 'none';
                checkmark.style.display = 'flex';
                titleText.innerText = "Xác thực thành công!";
                titleText.style.color = "#34d399";
                
                if (inputKey === FREE_KEY) {
                    loggedInKeyType = "free";
                    subText.innerText = "Cấp quyền: Khách hàng FREE. Hệ thống đã kích hoạt thời hạn 30 ngày.";
                } else if (inputKey === ADMIN_KEY) {
                    loggedInKeyType = "admin";
                    subText.innerText = "Cấp quyền: QUẢN TRỊ VIÊN VIP. Toàn quyền mở khóa kho dữ liệu Premium.";
                }

                setTimeout(() => {
                    modal.classList.remove('active');
                    document.getElementById('step1').classList.remove('active');
                    document.getElementById('step2').className = "step active";
                }, 1200);

            }, 3500); 
        }

        function clearOther(otherId) {
            document.getElementById(otherId).selectedIndex = 0;
            document.getElementById('deviceError').style.display = 'none';
        }

        function processDownload() {
            const iosDevice = document.getElementById('iosSelect').value;
            const androidDevice = document.getElementById('androidSelect').value;
            const deviceError = document.getElementById('deviceError');
            
            let finalDevice = iosDevice || androidDevice;

            if (!finalDevice) {
                deviceError.style.display = 'block';
                return;
            }
            deviceError.style.display = 'none';

            const titleEl = document.getElementById('mainTitle');
            titleEl.innerText = "Khanghuynhdelta - Free";
            titleEl.classList.add('neon-title-style');

            document.getElementById('mainSub').innerText = "Hệ thống đã nhận diện thông số cấu hình. Vui lòng tiến hành cài đặt tệp tin tương thích bên dưới.";
            document.getElementById('btnAccount').style.display = 'block';

            if (loggedInKeyType === "free") {
                document.getElementById('countdownTimer').style.display = 'block';
                document.getElementById('userStatusField').innerText = "Đang Hoạt Động";
                document.getElementById('userStatusField').className = "page-value status-green";
                document.getElementById('userKeyTypeField').innerText = "Khách Hàng Miễn Phí (Free Key)";
                startCountdown(); 
            } else if (loggedInKeyType === "admin") {
                document.getElementById('countdownTimer').style.display = 'none';
                document.getElementById('userStatusField').innerText = "Admin Server";
                document.getElementById('userStatusField').className = "page-value status-admin";
                document.getElementById('userKeyTypeField').innerText = "Quản Trị Viên Hệ Thống (VIP)";
                document.getElementById('accountPageDays').innerText = "Vĩnh viễn";
                document.getElementById('accountPageDays').style.color = "#f87171";
            }

            document.getElementById('step2').classList.remove('active');
            document.getElementById('step3').className = "step active";

            setTimeout(() => {
                const pBar = document.getElementById('pingBar');
                const pVal = document.getElementById('pingVal');
                if(pBar) {
                    pBar.style.width = "95%";
                    pVal.innerText = "14 ms (Cực thấp)";
                }
                const hBar = document.getElementById('hzBar');
                const hVal = document.getElementById('hzVal');
                if(hBar) {
                    hBar.style.width = "100%";
                    hVal.innerText = "120 Hz (Mượt mà)";
                }
            }, 500);
        }

        function startCountdown() {
            let totalSeconds = 30 * 24 * 60 * 60;
            const timerDisplay = document.getElementById('countdownTimer');
            const innerPageDisplay = document.getElementById('accountPageDays');

            innerPageDisplay.style.color = "var(--text-main)"; 

            clearInterval(countdownInterval);
            countdownInterval = setInterval(() => {
                if (totalSeconds <= 0) {
                    clearInterval(countdownInterval);
                    timerDisplay.innerHTML = "Hết hạn";
                    innerPageDisplay.innerHTML = "Khóa hệ thống đã hết hạn sử dụng";
                    return;
                }
                totalSeconds--;

                let days = Math.floor(totalSeconds / (24 * 3600));
                let hours = Math.floor((totalSeconds % (24 * 3600)) / 3600);
                let minutes = Math.floor((totalSeconds % 3600) / 60);
                let seconds = totalSeconds % 60;

                let timeString = `${days}d ${hours}h ${minutes}m ${seconds}s`;
                
                timerDisplay.innerHTML = timeString;
                innerPageDisplay.innerHTML = timeString;
            }, 1000);
        }

        function showAccountPage() {
            const mainContent = document.getElementById('mainContentCard');
            const accountPage = document.getElementById('accountPageView');
            const heroWrapper = document.getElementById('heroWrapper');
            const btnAccount = document.getElementById('btnAccount');
            const sysStatus = document.getElementById('systemStatusGrid');

            if (accountPage.style.display === 'block') {
                accountPage.style.display = 'none';
                mainContent.style.display = 'block';
                heroWrapper.style.display = 'block';
                sysStatus.style.display = 'grid';
                btnAccount.innerText = "Tài Khoản";
            } else {
                mainContent.style.display = 'none';
                heroWrapper.style.none = 'none';
                if(heroWrapper) heroWrapper.style.display = 'none';
                sysStatus.style.display = 'none';
                accountPage.style.display = 'block';
                btnAccount.innerText = "Quay Lại";
            }
        }

        function triggerDownload(fileType, parentItemId) {
            document.querySelectorAll('.premium-error-container').forEach(el => {
                el.style.display = 'none';
            });

            if (fileType.startsWith('vip_') && loggedInKeyType === "free") {
                if (parentItemId) {
                    const itemEl = document.getElementById(parentItemId);
                    if (itemEl) {
                        const errorBox = itemEl.querySelector('.premium-error-container');
                        if (errorBox) { errorBox.style.display = 'flex'; }
                    }
                }
                return; 
            }

            let downloadUrl = "";
            switch(fileType) {
                case 'aimlock': downloadUrl = "https://www.mediafire.com/file/l9n3wclza3okklo/AimLock_Delta_%252B_Video_Ccai.zip/file"; break;
                case 'aimneck': downloadUrl = "https://www.mediafire.com/file/qxvnnl3hq87n6zl/FFTH_NECK_%252B_ATENA_AVATAR.zip/file"; break;
                case 'shottrick': downloadUrl = "https://www.mediafire.com/file/tw069z51ysbhjbq/Shot_Trick_Plus%25F0%259F%258E%25AF.mobileconfig/file"; break;
                case 'vip_aimlock_beta': downloadUrl = "https://www.mediafire.com/file/xa75wb60lq0a9hk/AimLock_Beta_Full_Version.zip/file"; break;
                case 'vip_aimlock_mode': downloadUrl = "https://www.mediafire.com/file/kvavxrfe8p4n3p1/AimLock_Mode_Full_Version.zip/file"; break;
                case 'vip_custom_apple': downloadUrl = "https://www.mediafire.com/file/3vi8zedf2ryunut/Custom+Data+Apple.zip/file"; break;
                case 'vip_aimlock_speed': downloadUrl = "https://www.mediafire.com/file/4h00o0pe59yke4g/AimLock+Plus+Full+Version.zip/file"; break;
                case 'vip_custom_adr_new': downloadUrl = "https://www.mediafire.com/file/fjwxfxwcikdllw7/Custom+Data+New.settings/file"; break;
                case 'vip_ffth_body': downloadUrl = "https://www.mediafire.com/file/gmeg5o94rw760op/FFTH+AIM+BODY+10-5.imazingapp/file"; break;
                case 'vip_ffth_drag': downloadUrl = "https://www.mediafire.com/file/828ytrsam327c7e/FFTH+AIM+DRAG+10-5.imazingapp/file"; break;
                case 'vip_ffth_r8': downloadUrl = "https://www.mediafire.com/file/xnrn66phzvhj1xf/FFTH+AIM+R8+10-5.imazingapp/file"; break;
                case 'vip_mod_minecraft': downloadUrl = "https://www.mediafire.com/file/mgi62epy55gm2av/FFTH+MOD+MINECRAFT+OB53.zip/file"; break;
                case 'vip_ultraview_dynamics': downloadUrl = "https://www.mediafire.com/file/o2dm4htle2k167k/Setup+UltraView+Dynamics🧸.zip/file"; break;
                case 'vip_globalsecure': downloadUrl = "https://www.mediafire.com/file/e8vu5qeozks7t0p/UltraViewer+GlobalSecureConnect+Setup+1.0+-+3.0.zip/file"; break;
                case 'vip_apple_modern': downloadUrl = "https://www.mediafire.com/file/4ma1hfrv4989iez/Apple+Configuration+Modern.zip/file"; break;
                default: alert("Tệp tin này không tồn tại!"); return;
            }
            if (downloadUrl !== "" && downloadUrl !== "#") { window.location.href = downloadUrl; }
        }

        // --- CODE CHỨC NĂNG TINH CHỈNH ĐỘ NHẠY ĐÃ ĐƯỢC TÍCH HỢP ---
        function toggleSensitivityPanel() {
            const panel = document.getElementById('sensPanel');
            if(panel.style.display === 'block') {
                panel.style.display = 'none';
            } else {
                panel.style.display = 'block';
                panel.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
            }
        }

        function toggleStatusEffect(element) {
            element.classList.toggle('selected');
        }

        function startAIAnalysis() {
            const deviceType = document.getElementById('deviceSelect').value;
            if(!deviceType) {
                alert('Vui lòng chọn Hệ điều hành thiết bị của bạn trước!');
                return;
            }

            const overlay = document.getElementById('aiOverlay');
            const spinner = document.getElementById('aiSpinner');
            const checkmark = document.getElementById('aiCheckmark');
            const text = document.getElementById('aiOverlayText');
            const resultBox = document.getElementById('resultSensBox');

            overlay.classList.add('active');
            spinner.style.display = 'block';
            checkmark.style.display = 'none';
            text.innerText = 'Đang Bắt Đầu Phân Tích AI';

            setTimeout(() => {
                spinner.style.display = 'none';
                checkmark.style.display = 'block';
                text.innerText = 'ĐÃ HOÀN THÀNH';

                setTimeout(() => {
                    overlay.classList.remove('active');
                    renderSensitivityData(deviceType);
                    setTimeout(() => {
                        resultBox.scrollIntoView({ behavior: 'smooth', block: 'center' });
                    }, 200);
                }, 1000);
            }, 2500);
        }

        function renderSensitivityData(type) {
            const container = document.getElementById('sensRowsContainer');
            const resultBox = document.getElementById('resultSensBox');
            const titleBox = document.getElementById('resultSensTitle');
            
            let data = [];
            if(type === 'ios12-17') {
                titleBox.innerText = 'ĐỘ NHẠY TỐI ƯU ĐỘC QUYỀN (iOS)';
                data = [
                    { label: "Nhìn Xung Quanh", val: "168" },
                    { label: "Ống Ngắm Hồng Tâm", val: "192" },
                    { label: "Ống Ngắm 2x", val: "188" },
                    { label: "Ống Ngắm 4x", val: "185" },
                    { label: "Ống Ngắm Súng Ngắm", val: "100" },
                    { label: "Nút Camera Tự Do", val: "200" },
                    { label: "Kích thước Nút Bắn", val: "42%" }
                ];
            } else {
                titleBox.innerText = 'ĐỘ NHẠY TỐI ƯU ĐỘC QUYỀN (Android DPI)';
                data = [
                    { label: "Nhìn Xung Quanh", val: "180" },
                    { label: "Ống Ngắm Hồng Tâm", val: "168" },
                    { label: "Ống Ngắm 2x", val: "188" },
                    { label: "Ống Ngắm 4x", val: "185" },
                    { label: "Ống Ngắm Súng Ngắm", val: "100" },
                    { label: "Nút Camera Tự Do", val: "200" },
                    { label: "Kích thước Nút Bắn", val: "42%" }
                ];
            }

            container.innerHTML = data.map(item => `
                <div class="sensitivity-row">
                    <span style="color: #cbd5e1; font-weight:500;">${item.label}:</span>
                    <span style="color: #34d399; font-weight:700; font-family:monospace; font-size:16px;">${item.val}</span>
                </div>
            `).join('');

            resultBox.style.display = 'block';
        }

        function resetForm() {
            clearInterval(countdownInterval);
            document.getElementById('activationKey').value = "";
            document.getElementById('iosSelect').selectedIndex = 0;
            document.getElementById('androidSelect').selectedIndex = 0;
            document.getElementById('deviceSelect').selectedIndex = 0;
            loggedInKeyType = "";
            
            document.querySelectorAll('.status-item').forEach(item => item.classList.remove('selected'));
            document.getElementById('sensPanel').style.display = 'none';
            document.getElementById('resultSensBox').style.display = 'none';

            document.getElementById('accountPageView').style.display = 'none';
            document.getElementById('mainContentCard').style.display = 'block';
            document.getElementById('heroWrapper').style.display = 'block';
            document.getElementById('systemStatusGrid').style.display = 'grid';

            document.getElementById('countdownTimer').style.display = 'none';
            document.getElementById('btnAccount').style.display = 'none';
            document.getElementById('btnAccount').innerText = "Tài Khoản";

            const titleEl = document.getElementById('mainTitle');
            titleEl.innerText = "Hệ Thống Phân Phối Dữ Liệu";
            titleEl.classList.remove('neon-title-style');

            document.getElementById('mainSub').innerText = "Hạ tầng mã hóa tự động tối ưu hóa tệp tin hệ thống và tinh chỉnh cấu hình riêng cho từng dòng thiết bị di động.";

            document.querySelectorAll('.premium-error-container').forEach(el => {
                el.style.display = 'none';
            });

            document.getElementById('step2').classList.remove('active');
            document.getElementById('step3').classList.remove('active');
            document.getElementById('step1').className = "step active";
        }
    </script>
</body>
</html>
