<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to Company CRM</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .welcome-container {
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            text-align: center;
        }
        .btn-custom-outline {
            color: #28a745;
            border-color: #28a745;
        }
        .btn-custom-outline:hover {
            color: #fff;
            background-color: #28a745;
        }
        .feature-list {
            text-align: left;
        }
    </style>
</head>
<body>
    <div class="container welcome-container">
        <h1 class="display-4 mb-4">Welcome to Company CRM</h1>
        <p class="lead">Manage your employees, tasks, and projects efficiently with our CRM system.</p>

        <div class="row mt-5">
            <div class="col-md-6">
                <h2 class="h4">Employee Capabilities</h2>
                <ul class="feature-list">
                    <li>Registration: Employees can register through a dedicated form.</li>
                    <li>Task Management: Access CRM to start working on assigned tasks.</li>
                    <li>Reporting: View daily, weekly, and monthly reports. Check total working hours. Calculate salary based on working hours.</li>
                    <li>Meetings & Appointments: Access links to meetings and appointments.</li>
                    <li>Communication: Chat with admins and fellow employees.</li>
                </ul>
            </div>
            <div class="col-md-6">
                <h2 class="h4">Admin Capabilities</h2>
                <ul class="feature-list">
                    <li>Employee Management: Approve new employee registrations. Register employees to companies based on their certifications.</li>
                    <li>Reporting: Monitor reports for all employees.</li>
                    <li>Project & Task Management: Add projects and tasks for public or specific employees.</li>
                    <li>Communication: Chat with all employees.</li>
                    <li>Monitoring: See all employee login locations.</li>
                    <li>Meeting Management: Create meetings for public or specific employees.</li>
                </ul>
            </div>
        </div>

        <div class="row mt-5">
            <div class="col-md-6">
                <h2 class="h4">Super Admin Capabilities</h2>
                <ul class="feature-list">
                    <li>Multi-Company Management: Move between all companies and act as an admin for each one.</li>
                    <li>Project Oversight: Make projects professional and fix any mistakes.</li>
                </ul>
            </div>
            <div class="col-md-6">
                <h2 class="h4">Advantages of the CRM</h2>
                <ul class="feature-list">
                    <li>Centralized Management: A single platform for managing employees, tasks, and projects.</li>
                    <li>Enhanced Communication: Built-in chat system for seamless communication between employees and admin.</li>
                    <li>Comprehensive Reporting: Detailed reports on employee performance and working hours.</li>
                    <li>Task Automation: Automated task assignments and tracking.</li>
                    <li>Multi-Role Support: Clear role-based access and capabilities ensuring appropriate access controls.</li>
                </ul>
            </div>
        </div>

        <div class="card shadow-lg">
            <div class="card-body">
                <h5 class="card-title">Get Started</h5>
                <p class="card-text">Register as an individual or a company to start using the CRM system.</p>
                <div class="mbr-section-btn mt-3">
                    <a class="btn btn-success btn-lg mx-2" href="{{ route('users.create.employs') }}" target="_blank">
                        تسجيل أفراد
                    </a>
                    <a class="btn btn-custom-outline btn-lg mx-2" href="{{ route('companies.create',['country'=>66]) }}" target="_blank">
                        تسجيل شركات
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>
