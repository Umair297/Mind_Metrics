@extends('home')

@section('content')

    <!-- FullCalendar CSS -->
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.0/main.min.css" rel="stylesheet">
    <!-- FullCalendar JS -->
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.0/main.min.js"></script>
    <!-- Custom CSS -->
     
<style>
  .img-fluid {
    max-width: 50% !important;
    height: auto;
}
  .btn-primary{
        background-color: #EE2D7B !important;
        border: none;
    }
    .btn-primary:hover{
        background-color: #EE2D7B !important;
        border: none;
    }
    .px-md-4 {
        padding-right: 0rem !important;
        padding-left: 14rem !important;
    }
    body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background: #f8f9fa;
        }

        #calendar {
            width: 800px !important;
            margin: 20px auto;
            border-radius: 10px;
            background-color: #fff;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
        }

        .fc-header-toolbar {
            background: #f1f1f1;
            padding: 10px;
            border-bottom: 1px solid #e0e0e0;
            border-radius: 10px 10px 0 0;
        }

        .fc-toolbar-title {
            font-size: 20px;
            color: #333;
            font-weight: bold;
        }

        .fc-button {
            background: #EE2D7B;
            color: white;
            border: none;
            border-radius: 5px;
            padding: 5px 12px;
            font-size: 14px;
            transition: 0.3s;
        }

        .fc-button:hover {
            background: #EE2D7B;
            color: #fff;
        }

        .fc-daygrid-event {
            background: #EE2D7B;
            color: #ffffff !important;
            border: none;
            border-radius: 5px;
            padding: 2px 6px;
            font-size: 12px;
            margin: 2px;
        }

        .fc-daygrid-day {
            border: 1px solid #eaeaea;
        }

        .fc-day-today {
            background: #e8f5ff;
            border: 2px solid #EE2D7B;
        }

        .fc-button-group > .fc-button {
            margin-right: 5px;
        }
</style>

<div class="card bg-transparent shadow-none border-0">
  <div class="card-body row p-0 g-6" >
    <!-- Left Section -->
    <div class="col-xl-12 mt-5">
      <div class="card">
      <div class="container">
  <div class="row align-items-center">
    
    <!-- Left Column -->
    <div class="col-md-7">
    <div class="card-body p-2">
        <h5 class="card-title mb-2" style="font-size: 25px;">
          Welcome back, {{ Auth::user()->name }}! ✨
        </h5>
        <p class="mb-4">
        Stay updated on your ongoing cases, track recent service activity, and access all important details 
        instantly from your personalized dashboard, ensuring you're always informed and in control every step.
        </p>

        <a href="{{ route('assessments.index') }}" class="btn btn-primary me-2 mb-2">Manage Assessments</a>
        <a href="{{ route('services.index') }}" class="btn btn-primary mb-2">Manage Services</a>
      </div>
    </div>

    <!-- Right Column (Image) -->
    <div class="col-md-5 text-center">
    <div class="card-body p-2">
        <img
          src="http://localhost/cms/public/dashboard/assets/img/illustrations/card-advance-sale.png"
          height="100"
          alt="view sales"
          class="img-fluid" />
      </div>
    </div>

  </div>
</div>

      </div>
    </div>
  </div>
</div>

              
<div class="container-xxl flex-grow-1 container-p-y">
  <div class="row g-6">
<!-- Total Users -->
@if(Auth::user()->role === 'admin')
<div class="col-lg-4 col-sm-6">
  <div class="card card-border-shadow-primary h-100">
    <div class="card-body">
      <div class="d-flex align-items-center mb-2">
        <div class="avatar me-4">
          <span class="avatar-initial rounded bg-label-primary">
            <i class="ti ti-users ti-28px"></i>
          </span>
        </div>
        <h4 class="mb-0">{{ $totalUsers }}</h4>
      </div>
      <p class="mb-1">Total Users</p>
    </div>
  </div>
</div>

<!-- Users Admin -->
<div class="col-lg-4 col-sm-6">
  <div class="card card-border-shadow-warning h-100">
    <div class="card-body">
      <div class="d-flex align-items-center mb-2">
        <div class="avatar me-4">
          <span class="avatar-initial rounded bg-label-warning">
          <i class="ti ti-user-circle ti-28px"></i>
          </span>
        </div>
        <h4 class="mb-0">{{ $adminUsers }}</h4>
      </div>
      <p class="mb-1">Admin</p>
    </div>
  </div>
</div>

<!-- Users Client -->
<div class="col-lg-4 col-sm-6">
  <div class="card card-border-shadow-danger h-100">
    <div class="card-body">
      <div class="d-flex align-items-center mb-2">
        <div class="avatar me-4">
          <span class="avatar-initial rounded bg-label-danger">
          <i class="ti ti-users ti-28px"></i>
          </span>
        </div>
        <h4 class="mb-0">{{ $clientUsers }}</h4>
      </div>
      <p class="mb-1">Client</p>
    </div>
  </div>
</div>
@endif


 <!-- Total Assessment -->
 <div class="col-lg-3 col-sm-6">
  <div class="card card-border-shadow-primary h-100">
    <div class="card-body">
      <div class="d-flex align-items-center mb-2">
        <div class="avatar me-4">
          <span class="avatar-initial rounded bg-label-primary">
          <i class="ti ti-inbox ti-28px"></i>
          </span>
        </div>
        <h4 class="mb-0">{{ $receivedAssessment }}</h4>
      </div>
      <p class="mb-1">Status Received</p>
    </div>
  </div>
</div>


<div class="col-lg-3 col-sm-6">
  <div class="card card-border-shadow-warning h-100">
    <div class="card-body">
      <div class="d-flex align-items-center mb-2">
        <div class="avatar me-4">
          <span class="avatar-initial rounded bg-label-warning">
          <i class="ti ti-circle-check ti-28px"></i>
          </span>
        </div>
        <h4 class="mb-0">{{ $assignedAssessment }}</h4>
      </div>
      <p class="mb-1">Status Assigned</p>
    </div>
  </div>
</div>

<div class="col-lg-3 col-sm-6">
  <div class="card card-border-shadow-danger h-100">
    <div class="card-body">
      <div class="d-flex align-items-center mb-2">
        <div class="avatar me-4">
          <span class="avatar-initial rounded bg-label-danger">
          <i class="ti ti-loader-2 ti-28px"></i>
          </span>
        </div>
        <h4 class="mb-0">{{ $in_ProgressAssessment }}</h4>
      </div>
      <p class="mb-1">Status In Progress</p>
    </div>
  </div>
</div>

<div class="col-lg-3 col-sm-6">
  <div class="card card-border-shadow-danger h-100">
    <div class="card-body">
      <div class="d-flex align-items-center mb-2">
        <div class="avatar me-4">
          <span class="avatar-initial rounded bg-label-danger">
          <i class="ti ti-circle-check ti-28px"></i>

          </span>
        </div>
        <h4 class="mb-0">{{ $completedAssessment }}</h4>
      </div>
      <p class="mb-1">Status Completed</p>
    </div>
  </div>
</div>


<!-- Total Services -->
<div class="col-lg-4 col-sm-6">
    <div class="card card-border-shadow-primary h-100">
        <div class="card-body">
            <div class="d-flex align-items-center mb-2">
                <div class="avatar me-4">
                    <span class="avatar-initial rounded bg-label-primary">
                    <i class="menu-icon tf-icons ti ti-briefcase ti-28px"></i>
                    </span>
                </div>
                <!-- Display total services dynamically -->
                <h4 class="mb-0">{{ $totalServices }}</h4>
            </div>
            <p class="mb-1">Total Services</p>
        </div>
    </div>
</div>

<!-- Assessment -->
<div class="col-lg-4 col-sm-6">
    <div class="card card-border-shadow-warning h-100">
        <div class="card-body">
            <div class="d-flex align-items-center mb-2">
                <div class="avatar me-4">
                    <span class="avatar-initial rounded bg-label-warning">
                    <i class="ti ti-circle-check ti-28px"></i>
                    </span>
                </div>
                <!-- Display assigned services dynamically -->
                <h4 class="mb-0">{{ $assignedServices }}</h4>
            </div>
            <p class="mb-1">Status Assigned</p>
        </div>
    </div>
</div>

<!-- Role Received -->
<div class="col-lg-4 col-sm-6">
    <div class="card card-border-shadow-danger h-100">
        <div class="card-body">
            <div class="d-flex align-items-center mb-2">
                <div class="avatar me-4">
                    <span class="avatar-initial rounded bg-label-danger">
                    <i class="ti ti-inbox ti-28px"></i>
                    </span>
                </div>
                <h4 class="mb-0">{{ $receivedServices }}</h4>
            </div>
            <p class="mb-1">Status Received</p>
        </div>
    </div>
</div>


<div class="container mt-5">
  <div class="row">
    <!-- First Donut Chart -->
    <div class="col-md-6 mb-4">
      <div class="card shadow">
        <div class="card-body">
          <h5 class="card-title text-center">Services</h5>
          <canvas id="donutChart1" height="150"></canvas>
        </div>
      </div>
    </div>

    <!-- Second Donut Chart -->
    <div class="col-md-6 mb-4">
      <div class="card shadow">
        <div class="card-body">
          <h5 class="card-title text-center">Assessments</h5>
          <canvas id="donutChart2" height="150"></canvas>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  // Chart 1
  const ctx1 = document.getElementById('donutChart1').getContext('2d');
  const donutChart1 = new Chart(ctx1, {
    type: 'doughnut',
    data: {
      labels: ['Assigned', 'Received'],
      datasets: [{
        data: [{{ $assignedServices }}, {{ $receivedServices }}],
        backgroundColor: ['#28a745', '#ffc107'],
        borderWidth: 1
      }]
    },
    options: {
      cutout: '70%',
      responsive: true,
      plugins: {
        legend: {
          position: 'bottom'
        }
      }
    }
  });

  // Chart 2 - Just a sample (replace with dynamic data)
  const ctx2 = document.getElementById('donutChart2').getContext('2d');
  const donutChart2 = new Chart(ctx2, {
    type: 'doughnut',
    data: {
      labels: ['Received', 'Assigned', 'In Progress', 'Completed'],
      datasets: [{
        data: [{{ $receivedAssessment }}, {{  $assignedAssessment }}, {{  $in_ProgressAssessment }}, {{ $completedAssessment  }}],
        backgroundColor: ['#ffc107', '#28a745', '#0d6efd', '#6c757d'],
        borderWidth: 1
      }]
    },
    options: {
      cutout: '70%',
      responsive: true,
      plugins: {
        legend: {
          position: 'bottom'
        }
      }
    }
  });
</script> 

    <div class="container-xxl flex-grow-1 container-p-y p-0">
      <div class="row g-6">
          <div class="col-lg-12">
              <div class="card">
                  <div class="card-body">
                      <h5 class="card-title">Monthly Report</h5>
                        <canvas id="monthlyChart"></canvas>
                  </div>
              </div>
          </div>
      </div>
  </div>
  <div class="container-xxl flex-grow-1 container-p-y p-0">
      <div class="row g-6">
          <div class="col-lg-12">
              <div class="card">
              <canvas id="attendanceLineChart"></canvas>
              </div>
          </div>
      </div>
  </div>
  <div class="container-xxl flex-grow-1 container-p-y p-0">
      <div class="row g-6">
          <div class="col-lg-12">
              <div class="card">
              <div id="calendar"></div>
              </div>
          </div>
      </div>
  </div>
  </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var calendarEl = document.getElementById('calendar');

        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            events: '{{ route("calendar.data") }}',
            eventColor: '#EE2D7B', 
        });

        calendar.render();
    });
</script>


@endsection
<!-- Include Chart.js Library -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
 
<script> 
    document.addEventListener("DOMContentLoaded", function () {
        var ctx = document.getElementById('monthlyChart').getContext('2d');

        // Static data for the chart
        var labels = ["January", "February", "March", "April", "May", "June", "July"];
        var totalCustomersg = [50, 60, 70, 80, 90, 100, 110];
        var submittedCasesg = [30, 40, 50, 60, 70, 80, 90];
        var completedCasesg = [20, 25, 35, 45, 55, 65, 75];

        var monthlyChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [
                    {
                        label: 'Dentists Trained',
                        data: totalCustomersg,
                        backgroundColor: 'rgba(238, 45, 123, 0.6)',
                        borderColor: '#EE2D7B',
                        borderWidth: 1
                    },
                    {
                        label: 'Cases Submitted',
                        data: submittedCasesg,
                        backgroundColor: 'rgba(255, 179, 60, 0.6)', 
                        borderColor: '#FFB33C',
                        borderWidth: 1
                    },
                    {
                        label: 'Cases Completed',
                        data: completedCasesg,
                        backgroundColor: 'rgba(238, 45, 123, 0.3)', 
                        borderColor: '#EE2D7B',
                        borderWidth: 1
                    }
                ]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    });
</script>

<script>
document.addEventListener("DOMContentLoaded", function () {
    var ctx = document.getElementById('attendanceLineChart').getContext('2d');
    var attendanceChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: ["Mon", "Tue", "Wed", "Thu", "Fri", "Sat"],
            datasets: [{
                label: 'Attendance Count',
                data: [32, 28, 35, 30, 40, 20],
                backgroundColor: 'rgba(238, 45, 123, 0.2)', // light fill
                borderColor: '#EE2D7B', // main line color
                borderWidth: 2,
                tension: 0.4, // smooth curve
                fill: true
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
});
</script>

